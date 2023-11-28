<?php
global $entityManager;
include 'models/user.php';
require_once 'config.php';
require 'utils/validateRegistration.php';

$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$newPassword = $_POST['newPassword'];
$confirmedNewPassword = $_POST['confirmedNewPassword'];



if(!empty($newPassword) && $newPassword != $confirmedNewPassword){
    echo "New password and confirm new password fields do not match!";
    exit;
}

