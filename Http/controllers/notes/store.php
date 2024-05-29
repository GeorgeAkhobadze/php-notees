<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Validator;

$db = App::resolve(Database::class);

$errors = [];

$user = Session::getCurrentUser();

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(! Validator::string($_POST['body'], 1, 100)) {
        $errors['body'] = 'Max 100 characters.'; 
    }


    if( !empty($errors)) {

        return view("notes/create.view.php", [
            'heading' => 'Create Note',
            'errors' => $errors
        ]);
    }

    if(empty($errors)) {
        $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
            'body' => $_POST['body'],
            'user_id' => $user['id']
        ]);
    }

    redirect('/notes');
    die();

}