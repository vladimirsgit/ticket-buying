<?php
global $entityManager;
include 'models/user.php';
require_once 'config.php';

$username = $_GET['username'] ?? ' ';
$token = $_GET['token'] ?? ' ';

$repository = $entityManager->getRepository(User::class);

$criteria = [
    'username' => $username,
    'email_token' => $token
];

$user = $repository->findOneBy($criteria);


#if its null it means we can just kill the script
if($user == null){
    http_response_code(400);
    require 'views/400.php';
    echo "INVALID DATA";
    die();
}
$user->setConfirmedEmail(true);

$entityManager->persist($user);
$entityManager->flush();

header('Location: http://localhost:8080/tickets/login');
