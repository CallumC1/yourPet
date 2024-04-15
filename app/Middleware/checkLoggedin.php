<?php

class checkLoggedin {

    public function handle() {
        // Check if user is logged in
        if (isset($_SESSION['user_data'])) {
            header("Location: /dashboard");
            exit();
        }
    }
}


