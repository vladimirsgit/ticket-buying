<?php
global $entityManager;
require_once 'models/user.php';
require_once 'src/utils/functions_for_validation.php';

checkCSRFtoken();

$username = $_SESSION['username'] ?? '';

$userRepository = $entityManager->getRepository(User::class);

$userToBeDeleted = $userRepository->findOneBy(['username' => $username]);

if($userToBeDeleted == null || !isset($_POST['password'])){
    setSessionAttributeAndRedirect('invalid_credentials', '/tickets/profile');
}

if(!password_verify($_POST['password'], $userToBeDeleted->getPassword())){
    setSessionAttributeAndRedirect('invalid_credentials', '/tickets/profile');
}

$entityManager->remove($userToBeDeleted);
$entityManager->flush();

$_SESSION = array();
session_destroy();

header('Location: /tickets/register');
exit;