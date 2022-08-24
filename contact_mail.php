<?php
 
  $mail_to = "marketing@viola.ae";
  $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["userName"])));
  $email = filter_var(trim($_POST["userEmail"]), FILTER_SANITIZE_EMAIL);
  $phone = trim($_POST["phone"]);
  $message = trim($_POST["content"]);
  
 
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  
  require_once "vendor/autoload.php"; //PHPMailer Object 
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
    $mail->Password = 'BxOmlZpkN14kAbx';                           
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "SSL/TLS";                           
    //Set TCP port to connect to
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
      <td>'.$name.'</td> 
      </tr>
      <tr>
      <td> Email:</td> 
      <td>'.$email.'</td> 
      </tr>
      <tr>
      <td> Phone No.:</td> 
      <td>'.$phone.'</td> 
      </tr>
      <tr>
      <td> Message:</td> 
      <td>'.$message.'</td> 
      </tr>
      </table>
      </body>
      </html>';
      
        
        $mail->CharSet = 'UTF-8';
        $mail->addAddress("ahmed.zain@viola.ae", 'Viola Communication'); 
         
         
        $mail->isHTML(true); 
        $mail->Subject = "Viola Communication - Contact Us"; 
        $mail->Body = $content;
        $mail->AltBody = "This is the plain text version of the email content"; 
       
        if(!$mail->send()) 
        {
             
                echo 'Oops! Something went wrong, we couldn\'t send your message.';
              
        }else{   
               
                echo 'Thank You! Your message has been sent.';
                 
        }
      
      
        
  ?>