<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$user = $db->query('select * from users where id = :id', [
    'id' => $_GET['id']
])->findOrFail();


view("users/show.view.php", [
    'heading' => 'User Profile',
    'user' => $user
]);

