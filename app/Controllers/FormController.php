<?php

require_once __DIR__ . '/../Models/FormModel.php';

class FormController {
    
    public function index() {

        $formModel = new FormModel();
        $formData = $formModel->getFormData();


        require_once __DIR__ . '../../Views/form.php';
    }

    // Route: /submitForm
    public function submit() {

        if (!$_SERVER['REQUEST_METHOD'] == "POST") {
            exit();
        }


        $name = $_POST['name'];
        $email = $_POST['email'];

        $formModel = new FormModel();
        $result = $formModel->insertFormData($name, $email);

        if ($result != false) {
            echo "Form submitted successfully";

            header("Location: /form");

        } else {
            echo "Form submission failed";
        }

        
    }
}