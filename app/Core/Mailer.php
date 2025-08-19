<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
  public static function send($to, $subject, $body)
  {
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = $_ENV['SMTP_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['SMTP_USER'];
    $mail->Password = $_ENV['SMTP_PASS'];
    $mail->SMTPSecure = $_ENV['SMTP_SECURE'];
    $mail->Port = $_ENV['SMTP_PORT'];

    // $mail->SMTPDebug = 2;

    $mail->setFrom('manager.datican@gmail.com', 'Mucidar');

    $mail->addAddress($to);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;


    // Attempt to send the email and capture success/failure
    if (!$mail->send()) {
      // Return false and the error message instead of throwing an exception
      // return ['success' => false, 'error' => $mail->ErrorInfo];
      die($mail->ErrorInfo);
    }

    return ['success' => true]; // Indicate success
  }
}
