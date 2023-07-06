<!-- bez vendor, cmoposer.json i composer.lock neće raditi, a imaš video uputstvo kako to napraviti  -->
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';


//get data from form
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
// preparing mail content
$messagecontent ="Name = ". $name . "<br>Email = " . $email . "<br>Message =" . $message;
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'ssl://smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'akialeksej@gmail.com';                     //SMTP username --- tu upiši mejl koji ti je hostovan sa websajtom
    $mail->Password   = 'wufynajjfgmzdgon';                               //SMTP password --- to na gmail-u moraš uraditi kako bi dobio taj kod, imaš video uputstvo
   // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS` --- port od hostinga
    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('akialeksej@gmail.com', 'Joe User');     //Add a recipient
   //  $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
   //  $mail->addCC('cc@example.com');
   //  $mail->addBCC('bcc@example.com');
    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   // $mail->addAttachment('photo.jpeg', 'photo.jpeg');    //Optional name
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = $messagecontent;
    
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>