<?php require_once 'mail_sender.php';
function sendConfirmationEmail($email, $emailToken, $username){
    $confirmationLink = "https://ticketastic.store/confirm_email.php?token=" . $emailToken . "&username=" . $username;
    $subject = "Email confirmation";
    $message = "Hello! Please click <a href='{$confirmationLink}'>here</a> to activate your account. You will be redirected to the login page after successful confirmation.";


    sendEmail($email, $subject, $message);
}