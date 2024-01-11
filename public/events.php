<?php global $entityManager,$events;
require_once 'models/event.php'; ?>
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
    <div  class="container mt-5">
        <h2 class="mb-2">Upcoming Events</h2>
        <div class="list-group">

            <?php include 'src/adminActions/events_pagination.php';
            ?>
        </div>
        <div class="pagination justify-content-center">
            <?php $forLimit = sizeof($events) % 5 == 0 ? sizeof($events) / 5 : sizeof($events) / 5 + 1;
            for($i = 1; $i <= $forLimit; $i++){
                ?> <a style="margin-right: 2em; font-size: 20px"  href="/events?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php } ?>
        </div>
    </div>
</main>
</body>
<?php
include 'includes/footer.php';
?>
</html>