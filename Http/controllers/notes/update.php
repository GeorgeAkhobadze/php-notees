<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Validator;

$db = App::resolve(Database::class);

$user = Session::getCurrentUser();


$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();


authorize($note['user_id'] === $user['id']);


$errors = [];

if (! Validator::string($_POST['body'], 1, 100)) {
    $errors['body'] = 'Max 100 characters.';
}

if (count($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

$db->query('update notes set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);


redirect('/notes');
die();