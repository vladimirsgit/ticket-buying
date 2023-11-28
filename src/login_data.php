<?php
global $entityManager;
include 'models/user.php';
require_once 'config.php';


$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$repository = $entityManager->getRepository(User::class);

$user = $repository->findOneBy(['username'=>$username]);

if($user == null){
    $_SESSION['username_and_password_not_matching'] = true;
    header('Location: http://localhost:8080/tickets/login');
    exit();
}

if(!password_verify($password, $user->getPassword())){
    $_SESSION['username_and_password_not_matching'] = true;
    header('Location: http://localhost:8080/tickets/login');
    exit();
}

session_regenerate_id();

$_SESSION['username'] = $user->getUsername();
$_SESSION['lastname'] = $user->getLastname();
$_SESSION['firstname'] = $user->getFirstname();
$_SESSION['email'] = $user->getEmail();
$_SESSION['created'] = $user->getCreated();
$_SESSION['welcome'] = true;

header('Location: http://localhost:8080/tickets/');
