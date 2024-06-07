<?php

use Core\App;
use Core\Database;
use Core\Session;

header('Content-Type: application/json');

$user = Session::getCurrentUser();
$db = App::resolve(Database::class);

$json = file_get_contents('php://input');
$data = json_decode($json, true);


$messages = $db->query('SELECT * 
FROM chatroom_texts 
WHERE chatroom_id = :id 
ORDER BY created_at DESC 
LIMIT 10', [
    'id' => $_REQUEST['chatroomId']
])->get();

$data['messages'] = $messages;

$data['userId'] = $user['id'];

echo json_encode($data, JSON_UNESCAPED_UNICODE);