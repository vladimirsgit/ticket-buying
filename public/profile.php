<?php if(isset($_POST['updateProfile'])){
    require 'src/accountActions/update_profile.php';
} else if(isset($_POST['deleteProfile'])){
    require 'src/accountActions/delete_account.php';
}
?>
<?php if(!isset($_SESSION['username'])){
    header('Location: http://localhost:8080/tickets/login');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($_SESSION['username'])?>'s profile</title>
    <?php include 'includes/stylesheets.html' ?>
</head>
<body>
<?php
include 'includes/header.php';
?>
<main>
    <div class="container mt-5">
        <h1 class="text-center">Profile</h1>
        <form id="update_profile_form" action="profile" method="post">
            <?php if (isset($_SESSION['user_not_found'])) { ?>
                <p style="color: red">User not found</p>
            <?php } unset($_SESSION['user_not_found']);?>
            <?php if (isset($_SESSION['invalid_credentials'])) { ?>
                <p style="color: red">Invalid credentials</p>
            <?php } unset($_SESSION['invalid_credentials']);?>
            <?php if (isset($_SESSION['update_success'])) { ?>
                <p style="color: #30bde7">Profile updated successfully!</p>
            <?php } unset($_SESSION['update_success']);?>
            <div class="form-group">

                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="<?php echo htmlspecialchars($_SESSION['username'])?>" readonly>
            </div>
            <div class="form-group">
                <label for="lastname">Last name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="<?php echo htmlspecialchars($_SESSION['lastname'])?>" pattern="^[A-Za-z]{1,100}$">
            </div>

            <div class="form-group">
                <label for="firstname">First name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="<?php echo htmlspecialchars($_SESSION['firstname'])?>" pattern="^[A-Za-z]{1,100}$">
            </div>


            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo htmlspecialchars($_SESSION['email'])?>" readonly>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <?php if (isset($_SESSION['email_the_same'])) {?>
                <p style="color: red">New email and old email are the same!</p>
            <?php } unset($_SESSION['email_the_same']);?>
            <div class="form-group">
                <label for="newEmail">New Email</label>
                <input type="" class="form-control" id="newEmail" name="newEmail" placeholder="Complete only if you want to change your email" >
            </div>
            <?php if (isset($_SESSION['email_invalid'])) {?>
                <p style="color: red">Invalid email address</p>
            <?php } unset($_SESSION['email_invalid']);?>
            <?php if (isset($_SESSION['not_available'])) {?>
                <p style="color: red">Email address not available</p>
            <?php } unset($_SESSION['not_available']);?>
            <?php if (isset($_SESSION['newEmail_not_matching'])) {?>
                <p style="color: red">New email and confirm new email fields do not match!</p>
            <?php } unset($_SESSION['newEmail_not_matching']);?>
            <div class="form-group">
                <label for="confirmNewEmail">Confirm New Email</label>
                <input type="" class="form-control" id="confirmNewEmail" name="confirmNewEmail" placeholder="Complete only if you want to change your email">
            </div>

            <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Complete only if you want to change your password">
            </div>
            <?php if (isset($_SESSION['newpassword_confirm_not_matching'])) {?>
                <p style="color: red">New password and confirm new password fields do not match!</p>
            <?php } unset($_SESSION['newpassword_confirm_not_matching']);?>
            <div class="form-group">
                <label for="confirmedNewPassword">Confirm New Password</label>
                <input type="password" class="form-control" id="confirmedNewPassword" name="confirmedNewPassword" placeholder="Complete only if you want to change your password">
            </div>

            <div class="form-group">
                <?php if (isset($_SESSION['demoted'])) {?>
                    <p style="color: red">Admin rights revoked! You have been demoted!</p>
                <?php } unset($_SESSION['demoted']);?>
                <label for="role">Role</label>
                <input type="text" class="form-control" id="role" name="role" placeholder="<?php echo htmlspecialchars($_SESSION['role'])?>" readonly>
            </div>

            <div class="d-flex justify-content-between">
                <?php if(isset($_COOKIE['ok_cookies'])){
                    ?><button name="updateProfile" id="update-profile-button" type="submit" class="btn btn-warning mr-2">Update</button>
                    <button name="deleteProfile" id="delete-profile-button" class="btn btn-danger">Delete Account (irreversible)</button><?php } else {?>
                    <span>Please accept cookies in order to submit.</span> <?php } ?>
            </div>

            <input type="hidden" class="form-control" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']);?>">

        </form>
    </div>
</main>
<script src="public/js/confirm_deletion.js"></script>
</body>
<?php
include 'includes/footer.php';
?>
</html>
