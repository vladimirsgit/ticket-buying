<?php

function sendPasswordRecoveryEmail($email, $recoveryToken, $username): void{
    $passwordRecoveryLink = "http://localhost:8080/tickets/change_password.php?token=" . $recoveryToken . "&username=" . $username;

    $subject = "Password recovery for {$username}";
    $message = "Hello! You requested a password recovery email. The link will be available for 10 minutes since its generation. Click <a href='{$passwordRecoveryLink}'>here</a> to reset your password. <br>
                If this was not you, ignore this email.";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    mail($email, $subject, $message, $headers);
}