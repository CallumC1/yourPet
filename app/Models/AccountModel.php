<?php

class AccountModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }


    public function checkUserExists($email) {
        $sql = "SELECT email FROM users WHERE email = ?";
        $params = ["s", [$email]];

        $result = $this->db->executeQuery($sql, $params);
        $result = $result->num_rows;
 

        // If the user exists, return true
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function insertRegistrationData ($name, $email, $password_hash) {
        $sql = "INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)";
        $params = ["sss", [$name, $email, $password_hash]];

        $result =  $this->db->insertQuery($sql, $params);

        return $result;
    }


    public function checkLogin($email) {
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