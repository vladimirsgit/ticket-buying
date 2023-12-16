<?php if(isset($_SESSION['username'])){
    header('Location: http://localhost:8080/tickets/profile');
}
if (isset($_POST['login'])) {
    require 'src/accountActions/login_data.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <?php include 'includes/stylesheets.html' ?>
</head>
<body>
<?php include 'includes/header.php';
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
            <?php if (isset($_SESSION['email_not_confirmed'])) { ?>
                <p style="color: red">Please confirm your email!</p>
            <?php } unset($_SESSION['email_not_confirmed']);?>
            <?php if (isset($_SESSION['password_changed'])) {?>
                <p style="color: red">You can now login using your new password!</p>
            <?php } unset($_SESSION['password_changed']);?>
            <p class="mb-3"><a href="/tickets/forgotPassword">Forgot password</a></p>

            <input type="hidden" class="form-control" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <?php if(isset($_COOKIE['ok_cookies'])){
                ?><button name="login" id="login-button" type="submit" class="btn btn-primary">Log In</button><?php } else {?>
                <span>Please accept cookies in order to submit.</span> <?php } ?>
        </form>
    </div>

</main>

</body>
<?php
include 'includes/footer.php';
?>
</html>