<?php

// Imports that are not autoloaded.
require_once (__DIR__ . '/app/includes/Database.php');

// autoload classes
spl_autoload_register(function ($class) {
    require (__DIR__ . '/app/Controllers/' . $class . '.php');
});

class Router {
    protected $routes = [];

    // REQUEST METHOD, ROUTE, CONTROLLER

    public function addRoute($requestMethod, $route, $controller) {
        $this->routes[$route] = [
            "requestMethod" => $requestMethod,
            "controller" => $controller
        ];
    }


    public function handleRequest($URI, $method) {

        // Seperate the requestedURI by ? to get the route and the parameters
        $seperatedURI = explode("?", $URI);

        $URIParams = $seperatedURI[1] ?? null; 
        $URI = $seperatedURI[0];

        
        // regex {}
        $pattern = "/\:([a-zA-Z0-9_]+)/ ";
        var_dump(urldecode($URI));
        preg_match_all($pattern, urldecode($URI), $matches);
        var_dump($matches);



        // Check if the requested URI exists in routes array
        if (array_key_exists($URI, $this->routes)) {

            if ($this->routes[$URI]["requestMethod"] != $method) {
                // If the request method does not match the route method, handle 405 error
                http_response_code(405);
                // ! Allowed methods should not be displayed in production.
                echo "Method not allowed" . "<br>" . "Allowed methods: " . $this->routes[$URI]["requestMethod"];
                exit();
            }



            // Get the controller from the routes array
            $controller = $this->routes[$URI]["controller"];
            $controller = explode("@", $controller);
            
            $controllerName = $controller[0];
            $methodName = $controller[1] ?? "index";



            // Check if the controller exists
            if (class_exists($controllerName)){
                $controllerName = new $controllerName();
            } else {
                exit("Class does not exist: \"" .  $controllerName . "\" ");
            }



            // Check if the method exists in the class, execute method.
            if (method_exists($controllerName, $methodName)){

                if (isset($params)) {
                    call_user_func_array(array($controllerName, $methodName), array($params));
                } else {
                    $controllerName->$methodName();
                }

            } else {
                exit("Method does not exist: \"" .  $methodName . "\" ");
            }


        } else {
            // If route not found, handle 404 error
            http_response_code(404);
            require_once (__DIR__ . '/app/Views/404.php');
        }
    }

}