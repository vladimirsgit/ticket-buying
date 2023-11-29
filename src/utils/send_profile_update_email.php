<?php
function sendProfileUpdateEmail($email, $username, $lastname, $firstname, $newPassword): void{

    $subject = "Profile update for {$username}";
    $message = "Hello! Here are your new profile details: <br>Email address: {$email}<br>Username: {$username}<br>
                    Last name: {$lastname}<br>First name: {$firstname}<br>New password: {$newPassword}";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    mail($email, $subject, $message, $headers);
}