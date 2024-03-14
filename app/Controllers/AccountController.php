<?php

require_once __DIR__ . '/../Models/AccountModel.php';

class AccountController {

    public function auth_user($email, $password) {

        $model = new AccountModel();
        $result = $model->checkLogin($email, $password);

        if (password_verify($password, $result['password_hash'])) {

            $_SESSION["user_data"] = [
                "id" => $result['user_id'],
                "name" => $result['name'],
                "email" => $result['email']
            ];

            header("Location: /dashboard");

        } else {
            echo "Login failed";
        }

    }

    
    public function submitRegistration() {

        if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password'])) {
            echo "Please enter your name, email and password";
            header("Location: /register");
            exit();
        }

        if (!isset($_POST['terms'])) {
            $_SESSION['error'] = "Please agree to the terms of service and privacy policy";
            header("Location: /register");
            exit();
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $model = new AccountModel();

        // Check if the user already exists
        if ($model->checkUserExists($email)) {
            $_SESSION['error'] = "User already exists";
            header("Location: /register");
            exit();
        }

        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        
        $result = $model->insertRegistrationData($name, $email, $password_hash);

        if ($result != false) {
            $this->auth_user($email, $password);
        } else {
            echo "Registeration failed, please contact support.";
        }

    }


    public function submitLogin() {
        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            echo "Please enter your email and password";
            header("Location: /login");
            exit();
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $this->auth_user($email, $password);

    }
    

    public function logout() {
        session_destroy();
        header("Location: /");
    }

}