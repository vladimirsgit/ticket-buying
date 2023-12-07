<?php require_once 'mail_sender.php';
require_once 'mail_config.php';
function sendContactFormEmailToUser($email, $name, $userMessage): void {
    $subject = "Contact Submission";

    $message = "Thanks for contacting us. We will respond you as soon as we can. Here is what you sent us: <br>\"";
    $message = $message . $userMessage . "\"";


    sendEmail($email, $subject, $message, $name);
}

function sendContactFormEmailToOwner($email, $name, $userSubject, $userMessage): void{
    global $ownEmail;

    $userSubject = "Contact Form Submission: " . $userSubject;
    $message = "Hello! You received the following contact form from " . $name . " with the email address " . $email . "<br>";
    $message = $message . "\"" . $userMessage . "\"";

    sendEmail($ownEmail, $userSubject, $message);
}