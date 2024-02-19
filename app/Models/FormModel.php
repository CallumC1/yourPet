<?php

class FormModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }

    public function insertFormData($name, $email) {
        $sql = "INSERT INTO results (name, email) VALUES (?, ?)";
        $params = ["ss", [$name, $email]];

        $result =  $this->db->executeQuery($sql, $params);

        return $result;
        
    }
}