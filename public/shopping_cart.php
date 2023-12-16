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

        <form action="checkout_cart.php" method="post">
            <div class="text-end mt-4">
                <input type="hidden" name="action" value="checkout">
                <button type="submit" class="btn btn-primary">Checkout</button>
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