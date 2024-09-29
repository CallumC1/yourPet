<?php
namespace App\Models;
use App\Includes\Database;

class TokenModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }


    // Check if a token for the user exists already
    public function checkActiveToken($user_id) {
        $sql = "SELECT generated_at, expires_at FROM email_verification WHERE FK_user_id = ?";
        $params = ["s", [$user_id]];

        $result = $this->db->executeQuery($sql, $params);

        if (!$result->num_rows > 0) {
            return false;
        }

        $result = $result->fetch_assoc();

        return $result;
    }

    public function insertToken($user_id, $token, $generated_at, $expires_at) {
        
        $sql = "INSERT INTO email_verification (FK_user_id, token, generated_at, expires_at) VALUES (?, ?, ?, ?)";
        $params = ["ssss", [$user_id, $token, $generated_at, $expires_at]];
        
        $result = $this->db->insertQuery($sql, $params);
        
        return $result;
    }
        
        
    // If a token exists, just update the token
    public function updateToken($user_id, $token, $generated_at, $expires_at) {
        $sql = "UPDATE email_verification SET token = ?, generated_at = ?, expires_At = ? WHERE FK_user_id = ?";
        $params = ["ssss", [$token, $generated_at, $expires_at, $user_id]];

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
    public function getToken($user_id) {
        
        $sql = "SELECT token FROM email_verification WHERE FK_user_id = ?";
        $params = ["s", [$user_id]];

        $result = $this->db->executeQuery($sql, $params);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["token"];
        } else {
            return false;
        }

    }


}