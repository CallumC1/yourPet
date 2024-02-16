<?php

class Router {
    protected $routes = [];

    // Function to add routes
    public function addRoute($url, $handler) {
        $this->routes[$url] = $handler;
    }


    public function handleRequest($uri) {

        // Seperate the uri by ? to get the route and the parameters
        $uri = explode("?", $uri);

        // Set the parameters to the second element of the array, which is the parameters
        $params = $uri[1] ?? null;

        // Set the uri to the first element of the array, which is the route
        $uri = $uri[0];

        // Check if the requested URL exists in routes array
        if (array_key_exists($uri, $this->routes)) {
            // If exists, call the handler associated with the route 
            $handler = $this->routes[$uri];
            $handler();
        } else {
            // If route not found, handle 404 error
            http_response_code(404);
            echo "404 Not Found";
        }
    }

}