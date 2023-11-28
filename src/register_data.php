<?php
global $entityManager;
include 'models/user.php';
require_once 'config.php';
require 'utils/validateRegistration.php';
require 'utils/sendConfirmationEmail.php';

$lastname = $_POST['last_name'];
$firstname = $_POST['first_name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirmed_password = $_POST['confirmPassword'];

validateRegistrationFormData($lastname, $firstname, $email, $username, $password, $confirmed_password);

$password = password_hash($password, PASSWORD_DEFAULT);
$emailToken = bin2hex(openssl_random_pseudo_bytes(64));

$user = new User($username, $lastname, $firstname, $email, $password, $emailToken);

$repository = $entityManager->getRepository(User::class);

if($repository->findOneBy(['username' => $username])){
    echo "<p>Username Taken</p>";
    exit;
}
$entityManager->persist($user);
$entityManager->flush();

sendConfirmationEmail($email, $emailToken, $username);

echo '<script>alert("Your data was valid! Now please check your email for confirmation! :)")</script>';