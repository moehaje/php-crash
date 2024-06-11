<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm {

    public $attributes;
    protected $errors = [];

    public function __construct($attributes) {
        $this->attributes = $attributes;
        if (!Validator::email($this->attributes['email'])) {
            $this->errors['email'] = 'Please enter a valid email address';
        }

        if (!Validator::string($this->attributes['password'])) {
            $this->errors['password'] = 'Please enter a password!';
        }
    }

    public static function validate($attributes) {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;

    }

    public function throw() {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed() {
        return count($this->errors);
    }

    // "Getter" function
    public function errors() {
        return $this->errors;
    }

    public function addError($error, $message) {
        $this->errors[$error] = $message;

        return $this;
    }

}