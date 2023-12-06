<?php global $entityManager;
require_once 'models/user.php';
require_once 'src/utils/functions_for_validation.php';
require_once 'src/utils/sendEmails/send_password_recovery_email.php';
$email = $_POST['email'] ?? '';


checkCSRFtoken();

validateEmailAndPossiblyUsername($email, null, '/tickets/forgotPassword');


$userRepository = $entityManager->getRepository(User::class);
$user = $userRepository->findOneBy(['email' => $email]);

if($user == null){
    setSessionAttributeAndRedirect('user_not_found', '/tickets/forgotPassword');
}
//if(!empty($user->getResetPasswordtoken())){
//    setSessionAttributeAndRedirect('already_requested', '/tickets/forgotPassword');
//}

$passwordRecoveryToken = bin2hex(openssl_random_pseudo_bytes(64));

sendPasswordRecoveryEmail($email, $passwordRecoveryToken, $user->getUsername());

$user->setResetPasswordtoken($passwordRecoveryToken);

$entityManager->persist($user);
$entityManager->flush();

$_SESSION['check_email'] = true;
