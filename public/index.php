<?php
// Entry point for the application and all its requests

// Helpers

// Function to echo a string safely
// Should be moveed to a helper file
function safeEcho($string) {
    echo(htmlspecialchars($string));
}



// Routing

require_once __DIR__ . '../../router.php';

$router = new Router();

$router->addRoute("/", function() {
    // echo('Home Page');
    require_once '../app/Views/home.php';
});


$router->addRoute("/about", function() {
    // echo('About Page');
    require_once '../app/Views/about.php';
});


$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$router->handleRequest($uri);




?>