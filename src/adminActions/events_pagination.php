<?php global $entityManager;
$itemsPerPage = 5;

$page = $_GET['page'] ?? 1;
$page = max($page, 1);

$eventRepository = $entityManager->getRepository(Event::class);
$events = $eventRepository->findAll();

usort($events, function ($a, $b){
    return $a->getDate()->getTimestamp() - $b->getDate()->getTimestamp();
});
for($i = $page * 5 - 5; $i < $page * 5 && $i < sizeof($events); $i++){
    $event = $events[$i];
    ?> <a style="background-color: #1f2342" href="event_details.php?id=<?php echo $event->getId(); ?>" class="list-group-item list-group-item-action flex-column align-items-start mb-3">
        <div  class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 text-primary">Event Name: <?php echo htmlspecialchars($event->getName()); ?></h5>
            <small class="text-secondary">When (Y-m-d H:m): <?php echo htmlspecialchars($event->getDate()->format('Y-m-d H:i')); ?></small>
        </div>
        <p class="mb-1 text-success">Description: <?php echo htmlspecialchars($event->getDescription()); ?></p>
        <small class="text-info">Where: <?php echo htmlspecialchars($event->getLocation()); ?></small>
    </a>
    <?php
} ?>