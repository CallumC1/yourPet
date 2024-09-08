<?php

namespace App\Controllers;


class MyPetsController {
    
    public function index() {

        require __DIR__ . '../../Views/user/mypets.php';
    }
}