<?php
//the mails do not send ,  due to goggle has removed third mail api, if you want it to remove the server setting and smtp.php simple 
//and it should only send when the site is online
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/src/Exception.php';
require 'vendor/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/src/SMTP.php';

session_start();

if(isset($_POST['send'])){
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    

   
    //Load composer's autoloader

    $mail = new PHPMailer(true);                            
    try {
        //Server settings
        $mail->isSMTP();                                     
        $mail->Host = 'smtp.gmail.com';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = 'tyungquoil@gmail.com';     
        $mail->Password = 'tyungquoil12345';             
                              
        $mail->SMTPSecure =  PHPMailer::ENCRYPTION_SMTPS;                            
        $mail->Port = 465;                                   

        //Send Email
        $mail->setFrom($email,$name);
        
        //Recipients
        $mail->addAddress('tyungquoil@gmail.com');              
        $mail->addReplyTo($email);
        
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'New Message from tyungquoil.com';
        $mail->Body    = 'Name: ' . $name . '<br>' . 'Subject: ' . $subject . '<br>' . 'Message: ' . $message;
        
        $mail->send();
		
       $_SESSION['result'] = 'Message has been sent';
	   $_SESSION['status'] = 'ok';
    } catch (Exception $e) {
	   $_SESSION['result'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
	   $_SESSION['status'] = 'error';
    }
	
	header("location: index.php");

}


