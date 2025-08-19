<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Mailer;

class AuthController extends Controller
{
  // Display the registration form
  public function register()
  {
    $this->generateCsrfToken();

    // Prepare error message and form data
    $errorMessage = $this->getSessionData('error_message');
    $formData = $this->getSessionData('form_data', [
      'firstName' => '',
      'lastName' => '',
      'email' => ''
    ]);

    $this->view('auth/register', [
      'title' => 'Register',
      'error_message' => $errorMessage,
      'form_data' => $formData,
      'csrf_token' => $_SESSION['csrf_token']
    ], 'auth');
  }

  public function handleRegister()
  {

    $this->validateCsrfToken($_POST['csrf_token'], 'register');

    // Sanitize and validate inputs
    $firstName = $this->sanitize($_POST['firstName']);
    $lastName = $this->sanitize($_POST['lastName']);
    $email = $this->sanitize($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['cpassword'];

    // Save inputs to session so they are retained
    $this->setSessionData('form_data', [
      'firstName' => $firstName,
      'lastName' => $lastName,
      'email' => $email
    ]);

    // Validate user inputs
    $this->validateInputs($firstName, $lastName, $email, $password, $confirmPassword);

    // Check if email already exists
    $db = Database::getInstance();
    if ($this->isEmailExists($db, $email)) {
      $this->redirectWithError('An account with this email already exists. Do you wish to login?', 'register');
    }

    $userName = $this->generateUniqueUsername($db, $firstName, $lastName);
    $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);

    $verificationToken = bin2hex(random_bytes(32));
    $verificationTokenExpiry = date('Y-m-d H:i:s', strtotime('+24 hours'));

    // Store the user in the database with the verification token and expiry
    $this->saveUser($db, $firstName, $lastName, $userName, $email, $hashedPassword, $verificationToken, $verificationTokenExpiry);

    // Send verification email
    $this->sendVerificationEmail($email, $verificationToken, $userName);

    // Clear session data after successful registration
    unset($_SESSION['form_data']);

    // Redirect to the verify page with a success message
    $this->redirectWithSuccess('Your account has been successfully created! Please verify your email to proceed.', 'verify_email');
  }


  // Display the login form
  public function login()
  {
    $this->generateCsrfToken();

    // Prepare error and success messages
    $errorMessage = $this->getSessionData('error_message');
    $successMessage = $this->getSessionData('success_message');
    $formData = $this->getSessionData('form_data', ['email_or_username' => '']);

    $this->view('auth/login', [
      'title' => 'Login',
      'error_message' => $errorMessage,
      'success_message' => $successMessage,
      'csrf_token' => $_SESSION['csrf_token'],
      'form_data' => $formData
    ], 'auth');
  }

  // Handle login logic
  public function handleLogin()
  {
    $this->validateCsrfToken($_POST['csrf_token'], 'login');

    $input = $this->sanitize($_POST['email_or_username']);
    $password = $_POST['password'];

    $this->setSessionData('form_data', ['email_or_username' => $input]);

    if (empty($input)) {
      $this->redirectWithError('Please enter your Email or Username.', 'login');
    }

    // Check if input is an email or username
    $db = Database::getInstance();
    $user = $this->findUserByEmailOrUsername($db, $input);

    if ($user && password_verify($password, $user['password'])) {
      // $this->validateUserVerification($user, 'login');
      $this->loginUser($user);
    } else {
      $this->redirectWithError('Invalid username/email or password.', 'login');
    }
  }

  public function verify()
  {
    // Check if a success message exists
    $message = $this->getSessionData('success_message') ?? 'Please verify your email to proceed.';

    // Load the verification view and pass the message
    $this->view('auth/verify', ['message' => $message], 'auth');
  }


  // Handle email verification
  public function verifyEmail()
  {

    $token = $_GET['token'] ?? null;

    if (!$token) {
      $this->redirectWithError('Invalid verification token.', 'register');
    }

    $db = Database::getInstance();
    $user = $this->findUserByToken($db, $token);

    if (!$user) {
      $this->redirectWithError('Invalid or expired verification token.', 'register');
    }

    // Check if the token has expired

    $currentDateTime = new \DateTime('now', new \DateTimeZone('UTC'));
    $tokenExpiryDateTime = new \DateTime($user['verification_token_expiry'], new \DateTimeZone('UTC'));

    if ($currentDateTime->getTimestamp() > $tokenExpiryDateTime->getTimestamp()) {
      // Token has expired, show a page to resend the verification email
      $this->view('auth/expired_token', [
        'title' => 'Verification Token Expired',
        'email' => $user['email']
      ], 'auth');
      return;
    }
    // Verify the email if the token is valid and not expired
    $this->verifyUserEmail($db, $user);

    // Optionally set a success message here
    $this->redirectWithSuccess('Your email has been successfully verified!', 'login');
  }

  public function resendVerificationEmail()
  {
    $email = $_POST['email'] ?? null;

    if (!$email) {
      $this->redirectWithError('Invalid request.', 'register');
    }

    $db = Database::getInstance();
    $user = $this->isEmailExists($db, $email);

    if (!$user) {
      $this->redirectWithError('No account found with that email address.', 'register');
    }

    if ($user['verified']) {
      $this->redirectWithError('This email is already verified. Please login.', 'login');
    }

    // Generate a new token and expiration date
    $newToken = bin2hex(random_bytes(32));
    $newExpiry = date('Y-m-d H:i:s', strtotime('+24 hours'));

    // Update the user record with the new token and expiry
    $db->query(
      "UPDATE users SET verification_token = ?, verification_token_expiry = ? WHERE email = ?",
      [$newToken, $newExpiry, $email]
    );

    // Send the new verification email
    $this->sendVerificationEmail($email, $newToken, $user['username']);

    $this->redirectWithSuccess('A new verification email has been sent to your email address.', 'login');
  }



