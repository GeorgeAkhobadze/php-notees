<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$user = Session::getCurrentUser();

$chatroom = $db->query('select * from chatrooms where id = :id', [
    'id' => $_GET['id']
])->find();

$isMember = $db->query('select * from chatroom_members where user_id = :userId and chatroom_id = :chatroomId', [
    'userId' => $user['id'],
    'chatroomId' => $chatroom['id']
])->find();



view("chat/index.view.php", [
    'heading' => $chatroom['name'],
    'errors' => [],
    'chatroom' => $chatroom,
    'isMember' => $isMember,
]);