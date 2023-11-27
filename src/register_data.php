<?php
global $entityManager;
include 'models/user.php';
require_once 'config.php';

    $lastname = $_POST['last_name'];
    $firstname = $_POST['first_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmed_password = $_POST['confirmPassword'];

    if(empty($lastname) || empty($firstname) || empty($email) || empty($username)
        || empty($password) || empty($confirmed_password)){
       echo "<p>Please make sure none of the fields are empty!</p>";
       exit();
    }

    if(!preg_match("/^[A-Za-z]{1,100}$/", $lastname)){
        echo "<p>Please make sure your last name is valid!</p>";
        exit();
    } else if(!preg_match("/^[A-Za-z]{1,100}$/", $firstname)){
        echo "<p>Please make sure your first name is valid!</p>";
        exit();
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<p>Please make sure your email is valid!</p>";
        exit();
    } else if(!preg_match("/^[A-Za-z0-9#_.]{3,10}$/", $username)){
        echo "<p>Please make sure your username is valid!</p>";
        exit();
    } else if($password !== $confirmed_password){
        echo "<p>Please make sure password fields match!</p>";
        exit();
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $emailToken = bin2hex(openssl_random_pseudo_bytes(64));

    $user = new User($username, $lastname, $firstname, $email, $password, $emailToken);

    $repository = $entityManager->getRepository(User::class);
    if($repository->findOneBy(['username' => $username])){
        echo "<p>Username Taken</p>";
        exit();
    }

    $entityManager->persist($user);
    $entityManager->flush();

    mail($email, "HI!", "HELLO");
    echo '<script>alert("Your data was valid! Now please check your email for confirmation! :)")</script>';