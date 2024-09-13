<?php

namespace App\Routes;

class router {

    protected $routes = [];
    protected $middleware = [];

    // REQUEST METHOD, ROUTE, CONTROLLER
    // Middleware is optional

    public function addRoute($requestMethod, $route, $controller) {
        $controller = "App\\Controllers\\" . $controller;

        // check for {param} in route in regex
        if (preg_match('/{[a-zA-Z0-9-]+}/', $route)) {

            // Replace {param} with regex to match any string
            $route = preg_replace('/{[a-zA-Z0-9-]+}/', '([a-zA-Z0-9-]+)', $route);
        }
        
        $this->routes[$route] = [
            "requestMethod" => $requestMethod,
            "controller" => $controller,
        ];

    }


    // Add middleware to a route
    public function addMiddleware($route, $middleware) {

        // When middleware is added, check the string for an @ symbol to split the middleware and method apart.
        // If no method is provided, default to handle.
        $method = explode("@", $middleware);
        $middleware = "App\\Middleware\\" . $method[0];
        $methodName = $method[1] ?? "handle";


        $this->middleware[$route] = [
            "middleware" => $middleware,
            "methodName" => $methodName,
        ];
    }


    public function handleRequest($URI, $method) {
        session_start();

        $seperatedURI = explode("?", $URI);
        $URIParams = $seperatedURI[1] ?? null; 
        $URI = $seperatedURI[0];
        $URI = rtrim($URI, "/");

        $routeFound = false;

        foreach ($this->routes as $route => $data) {

            $pattern = "@^" . $route . "$@D";
            $matches = [];

            // check if route exists in routes array.
            if (!preg_match($pattern, $URI, $matches)) {                
                continue;
            }

            $routeFound = true;
            

            // Middleware Logic
            // Check if the route has middleware
            if (isset($this->middleware[$route])) {
                $middlewareName = $this->middleware[$route]["middleware"];
                $middlewareMethodName = $this->middleware[$route]["methodName"];

                // Initialize & execute the middleware.
                $middleware = new $middlewareName();

                // Change handle to split method.
                $middleware->$middlewareMethodName();
        
            };

            // If the request method does not match the route method, handle 405 error
            if ($data["requestMethod"] != $method) {
                http_response_code(405);
                // ! Allowed methods should not be displayed in production.
                echo "Method not allowed" . "<br>" . "Allowed methods: " . $data["requestMethod"];
                exit();
            }


            // Get controller & Split the method
            $controller = explode("@", $data["controller"]);
            $controllerName = $controller[0];
            $methodName = $controller[1] ?? "index";


            // Check if the controller and method exists
            if (!class_exists($controllerName) || !method_exists($controllerName, $methodName)) {
                exit("Class or Method does not exist: \"" .  $controllerName . "\" or \"" . $methodName . "\" ");
            }


            // Initialize a new controller 
            $controllerName = new $controllerName();

            
            // Get the parameters from preg_match
            // Remove the first element from the array, as it is the full match
            // The rest of the array are the parameters
            $slicedArray = array_slice($matches, 1);
            $params = $slicedArray ?? null;

            // If the route has parameters, pass them to the method as an unpacked array
            if (isset($params)) {
                call_user_func_array(array($controllerName, $methodName), array(...$params));
            } else {
                $controllerName->$methodName();
            }

            // Exit the loop if route is founds
            exit();

        }

        // If route not found, handle 404 error
        if (!$routeFound) {
            http_response_code(404);
            require_once __DIR__ . '/../Views/404.php';
        }
    }
}