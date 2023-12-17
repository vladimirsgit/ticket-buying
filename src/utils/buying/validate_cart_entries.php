<?php function validate_post_and_db($cart_entries_from_db, $events_ids_from_cart_session, $userId, $eventRepository): array {
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

function modify_events_and_save_data($valid_event_ids_and_their_quantities, $userId, $entityManager, $eventRepository, $cartRepository): void {
    foreach ($valid_event_ids_and_their_quantities as $eventId => $quantity){
        $event = $eventRepository->find($eventId);
        $cart_entry = $cartRepository->findOneBy(['userId' => $userId, 'eventId' => $eventId]);
        $entityManager->remove($cart_entry);
        $event->buyTickets($quantity);
        $entityManager->persist($event);
        $entityManager->flush();
    }

}
