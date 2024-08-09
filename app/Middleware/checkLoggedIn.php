<?php

class checkLoggedin {

    public function handle() {
        // Check if user is logged in
        if (isset($_SESSION['user_data']) && $_SESSION['user_data']['email_verified']) {
            header("Location: /dashboard");
            exit();
        }
    }
}


