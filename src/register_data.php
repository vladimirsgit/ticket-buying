<?php
global $entityManager;
include 'models/user.php';
require_once 'config.php';
require 'utils/validate_registration.php';
require 'utils/send_confirmation_email.php';

checkCSRFtoken();

$lastname = $_POST['lastname'] ?? '';
$firstname = $_POST['firstname'] ?? '';
$email = $_POST['email'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$confirmed_password = $_POST['confirmPassword'] ?? '';

$repository = $entityManager->getRepository(User::class);

if($repository->findOneBy(['username' => $username])){
    setSessionAttributeAndRedirect('username_taken', '/tickets/register');
}

validateRegistrationFormData($lastname, $firstname, $email, $username, $password, $confirmed_password);

$password = password_hash($password, PASSWORD_DEFAULT);
$emailToken = bin2hex(openssl_random_pseudo_bytes(64));

$user = new User($username, $lastname, $firstname, $email, $password, $emailToken);

$entityManager->persist($user);
$entityManager->flush();

sendConfirmationEmail($email, $emailToken, $username);

echo '<script>alert("Your data was OK! Now please check your email for confirmation! :)")</script>';