<?php

require_once __DIR__ . '/../Models/FormModel.php';

class FormController {
    
    public function index() {
        require_once __DIR__ . '../../Views/form.php';
    }

    public function submit() {

        if (!$_SERVER['REQUEST_METHOD'] == "POST") {
            exit();
        }


        $name = $_POST['name'];
        $email = $_POST['email'];

        $formModel = new FormModel();
        $result = $formModel->insertFormData($name, $email);

        if ($result) {
            echo "Form submitted successfully";
        } else {
            echo "Form submission failed";
        }
        var_dump($result);

        
    }
}