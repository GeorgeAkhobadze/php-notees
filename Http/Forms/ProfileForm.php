<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class ProfileForm extends Form {
    /**
     * @var true
     */
    public bool $hasFile = false;

    public function __construct($attributes) {

        $this->attributes = $attributes;

        if ($attributes['image']['type']) {
            $this->hasFile = true;
        }

        if($this->hasFile && !Validator::image($attributes['image'])) {
            $this->errors['image'] = 'Invalid image format.';
        }
    }


}