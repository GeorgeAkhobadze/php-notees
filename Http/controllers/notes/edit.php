<?php


use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);


$user = Session::getCurrentUser();


$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $user['id']);

view("notes/edit.view.php", [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' => $note
]);