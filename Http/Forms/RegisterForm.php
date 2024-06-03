<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class RegisterForm extends Form {

    public function __construct($attributes) {
        $this->attributes = $attributes;

        if (!$attributes['email'] || !Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }

        if (!$attributes['password'] || !Validator::string($attributes['password'], 7, INF)) {
            $this->errors['password'] = 'Please provide a password of at least seven characters.';
        }

        if(!$attributes['confirmpassword'] || !Validator::isEqual($attributes['password'], $attributes['confirmpassword'])) {
            $this->errors['confirmpassword'] = 'Passwords do not match.';
        }
    }
}