  // Private helper methods

  private function generateCsrfToken()
  {
    if (empty($_SESSION['csrf_token'])) {
      $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
  }

  private function getSessionData($key, $default = null)
  {
    $data = $_SESSION[$key] ?? $default;
    unset($_SESSION[$key]);
    return $data;
  }

  private function setSessionData($key, $value)
  {
    $_SESSION[$key] = $value;
  }

  // private function setSessionData($key, $value, $type = 'message')
  // {
  //   $_SESSION[$key][$type] = $value;
  // }

  // private function getSessionData($key, $type = 'message', $default = null)
  // {
  //   $data = $_SESSION[$key][$type] ?? $default;
  //   unset($_SESSION[$key][$type]);
  //   return $data;
  // }


  private function validateCsrfToken($token, $redirectUrl)
  {
    if (!isset($token) || !isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
      $this->redirectWithError('Invalid CSRF token.', $redirectUrl);
    }
    unset($_SESSION['csrf_token']);
  }


  private function sanitize($input)
  {
    return htmlspecialchars(trim($input));
  }

  private function validateInputs($firstName, $lastName, $email, $password, $confirmPassword)
  {
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword)) {
      $this->redirectWithError('All fields are required.', 'register');
    }

    if (!preg_match("/^[a-zA-Z]{3,30}$/", $firstName)) {
      $this->redirectWithError(
        'First name should contain only alphabetic characters and be between 3 and 30 characters.',
        'register'
      );
    }

    if (!preg_match("/^[a-zA-Z]{3,30}$/", $lastName)) {
      $this->redirectWithError(
        'Last name should contain only alphabetic characters and be between 3 and 30 characters.',
        'register'
      );
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->redirectWithError('Please enter a valid email address.', 'register');
    }

    if (
      strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) ||
      !preg_match("/\d/", $password)
    ) {
      $this->redirectWithError('Password must be at least 8 characters long, contain one
  uppercase letter, one lowercase letter, and one number.', 'register');
    }

    if ($password !== $confirmPassword) {
      $this->redirectWithError('Passwords do not match.', 'register');
    }
  }

  private function isEmailExists($db, $email)
  {
    return $db->query("SELECT * FROM users WHERE email = ?", [$email])->fetch();
  }

  private function generateUniqueUsername($db, $firstName, $lastName)
  {
    $userName = strtolower("{$firstName}_{$lastName}");
    $baseUserName = $userName;
    $counter = 1;

    while ($this->isUsernameExists($db, $userName)) {
      $userName = $baseUserName . '_' . $counter;
      $counter++;
    }
    return $userName;
  }


  private function isUsernameExists($db, $userName)
  {
    return $db->query("SELECT * FROM users WHERE username = ?", [$userName])->fetch();
  }

  private function saveUser($db, $firstName, $lastName, $userName, $email, $hashedPassword, $verificationToken, $verificationTokenExpiry)
  {
    try {
      $db->query(
        "INSERT INTO users (firstname, lastname, username, email, password, verification_token, verification_token_expiry, verified) 
      VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
        [$firstName, $lastName, $userName, $email, $hashedPassword, $verificationToken, $verificationTokenExpiry, 0]
      );
    } catch (\Exception $e) {
      error_log("Error saving user: " . $e->getMessage());
      $this->redirectWithError('Error saving user to the database.', 'register');
    }
  }


  private function sendVerificationEmail($email, $token, $userName)
  {
    $verificationUrl = $_ENV['URL'] . "/verify?token=" . urlencode($token);
    $subject = "Verify Your Email Address";
    $body = $this->generateEmailBody($verificationUrl, $userName);

    Mailer::send($email, $subject, $body);
  }

  private function generateEmailBody($verificationUrl, $userName)
  {
    return "
  <html>

  <body>
    <h1 class='h3'>Verify Your Email Address</h1>
    <p>Hello {$userName},</p>
    <p>Thank you for registering. Please verify your email by clicking the link below:</p>
    <a class='btn btn-primary-subtle' href='{$verificationUrl}'>Verify Email</a>
    <p>If the button doesn't work, copy and paste this URL into your browser:</p>
    <a href='{$verificationUrl}'>{$verificationUrl}</a>
  </body>

  </html>
  ";
  }

  private function redirectWithError($message, $redirectUrl)
  {
    $this->setSessionData('error_message', $message);
    header("Location: /{$redirectUrl}");
    exit;
  }

  private function redirectWithSuccess($message, $redirectUrl)
  {
    $this->setSessionData('success_message', $message);
    header("Location: /{$redirectUrl}");
    exit;
  }

  private function findUserByEmailOrUsername($db, $input)
  {
    return $db->query("SELECT * FROM users WHERE email = ? OR username = ?", [$input, $input])->fetch();
  }

  private function validateUserVerification($user, $redirectUrl)
  {
    if (!$user['verified']) {
      $this->redirectWithError('Your email address is not verified. Please check your email.', $redirectUrl);
    }
  }

  private function loginUser($user)
  {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user'] = $user['username'];

    // Optionally check if the user is verified and set a message
    if (!$user['verified']) {
      $this->setSessionData('error_message', 'Your email address is not verified. Please check your email to verify your account.');
    }

    header("Location: /dashboard/{$_SESSION['user']}");
    exit;
  }

  private function findUserByToken($db, $token)
  {
    return $db->query("SELECT * FROM users WHERE verification_token = ?", [$token])->fetch();
  }

  private function verifyUserEmail($db, $user)
  {
    $db->query("UPDATE users SET verified = 1, verification_token = NULL WHERE id = ?", [$user['id']]);
    $this->redirectWithSuccess('Your email has been verified. You can now login.', 'login');
  }
}
