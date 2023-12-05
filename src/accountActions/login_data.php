<?php
global $entityManager;
include 'models/user.php';
require 'src/utils/functions_for_validation.php';

checkCSRFtoken();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$repository = $entityManager->getRepository(User::class);

$user = $repository->findOneBy(['username'=>$username]);

if($user == null){
    setSessionAttributeAndRedirect('username_and_password_not_matching', '/tickets/login');
}

if(!$user->isConfirmedEmail()){
    setSessionAttributeAndRedirect('email_not_confirmed', '/tickets/login');
}

if(!password_verify($password, $user->getPassword())){
    setSessionAttributeAndRedirect('username_and_password_not_matching', '/tickets/login');
}

session_regenerate_id(true);


$_SESSION['username'] = $user->getUsername();
$_SESSION['lastname'] = $user->getLastname();
$_SESSION['firstname'] = $user->getFirstname();
$_SESSION['email'] = $user->getEmail();
$_SESSION['created'] = $user->getCreated();
$_SESSION['role'] = $user->getRole();
$_SESSION['welcome'] = true;

header('Location: /tickets/');
