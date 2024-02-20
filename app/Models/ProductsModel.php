<?php

class ProductsModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getProductsData() {
        $sql = "SELECT * FROM products";

        $result =  $this->db->executeQuery($sql);
        
        if ($result) {
            $result = $result->fetch_all(MYSQLI_ASSOC);
            var_dump($result);
            exit();
        } else {
            $result = false;
        }


        return $result;
    }

    public function getProductsByType($type) {
        $sql = "SELECT * FROM products WHERE product_type = ?";

        $params = ["s", [$type]];

        $result =  $this->db->executeQuery($sql, $params);
        
        if ($result) {
            $result = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $result = false;
        }

        return $result;
    }

}