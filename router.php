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

        // check for {param} in route in regex
        if (preg_match('/{[a-zA-Z0-9]+}/', $route)) {
            echo("Route before regex:");
            var_dump($route);

            // Replace {param} with regex to match any string
            $route = preg_replace('/{[a-zA-Z0-9]+}/', '([a-zA-Z0-9]+)', $route);
            echo("Route after regex:");
            var_dump($route);
        }


        $this->routes[$route] = [
            "requestMethod" => $requestMethod,
            "controller" => $controller,
            // "params" => [["paramName", "location"]]
        ];

    }


    public function handleRequest($URI, $method) {

        $seperatedURI = explode("?", $URI);

        $URIParams = $seperatedURI[1] ?? null; 
        $URI = $seperatedURI[0];



        foreach ($this->routes as $route => $data) {

            $pattern = "@^" . $route . "$@D";
            $matches = [];

            // check if route exists in routes array

            // echo($route . " -URI-> " . $URI . "<br>");

            if ($route == $URI || preg_match($pattern, $URI, $matches)) {
                echo($route . " --> route matched <br>");
            } else {
                echo($route . " --> route not matched <br>");
            }

            continue;


            // Checks if the route contains regex to match parameters
            if (preg_match($pattern, $URI, $matches)) {
                echo("Matches:");
                var_dump($matches);

                // $stringLength = strlen($matches[0]);
                // $stringLength -= strlen($matches[1]);
                // echo("String length: " . $stringLength . "<br>");

                echo("pattern:");
                var_dump($pattern);

            } else {
                // Get the controller from the routes array
                $controller = $data["controller"];
                $controller = explode("@", $controller);

                echo("Controller:");
                var_dump($controller);
                
                $controllerName = $controller[0];
                $methodName = $controller[1] ?? "index";
                echo("Method name:");
                var_dump($methodName);

                // Run the method

                $controllerName->$methodName();
            }




        }

        exit();


        // End of testing grounds


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