<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$user = Session::getCurrentUser();

//dd($_SERVER['REQUEST_METHOD']);

$db->query('INSERT INTO friendships(user, friend, status) VALUES(:user, :friend, :status)', [
    'user' => $user['id'],
    'friend' => $_GET['id'],
    'status' => "pending"
]);

redirect('/user?id=' . $_GET['id']);
exit();
