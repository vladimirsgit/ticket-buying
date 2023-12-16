<?php
    if(isset($_POST['contact_form_submit'])){
        require_once 'src/contact_form_process.php';
    } ?>
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
        <h2>Contact Us</h2>
        <?php if (isset($_SESSION['empty_fields'])) { ?>
            <p style="color: red">Please make sure none of the fields are empty!</p>
        <?php } unset($_SESSION['empty_fields']);?>
        <?php if (isset($_SESSION['invalid_email'])) { ?>
            <p style="color: red">Please make the email is valid.</p>
        <?php } unset($_SESSION['invalid_email']);?>
        <form action="#" method="post">
            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Your Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <input type="hidden" class="form-control" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            <div class="g-recaptcha" data-sitekey="6Lc5oTMpAAAAAG4oieBzD9EUdemq7_UUdTt9D_eq"></div>
            <?php if(isset($_COOKIE['ok_cookies'])){
            ?><button type="submit" class="btn btn-primary" name="contact_form_submit">Submit</button><?php } else {?>
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