<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\FriendForm;

$db = App::resolve(Database::class);
$user = Session::getCurrentUser();
$router = new \Core\Router();
$friend = $_GET['id'] ?? $_POST['id'];

$friendStatus = $db->query('SELECT *
FROM friendships
WHERE (user = :user and friend = :friend)
OR (user = :friend and friend = :user)', [
    'user' => Session::getCurrentUser()['id'],
    'friend' => $friend
])->find();


authorize($user['id'] === $friendStatus['user'] || $user['id'] === $friendStatus['friend']);

$db->query('delete from friendships where id = :id', [
    'id' => $friendStatus['id']
]);

redirect($router->previousUrl());
exit();