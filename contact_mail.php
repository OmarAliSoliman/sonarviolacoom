<?php

$mail_to = "marketing@viola.ae";
$name = str_replace(array("\r", "\n"), array(" ", " "), strip_tags(trim($_POST["userName"])));
$email = filter_var(trim($_POST["userEmail"]), FILTER_SANITIZE_EMAIL);
$phone = trim($_POST["phone"]);
$message = trim($_POST["content"]);

// Additional PHP validations
if (empty($name) || empty($email) || empty($phone) || empty($message)) {
    $data = ['message' => 'Please fill out all fields', 'status' => 'error'];
    echo json_encode($data);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $data = ['message' => 'Invalid email format', 'status' => 'error'];
    echo json_encode($data);
    exit;
}

if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
    $data = ['message' => 'Name can only contain letters and spaces', 'status' => 'error'];
    echo json_encode($data);
    exit;
}

if (!preg_match('/^[0-9+\-() ]+$/', $phone)) {
    $data = ['message' => 'Invalid phone number format', 'status' => 'error'];
    echo json_encode($data);
    exit;
}

if (!isValidContent($message)) {
  $data = ['message' => 'Content cannot contain script or HTML tags', 'status' => 'error'];
  echo json_encode($data);
  exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = "smtp.office365.com";
    $mail->SMTPAuth = true;
    $mail->Username = "no-reply@viola.ae";
    $mail->Password = 'Yuv20978';
    $mail->SMTPSecure = "SSL/TLS";
    $mail->Port = 587;

    $mail->From = "no-reply@viola.ae";

    $content = '<html>
      <head>
      <title></title>
      </head>
      <body><table> 
      <tr>
      <td colspan="2">Hello, </td> 
      </tr>
      <tr>
      <td> Name:</td> 
      <td>' . $name . '</td> 
      </tr>
      <tr>
      <td> Email:</td> 
      <td>' . $email . '</td> 
      </tr>
      <tr>
      <td> Phone No.:</td> 
      <td>' . $phone . '</td> 
      </tr>
      <tr>
      <td> Message:</td> 
      <td>' . $message . '</td> 
      </tr>
      </table>
      </body>
      </html>';

    $mail->CharSet = 'UTF-8';
    $mail->addAddress("marketing@viola.ae", 'Viola Communication');
    $mail->isHTML(true);
    $mail->Subject = "Viola Communication - Contact Us";
    $mail->Body = $content;
    $mail->AltBody = "This is the plain text version of the email content";

    $mail->send();

    $data = ['message' => 'Thank you', 'status' => 'success'];
    echo json_encode($data);
} catch (Exception $e) {
    $data = ['message' => 'Please try again later', 'status' => 'error'];
    echo json_encode($data);
}

function isValidContent($content) {
  // Regular expression to check if content contains script or HTML tags
  return !preg_match('/<(.*?)script(.*?)>|<(.*?)\/(.*?)script(.*?)>|<(.*?)style(.*?)>|<(.*?)\/(.*?)style(.*?)>|<.*?>/', $content);
}
?>
