<?php
global $entityManager;
require_once 'models/user.php';
require_once 'src/utils/functions_for_validation.php';
require_once 'src/utils/sendEmails/send_profile_update_email.php';
require_once 'src/utils/update_user_data.php';

checkCSRFtoken();

$username = $_SESSION['username'] ?? '';

$lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : $_SESSION['lastname'];
$firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : $_SESSION['firstname'];

$newEmail = $_POST['newEmail'] ?? '';
$confirmedNewEmail = $_POST['confirmNewEmail'] ?? '';

$password = $_POST['password'] ?? '';
$newPassword = $_POST['newPassword'] ?? '';
$confirmedNewPassword = $_POST['confirmedNewPassword'] ?? '';


$repository = $entityManager->getRepository(User::class);

$user = $repository->findOneBy(['username' => $_SESSION['username']]);

if($user == null){
    setSessionAttributeAndRedirect('user_not_found', '/profile');
}

validateName($lastname, $firstname);

validateNewEmail($newEmail, $confirmedNewEmail, $entityManager);

validateProfileUpdatePasswordFields($password, $user, $newPassword, $confirmedNewPassword);

//if it arrived here, it means we either have a valid new email or the field is empty, so we can assume that email will be either new email field or session email
$email = !empty($_POST['newEmail']) ? $_POST['newEmail'] : $_SESSION['email'];

updateUserData($user, !empty($newPassword), $lastname, $firstname, $email, $newPassword);
$entityManager->persist($user);
$entityManager->flush();

$newPassword = !empty($newPassword) ? "True" : "False";

sendProfileUpdateEmail($email, $username, $lastname, $firstname, $newPassword);

setSessionAttributeAndRedirect('update_success', '/profile');




