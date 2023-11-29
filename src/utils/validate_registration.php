<?php
require 'functions_for_validation.php';
function validateRegistrationFormData($lastname, $firstname, $email, $username, $password, $confirmed_password): void {

    checkIfFieldsAreEmpty($lastname, $firstname, $email, $username, $password, $confirmed_password);
    validateName($lastname, $firstname);
    validateEmailAndUsername($email, $username);

    if($password !== $confirmed_password){
        setSessionAttributeAndRedirect('passwords_not_matching', 'Location: /tickets/register');
    }
}
