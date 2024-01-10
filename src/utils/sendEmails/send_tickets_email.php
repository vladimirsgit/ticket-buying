<?php require_once 'mail_sender.php';
function sendTicketsEmail($email, $username, $tickets): void{

    $subject = "Tickets for {$username}";
    $message = "Hello! Please see your tickets attached. We hope you have a wonderful time! :) <br>
Please use the contact form at our website if you need any help.";

    sendEmail($email, $subject, $message, '', $tickets);
}