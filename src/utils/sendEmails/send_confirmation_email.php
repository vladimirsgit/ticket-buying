<?php
function sendConfirmationEmail($email, $emailToken, $username){
    $confirmationLink = "http://localhost:8080/tickets/confirm_email.php?token=" . $emailToken . "&username=" . $username;
    $subject = "Email confirmation";
    $message = "Hello! Please click <a href='{$confirmationLink}'>here</a> to activate your account. You will be redirected to the login page after successful confirmation.";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    mail($email, $subject, $message, $headers);
}