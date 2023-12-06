<?php require_once 'mail_sender.php';
function sendProfileUpdateEmail($email, $username, $lastname, $firstname, $newPassword): void{

    $subject = "Profile update for {$username}";
    $message = "Hello! Here are your new profile details: <br>Email address: {$email}<br>Username: {$username}<br>
                    Last name: {$lastname}<br>First name: {$firstname}<br>New password: {$newPassword}";

    sendEmail($email, $subject, $message);
}