<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\FriendForm;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);
$user = Session::getCurrentUser();

$users = $db->query('select * from users where id != :id;', [
    'id' => $user['id']
])->get();


view("users/index.view.php", [
'heading' => 'User List',
    'users' => $users
]);
