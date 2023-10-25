<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php"; //PHPMailer Object
 
 
$txt = $_POST["news_email"].PHP_EOL;
file_put_contents(__DIR__."/newsLetterEmailList.txt", $txt,FILE_APPEND);


$mail_to = $_POST["news_email"];
$email = filter_var(trim($_POST["news_email"]), FILTER_SANITIZE_EMAIL);

$mail = new PHPMailer(true); //From email address and name


//Enable SMTP debugging.
// $mail->SMTPDebug = 3;
//Set PHPMailer to use SMTP.
$mail->isSMTP();
//Set SMTP host name
$mail->Host = "smtp.office365.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;
//Provide username and password
$mail->Username = "no-reply@viola.ae";
$mail->Password = 'Yuv20978';
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "SSL/TLS";
//Set TCP port to connect to
$mail->Port = 587;

$mail->From = "no-reply@viola.ae";


$content = '<html>
            <head>
            <title>HTML email</title>
            </head>
            <body><table>
            <tr>
            <td>Hello  '.$email.'</td>
            </tr>
            <tr>
            <td>Thank you for subscribing to our newsletter.</td>
            </tr>
            </table>
            </body>
            </html>';


$mail->CharSet = 'UTF-8';
$mail->addAddress($_POST["news_email"], 'Viola Communication');


$mail->isHTML(true);
$mail->Subject = "Viola Communication - Subscribe Form";
$mail->Body = $content;
$mail->AltBody = "This is the plain text version of the email content";

if (!$mail->send()) {
    $host = $_SERVER['HTTP_HOST'];
//        $uri = $_SERVER['REQUEST_URI'];
    $uriPage = "https://" . $host;
    $data = ['message' => "Please Try Again Later", 'status' => 'error'];
    echo json_encode($data);
//        header("Location: $uriPage");
//    echo 'Oops! Something went wrong, we couldn\'t send your message.';

} else {


    $servername = "localhost";
    $username = "urkkqqzuzk";
    $password = "xPtQDTN3GA";
    $dbname = "urkkqqzuzk";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        $data = [ 'message' => "Connection failed", 'status' => 'error' ];
    }else{

        $sql = "INSERT INTO newsletter ( useremail, created_at) VALUES ('". $email ."', Now())";

        if (mysqli_query($conn, $sql)) {
            $data = [ 'message' => 'Thank You For Subscribing!', 'status' => 'success' ];
        } else {
            $data = [ 'message' => "Please Try Again Later", 'status' => 'error' ];
        }

    }


    $host = $_SERVER['HTTP_HOST'];
//        $uri = $_SERVER['REQUEST_URI'];
    $uriPage = "https://" . $host;
     
    echo json_encode($data);
//        header("Location: $uriPage");

 
}

