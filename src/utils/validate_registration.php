<?php
require 'functions_for_validation.php';
function validateRegistrationFormData($lastname, $firstname, $email, $username, $password, $confirmed_password): void {

    if(checkIfFieldsAreEmpty($lastname, $firstname, $email, $username, $password, $confirmed_password)){
        setSessionAttributeAndRedirect('empty_fields', '/tickets/register');
    }
    validateName($lastname, $firstname);
    validateEmailAndUsername($email, $username);

    if($password !== $confirmed_password){
        setSessionAttributeAndRedirect('passwords_not_matching', 'Location: /tickets/register');
    }
}
