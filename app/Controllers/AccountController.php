<?php

require_once __DIR__ . '/../Models/AccountModel.php';

class AccountController {

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

            // Check if the user has verified their email, if not, generate a new token
            // Do not assign session variables if the email is not verified.
            $user_id = $user['user_id'];
            $emailVerified = $this->checkEmailVerified($user_id);

            // If the email is not verified, generate a new token.
            if (!$emailVerified) {
                $_SESSION["error"] = ["email_not_verified", "Please verify your email"];

                $this->generateEmailVerificationToken($user_id);
                echo "Email not verified, please verify your email";
                
                // Redirect to the email verification page
                include(__DIR__ . '/../Views/components/testEmail.php');
                exit();

            }
            
            $_SESSION["user_data"] = [
                "id" => $user['user_id'],
                "name" => $user['user_name'],
                "email" => $user['user_email']
            ];
            


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

    
    /**
     * Generates a token for the user to verify their email
     * Creates a new token if the user does not have one, otherwise updates the existing token.
     * 
     * Eventually this will send an email to the user with a link to verify their email.
     * And the token will be deleted once the email is verified or after a certain amount of time.
     */
    public function generateEmailVerificationToken($user_id) {
        echo "Generating Token <br>";
        $token = bin2hex(random_bytes(2));
        $model = new AccountModel();

        $hasToken = $model->checkUserHasEmailVerificationToken($user_id);

        if ($hasToken) {
            echo "User already has a token, regenerating token <br>";
            $result = $model->updateEmailVerificationToken($user_id, $token);
        } else {
            $result = $model->insertEmailVerificationToken($user_id, $token);
        }

    }



    public function test() {




        $resend = Resend::client('re_UWUxdTNd_CaCvcUrb5d2sRA9xDDHBexE3');

        $resend->emails->send([
            'from' => 'test@yourpet.callumc.net',
            'to' => 'rdskyra1234@gmail.com',
            'subject' => 'hello world',
            'html' => '<h1>Hello, world!</h1> <p>This is a test email</p>',
        ]);

    }


    /**
     * Verifys the users email using a token thy have provided in the URL.
     * 
     * @param string $providedToken
     */
    public function verifyEmailToken($user_id, $providedToken) {
        $model = new AccountModel();
        
        if (!$providedToken || !$user_id) {
            echo "No token provided or user id is not found";
            exit();
        }
        

        $verificationToken = $model->getEmailVerificationToken($user_id);
        if (!$verificationToken) {
            echo "Token not found";
            exit();
        }

        if ($providedToken != $verificationToken) {
            echo "Token does not match";
            exit();
        }

        $userVerified = $model->verifyUserEmail($user_id);
        if (!$userVerified) {
            echo "Error verifying user, please contact our support team.";
            exit();
        }

        // Take the user to the dashboard
        echo "Email verified";


    }

    public function checkEmailVerified($user_id) {
        $model = new AccountModel();

        $emailVerified = $model->isUserEmailVerified($user_id);

        return $emailVerified;    
        
    }

}