<?php global $entityManager;
require_once 'src/utils/functions_for_validation.php';
require_once 'src/utils/buying/validate_cart_entries.php';
require_once 'models/cart_entry.php';
require_once 'models/event.php';
require_once 'models/user.php';
require_once 'src/ticketBuying/create_ticket.php';
require_once 'src/utils/sendEmails/send_tickets_email.php';
checkCSRFtoken();

$cartRepository = $entityManager->getRepository(CartEntry::class);
$userRepository = $entityManager->getRepository(User::class);
$eventRepository = $entityManager->getRepository(Event::class);

$username = $_SESSION['username'] ?? '';

$user = $userRepository->findOneBy(['username' => $username]);

$events_ids_from_cart_session = $_SESSION['cart_data_ids'] ?? '';

if(sizeof($events_ids_from_cart_session) < 2){
    setSessionAttributeAndRedirect('invalid_data', '/cart');
}
if($username == null){
    setSessionAttributeAndRedirect('invalid_data', '/cart');
}

$userId = $user->getId();

$cart_entries_from_db = $cartRepository->findBy(['userId' => $userId]);


for($i = 1; $i < sizeof($events_ids_from_cart_session); $i++){
    $cart_entry = $cartRepository->findOneBy(['userId' => $userId, 'eventId' => $events_ids_from_cart_session[$i]]);

    if($cart_entry->isExpired()){
        setSessionAttributeAndRedirect('expired_entries', '/cart');
    }
}

$valid_event_ids_and_their_quantities = validate_post_and_db($cart_entries_from_db, $events_ids_from_cart_session, $userId, $eventRepository);

$tickets = modify_events_and_create_tickets($valid_event_ids_and_their_quantities, $userId, $entityManager, $eventRepository, $cartRepository);

foreach ($tickets as $ticket){
    error_log($ticket);
}
sendTicketsEmail($user->getEmail(), $user->getUsername(), $tickets);

setSessionAttributeAndRedirect('tickets_bought', '/cart');