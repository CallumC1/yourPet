<?php


class RegisterController {

    private $UserService;
    private $EmailService;

    public function __construct() {
        $this->UserService = new UserService();
        $this->EmailService = new EmailService();
    }
    
    public function index() {

        // TODO: REMOVE THIS.
        // $error = isset($_SESSION["error"]) ? $_SESSION["error"] : [""];
        // $error_email = "";
        // $error_terms = "";

        // switch ($error[0]) {
        //     case "email":
        //         $error_email = $error[1];
        //         break;
        //     case "terms":
        //         $error_terms = $error[1];
        //         break;
        //     default:
        //         $error = "";
        //         break;
        // }
        
        require_once __DIR__ . '../../Views/register.php';
    }

    public function processRegistration() {
        if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password'])) {
            // header("Location: /register");
            echo( json_encode(["type" => "error", "formField" => "general" , "message" => "One or more fields have not been filled out."]) );
            exit();
        }

        if (!isset($_POST['terms'])) {
            // $_SESSION["error"] = ["terms", "Please agree to the terms of service and privacy policy"];
            // header("Location: /register");
            echo( json_encode(["type" => "error", "formField" => "terms", "message" => "Please agree to the terms of service and privacy policy to continue."]) );
            exit();
        }


        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];


        $userExists = $this->UserService->checkUserExists($email);
        if ($userExists) {
            // Error = Type, Effected field, Message 
            // $_SESSION["error"] = ["email", "User with that email already exists"];
            // header("Location: /register");
            echo( json_encode(["type" => "error", "formField" => "email", "message" => "User with that email already exists"]) );
            exit();
        }
        
        // Register the user and ensure succeessfull.
        $regResult = $this->UserService->RegisterUser($name, $email, $password);
        if (!$regResult) {
            echo( json_encode(["type" => "error", "message" => "Registeration failed, please contact support."]) );
            exit();
        }

        echo( json_encode(["type" => "success", "message" => "Registration successful!"]) );

        // Users session needs to be set before anything email related is done.
        $user = $this->UserService->getUserByEmail($email);
        $this->UserService->SetSession($user);

        // After account creation, send the email verification email
        // Should this be done when sent to the email verification page?
        $this->UserService->EmailVerification($user["user_id"], $user["user_email"]);
        exit();

    }

    public function sendVerificationEmail() {

    }
    
}