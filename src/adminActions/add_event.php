<?php global $entityManager;
require 'src/utils/functions_for_validation.php';
require 'models/event.php';

checkCSRFtoken();

$name = $_POST['event_name'] ?? '';
$type = $_POST['event_type'] ?? '';
$date = $_POST['event_date'] ?? '';
$time = $_POST['event_time'] ?? '';
$location = $_POST['event_location'] ?? '';
$totalTickets = $_POST['total_tickets'] ?? '';
$price = $_POST['ticket_price'] ?? '';
$description = $_POST['event_description'] ?? '';



if(checkIfFieldsAreEmpty($name, $type, $date, $time, $location, $totalTickets, $price, $description)){
    setSessionAttributeAndRedirect('empty_fields', '/tickets/adminDashboard');
}

if($type !== 'movie' && $type !== 'concert' && $type !== 'theater'){
    setSessionAttributeAndRedirect('invalid_data', '/tickets/adminDashboard');
}

if(!validateDate($date) || !validateTime($time)){
    setSessionAttributeAndRedirect('invalid_data', '/tickets/adminDashboard');
}

if($totalTickets > PHP_INT_MAX || !is_numeric($totalTickets) || $totalTickets < 1) {
    setSessionAttributeAndRedirect('invalid_data', '/tickets/adminDashboard');
}

if(!is_numeric($price) || $price < 0 || $price > 99999.99){
    setSessionAttributeAndRedirect('invalid_data', '/tickets/adminDashboard');
}

$dateTime = DateTime::createFromFormat('Y-m-d H:i', $date . " " . $time);

$event = new Event($name, $type, $dateTime, $location, $totalTickets, $price, $description);

$entityManager->persist($event);
$entityManager->flush();

setSessionAttributeAndRedirect('add_event_OK', '/tickets/adminDashboard');