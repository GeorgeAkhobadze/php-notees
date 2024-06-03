<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$user = Session::getCurrentUser();
//update notes set body = :body where id = :id
$friendStatus = $db->query('SELECT * FROM friendships WHERE 
    (user = :user AND friend = :friend AND status = "pending") OR 
    (user = :friend AND friend = :user AND status = "pending")', [
    'user' => Session::getCurrentUser()['id'],
    'friend' => $_GET['id']
])->find();

if ($friendStatus) {
    $db->query('UPDATE friendships SET status = "accepted" WHERE 
        (user = :user AND friend = :friend AND status = "pending") OR 
        (user = :friend AND friend = :user AND status = "pending")', [
        'user' => Session::getCurrentUser()['id'],
        'friend' => $_GET['id']
    ]);
}

redirect('/user?id=' . $_GET['id']);
exit();
