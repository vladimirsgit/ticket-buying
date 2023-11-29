<?php
function updateUserData($user, $updatePassword, $lastname = null, $firstname = null, $emailAddress = null, $newPassword = null): void{
    $user->setLastName($lastname);
    $_SESSION['lastname'] = $lastname;

    $user->setFirstname($firstname);
    $_SESSION['firstname'] = $firstname;

    $user->setEmail($emailAddress);
    $_SESSION['email'] = $emailAddress;

    if($updatePassword){
        $user->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));
    }

}