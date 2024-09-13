<?php

namespace App\Controllers;
use App\Services\TokenService;
use App\Services\EmailService;
use App\Services\UserService;

class VerifyEmailController {

    private $tokenService;
    private $emailService;
    private $userService;

    public function __construct() {
        $this->tokenService = new TokenService();
        $this->emailService = new EmailService();
        $this->userService = new UserService();
    }

    public function index() {
        require_once __DIR__ . '../../Views/auth/verifyEmail.php';
    }

    public function verified() {
        require_once __DIR__ . '../../Views/auth/verifiedEmail.php';
    }

    public function verify($user_id, $token) {

        if ($this->tokenService->isValidToken($user_id, $token) == "valid_token") {
            if ($this->userService->VerifyUserEmail($user_id) ) {
                echo( json_encode(["type" => "success", "message" => "Email verification successful"]) );
                header("Location: /verifiedEmail"); # This could be in JS, but the user would have to be taken to a page.
            } else {
                echo( json_encode(["type" => "error", "message" => "Email verification failed. Please contact support"]) );
                header("Location: /verifiedEmail?error=email_verification_failed"); # This could be in JS, but the user would have to be taken to a page.
            }
        } else {
            echo( json_encode(["type" => "error", "message" => "Invalid token"]) );
        }
    }


    public function resendEmail() {
        if ($this->emailService->resendEmailToken() == "success") {
            echo( json_encode(["type" => "success", "message" => "Email sent successfully"]) );
        } else {
            echo( json_encode(["type" => "error", "message" => "Error sending email"]) );
        }
    }


}