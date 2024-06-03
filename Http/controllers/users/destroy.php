<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\FriendForm;

$db = App::resolve(Database::class);
$user = Session::getCurrentUser();

$friendStatus = $db->query('SELECT *
FROM friendships
WHERE (user = :user and friend = :friend)
OR (user = :friend and friend = :user)', [
    'user' => Session::getCurrentUser()['id'],
    'friend' => $_GET['id']
])->find();


authorize($user['id'] === $friendStatus['user'] || $user['id'] === $friendStatus['friend']);

$db->query('delete from friendships where id = :id', [
    'id' => $friendStatus['id']
]);

redirect('/user?id=' . $_GET['id']);
exit();