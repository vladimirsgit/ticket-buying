<?php global $entityManager;
require_once 'models/user.php';
require_once 'models/cart_entry.php';
require_once 'models/event.php';

$cartRepository = $entityManager->getRepository(CartEntry::class);
$userRepository = $entityManager->getRepository(User::class);
$eventRepository = $entityManager->getRepository(Event::class);

$user = $userRepository->findOneBy(['username' => $_SESSION['username']]);

if($user == null) {
    setSessionAttributeAndRedirect('invalid_data', '/tickets/');
}

$userId = $user->getId();

$cartEntries = $cartRepository->findBy(['userId' => $userId]);

$userIdAndEventsIdArray = [];
$userIdAndEventsIdArray[0] = $userId;

$eventsFromCart = [];

$eventIdWithQuantities = [];

foreach ($cartEntries as $cart_entry){
    $eventsFromCart[] = $eventRepository->find($cart_entry->getEventId());
    $userIdAndEventsIdArray[] = $cart_entry->getEventId();
    $eventIdWithQuantities[$cart_entry->getEventId()] = $cart_entry->getQuantity();
}
$_SESSION['cart_data_ids'] = $userIdAndEventsIdArray;

$i = 0;
$totalValue = 0;
foreach ($eventsFromCart as $eventFromCart){
$i++;
$quantity = $eventIdWithQuantities[$eventFromCart->getId()];
if($quantity == 0){
    continue;
}
?> <tr>
    <td><?php echo $i;?></td>
    <td><?php echo $eventFromCart->getName(); ?> </td>
    <td><?php echo $eventFromCart->getPrice(); ?> GOLD</td>
    <td>
            <form action="update_cart.php" method="post" class="d-inline">
                <input type="hidden" name="eventId" value="<?php echo $eventFromCart->getId();?>">
                    <input type="hidden" name="action" value="subtract">
                    <button type="submit" class="btn btn-primary">-</button>
                <input type="hidden" class="form-control" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            </form>
            <span class="d-inline" id="itemQuantity"><?php echo $quantity; ?></span>
            <form action="update_cart.php" method="post" class="d-inline">
                <input type="hidden" name="eventId" value="<?php echo $eventFromCart->getId();?>">
                    <input type="hidden" name="action" value="add">
                    <button type="submit" class="btn btn-primary">+</button>
                <input type="hidden" class="form-control" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                <?php if (isset($_SESSION['max_allowed'])) { ?>
                    <p style="color: #30bde7" class="d-inline">The maximum is 5 tickets per event.</p>
                <?php } unset($_SESSION['max_allowed']);?>
            </form>

    </td>
    <td><?php echo $eventFromCart->getPrice() * $quantity; $totalValue+=$eventFromCart->getPrice() * $quantity;?> GOLD</td>

</tr>
<?php } ?>