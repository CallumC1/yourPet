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


    public function insertRegistrationData ($name, $email, $password_hash) {
        $sql = "INSERT INTO users (user_name, user_email, user_password_hash) VALUES (?, ?, ?)";
        $params = ["sss", [$name, $email, $password_hash]];

        $result =  $this->db->insertQuery($sql, $params);

        return $result;
    }


    public function checkLogin($email) {
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
        $params = ["i", [$user_id]];

        $result = $this->db->executeQuery($sql, $params);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false;
        }
    }


    // Check if a token for the user exists already
    public function checkUserHasEmailVerificationToken($user_id) {
        $sql = "SELECT * FROM email_verification WHERE FK_user_id = ?";
        $params = ["i", [$user_id]];

        $result = $this->db->executeQuery($sql, $params);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertEmailVerificationToken($user_id, $token) {

        $sql = "INSERT INTO email_verification (FK_user_id, token) VALUES (?, ?)";
        $params = ["is", [$user_id, $token]];

        $result = $this->db->insertQuery($sql, $params);

        return $result;
    }

    // If a token exists, just update the token
    public function updateEmailVerificationToken($user_id, $token) {
        $sql = "UPDATE email_verification SET token = ? WHERE FK_user_id = ?";
        $params = ["si", [$token, $user_id]];

        $result = $this->db->insertQuery($sql, $params);

        return $result;
    }

    // User signsup
    // User is sent an email with a token
    // User clicks the link in the email
    // User is redirected to the site with the token in the URL
    // The token is checked against the database using the user_id from the session
    // If the token is valid, the user is verified
    // If the token is invalid, the user is not verified
    // The token is then deleted from the database

    // Check if a users token is valid
    public function getEmailVerificationToken($user_id) {
        
        $sql = "SELECT token FROM email_verification WHERE FK_user_id = ?";
        $params = ["i", [$user_id]];

        $result = $this->db->executeQuery($sql, $params);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["token"];
        } else {
            return false;
        }

    }

    public function verifyUserEmail($user_id) {
        $sql = "UPDATE users SET email_verified = 1 WHERE user_id = ?";
        $params = ["i", [$user_id]];

        $result = $this->db->insertQuery($sql, $params);
        
        return $result;
    }


    public function isUserEmailVerified($user_id) {
        $sql = "SELECT email_verified FROM users WHERE user_id = ?";
        $params = ["i", [$user_id]];

        $result = $this->db->executeQuery($sql, $params);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["email_verified"];
        } else {
            return false;
        }
    }




    
}