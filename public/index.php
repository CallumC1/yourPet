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

$router->addRoute("GET", "/register", "RegisterController@index");

$router->addRoute("GET", "/products", "ProductsController");

$router->addRoute("GET", "/products/all", "ProductsController@getAllProducts");

$router->addRoute("GET", "/products/type", "ProductsController@getProductsByType");

$router->addRoute("GET", "/products/type/{productType}", "ProductsController@getProductsByType");



$router->handleRequest($uri, $method);


?>