<?php


class Database {
    private $conn;
    
    // Create a connection to the database
    public function __construct() {
        $host = getenv('MYSQL_HOST');
        $db_name = getenv('MYSQL_DATABASE');
        $username = getenv('MYSQL_USER');
        $password = getenv('MYSQL_PASSWORD');
        $this->conn = new mysqli($host, $username, $password, $db_name);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

    }

    // Insert a query into the database
    public function insertQuery($sql, $params = "" ) {
        $stmt = $this->conn->prepare($sql);

        if ($params != "") {
            $stmt->bind_param($params[0], ...$params[1]);
        }
        
        try {
            $result = $stmt->execute();
            $stmt->close();
            return $result;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            $stmt->close();
            return false;
        }        

    }

    // Execute a query and return the result
    public function executeQuery($sql, $params = "") {

        $stmt = $this->conn->prepare($sql);

        if ($params != "") {
            // ... unpacks the array into separate variables
            $stmt->bind_param($params[0], ...$params[1]);
        } 
        
        try {
            $result = $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            $stmt->close();
            return false;
        }       
    }

}