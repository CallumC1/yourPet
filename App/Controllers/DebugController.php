<?php

namespace App\Controllers;

class DebugController {
    
    public function index() {
        require_once __DIR__ . '../../Views/debug.php';
    }
}