<?php require_once 'mail_sender.php';
function sendPasswordChangedEmail($email, $username): void{
    $subject = "Password successfully changed";
    $message = "Hello {$username}! Your password reset was successful!";
    $headers = "MIME-Version: 1.0" . "\r\n";

    sendEmail($email, $subject, $message);
}