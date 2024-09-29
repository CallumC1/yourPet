<?php

namespace App\Controllers;


use App\Models\ProductsModel;



class HomeController {
    
    public function index() {

      

        $productsModel = new ProductsModel();
        $products = $productsModel->getProductsData();

        require_once __DIR__ . '../../Views/home.php';
    }
}