<?php

require_once __DIR__ . '/../Models/AccountModel.php';

class AccountController {
    
    public function submitRegistration() {
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
        
        $model->insertRegistrationData($name, $email, $password_hash);
    }


    public function submitLogin() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $model = new AccountModel();
        $result = $model->checkLogin($email, $password);

        

        if (password_verify($password, $result['password_hash'])) {
            echo "Login successful";
            $_SESSION["user_data"] = [
                "id" => $result['user_id'],
                "name" => $result['name'],
                "email" => $result['email']
            ];
        } else {
            echo "Login failed";
        }

    }

}