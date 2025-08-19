<?php

namespace App\Controllers;

use App\Core\Mailer;
use App\Core\Controller;

class HomeController extends Controller
{
  public function index()
  {
    // Check for the flash message in the session
    $flash_message = isset($_SESSION['flash_message']) ? $_SESSION['flash_message'] : '';

    // Clear the flash message after retrieving it
    unset($_SESSION['flash_message']);

    // Prepare data to pass to the view
    $data = [
      'title' => 'Welcome to the Lagos State University Information Data Research',
      'message' => 'This is the home page of the site.',
      'flash_message' => $flash_message // Include flash message
    ];

    // Load the home view and pass the data
    $this->view('home', $data);
  }



  public function handleContactForm()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Retrieve and sanitize form data
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $message = htmlspecialchars($_POST['message']);

      // Prepare email details
      $subject = 'New Contact Form Submission';
      $body = "<h3>New Message from $name</h3>
                 <p><strong>Email:</strong> $email</p>
                 <p><strong>Message:</strong><br>$message</p>";

      // Initialize flash message
      $flash_message = '';

      // Attempt to send the email
      if (Mailer::send('manager.datican@gmail.com', $subject, $body)) {
        $flash_message = 'Message has been sent successfully!';
      } else {
        $flash_message = 'Message could not be sent.';
      }

      // Store flash message in session
      $_SESSION['flash_message'] = $flash_message;

      // Redirect to home page
      header("Location: /");
      exit();
    }
  }
}
