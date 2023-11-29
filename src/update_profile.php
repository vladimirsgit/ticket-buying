<?php
global $entityManager;
include 'models/user.php';
require_once 'config.php';
require 'utils/functions_for_validation.php';
require 'utils/send_profile_update_email.php';
require 'utils/update_user_data.php';

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
    setSessionAttributeAndRedirect('user_not_found', '/tickets/profile');
}

validateName($lastname, $firstname);

validateEmailAndUsername($email);

if(!empty($newPassword) && $newPassword != $confirmedNewPassword){
    setSessionAttributeAndRedirect('newpassword_confirm_not_matching', '/tickets/profile');
}

if(!password_verify($password, $user->getPassword())){
    setSessionAttributeAndRedirect('invalid_credentials', '/tickets/profile');
}

updateUserData($user, !empty($newPassword), $lastname, $firstname, $email, $newPassword);
$entityManager->persist($user);
$entityManager->flush();

setSessionAttributeAndRedirect('update_success', '/tickets/profile');

$newPassword = !empty($newPassword) ? "True" : "False";
sendProfileUpdateEmail($email, $username, $lastname, $firstname, $newPassword);


