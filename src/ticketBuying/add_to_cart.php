<?php global $entityManager;
require_once 'src/utils/functions_for_validation.php';
require_once 'models/cart_entry.php';
require_once 'src/utils/validate_cart_add.php';

checkCSRFtoken();

$eventId = $_SESSION['event_id_for_cart'] ?? '';
$username = $_SESSION['username'] ?? '';
$quantity = $_POST['quantity'] ?? '';



$userId = validatePostRequestData($eventId, $username, $quantity);
validateUserAllowedToReserve($entityManager, $eventId, $userId);
validateTicketsAvailable($entityManager, $eventId, $quantity);

$cartEntry = new CartEntry($userId, $eventId, $quantity);

$entityManager->persist($cartEntry);
$entityManager->flush();

$_SESSION['add_to_cart_success'] = $quantity;
header('Location: /tickets/eventDetails?id=' . $eventId);
exit;
