<?php
namespace App\Services;
use App\Models\RegisterModel;
use App\Models\AccountModel;


use Ramsey\Uuid\Uuid;

class AuthResponse {
    public $status;
    public $message;
    public $user;

    public function __construct($status, $message, $user = null) {
        $this->status = $status;
        $this->message = $message;
        $this->user = $user;
    }
}

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
        $uuid = $this->generateUUID();

        $regResult = $this->registerModel->insertRegistrationData($uuid, $name, $email, $passwordHash);
        
        if (!$regResult) {
            error_log("User Registeration failed! Timestamp: " . date("Y-m-d H:i:s"));
        }

        return $regResult;

    }

    private function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function generateUUID() {#
        $uuid = Uuid::uuid4();
        return $uuid->toString();
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

    public function VerifyUserEmail($user_id) {
        $_SESSION["user_data"]["email_verified"] = 1;
        return $this->accountModel->verifyUserEmail($user_id);
    }


    public function GetUserByEmail($email) {
        return $this->accountModel->getUserbyEmail($email);
    }

    public function SetSession($user) {
        $_SESSION["user_data"] = [
            "id" => $user['user_id'],
            "name" => $user['user_name'],
            "email" => $user['user_email'],
            "email_verified" => $user['email_verified'] // This needs to be true for the user to log in.
        ];
    }

    public function AuthenticateUser($user_email, $password) {
        $user = $this->accountModel->getUserbyEmail($user_email);
        // For security reasons, we shouldnt return at this point as the timing of the response can be used to determine if the email exists.
        if (!$user) {
            return new AuthResponse("error", "no_user");
        }

        // Check if the users password matches the hash.
        if (!password_verify($password, $user['user_password_hash'])) {
            return new AuthResponse("error", "invalid_credentials");
        }

        if ($user['email_verified'] != 1) {
            return new AuthResponse("error", "email_not_verified", $user);
        }

        // If all checks pass, return the user data as success.
        return new AuthResponse("success", "User Authenticated", $user);

    }


    

}