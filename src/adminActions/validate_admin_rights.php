<?php
global $entityManager;
require_once 'models/user.php';

if(!isset($_SESSION['username'])){
    header('Location: /tickets/login');
    exit;
} else if($_SESSION['role'] == 'common'){
    header('Location: /tickets/');
    exit;
}

$userRepository = $entityManager->getRepository(User::class);
$user = $userRepository->findOneBy(['username' => $_SESSION['username']]);

if($user->getRole() != 'admin'){
    $_SESSION['role'] = 'common';
    setSessionAttributeAndRedirect('demoted', '/tickets/profile');
}



