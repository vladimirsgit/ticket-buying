<?php global $entityManager;
require 'models/user.php';
require 'src/utils/functions_for_validation.php';
require 'src/utils/sendEmails/send_password_changed_email.php';

checkCSRFtoken();

$password = $_POST['newPassword'] ?? '';
$confirmedPassword = $_POST['confirmedNewPassword'] ?? '';

if($password !== $confirmedPassword){
    setSessionAttributeAndRedirect('newpassword_confirm_not_matching', '/tickets/setNewPassword');
}

$username = $_SESSION['username_to_change_password'] ?? '';

$userRepository = $entityManager->getRepository(User::class);

$user = $userRepository->findOneBy(['username' => $username]);

if($user == null){
    http_response_code(400);
    require 'views/400.php';
    exit;
}

$user->setPassword(password_hash($password, PASSWORD_DEFAULT));

$entityManager->persist($user);
$entityManager->flush();

sendPasswordChangedEmail($user->getEmail(), $user->getUsername());

$_SESSION = array();

session_regenerate_id(true);

$_SESSION['password_changed'] = true;

header('Location: /tickets/login');