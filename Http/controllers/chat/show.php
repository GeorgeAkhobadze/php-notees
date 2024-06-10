<?php

use Core\App;
use Core\Database;
use Core\Session;

header('Content-Type: application/json');

$user = Session::getCurrentUser();
$db = App::resolve(Database::class);

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$isMember = $db->query('select * from chatroom_members where user_id = :userId and chatroom_id = :chatroomId', [
    'userId' => $user['id'],
    'chatroomId' => $_REQUEST['chatroomId']
])->find();


$messages = $isMember ? $db->query('SELECT * 
FROM chatroom_texts 
WHERE chatroom_id = :id 
ORDER BY created_at DESC 
LIMIT 10', [
    'id' => $_REQUEST['chatroomId']
])->get() : false;

$data['messages'] = $messages;

$data['userId'] = $user['id'];

echo json_encode($data, JSON_UNESCAPED_UNICODE);