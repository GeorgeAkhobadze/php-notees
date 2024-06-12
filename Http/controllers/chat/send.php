<?php

use Core\App;
use Core\Database;
use Core\Session;

header('Content-Type: application/json');

$user = Session::getCurrentUser();
$db = App::resolve(Database::class);

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$messages = $db->query('INSERT INTO chatroom_texts(message, user_id, chatroom_id) VALUES(:message, :userId, :chatroom_id)', [
    'chatroom_id' => $data['chatroomId'],
    'message' => $data['message'],
    'userId' => $user['id']
]);

//$id = $messages->lastInsertId();
//
//$message= $db->query('SELECT * FROM chatroom_texts WHERE id = :id', [
//    "id"=>$id
//]);
//
//dd($messages);