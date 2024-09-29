<?php
namespace App\Models;
use App\Includes\Database;


class RegisterModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }

    public function insertRegistrationData ($uuid, $name, $email, $password_hash) {
        $sql = "INSERT INTO users (user_id, user_name, user_email, user_password_hash) VALUES (?, ?, ?, ?)";
        $params = ["ssss", [$uuid, $name, $email, $password_hash]];

        $regResult =  $this->db->insertQuery($sql, $params);

        return $regResult;
    }
} 
