<?php
namespace App\Middleware;

class checkLoggedIn {

    public function handle() {
        // Check if user is logged in
        if (isset($_SESSION['user_data'])) {

            if (!isset($_SESSION['user_data']['email_verified'])) {
                header("Location: /verifyEmail");
                exit();
            }

            header("Location: /dashboard");
            exit();
        }
    }
}


