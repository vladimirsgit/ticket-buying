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
if(isset($_SESSION['username'])){
    header('Location: http://localhost:8080/tickets/profile');
}
?>
<main>
    <div class="container mt-5">
        <h1 class="text-center">Log In</h1>
        <form id="login_form" action="login" method="post">

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required pattern="[A-Za-z0-9#_.]{3,20}$">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <?php if (isset($_SESSION['username_and_password_not_matching'])) { ?>
                <p style="color: red">Username and password do not match!</p>
            <?php } unset($_SESSION['username_and_password_not_matching']);?>
            <button name="login" id="login-button" type="submit" class="btn btn-primary">Log In</button>

        </form>
    </div>
</main>
<?php
if(isset($_POST['login'])){
    require 'src/login_data.php';
}
?>
</body>
</html>