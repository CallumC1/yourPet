<?php

class DashboardController {
    
    public function index() {

        var_dump( $_SESSION['user_data']);
        require __DIR__ . '../../Views/dashboard.php';
    }
}