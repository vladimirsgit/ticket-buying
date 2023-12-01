<?php global $entityManager;
require 'models/user.php';
require 'src/utils/functions_for_validation.php';

$username = $_GET['username'] ?? '';
$token = $_GET['token'] ?? '';


if(empty($username) || empty($token)){
    setSessionAttributeAndRedirect('invalid_pass_change', '/tickets/');
}

$repository = $entityManager->getRepository(User::class);

$criteria = [
    'username' => $username,
    'reset_password_token' => $token
];

$user = $repository->findOneBy($criteria);


#if its null it means we can just kill the script
if($user == null || !$user->isConfirmedEmail()){
    http_response_code(400);
    require 'views/400.php';
    echo "INVALID DATA";
    exit;
}

$user->setResetPasswordtoken("");

$entityManager->persist($user);
$entityManager->flush();

$_SESSION['allowed_to_change_password'] = time();
$_SESSION['username_to_change_password'] = $user->getUsername();

error_log($_SESSION['username_to_change_password']);
header('Location: /tickets/setNewPassword');