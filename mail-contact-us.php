<?php
ob_start();
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once('PHPMailer/Exception.php');
require_once('PHPMailer/PHPMailer.php');
require_once('PHPMailer/SMTP.php');


if(isset($_POST['mail-contact-us'])){
    $name = $_REQUEST["name"];
    $email = $_REQUEST["email"];
    $phone = $_REQUEST["phone"];
    $message = $_REQUEST["message"];

//For Email Sending--------------------------------------

//Create a new PHPMailer instance
    $mail = new PHPMailer;
    try{

        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = "mail.feedppl.org";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "info@feedppl.org";
        $mail->Password = "InfoFeedPpl@123";
        $mail->SetFrom($email, $name);//Here We Will Put Website Domain
        $mail->Subject = "Mail From WebSite - Contact US Page";
        $mail->Body = "
Name: <b>$name</b><br/><br/>
Email: <b>$email</b><br/><br/>
Phone No: <b>$phone</b><br/><br/>
Message : <b>$message</b><br/>";

        $mail->AddAddress("jainshailu91@gmail.com");
        $mail->AddAddress("info@feedppl.org");
        $mail->AddAddress("kj.jainkalpesh@gmail.com");
//$mail->AddAttachment("$target_path1");
        if ($mail->Send()) {
            header("Location: thank-you.php");
        } else {
            echo "Error";
        }
    }catch(Exception $e){
        echo "Error" . $e->getMessage();
        echo "<br>" . $e->getTrace();
    }
}else{
    echo "Form was not submitted";
}