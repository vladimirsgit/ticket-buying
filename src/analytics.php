<?php global $entityManager;
require_once 'models/visitor.php';

$visitorRepository = $entityManager->getRepository(Visitor::class);

$visitors = $visitorRepository->findAll();

$totalVisits = 0;

foreach ($visitors as $visitor){
    $totalVisits+=$visitor->getVisits();
}

$uniqueVisitors = sizeof($visitors);

$data = [
    'totalVisits' => $totalVisits,
    'uniqueVisitors' => $uniqueVisitors
];

header('Content-Type: application/json');


echo json_encode($data);