<?php

class AccountModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }

    public function insertRegistrationData ($name, $email, $password_hash) {
        $sql = "INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)";
        $params = ["sss", [$name, $email, $password_hash]];

        $result =  $this->db->insertQuery($sql, $params);

        if ($result != false) {
            echo "Form submitted successfully";

            header("Location: /login");

        } else {
            echo "Form submission failed";
        }
    }


    public function checkLogin($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $params = ["s", [$email]];

        $result = $this->db->executeQuery($sql, $params);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false;
        }
    }


    
}