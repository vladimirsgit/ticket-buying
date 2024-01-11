<?php
require 'functions_for_validation.php';
function validateRegistrationFormData($lastname, $firstname, $email, $confirmed_email, $username, $password, $confirmed_password): void {

    if(checkIfFieldsAreEmpty($lastname, $firstname, $email, $username, $password, $confirmed_password)){
        setSessionAttributeAndRedirect('empty_fields', '/register');
    }
    validateName($lastname, $firstname);
    validateEmailAndPossiblyUsername($email, $username);

    if($email !== $confirmed_email){
        setSessionAttributeAndRedirect('emails_not_matching', '/register');
    }
    if($password !== $confirmed_password){
        setSessionAttributeAndRedirect('passwords_not_matching', '/register');
    }
}
