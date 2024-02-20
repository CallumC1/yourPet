<?php

class FormModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }

    public function insertFormData($name, $email) {
        $sql = "INSERT INTO results (name, email) VALUES (?, ?)";
        $params = ["ss", [$name, $email]];

        $result =  $this->db->insertQuery($sql, $params);

        return $result;
        
    }
    
    public function getFormData() {
        $sql = "SELECT * FROM results";

        $result =  $this->db->executeQuery($sql);
        
        if ($result) {
            $result = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $result = false;
        }


        return $result;
    }
}