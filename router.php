<?php

class Router {
    protected $routes = [];

    public function addRoute($uri, $handler) {
        $this->routes[$uri] = $handler;
    }


    public function handleRequest($uri) {
        if (array_key_exists($uri, $this->routes)) {
            return $this->routes[$uri]();
        } else {
            http_response_code(404);
            echo('404 Not Found');
        }
    }

}


$router = new Router();

$router->addRoute('/', function() {
    echo('Home Page');
});


$router->addRoute('/about', function() {
    echo('About Page');
});


$uri = $_SERVER['REQUEST_URI'];
$router->handleRequest($uri);