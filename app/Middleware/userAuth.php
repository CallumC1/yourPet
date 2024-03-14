<?php

class userAuth {

    public function handle() {
        echo("Middleware for dashboard");

        // Check if user is logged in
        if (!isset($_SESSION['user_data'])) {
            header("Location: /login");
            exit();
        }
    }
}


