<?php
global $entityManager;
include 'models/user.php';
require_once 'config.php';
require 'utils/functionsForValidation.php';
require 'utils/sendProfileUpdateEmail.php';
require 'utils/updateUserData.php';

$username = $_SESSION['username'] ?? '';

$lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : $_SESSION['lastname'];
$firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : $_SESSION['firstname'];
$email = !empty($_POST['email']) ? $_POST['email'] : $_SESSION['email'];

$password = $_POST['password'] ?? '';
$newPassword = $_POST['newPassword'] ?? '';
$confirmedNewPassword = $_POST['confirmedNewPassword'] ?? '';


$repository = $entityManager->getRepository(User::class);

$user = $repository->findOneBy(['username' => $_SESSION['username']]);

if($user == null){
    echo "User not found";
    exit;
}

validateName($lastname, $firstname);

validateEmailAndUsername($email);

if(!empty($newPassword) && $newPassword != $confirmedNewPassword){
    echo "New password and confirm new password fields do not match!";
    exit;
}

if(!password_verify($password, $user->getPassword())){
    echo "Check your password";
    exit;
}

updateUserData($user, !empty($newPassword), $lastname, $firstname, $email, $newPassword);
$entityManager->persist($user);
$entityManager->flush();

echo "Profile updated successfully!";

$newPassword = !empty($newPassword) ? "True" : "False";
sendProfileUpdateEmail($email, $username, $lastname, $firstname, $newPassword);


