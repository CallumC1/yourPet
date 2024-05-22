<?php

$host = getenv('MYSQL_HOST');
$db = getenv('MYSQL_DATABASE');
$user = getenv('MYSQL_USER');
$pass = getenv('MYSQL_PASSWORD');


class Database {
    // private $host = "localhost";
    // private $db_name = "yourpet";
    // private $username = "root";
    // private $password = "";
    private $conn;

    // Create a connection to the database
    public function __construct() {
        echo "host: " . $host;
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

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