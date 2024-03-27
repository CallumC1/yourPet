<?php


class RegisterController {
    
    public function index() {

        $error = isset($_SESSION["error"]) ? $_SESSION["error"] : "";
        $error_email = "";
        $error_terms = "";

        switch ($error[0]) {
            case "email":
                $error_email = $error[1];
                break;
            case "terms":
                $error_terms = $error[1];
                break;
            default:
                $error = "";
                break;
        }

     
        
        require_once __DIR__ . '../../Views/register.php';
    }
    
}