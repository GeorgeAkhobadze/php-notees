<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm extends Form{

    public function __construct($attributes) {

        $this->attributes = $attributes;

        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Invalid Credentials.';
        }

        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Invalid Credentials Pass.';
        }
    }
}