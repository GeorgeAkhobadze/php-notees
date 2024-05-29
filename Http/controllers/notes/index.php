<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$heading = 'My Notes';

$user = Session::getCurrentUser();

$notes = $db->query('select * from notes where user_id = :id;', [
    'id' => $user['id']
])->get();


view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);