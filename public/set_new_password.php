<?php if(!isset($_SESSION['allowed_to_change_password'])){
    header('Location: /tickets/');
} else if(time() - $_SESSION['allowed_to_change_password'] > 600){
    unset($_SESSION['allowed_to_change_password']);
    $_SESSION['change_password_link_expired'] = true;
    header('Location: /tickets/forgotPassword');
} if(isset($_POST['changePassword'])){
    require 'src/accountActions/change_password.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketastic</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/reset.css" type="text/css" rel="stylesheet">
    <link href="public/css/general.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php
include 'includes/header.php';?>
<main>
    <div class="container mt-5">
        <h1 class="text-center">Change Password</h1>
        <form id="forgot_password_form" action="" method="post">

            <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password">
            </div>
            <?php if (isset($_SESSION['newpassword_confirm_not_matching'])) {?>
                <p style="color: red">New password and confirm new password fields do not match!</p>
            <?php } unset($_SESSION['newpassword_confirm_not_matching']);?>
            <div class="form-group">
                <label for="confirmedNewPassword">Confirm New Password</label>
                <input type="password" class="form-control" id="confirmedNewPassword" name="confirmedNewPassword" placeholder="Confirm new password">
            </div>
            <button name="changePassword" type="submit" class="btn btn-primary btn-block">Change Password</button>
            <input type="hidden" class="form-control" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

        </form>
    </div>

</main>
</body>
</html>