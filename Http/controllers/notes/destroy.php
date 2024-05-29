<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$user = Session::getCurrentUser();

$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorize($note['user_id'] === $user['id']);

$db->query('delete from notes where id = :id', [
    'id' => $_POST['id']
]);

redirect('/notes');
exit();