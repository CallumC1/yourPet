<?php


class LoginController {

    private $UserService;

    public function __construct() {
        $this->UserService = new UserService();
    }
    
    public function index() {

        
        $error = isset($_SESSION["error"]) ? $_SESSION["error"] : [""];
        $error_no_user = "";

        switch ($error[0]) {
            case "no_user":
                $error_no_user = $error[1];
                break;
            default:
                $error = "";
                break;
        }

        require_once __DIR__ . '../../Views/login.php';
    }

    public function processLogin(){
        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            echo( json_encode(["type" => "error", "formField" => "general", "message" => "Email or password was not submitted."]) );
            exit();
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->UserService->AuthenticateUser($email, $password);
        if ($user == "err_no_user") {
            echo( json_encode(["type" => "error", "formField" => "general", "message" => "An account with these credentials does not exist."]) );
            exit();
        } else if ($user == "err_invalid_credentials") {
            echo( json_encode(["type" => "error", "formField" => "general", "message" => "Username or Password is invalid."]) );
            exit();
        }
        
        // If email and password are correct, set the session.
        $this->UserService->setSession($user);

        // Redirect to dashboard if successful
        echo( json_encode(["type" => "success", "message" => "User Authenticated."]) );
        exit();

    }
    
}