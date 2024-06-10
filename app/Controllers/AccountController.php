<?php

require_once __DIR__ . '/../Models/AccountModel.php';

class AccountController {

    private $tokenService;

    public function __construct() {
        $this->tokenService = new TokenService();
    }

    public function auth_user($email, $password) {

        // Get the users hashed password from the database
        $model = new AccountModel();
        $user = $model->checkLogin($email);


        // If the user doesnt exist, return false
        if (!$user) {
            $_SESSION["error"] = ["no_user", "User with that email doesnt exist"];
            return False;
        }

        if (password_verify($password, $user['user_password_hash'])) {

            $_SESSION["user_data"] = [
                "id" => $user['user_id'],
                "name" => $user['user_name'],
                "email" => $user['user_email']
            ];

            // Check if the user has verified their email, if not, generate a new token
            $user_id = $user['user_id'];
            $user_email = $user['user_email'];
            $emailVerified = $this->checkEmailVerified($user_id);

            // If the email is not verified, generate a new token.
            if (!$emailVerified) {
                $_SESSION["error"] = ["email_not_verified", "Please verify your email"];

                $generatedToken = $this->tokenService->generateToken($user_id);
                $saveSuccess = $this->tokenService->saveToken($user_id, $generatedToken);

                // A token is only saved if a new token is generated. So if the token is saved, send the email.
                if ($saveSuccess) {
                    $this->tokenService->sendEmailVerificationToken($user_id, $user_email, $generatedToken);
                } 

                include(__DIR__ . "/../Views/verifyEmail.php");
                exit();

            }
            
            
            return True;

        } else {
            // If the password is incorrect, return false
            $_SESSION["error"] = ["incorrect_details", "Email or Password not correct"];
            return False;
        }

    }

    
    public function submitRegistration() {

        if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password'])) {
            echo "Please enter your name, email and password";
            header("Location: /register");
            exit();
        }

        if (!isset($_POST['terms'])) {
            $_SESSION["error"] = ["terms", "Please agree to the terms of service and privacy policy"];

            header("Location: /register");
            exit();
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $model = new AccountModel();

        // Check if the user already exists
        if ($model->checkUserExists($email)) {
            // Error = Type, Message 
            $_SESSION["error"] = ["email", "User with that email already exists"];
            header("Location: /register");
            exit();
        }

        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $result = $model->insertRegistrationData($name, $email, $password_hash);

        if (!$result) {
            echo "Registeration failed, please contact support.";
            exit();
        }

        if (!$this->auth_user($email, $password) ) {
            echo ("Automatic Login failed, please contact support.");
            exit();
        }

        // Redirect to dashboard if successful
        header("Location: /dashboard");
        exit();

    }


    public function submitLogin() {
        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            echo "Please enter your email and password";
            header("Location: /login");
            exit();
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!$this->auth_user($email, $password)) {
            // Error is set in the auth_user function
            header("Location: /login");
            exit();
        }

        // Redirect to dashboard if successful
        header("Location: /dashboard");
        exit();

    }
    

    public function logout() {
        session_destroy();
        header("Location: /");
    }

    public function checkEmailVerified($user_id) {
        $model = new AccountModel();
        $emailVerified = $model->isUserEmailVerified($user_id);
        return $emailVerified;    
    }

    public function verifyEmailToken($user_id, $providedToken) {
        return $this->tokenService->verifyToken($user_id, $providedToken);
    }

    // Generate a new token and send it to the user
    public function resendEmailToken() {
        $user_id = $_SESSION["user_data"]["id"];
        $user_email = $_SESSION["user_data"]["email"];
        $generatedToken = $this->tokenService->generateToken($user_id);
        $saveSuccess = $this->tokenService->saveToken($user_id, $generatedToken);
        
        if ($saveSuccess) {
            $this->tokenService->sendEmailVerificationToken($user_id, $user_email, $generatedToken);
            echo(json_encode(["success" => "Email sent"]));
        } else {
            echo(json_encode(["error" => "Error sending email"]));
        }
        
    } 

}