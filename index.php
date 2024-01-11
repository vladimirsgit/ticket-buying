<?php
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
require_once 'vendor/autoload.php';
require_once 'db_config.php';
$routes = [
    '/' => 'public/home.php',
    '/register' => 'public/register_form.php',
    '/confirm_email.php' => 'src/registration/confirm_email.php',
    '/login' => 'public/login_form.php',
    '/logout.php' => 'src/accountActions/logout.php',
    '/profile' => 'public/profile.php',
    '/contact' => 'public/contact_us.php',
    '/adminDashboard' => 'public/admin_dashboard.php',
    '/events' => 'public/events.php',
    '/forgotPassword' => 'public/forgot_password_form.php',
    '/change_password.php' => 'src/accountActions/validate_password_recovery_token_and_username.php',
    '/setNewPassword' => 'public/set_new_password.php',
    '/eventDetails' => 'public/event_details.php',
    '/add_to_cart.php' => 'src/ticketBuying/add_to_cart.php',
    '/cart' => 'public/shopping_cart.php',
    '/update_cart.php' => 'src/ticketBuying/update_cart.php',
    '/buy_tickets.php' => 'src/ticketBuying/buy_tickets.php',
    '/parse_sun_data.php' => 'src/parse_sun_data.php',
    '/analytics.php' => 'src/analytics.php'
];
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(64));
}
$apis = ['/confirm_email.php', '/logout.php', '/change_password.php', '/add_to_cart.php', '/update_cart.php',
	'buy_tickets.php', '/parse_sun_data.php', '/analytics.php'];

if(array_key_exists($uri, $routes)){
    doAnalytics($uri, $apis);
    require $routes[$uri];
} else {
    http_response_code(404);
    require 'views/404.php';
}


function doAnalytics($uri, $apis){
    require_once 'models/visitor.php';
    global $entityManager;
    if(in_array($uri, $apis)) return;
    if($_SERVER['REMOTE_ADDR'] == $_SERVER['SERVER_ADDR']) return;
    $visitorRepository = $entityManager->getRepository(Visitor::class);

    $IP = $_SERVER['REMOTE_ADDR'];
    $visitor = $visitorRepository->find($IP);

    if($visitor == null){
        $visitor = new Visitor($IP, 1);
    } else {
        $visitor->setVisits($visitor->getVisits() + 1);
    }
    $entityManager->persist($visitor);
    $entityManager->flush();
}
