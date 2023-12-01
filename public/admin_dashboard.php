<?php global $entityManager;
require 'src/adminActions/validate_admin_rights.php';
if(isset($_POST['roleAction'])){
    require 'src/adminActions/change_role.php';
} else if(isset($_POST['add_event'])){
    require 'src/adminActions/add_event.php';
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/reset.css" type="text/css" rel="stylesheet">
    <link href="public/css/general.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php include 'includes/header.php';?>
    <main>
       <?php include 'includes/add_event_form.php';
       include 'includes/users_table.php';?>
    </main>

</body>
</html>