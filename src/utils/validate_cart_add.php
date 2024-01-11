<?php
require_once 'models/event.php';
require_once 'models/user.php';
require_once 'functions_for_validation.php';
function validatePostRequestData($eventId, $username, $quantity): int
{
    global $entityManager;

    if(empty($eventId)) {
        setSessionAttributeAndRedirect('invalid_data', '/');
    }
    if (!filter_var($quantity, FILTER_VALIDATE_INT) || $quantity < 1 || $quantity > 5) {
        setSessionAttributeAndRedirect('invalid_data', '/');
    }
    $eventRepository = $entityManager->getRepository(Event::class);
    $event = $eventRepository->findBy(['id' => $eventId]);

    $userRepository = $entityManager->getRepository(User::class);
    $user = $userRepository->findOneBy(['username' => $username]);

    if ($user == null || $event == null) {
        setSessionAttributeAndRedirect('invalid_data', '/');
    }

    return $user->getId();
}

function validateUserAllowedToReserve($entityManager, $eventId, $userId): void{

    $cartRepository = $entityManager->getRepository(CartEntry::class);

    $cartEntriesForUser = $cartRepository->findBy(['userId' => $userId]);
    usort($cartEntriesForUser, function ($a, $b){
        return $a->getCreatedAt()->getTimestamp() - $b->getCreatedAt()->getTimestamp();
    });

    if(sizeof($cartEntriesForUser) == 2){
        $dateWhenMoreCanBeAdded = $cartEntriesForUser[0]->getCreatedAt()->modify('+12 hours')->format('Y-m-d H:i');
        setSessionAttributeAndRedirect('max_reservations', '/eventDetails?id=' . $eventId, $dateWhenMoreCanBeAdded);
    }
    $cartEntry = $cartRepository->findOneBy(['eventId' => $eventId, 'userId' => $userId]);
    if($cartEntry != null && $cartEntry->isExpired()){
        $dateWhenNewReservationIsAllowed = $cartEntry->getCreatedAt()->modify('+12 hours')->format('Y-m-d H:i');
        setSessionAttributeAndRedirect('reservation_expired', '/eventDetails?id=' . $eventId, $dateWhenNewReservationIsAllowed);
    }
    if($cartEntry != null){
        setSessionAttributeAndRedirect('already_in_cart', '/eventDetails?id=' . $eventId);
    }


}
function validateTicketsAvailable($entityManager, $eventId, $quantity): void{
    $eventRepository = $entityManager->getRepository(Event::class);
    $event = $eventRepository->find($eventId);

    $eventTotalTickets = $event->getTotalTickets();
    $eventSoldTickets = $event->getSoldTickets();
    $eventReservedTickets = $event->getReservedTickets();

    $freeTickets = $eventTotalTickets - $eventSoldTickets - $eventReservedTickets;
    if($freeTickets == 0){
        setSessionAttributeAndRedirect('event_sold_out', '/eventDetails?id=' . $eventId);
    }
    if($quantity > $freeTickets){
        setSessionAttributeAndRedirect('free_tickets_left', '/eventDetails?id=' . $eventId, $freeTickets);
    }

    $event->setReservedTickets($event->getReservedTickets() + $quantity);

    $entityManager->persist($event);
    $entityManager->flush();
}