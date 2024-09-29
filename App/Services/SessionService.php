<?php

namespace App\Services;

class SessionService {

    public function __construct() {
    }

    public function start(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function destory() {
        session_destroy();
    }


}