<?php
if(!isset($_SESSION['username'])){
    header('Location: http://localhost:8080/tickets/login');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($_SESSION['username'])?>'s profile</title>
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
        <h1 class="text-center">Profile</h1>
        <form id="update_profile_form" action="profile" method="post">
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
                <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo htmlspecialchars($_SESSION['email'])?>" pattern="^[A-Za-z0-9#\._\-]+@[A-Za-z0-9\-]+\.[A-Za-z]+$">
            </div>


            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Complete only if you want to change your password">
            </div>


            <div class="form-group">
                <label for="confirmedNewPassword">Confirm New Password</label>
                <input type="password" class="form-control" id="confirmedNewPassword" name="confirmedNewPassword" placeholder="Complete only if you want to change your password">
            </div>

            <button name="updateProfile" id="update-profile-button" type="submit" class="btn btn-warning">Update</button>
            <button name="deleteProfile" id="delete-profile-button" type="submit" class="btn btn-danger">Delete Account (irreversible)</button>
        </form>
    </div>
</main>
<?php
if(isset($_POST['updateProfile'])){
    require 'src/updateProfile.php';
}
?>
</body>
</html>
