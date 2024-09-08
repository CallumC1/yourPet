<?php

namespace App\Controllers;
use App\Utils\ValidatorUtil;
use App\Services\UserService;

class LoginController {

    private $UserService;
    private $Validator;

    public function __construct() {
        $this->Validator = new ValidatorUtil();
        $this->UserService = new UserService();
    }
    
    public function index() {
        require_once __DIR__ . '../../Views/login.php';
    }

    public function processLogin(){
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        $this->Validator->validateRequired("email", $email, "Email is required.");
        $this->Validator->validateRequired("password", $password, "Password is required.");
        
        if ($this->Validator->hasErrors()) {
            echo (json_encode([
                "type" => "error",
                "errors" => $this->Validator->getErrors()
            ]));
            exit();
        }


        $authResponse = $this->UserService->AuthenticateUser($email, $password);
        if ($authResponse->status == "error") {
            switch($authResponse->message) {
                case 'no_user':
                    echo( json_encode([
                        "type" => "error",
                        "formField" => "email",
                        "message" => "An account with these credentials does not exist."
                    ]));
                    break;
                case 'invalid_credentials':
                    echo( json_encode([
                        "type" => "error",
                        "formField" => "general",
                        "message" => "Username or Password is invalid."
                    ]));
                    break;
                case 'email_not_verified':
                    // Set the session with the user data so we can use it elsewhere.
                    $this->UserService->setSession($authResponse->user);
                    echo( json_encode([
                        "type" => "error",
                        "redirect" => "/verifyEmail",
                        "message" => "Email not verified."
                    ]));
                    break;
            }
            exit();
        }
        // Set the session if the user is authenticated.
        $this->UserService->setSession($authResponse->user); 

        // Redirect to dashboard if successful
        echo( json_encode(["type" => "success", "message" => "User Authenticated."]) );
        exit();

    }
    
}