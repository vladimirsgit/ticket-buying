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
    if(isset($_SESSION['welcome']) && $_SESSION['welcome']){
        $_SESSION['welcome'] = false;

    ?> <h1>WELCOME!</h1> <?php } ?>
</body>
</html>