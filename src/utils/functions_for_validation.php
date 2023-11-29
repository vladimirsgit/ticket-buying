<?php
function checkIfFieldsAreEmpty(): void {
    $args = func_get_args();

    foreach ($args as $arg){
        if(empty($arg)){
            setSessionAttributeAndRedirect('empty_fields', '/tickets/register');
        }
    }
}

function validateName($lastname, $firstname): void {
    if($lastname != "" && !preg_match("/^[A-Za-z]{1,100}$/", $lastname)){
        setSessionAttributeAndRedirect('lastname_invalid', '/tickets/register');
    } else if($firstname != "" && !preg_match("/^[A-Za-z]{1,100}$/", $firstname)){
        setSessionAttributeAndRedirect('firstname_invalid', '/tickets/register');
    }
}

function validateEmailAndUsername($email, $username = null): void {
    if(($email == '') || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        setSessionAttributeAndRedirect('email_invalid', '/tickets/register');
    } else if($username != null && !preg_match("/^[A-Za-z0-9#_.]{3,20}$/", $username)){
        setSessionAttributeAndRedirect('username_invalid', '/tickets/register');
    }
}

function checkCSRFtoken(): void{
    if(!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])){
        setSessionAttributeAndRedirect('csrf_attack', '/tickets/');
    }
}

function setSessionAttributeAndRedirect($attribute, $headerLocation): void {
    $_SESSION[$attribute] = true;
    header('Location: ' . $headerLocation);
    exit;
}