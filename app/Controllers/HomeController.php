<?php
require_once __DIR__ . '/../Models/ProductsModel.php';


class HomeController {
    
    public function index() {

        $productsModel = new ProductsModel();
        $products = $productsModel->getProductsData();

        require_once __DIR__ . '../../Views/home.php';
    }
}