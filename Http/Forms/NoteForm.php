<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class NoteForm extends Form {
    /**
     * @var true
     */
    public bool $hasFile = false;

    public function __construct($attributes) {

        $this->attributes = $attributes;

        if(! Validator::string($attributes['body'], 1, 100)) {
            $this->errors['body'] = 'Max 100 characters.';
        }
        
        if ($attributes['image']['type']) {
            $this->hasFile = true;
        }

        if($this->hasFile && !Validator::image($attributes['image'])) {
            $this->errors['image'] = 'Invalid image format.';
        }

    }
    
    




}