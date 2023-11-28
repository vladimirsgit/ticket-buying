<?php
require 'functionsForValidation.php';
function validateRegistrationFormData($lastname, $firstname, $email, $username, $password, $confirmed_password): void {

    checkIfFieldsAreEmpty($lastname, $firstname, $email, $username, $password, $confirmed_password);
    validateName($lastname, $firstname);
    validateEmailAndUsername($email, $username);

    if($password !== $confirmed_password){
        $_SESSION['passwords_not_matching'] = true;
        header('Location: http://localhostL8080/tickets/register');
        exit;
    }
}
