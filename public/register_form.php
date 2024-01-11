<?php
if(isset($_POST['register'])){
    require 'src/registration/register_data.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <?php include 'includes/stylesheets.html' ?>
</head>
<body>
<?php
include 'includes/header.php';
?>
<main>
    <div class="container mt-5">
        <h1 class="text-center">Registration Form</h1>
        <form id="registration_form" action="register" method="post">
            <?php if (isset($_SESSION['empty_fields'])) { ?>
                <p style="color: red">Please make sure none of the fields are empty!</p>
            <?php } unset($_SESSION['empty_fields']);?>
            <div class="form-group">
                <label for="lastname">Last name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your last name" required pattern="^[A-Za-z]{1,100}$">
                <?php if (isset($_SESSION['lastname_invalid'])) { ?>
                    <p style="color: red">Last name invalid!</p>
                <?php } unset($_SESSION['lastname_invalid']);?>

            </div>

            <div class="form-group">
                <label for="firstname">First name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter your first name" required pattern="^[A-Za-z]{1,100}$">
                <?php if (isset($_SESSION['firstname_invalid'])) { ?>
                    <p style="color: red">First name invalid!</p>
                <?php } unset($_SESSION['firstname_invalid']);?>

            </div>


            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required pattern="^[A-Za-z0-9#\._\-]+@[A-Za-z0-9\-]+\.[A-Za-z]+$">
                <?php if (isset($_SESSION['email_invalid'])) { ?>
                    <p style="color: red">Email address invalid!</p>
                <?php } unset($_SESSION['email_invalid']);?>
            </div>
            <div class="form-group">
                <label for="confirmEmail">Confirm email address</label>
                <input type="email" class="form-control" id="confirmEmail" name="confirmEmail" placeholder="Confirm email" required pattern="^[A-Za-z0-9#\._\-]+@[A-Za-z0-9\-]+\.[A-Za-z]+$">
                <?php if (isset($_SESSION['emails_not_matching'])) { ?>
                    <p style="color: red">Email addresses do not match!</p>
                <?php } unset($_SESSION['emails_not_matching']);?>
                <?php if (isset($_SESSION['email_taken'])) { ?>
                    <p style="color: red">Email addresses do not match!</p>
                <?php } unset($_SESSION['email_taken']);?>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required pattern="[A-Za-z0-9#_.]{3,20}$">
                <?php if(isset($_SESSION['username_taken'])) {?> <p style="color: red">Username taken!</p> <?php } unset($_SESSION['username_taken']); ?>
                <?php if (isset($_SESSION['username_invalid'])) { ?>
                    <p style="color: red">Username invalid!</p>
                <?php } unset($_SESSION['username_invalid']);?>

            </div>


            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>

            <?php if (isset($_SESSION['passwords_not_matching'])) { ?>
                <p style="color: red">Passwords do not match!</p>
            <?php } unset($_SESSION['passwords_not_matching']);?>

            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
            </div>

            <input type="hidden" class="form-control" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <div class="g-recaptcha" data-sitekey="6Lc5oTMpAAAAAG4oieBzD9EUdemq7_UUdTt9D_eq"></div>
            <?php if(isset($_COOKIE['ok_cookies'])){

                ?><button name="register" id="register-button" type="submit" class="btn btn-primary">Register</button><?php } else {?>
                <span>Please accept cookies in order to submit.</span> <?php } ?>

            <?php if(isset($_SESSION['captcha_failed'])) {?>
            <span>CAPTCHA FAILED</span>
            <?php } unset($_SESSION['captcha_failed']);?>
        </form>
    </div>
</main>

</body>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php
include 'includes/footer.php';
?>
</html>