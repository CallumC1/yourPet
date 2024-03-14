<?php

// Imports that are not autoloaded.
require_once (__DIR__ . '/app/includes/Database.php');

// Autoloads classes and middleware
spl_autoload_register(function ($class) {
    $controllerPath =  __DIR__ . '/app/Controllers/' . $class . '.php';
    $middlewarePath = __DIR__ . '/app/Middleware/' . $class . '.php';

    if (file_exists($controllerPath)) {
        require_once $controllerPath;
    } else if (file_exists($middlewarePath)) {
        require_once $middlewarePath;
    }
});

class Router {
    protected $routes = [];
    protected $middleware = [];

    // REQUEST METHOD, ROUTE, CONTROLLER
    // Middleware is optional

    public function addRoute($requestMethod, $route, $controller) {

        // check for {param} in route in regex
        if (preg_match('/{[a-zA-Z0-9]+}/', $route)) {

            // Replace {param} with regex to match any string
            $route = preg_replace('/{[a-zA-Z0-9]+}/', '([a-zA-Z0-9]+)', $route);
        }

        $this->routes[$route] = [
            "requestMethod" => $requestMethod,
            "controller" => $controller,
        ];

    }


    // Add middleware to a route
    public function addMiddleware($route, $middleware) {
        $this->middleware[$route] = $middleware;
        // echo "Middleware added to route: " . $route;
    }


    public function handleRequest($URI, $method) {
        

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
                $middlewareName = $this->middleware[$route];

                // Initialize & execute the middleware.
                $middleware = new $middlewareName();
                $middleware->handle();
        
                exit();
            };
        


            // Get the parameter from preg_match
            $params = $matches[1] ?? null;

            // If the request method does not match the route method, handle 405 error
            if ($data["requestMethod"] != $method) {
                http_response_code(405);
                // ! Allowed methods should not be displayed in production.
                echo "Method not allowed" . "<br>" . "Allowed methods: " . $data["requestMethod"];
                exit();
            }

            // Get the controller from the routes array
            $controller = $data["controller"];
            $controller = explode("@", $controller);

            $controllerName = $controller[0];
            $methodName = $controller[1] ?? "index";



            // Check if the controller exists
            if (!class_exists($controllerName)) {
                exit("Class does not exist: \"" .  $controllerName . "\" ");
            }

            // Check if the method exists
            if (!method_exists($controllerName, $methodName)) {
                exit("Method does not exist: \"" .  $methodName . "\" ");
            }


            // Initialize the controller 
            $controllerName = new $controllerName();


            // If the route has parameters, pass them to the method (WIP)
            if (isset($params)) {
                call_user_func_array(array($controllerName, $methodName), array($params));
            } else {
                $controllerName->$methodName();
            }


        }

        // If route not found, handle 404 error
        if (!$routeFound) {
            http_response_code(404);
            require_once (__DIR__ . '/app/Views/404.php');
        }
    }
}