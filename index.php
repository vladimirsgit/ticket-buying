<?php
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
require_once 'vendor/autoload.php';


$routes = [
    '/tickets/' => 'public/home.php',
    '/tickets/register' => 'public/register_form.php',
    '/tickets/login' => 'public/login_form.php',
    '/tickets/confirmEmail' => 'src/confirm_email.php'
];

    if(array_key_exists($uri, $routes)){
        require $routes[$uri];

    } else {
        http_response_code(404);
        require 'views/404.php';
    }
