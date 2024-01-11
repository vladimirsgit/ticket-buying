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
        <div id="analytics"></div>
        <div id="sun-div"></div>
        <?php

        $timeZone= new DateTimeZone('UTC');
            $timeNow = new DateTime('now', $timeZone);
        if(isset($_SESSION['welcome']) && $_SESSION['welcome']){
            $_SESSION['welcome'] = false;
            ?> <h1>WELCOME!</h1> <?php }  ?>
        <?php if (isset($_SESSION['csrf_attack'])) { ?>
            <p style="color: red">Possible attack, be careful of the links that you click on!</p>
        <?php } unset($_SESSION['csrf_attack']);?>
        <?php if (isset($_SESSION['invalid_pass_change'])) { ?>
            <p style="color: red">Invalid data token/username for password change.</p>
        <?php } unset($_SESSION['invalid_pass_change']);?>
        <?php if (isset($_SESSION['invalid_data'])) { ?>
            <p style="color: red">You have been redirected because the data was invalid.</p>
        <?php } unset($_SESSION['invalid_data']);?>

    </main>
</body>
<?php
    include 'includes/footer.php';
?>
<script src="public/js/get_location.js"></script>
<script src="public/js/analytics.js"></script>
</html>