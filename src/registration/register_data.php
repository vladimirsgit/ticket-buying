<?php
global $entityManager;
require_once 'models/user.php';
require_once 'src/utils/validate_registration.php';
require_once 'src/utils/sendEmails/send_confirmation_email.php';
require_once 'src/utils/verify_recaptcha.php';



checkCSRFtoken();

$lastname = $_POST['lastname'] ?? '';
$firstname = $_POST['firstname'] ?? '';
$email = $_POST['email'] ?? '';
$confirmed_email = $_POST['confirmEmail'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$confirmed_password = $_POST['confirmPassword'] ?? '';

$repository = $entityManager->getRepository(User::class);

if($repository->findOneBy(['username' => $username])){
    setSessionAttributeAndRedirect('username_taken', '/tickets/register');
}

validateRegistrationFormData($lastname, $firstname, $email, $confirmed_email, $username, $password, $confirmed_password);

$password = password_hash($password, PASSWORD_DEFAULT);
$emailToken = bin2hex(openssl_random_pseudo_bytes(64));

$user = new User($username, $lastname, $firstname, $email, $password, $emailToken);

$entityManager->persist($user);
$entityManager->flush();

sendConfirmationEmail($email, $emailToken, $username);

echo '<script>alert("Your data was OK! Now please check your email for confirmation! :)")</script>';