<?php require_once 'src/utils/functions_for_validation.php';

checkCSRFtoken();

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';

$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

if(checkIfFieldsAreEmpty($name, $email, $subject, $message)){
    setSessionAttributeAndRedirect('empty_fields', '/tickets/contact');
}

$name = htmlspecialchars($name);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
$subject = htmlspecialchars($subject);
$message = htmlspecialchars($message);

if(!$email){
    setSessionAttributeAndRedirect('invalid_email', '/tickets/contact');
}

