<?php
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
require_once 'vendor/autoload.php';


$routes = [
    '/tickets/' => 'public/home.php',
    '/tickets/register' => 'public/register_form.php',
    '/tickets/confirmEmail' => 'src/confirm_email.php',
    '/tickets/login' => 'public/login_form.php',
    '/tickets/logout' => 'src/logout.php',
    '/tickets/profile' => 'public/profile.php',
    '/tickets/adminDashboard' => 'public/admin_dashboard.php'
];
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(64));
}

if(array_key_exists($uri, $routes)){
    require $routes[$uri];
} else {
    http_response_code(404);
    require 'views/404.php';
}
