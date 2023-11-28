<?php
global $entityManager;
include 'models/user.php';
require_once 'config.php';


$username = $_POST['username'];
$password = $_POST['password'];

$repository = $entityManager->getRepository(User::class);

$user = $repository->findOneBy(['username'=>$username]);

if($user == null){
    echo "Invalid data!";
    exit();
}

if(!password_verify($password, $user->getPassword())){
    echo "Invalid data!";
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
