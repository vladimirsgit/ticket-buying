<?php if(isset($_POST['resetPassword'])){
    require 'src/accountActions/enter_email_for_password_recovery.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketastic</title>
    <?php include 'includes/stylesheets.html' ?>
</head>
<body>
<?php
include 'includes/header.php';?>
<main>
    <div class="container mt-5">
        <h1 class="text-center">Forgot Password</h1>
        <form id="forgot_password_form" action="forgotPassword" method="post">

            <div class="form-group">
                <label for="email">Enter your email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <?php if (isset($_SESSION['user_not_found'])) { ?>
                <p style="color: red">No user found with this email address!</p>
            <?php } unset($_SESSION['user_not_found']);?>
            <?php if (isset($_SESSION['change_password_link_expired'])) { ?>
                <p style="color: red">The link expired, generate a new one.</p>
            <?php } unset($_SESSION['change_password_link_expired']);?>
            <?php if (isset($_SESSION['check_email'])) { ?>
                <p style="color: #30bde7">Check your email and follow the instructions!</p>
            <?php } unset($_SESSION['check_email']);?>
            <?php if (isset($_SESSION['already_requested'])) { ?>
                <p style="color: red">Please check your email address, you already requested this!</p>
            <?php } unset($_SESSION['already_requested']);?>

            <input type="hidden" class="form-control" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <?php if(isset($_COOKIE['ok_cookies'])){
                ?><button name="resetPassword" type="submit" class="btn btn-primary btn-block">Reset Password</button><?php } else {?>
                <span>Please accept cookies in order to submit.</span> <?php } ?>
        </form>
    </div>

</main>
</body>
<?php
include 'includes/footer.php';
?>
</html>