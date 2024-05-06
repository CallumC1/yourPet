<?php
// Start the session
session_start();

// Entry point for the application and all its requests

// Helpers

/* Function to echo a string safely
Should be moved to a helper file 
*/
function out($string) {
    echo(htmlspecialchars($string));
}


// Routing

require_once __DIR__ . '../../router.php';

$router = new Router();

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];


// REQUEST METHOD, ROUTE, CONTROLLER, Middleware
// NOTE: If two routes have the same route but one has a parameter, the parameter route should be added last!
// This is because the routes are checked in the order they are added and the first match is used.
// If the parameter route is added first, it will match all routes and the second route will never be found.
$router->addRoute("GET", "", "HomeController@index");

$router->addRoute("GET", "/about", "AboutController@index");

$router->addRoute("GET", "/form", "FormController@index");
$router->addRoute("POST", "/formSubmit", "FormController@submit");

// Registration Routes
$router->addRoute("GET", "/register", "RegisterController@index");
$router->addMiddleware("/register", "checkLoggedIn");
$router->addRoute("POST", "/registerSubmit", "AccountController@submitRegistration");


// Login Routes
$router->addRoute("GET", "/login", "LoginController@index");
$router->addMiddleware("/login", "checkLoggedIn");
$router->addRoute("POST", "/loginSubmit", "AccountController@submitLogin");
$router->addRoute("GET", "/logout", "AccountController@logout");


// Products Routes {} is a parameter
$router->addRoute("GET", "/products", "ProductsController@index");
$router->addRoute("GET", "/products/all", "ProductsController@getAllProducts");
$router->addRoute("GET", "/products/type", "ProductsController@getProductsByType");
$router->addRoute("GET", "/products/{productType}", "ProductsController@getProductsByType");


$router->addRoute("GET", "/dashboard", "DashboardController@index");
$router->addMiddleware("/dashboard", "userAuth");

$router->addRoute("GET", "/pets", "MyPetsController@index");
$router->addMiddleware("/pets", "userAuth");




// Handles the request
$router->handleRequest($uri, $method);


?>