<?php

class AccountModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }

    public function checkUserExists($email) {
        $sql = "SELECT user_email FROM users WHERE user_email = ?";
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


    public function getUserbyEmail($email) {
        $sql = "SELECT * FROM users WHERE user_email = ?";
        $params = ["s", [$email]];

        $result = $this->db->executeQuery($sql, $params);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false;
        }
    }


    public function getUserRole($user_id) {
        $sql = "SELECT user_roles FROM users WHERE user_id = ?";
        $params = ["s", [$user_id]];

        $result = $this->db->executeQuery($sql, $params);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false;
        }
    }

    public function verifyUserEmail($user_id) {
        $sql = "UPDATE users SET email_verified = 1 WHERE user_id = ?";
        $params = ["s", [$user_id]];

        $result = $this->db->insertQuery($sql, $params);
        
        return $result;
    }


    public function isUserEmailVerified($user_id) {
        $sql = "SELECT email_verified FROM users WHERE user_id = ?";
        $params = ["s", [$user_id]];

        $result = $this->db->executeQuery($sql, $params);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["email_verified"];
        } else {
            return false;
        }
    }




    
}