<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$user = Session::getCurrentUser();

$userData = $db->query('select * from users where id = :id;', [
    'id' => $user['id']
])->get();

view("profile/index.view.php", [
'heading' => 'Profile',
'user' => $userData
]);


