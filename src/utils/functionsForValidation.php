<?php
function checkIfFieldsAreEmpty(): void {
    $args = func_get_args();

    foreach ($args as $arg){
        if(empty($arg)){
            $_SESSION['empty_fields'] = true;
            header('Location: http://localhost:8080/tickets/register');
            exit;
        }
    }
}

function validateName($lastname, $firstname): void {
    if($lastname != "" && !preg_match("/^[A-Za-z]{1,100}$/", $lastname)){
        $_SESSION['lastname_invalid'] = true;
        header('Location: http://localhost:8080/tickets/register');
        exit;
    } else if($firstname != "" && !preg_match("/^[A-Za-z]{1,100}$/", $firstname)){
        $_SESSION['firstname_invalid'] = true;
        header('Location: http://localhost:8080/tickets/register');
        exit;
    }
}

function validateEmailAndUsername($email, $username = null): void {
    if(($email == '') || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['email_invalid'] = true;
        header('Location: http://localhost:8080/tickets/register');
        exit;
    } else if($username != null && !preg_match("/^[A-Za-z0-9#_.]{3,20}$/", $username)){
        $_SESSION['username_invalid'] = true;
        header('Location: http://localhost:8080/tickets/register');
        exit;
    }
}
