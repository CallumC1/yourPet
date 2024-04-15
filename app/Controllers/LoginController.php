<?php


class LoginController {
    
    public function index() {

        
        $error = isset($_SESSION["error"]) ? $_SESSION["error"] : [""];
        $error_no_user = "";

        switch ($error[0]) {
            case "no_user":
                $error_no_user = $error[1];
                break;
            default:
                $error = "";
                break;
        }

        require_once __DIR__ . '../../Views/login.php';
    }
    
}