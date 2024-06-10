<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$user = Session::getCurrentUser();
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$messages = $db->query('INSERT INTO chatroom_members(user_id, chatroom_id) VALUES(:userId, :chatroom_id)', [
    'chatroom_id' => $data['chatroomId'],
    'userId' => $user['id']
]);
