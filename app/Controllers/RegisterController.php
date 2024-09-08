<?php

namespace App\Controllers;
use App\Utils\ValidatorUtil;
use App\Services\UserService;
use App\Services\EmailService;

class RegisterController {

    private $UserService;
    private $EmailService;
    private $Validator;

    public function __construct() {
        $this->UserService = new UserService();
        $this->EmailService = new EmailService();
        $this->Validator = new ValidatorUtil();
    }
    
    public function index() {
        require_once __DIR__ . '/../../Views/auth/register.php';
    }


    public function processRegistration() {
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $checkbox = $_POST['terms'] ?? null;

        // Check if all fields are filled out

        $this->Validator->validateRequired("name", $name, "Name is required.");
        $this->Validator->validateRequired("email", $email, "Email is required.");
        $this->Validator->validateRequired("password", $password, "Password is required.");
        $this->Validator->validateRequired("terms", $checkbox, "Please agree to the terms of service and privacy policy to continue.");

        // Specific Validations
        $this->Validator->validateMinLength("name", $name, 3, "Name must be at least 3 characters long.");
        $this->Validator->validateMaxLength("name", $name, 50, "Name must be less than 50 characters long.");
        $this->Validator->validateMinLength("password", $password, 8, "Password must be at least 8 characters long.");
        $this->Validator->validateMaxLength("password", $password, 100, "Password must be less than 0 characters long.");
        $this->Validator->validateEmail("email", $email, "Email is not valid.");

        if ($this->Validator->hasErrors()) {
            echo( json_encode([
                "type" => "error", 
                "errors" => $this->Validator->getErrors()
                ]) );
            exit();
        }

        $userExists = $this->UserService->checkUserExists($email);
        if ($userExists) {
            // Error = Type, Effected field, Message 
            echo( json_encode([
                "type" => "error", 
                "formField" => "email", 
                "message" => "User with that email already exists"
                ]));
            exit();
        }
        
        // Register the user and ensure succeessfull.
        $regResult = $this->UserService->RegisterUser($name, $email, $password);
        if (!$regResult) {
            echo( json_encode([
                "type" => "error", 
                "message" => "Registeration failed, please contact support."
                ]));
            exit();
        }

        // Registration successful

        // Users session needs to be set before anything email related is done.
        $user = $this->UserService->getUserByEmail($email);
        $this->UserService->SetSession($user);

        // After account creation, send the email verification email
        $this->UserService->EmailVerification($user["user_id"], $user["user_email"]);

        // Return success message, JS will redirect to the verify email page.
        echo( json_encode([
            "type" => "success", 
            "message" => "Registration successful!"
            ]) );
        exit();

    }

    public function sendVerificationEmail() {

    }
    
}