<?php

// Entry point for the application and all its requests
// This file is the first file that is loaded when the user visits the website.

// Require session manager.
// Ideally, this could be a class that is instantiated and used to manage sessions.
require_once __DIR__ . '../../app/includes/sessions.php';

// Helpers
require_once __DIR__ . '../../app/includes/helpers.php';


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


// DEBUG ONLY
$router->addRoute("GET", "/debug", "DebugController@index");


// Registration Routes
$router->addRoute("GET", "/register", "RegisterController@index");
$router->addMiddleware("/register", "checkLoggedIn");
$router->addRoute("POST", "/registerUser", "RegisterController@processRegistration");


// Login Routes
$router->addRoute("GET", "/login", "LoginController@index");
$router->addMiddleware("/login", "checkLoggedIn");
$router->addRoute("POST", "/loginSubmit", "LoginController@processLogin");
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

// Admin Dashboard
$router->addRoute("GET", "/admin/dashboard", "AdminDashboardController@index");
$router->addMiddleware("/admin/dashboard", "userAuth@adminHandle");

// Testing routes
$router->addRoute("GET", "/auth/email", "AccountController@generateEmailVerificationToken");
$router->addRoute("GET", "/auth/email/resend", "VerifyEmailController@resendEmail");

$router->addRoute("GET", "/auth/email/{userid}/{token}", "VerifyEmailController@verify");
$router->addRoute("GET", "/verifyEmail", "VerifyEmailController@index");
$router->addRoute("GET", "/verifiedEmail", "VerifyEmailController@verified");




// Handles the request
$router->handleRequest($uri, $method);


?>