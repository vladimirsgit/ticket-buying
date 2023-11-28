<?php
global $entityManager;
include 'models/user.php';
require_once 'config.php';
require 'utils/validateRegistration.php';
require 'utils/sendConfirmationEmail.php';

$lastname = $_POST['lastname'] ?? '';
$firstname = $_POST['firstname'] ?? '';
$email = $_POST['email'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$confirmed_password = $_POST['confirmPassword'] ?? '';

$repository = $entityManager->getRepository(User::class);

if($repository->findOneBy(['username' => $username])){
    $_SESSION['username_taken'] = true;
    header('Location: http://localhost:8080/tickets/register');
    exit;
}

validateRegistrationFormData($lastname, $firstname, $email, $username, $password, $confirmed_password);

$password = password_hash($password, PASSWORD_DEFAULT);
$emailToken = bin2hex(openssl_random_pseudo_bytes(64));

$user = new User($username, $lastname, $firstname, $email, $password, $emailToken);

$entityManager->persist($user);
$entityManager->flush();

sendConfirmationEmail($email, $emailToken, $username);

echo '<script>alert("Your data was OK! Now please check your email for confirmation! :)")</script>';