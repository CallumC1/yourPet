<?php

class RegisterModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }

    public function insertRegistrationData ($name, $email, $password_hash) {
        $sql = "INSERT INTO users (user_name, user_email, user_password_hash) VALUES (?, ?, ?)";
        $params = ["sss", [$name, $email, $password_hash]];

        $regResult =  $this->db->insertQuery($sql, $params);

        return $regResult;
    }
} 