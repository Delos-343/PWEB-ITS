<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// The folder location depends on your installation
// You can also use composer to install this library
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer();

// Get the $_POST value
// ...

// Saving into the database
// ...

// Sending the email
try {
    // Server settings (DO NOT CHANGE THIS)
    $mail->isSMTP();                             //Send using SMTP
    $mail->Host       = 'smtp.mailtrap.io';      //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                    //Enable SMTP authentication
    $mail->Username   = 'e962e93a547f61';        //SMTP username
    $mail->Password   = 'b455b8564a9420';        //SMTP password
    $mail->SMTPSecure = 'tls';                   //Enable TLS encryption
    $mail->Port       = 2525;                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Setup sender and recipients
    $mail->setFrom('<your email>', '<your name>');                              // Sender (CHANGE THIS)
    $mail->addAddress('user submitted email address', 'user submitted name');   //Add a recipient (CHANGE THIS)

    // Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Your message has been delivered';
    $mail->Body    = '<h1>Dear, {user submitted name}</h1>
                        <p>Your message: {user submitted message} </b> has been delivered succesfully.</p>'; // (CHANGE THIS)
                        
    $mail->AltBody = 'Dear User. Your message has been delivered successfully.';

    // Send the message
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>