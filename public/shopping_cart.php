 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketastic</title>
    <?php include 'includes/stylesheets.html' ?>
</head>
<body>
<?php if(!isset($_SESSION['username'])){
    header('Location: /');
}
include 'includes/header.php';?>
<main>
    <div class="container mt-5">
        <h2>Your Shopping Cart</h2>
            <table class="table table-striped table-hover table-dark table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                require 'src/ticketBuying/display_cart.php';
                ?>
                </tbody>
            </table>

        <div class="text-end">
            <h4>Total: <?php echo $totalValue; ?> GOLD</h4>
        </div>

        <form action="buy_tickets.php" method="post">
            <?php if (isset($_SESSION['invalid_data'])) { ?>
                <p style="color: red">Invalid data, impossible to buy.</p>
            <?php } unset($_SESSION['invalid_data']);?>
            <?php if (isset($_SESSION['expired_entries'])) { ?>
                <p style="color: red">You cannot buy expired reservations.</p>
            <?php } unset($_SESSION['expired_entries']);?>
            <?php if (isset($_SESSION['sold_out'])) { ?>
                <p style="color: red">Sold out.</p>
            <?php } unset($_SESSION['sold_out']);?>
            <?php if (isset($_SESSION['not_enough_tickets'])) { ?>
                <p style="color: red">The selected amount exceeds our availability.</p>
            <?php } unset($_SESSION['not_enough_tickets']);?>
            <?php if (isset($_SESSION['tickets_bought'])) { ?>
                <p style="color: #30bde7">Purchase successful. Please check your email to see your tickets.</p>
            <?php } unset($_SESSION['tickets_bought']);?>
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-warning" name="buy_tickets">Buy now</button>
            </div>
            <input type="hidden" class="form-control" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
        </form>
    </div>
</main>

</body>
<?php
include 'includes/footer.php';
?>
</html>