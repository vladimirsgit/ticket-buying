<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets reservation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/reset.css" type="text/css" rel="stylesheet">
    <link href="public/css/general.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php
include 'includes/header.php';
?>
<main>
    <div class="container mt-5">
        <h1 class="text-center">Registration Form</h1>
        <form id="registration_form" action="register" method="post">
            <div class="form-group">
                <label for="last_name">Last name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your last name"  >
            </div>

            <div class="form-group">
                <label for="first_name">First name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name" required pattern="^[A-Za-z]{1,100}$">
            </div>


            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required pattern="^[A-Za-z0-9#\._\-]+@[A-Za-z0-9\-]+\.[A-Za-z]+$">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required pattern="[A-Za-z0-9#_.]{3,20}$">
            </div>


            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>


            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
            </div>

            <button name="register" id="register-button" type="submit" class="btn btn-primary">Register</button>

        </form>
    </div>
</main>
<?php
if(isset($_POST['register'])){
    require 'src/register_data.php';
}
?>
</body>
</html>