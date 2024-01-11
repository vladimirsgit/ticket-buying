<?php global $entityManager;
require_once 'src/utils/functions_for_validation.php';
require_once 'models/user.php';
require_once 'models/cart_entry.php';
require_once 'models/event.php';

checkCSRFtoken();

$action = $_POST['action'] ?? '';
$eventId = $_POST['eventId'] ?? '';
$username = $_SESSION['username'] ?? '';

if(checkIfFieldsAreEmpty($action, $eventId, $username)){
    setSessionAttributeAndRedirect('invalid_data', '/123');
}

$userRepository = $entityManager->getRepository(User::class);
$cartRepository = $entityManager->getRepository(CartEntry::class);
$eventRepository = $entityManager->getRepository(Event::class);

$user = $userRepository->findOneBy(['username' => $username]);
$event = $eventRepository->find($eventId);

if($user == null || $event == null){
    setSessionAttributeAndRedirect('invalid_data', '/');
}

$cartEntry = $cartRepository->findOneBy(['userId' => $user->getId(), 'eventId' => $eventId]);

if($cartEntry == null){
    setSessionAttributeAndRedirect('invalid_data', '/');
}

if($action === "add"){
    addQuantity($cartEntry, $event);

    persistAndFlush($entityManager, $cartEntry, $event);
} else if($action === "subtract"){
    subtractQuantity($cartEntry, $event);

    persistAndFlush($entityManager, $cartEntry, $event);
} else {
    setSessionAttributeAndRedirect('invalid_data', '/');
}



function addQuantity(CartEntry $cartEntry, Event $event): void {
    $maxQuantityAllowed = 5;
    if($cartEntry->getQuantity() == $maxQuantityAllowed){
        setSessionAttributeAndRedirect('max_allowed', '/cart');
    }
    if($event->getReservedTickets() + $event->getSoldTickets() >= $event->getTotalTickets()){
        setSessionAttributeAndRedirect('no_more_tickets', '/cart');
    }
    $event->setReservedTickets($event->getReservedTickets() + 1);
    $cartEntry->setQuantity($cartEntry->getQuantity() + 1);
}

function subtractQuantity(CartEntry $cartEntry, Event $event): void {
    if($cartEntry->getQuantity() == 0){
        setSessionAttributeAndRedirect('invalid_data', '/');
    }
    $event->setReservedTickets($event->getReservedTickets() - 1);
    $cartEntry->setQuantity($cartEntry->getQuantity() - 1);

}

function persistAndFlush($entityManager, $cartEntry, $event): void{
    $entityManager->persist($cartEntry);
    $entityManager->flush();
    $entityManager->persist($event);
    $entityManager->flush();
    header('Location: /cart');
    exit;
}