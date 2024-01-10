<?php
require_once 'src/ticketBuying/create_ticket.php';

function validate_post_and_db($cart_entries_from_db, $events_ids_from_cart_session, $userId, $eventRepository): array {
    $valid_event_ids_and_their_quantities = [];

    foreach ($cart_entries_from_db as $cart_entry){
        if($cart_entry->getUserId() != $userId){
            setSessionAttributeAndRedirect('invalid_data', '/tickets/cart');
        }
        if(!in_array($cart_entry->getEventId(), $events_ids_from_cart_session)){
            setSessionAttributeAndRedirect('invalid_data', '/tickets/cart');
        }
        $valid_event_ids_and_their_quantities[$cart_entry->getEventId()] = $cart_entry->getQuantity();
    }
    foreach ($valid_event_ids_and_their_quantities as $eventId => $quantity) {
        $event = $eventRepository->find($eventId);
        if ($event == null) {
            setSessionAttributeAndRedirect('invalid_data', '/tickets/cart');
        }
        if($event->isSoldOut()){
            setSessionAttributeAndRedirect('sold_out', '/tickets/cart');
        }
    }
    return $valid_event_ids_and_their_quantities;
}

function modify_events_and_create_tickets($valid_event_ids_and_their_quantities, $userId, $entityManager, $eventRepository, $cartRepository): array {
    $pdfs = [];
    foreach ($valid_event_ids_and_their_quantities as $eventId => $quantity){
        $event = $eventRepository->find($eventId);


        $cart_entry = $cartRepository->findOneBy(['userId' => $userId, 'eventId' => $eventId]);
        $entityManager->remove($cart_entry);
        $event->buyTickets($quantity);
        $entityManager->persist($event);
        $entityManager->flush();
        for ($i = 0; $i < $quantity; $i++) {
            $ticket = createTicket($event->getName(), $event->getDate(), $event->getLocation(), $eventId . rand(1, PHP_INT_MAX));
            array_push($pdfs, $ticket);
        }
    }
    return $pdfs;
}
