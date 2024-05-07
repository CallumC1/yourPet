<?php

class userAuth {

    public function handle() {
        // Check if user is logged in
        if (!isset($_SESSION['user_data'])) {
            header("Location: /login");
            exit();
        }
    }

    public function adminHandle() {
        // Check if user is logged in
        if (!isset($_SESSION['user_data'])) {
            header("Location: /login");
            exit();
        }

        // Check if user is an admin
        // For security reasons, in the future, the role should be checked against a database.
        if ($_SESSION['user_data']['role'] !== 'admin') {
            header("Location: /dashboard");
            exit();
        }
    }

}


