<?php
namespace App\Utils;

class ValidatorUtil {
    private $errors = [];

    public function validateRequired($field, $value, $message) {
        if (empty($value)) {
            $this->errors[$field] = $message;
        }
    }

    public function validateMinLength($field, $value, $minLength, $message) {
        if (strlen($value) < $minLength) {
            $this->errors[$field] = $message;
        }
    }

    public function validateMaxLength($field, $value, $maxLength, $message) {
        if (strlen($value) > $maxLength) {
            $this->errors[$field] = $message;
        }
    }

    public function validateEmail($field, $value, $message) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = $message;
        }
    }

    public function getErrors() {
        return $this->errors;
    }

    public function hasErrors() {
        return !empty($this->errors);
    }

}