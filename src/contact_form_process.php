<?php require_once 'src/utils/functions_for_validation.php';
require_once 'src/utils/sendEmails/send_contact_form_email.php';
require_once 'src/utils/verify_recaptcha.php';

checkCSRFtoken();

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';

$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

if(checkIfFieldsAreEmpty($name, $email, $subject, $message)){
    setSessionAttributeAndRedirect('empty_fields', '/contact');
}

$name = htmlspecialchars($name);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
$subject = htmlspecialchars($subject);
$message = htmlspecialchars($message);

if(!$email){
    setSessionAttributeAndRedirect('invalid_email', '/contact');
}

sendContactFormEmailToUser($email, $name, $message);
sendContactFormEmailToOwner($email, $name, $subject, $message);