<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm {

    protected $errors = [];
    public function validate($email, $password) {

        $errors = [];

        if (!Validator::email($email)) {
            $this->errors['email'] = 'Please enter a valid email address';
        }

        if (!Validator::string($password)) {
            $this->errors['password'] = 'Please enter a password!';
        }

        return empty($this->errors);

    }

    // "Getter" function
    public function errors() {
        return $this->errors;
    }

}