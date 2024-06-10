<?php

require_once __DIR__ . '/../Models/AccountModel.php';

class VerifyEmailController {

    private $tokenService;

    public function __construct() {
        $this->tokenService = new TokenService();
    }

    public function index() {

        $tokenState = $this->tokenService->checkToken($_SESSION["user_data"]["id"]);

        echo $tokenState;

        require_once __DIR__ . '../../Views/verifyEmail.php';
    }


}