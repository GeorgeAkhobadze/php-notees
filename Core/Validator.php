<?php

namespace Core;

class Validator {
    public static function string($value, $min = 1, $max = INF) {
        $value = trim($value);
        
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function isEqual($value, $value2) {
        return $value === $value2;
    }

    public static function image($value) {
        if(
            $value['size'] > 0 &&
            getimagesize($value['tmp_name']) !== false
        ) {
            return true;
        } else {
            return false;
        }
    }

    public static function userExists($userId) {
        $db = App::resolve(Database::class);
        $users = $db->query('select * from users where id = :id;', [
            'id' => $userId
        ])->get();
        if(!$users) {
            return  false;
        } else {
            return true;
        }
    }

}