<?php

require_once __DIR__ . '/../Models/AccountModel.php';

class AccountController {
    
    public function submitRegistration() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        
        $model = new AccountModel();
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