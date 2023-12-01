<?php
function sendPasswordChangedEmail($email, $username): void{
    $subject = "Password successfully changed";
    $message = "Hello {$username}! Your password reset was successful!";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    mail($email, $subject, $message, $headers);
}