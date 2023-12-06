<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
require_once 'mail_config.php';

function sendEmail($to, $subject, $message): void {
    global $mailUsername, $mailPassword;

    $mail = new PHPMailer(true);
    $mail->isSMTP();

    try{
        $mail->SMTPDebug  = 0;
        $mail->SMTPAuth   = true;

        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = $mailUsername;
        $mail->Password = $mailPassword;

        $mail->setFrom($mailUsername, 'Ticketastic');
        $mail->addAddress($to);

        $mail->Subject = $subject;
        $mail->AltBody = 'To view this post you need a compatible HTML viewer!';
        $mail->MsgHTML($message);

        $mail->send();
    } catch (Exception $exception){
        error_log($exception->getMessage());
    }
}