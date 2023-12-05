<?php global $entityManager;
require 'models/event.php';
require 'models/cart.php';

$eventId = $_POST['event_id_for_cart'] ?? null;


if($eventId == null || !filter_var($eventId, FILTER_VALIDATE_INT)){
    setSessionAttributeAndRedirect('invalid_data', 'Location: /tickets/');
}

