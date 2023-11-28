<?php

function validateRegistrationFormData($lastname, $firstname, $email, $username, $password, $confirmed_password): void {

    checkIfFieldsAreEmpty($lastname, $firstname, $email, $username, $password, $confirmed_password);

    if(!preg_match("/^[A-Za-z]{1,100}$/", $lastname)){
        echo "<p>Please make sure your last name is valid!</p>";
        exit;
    } else if(!preg_match("/^[A-Za-z]{1,100}$/", $firstname)){
        echo "<p>Please make sure your first name is valid!</p>";
        exit;
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<p>Please make sure your email is valid!</p>";
        exit;
    } else if(!preg_match("/^[A-Za-z0-9#_.]{3,20}$/", $username)){
        echo "<p>Please make sure your username is valid!</p>";
        exit;
    } else if($password !== $confirmed_password){
        echo "<p>Please make sure password fields match!</p>";
        exit;
    }
}
function checkIfFieldsAreEmpty(): void {
    $args = func_get_args();

    foreach ($args as $arg){
        if(empty($arg)){
            echo "<p>Please make sure none of the fields are empty!</p>";
            exit;
        }
    }
}