<?php global $entityManager,$events;
require_once 'models/event.php';
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
include 'includes/header.php';
$eventRepository = $entityManager->getRepository(Event::class);
$eventId = $_GET['id'];
$event = $eventRepository->findOneBy(['id' => $eventId]);
if($event == null){
    header('Location: /tickets/notFound');
    exit;
}
$_SESSION['event_id_for_cart'] = $eventId;
?>
<main>

    <div style="background-color: #1f2342" class="list-group-item list-group-item-action flex-column align-items-start mb-3">
        <div  class="d-flex w-100 justify-content-between">
            <p style="font-size: 30px" class="mb-1 text-primary">Event Name: <?php echo htmlspecialchars($event->getName()); ?></p>
            <p class="text-secondary">When (Y-m-d H:m) <?php echo htmlspecialchars($event->getDate()->format('Y-m-d H:i')); ?></p>
        </div>
        <p class="text-info mb-1">Price: <?php echo htmlspecialchars($event->getPrice()); ?> GOLD</p>
        <p class="text-info mb-1">Type: <?php echo htmlspecialchars($event->getType()); ?></p>
        <p class="text-info mb-1">Where: <?php echo htmlspecialchars($event->getLocation()); ?></p>

        <p class="mb-1 text-success">Description: <?php echo htmlspecialchars($event->getDescription()); ?></p>

    </div>
    <?php if(isset($_SESSION['username'])){ ?>
        <?php if (isset($_SESSION['max_reservations'])) { ?>
            <p style="color: red">You are not allowed to make any reservations for the moment. You will be able to reserve again at aprox: <span id="dateOkForReservation"><?php echo $_SESSION['max_reservations']; ?> (UTC)</span></p>
        <?php } unset($_SESSION['max_reservations']);?>
        <?php if (isset($_SESSION['already_in_cart'])) { ?>
            <p style="color: red">Please edit your cart for this specific event.</p>
        <?php } unset($_SESSION['already_in_cart']);?>
        <?php if (isset($_SESSION['reservation_expired'])) { ?>
            <p style="color: red">Unfortunately your reservation has expired. Please wait until <?php echo $_SESSION['reservation_expired'] ?> (UTC) to make another reservation for this specific event.</p>
        <?php } unset($_SESSION['reservation_expired']);?>
        <?php if (isset($_SESSION['free_tickets_left'])) { ?>
            <p style="color: red">Unfortunately there are only <?php echo $_SESSION['free_tickets_left']; ?> left.</p>
        <?php } unset($_SESSION['free_tickets_left']);?>
        <?php if (isset($_SESSION['event_sold_out'])) { ?>
            <p style="color: red">Unfortunately the event is sold out.</p>
        <?php } unset($_SESSION['event_sold_out']);?>
        <?php if (isset($_SESSION['add_to_cart_success'])) { ?>
            <p style="color: #30bde7">You have successfully added to <a href="/tickets/cart">cart</a> <span style="color: red"> <?php echo $_SESSION['add_to_cart_success'] ?></span> tickets.</p>
        <?php } unset($_SESSION['add_to_cart_success']);?>
    <div class="mt-3">
        <form method="post" action="add_to_cart.php">

            <label for="quantity" class="ml-3" typeof="submit">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" max="5" value="1">
            <p class="mt-1 text-warning">NOTE: <br>
                - A reservation means pressing the "Add to cart" button, for any event. <br>
                - By adding to cart, your tickets will be reserved for 10 minutes after you press the button.<br>
                - You are only allowed to add 5 tickets per event to your cart at most.<br>
                - You are allowed to make only one reservation per event in a 12-hour period <br>
                - You are not allowed to make more than 2 reservations in a 12-hour period.<br>
                - Editing your cart does not reset the 10 minutes timer. <br>
            </p>

            <?php if(isset($_COOKIE['ok_cookies'])){
                ?><button name="addToCart" class="btn btn-primary mt-1" type="submit" >Add to Cart</button><?php } else {?>
                <span>Please accept cookies in order to submit.</span> <?php } ?>
            <input type="hidden" class="form-control" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
        </form>
    </div> <?php } else { ?> <div class="mt-3">
        <p>Please <a href="/tickets/login">log in</a> or <a href="/tickets/register">register</a> to make a purchase</p>
    </div> <?php } ?>
</main>
</body>
<?php
include 'includes/footer.php';
?>
</html>