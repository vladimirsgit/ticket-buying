<?php
require_once 'mail_sender.php';
function sendPasswordRecoveryEmail($email, $recoveryToken, $username): void{
    $passwordRecoveryLink = "https://ticketastic.store/change_password.php?token=" . $recoveryToken . "&username=" . $username;

    $subject = "Password recovery for {$username}";
    $message = "Hello! You requested a password recovery email. The link will be available for 10 minutes since its generation. Click <a href='{$passwordRecoveryLink}'>here</a> to reset your password. <br>
                If this was not you, ignore this email.";

    sendEmail($email, $subject, $message);

}