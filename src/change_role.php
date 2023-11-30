<?php
global $entityManager;
require_once 'models/user.php';
require_once 'models/role_change.php';
require 'utils/functions_for_validation.php';
require_once 'config.php';

$userRepository = $entityManager->getRepository(User::class);

$userToBeChangedId = $_POST['user_id'] ?? null;
$actionToBeMade = $_POST['roleAction'] ?? null;

//make sure the action request is valid
if($actionToBeMade !== 'promote' && $actionToBeMade !== 'demote'){
    setSessionAttributeAndRedirect('invalid_action', '/tickets/adminDashboard');
}
//if theres no user id or if its not integer or if we have no action to be made, then its invalid
if($userToBeChangedId == null || !filter_var($userToBeChangedId, FILTER_VALIDATE_INT) || $actionToBeMade == null){
    setSessionAttributeAndRedirect('invalid_action', '/tickets/adminDashboard');
}

//if we cannot find the user by its id, then its not valid
$user = $userRepository->findOneBy(['id' => $userToBeChangedId]);
if($user == null){
    setSessionAttributeAndRedirect('invalid_action', '/tickets/adminDashboard');
}

//we make sure the action makes sense
if($actionToBeMade == 'promote' && $user->getRole() == 'admin' || $actionToBeMade == 'demote' && $user->getRole() == 'common'){
    setSessionAttributeAndRedirect('invalid_action', '/tickets/adminDashboard');
}


$adminId = $userRepository->findOneBy(['username' => $_SESSION['username']])->getId();

if($userToBeChangedId == $adminId){
    setSessionAttributeAndRedirect('invalid_action', '/tickets/adminDashboard');
}
//create the role_change DB entry
$role_change = new Role_changes($adminId, $userToBeChangedId, $actionToBeMade);

$entityManager->persist($role_change);
$entityManager->flush();

$_SESSION['user_role_changed_id'] = $userToBeChangedId;
$_SESSION['action_made'] = 'promoted';
$user->setRole('admin');

if($actionToBeMade == 'demote') {
    $_SESSION['action_made'] = 'demoted';
    $user->setRole('common');
}

$entityManager->persist($user);
$entityManager->flush();
setSessionAttributeAndRedirect('role_change_OK', '/tickets/adminDashboard');