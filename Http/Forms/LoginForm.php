<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm {

    protected $errors = [];
    public array $attributes;

    public function __construct($attributes) {

        $this->attributes = $attributes;

        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Invalid Credentials.';
        }

        if (!Validator::string($attributes['password'])) {
            $this->errors['password'] = 'Invalid Credentials Pass.';
        }
    }

    /**
     * @throws ValidationException
     */
    public static function validate($attributes) {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw() {
        validationException::throw($this->errors, $this->attributes);
    }

    public function failed() {
        return count($this->errors);
    }

    public function errors() {
        return $this->errors;
    }

    public function error($field, $message) {
        $this->errors[$field] = $message;

        return $this;
    }
}