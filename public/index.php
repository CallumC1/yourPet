<?php
// Entry point for the application and all its requests

// Helpers

/* Function to echo a string safely
Should be moved to a helper file ]
*/
function safeEcho($string) {
    echo(htmlspecialchars($string));
}



// Routing

require_once __DIR__ . '../../router.php';

$router = new Router();

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];


// REQUEST METHOD, ROUTE, CONTROLLER
$router->addRoute("GET", "/", "HomeController@index");

$router->addRoute("GET", "/about", "AboutController@index");

$router->addRoute("GET", "/form", "FormController@index");

$router->addRoute("POST", "/formSubmit", "FormController@submit");


$router->handleRequest($uri, $method);


?>