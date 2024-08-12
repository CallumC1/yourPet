<?php

class UserService {

    private $registerModel;
    private $accountModel;

    public function __construct() {
        $this->registerModel = new RegisterModel();
        $this->accountModel = new AccountModel();
    }
    
    public function checkUserExists($email) {
        return $this->accountModel->checkUserExists($email);
    }

    public function RegisterUser($name, $email, $password) {

        $passwordHash = $this->hashPassword($password);

        $regResult = $this->registerModel->insertRegistrationData($name, $email, $passwordHash);
        
        if (!$regResult) {
            error_log("User Registeration failed! Timestamp: " . date("Y-m-d H:i:s"));
        }

        return $regResult;

    }

    private function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function EmailVerification($user_id, $email) {
        $tokenService = new TokenService();


        // Check if the user already has a token
        $tokenStatus = $tokenService->checkToken($user_id);
        if ($tokenStatus == "TV") { // Token is still valid
            return;
        }

        $token = $tokenService->generateToken();
        $saveSuccess = $tokenService->saveToken($user_id, $token);

        if (!$saveSuccess) {
            error_log("Failed to save token for user: " . $user_id);
            return;
        }
        


        $emailService = new EmailService();
        $emailService->sendEmailVerificationToken($user_id, $email, $token);
    }


    public function GetUserByEmail($email) {
        return $this->accountModel->getUserbyEmail($email);
    }

    public function SetSession($user) {
        $_SESSION["user_data"] = [
            "id" => $user['user_id'],
            "name" => $user['user_name'],
            "email" => $user['user_email'],
            "email_verified" => $user['email_verified']
        ];
    }


    

}