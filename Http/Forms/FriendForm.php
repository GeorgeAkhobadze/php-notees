<?php

namespace Http\Forms;

use Core\Validator;

class FriendForm extends Form{



    public function __construct($attributes) {
        $router = new \Core\Router();
        $this->attributes = $attributes;

        if (!Validator::userExists($attributes['userId'])) {
            $this->errors['userId'] = 'Invalid Action.';
            $router->abort(404);
        }
    }
}