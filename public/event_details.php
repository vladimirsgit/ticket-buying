<?php global $entityManager,$events;
require 'models/event.php'; ?>
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
include 'includes/header.php';
$eventRepository = $entityManager->getRepository(Event::class);
$eventId = $_GET['id'];
$event = $eventRepository->findOneBy(['id' => $eventId]);
if($event == null){
    header('Location: /tickets/notFound');
    exit;
}
$_POST['event_id_for_cart'] = $eventId;
?>
<main>

    <div style="background-color: #1f2342" class="list-group-item list-group-item-action flex-column align-items-start mb-3">
        <div  class="d-flex w-100 justify-content-between">
            <p style="font-size: 30px" class="mb-1 text-primary">Event Name: <?php echo htmlspecialchars($event->getName()); ?></p>
            <p class="text-secondary">When (Y-m-d H:m) <?php echo htmlspecialchars($event->getDate()->format('Y-m-d H:i')); ?></p>
        </div>
        <p class="text-info mb-1">Price: <?php echo htmlspecialchars($event->getPrice()); ?></p>
        <p class="text-info mb-1">Type: <?php echo htmlspecialchars($event->getType()); ?></p>
        <p class="text-info mb-1">Where: <?php echo htmlspecialchars($event->getLocation()); ?></p>

        <p class="mb-1 text-success">Description: <?php echo htmlspecialchars($event->getDescription()); ?></p>

    </div>
    <?php if(isset($_SESSION['username'])){ ?>
    <div class="mt-3">
        <form method="post" action="add_to_cart.php">

            <label for="quantity" class="ml-3" typeof="submit">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" max="5" value="1">
            <p class="mt-1 text-warning">NOTE: <br>
                - A reservation means pressing the "Add to cart" button, for any event. <br>
                - By adding to cart, your tickets will be reserved for 10 minutes after you press the button.<br>
                - You are only allowed to add 5 tickets per event to your cart at most.<br>
                - You are not allowed to make more than 2 reservations in a 12-hour period.<br>
                - Editing your cart does not reset the 10 minutes timer. <br>
            </p>
            <button name="addToCart" class="btn btn-primary mt-1" type="submit" >Add to Cart</button>
        </form>
    </div> <?php } else { ?> <div class="mt-3">
        <p>Please <a href="/tickets/login">log in</a> or <a href="/tickets/register">register</a> to make a purchase</p>
    </div> <?php } ?>
</main>
</body>
</html>