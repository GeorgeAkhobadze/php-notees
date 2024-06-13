<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$user = Session::getCurrentUser();

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$isLiked = $db->query('SELECT * FROM likes WHERE note_id = :note_id AND user_id = :user_id', [
    'note_id' => $data['noteId'],
    'user_id' => $user['id'],
])->get();

if ($isLiked) {
    $db->query('DELETE FROM likes WHERE note_id = :note_id AND user_id = :user_id', [
        'note_id' => $data['noteId'],
        'user_id' => $user['id'],
    ]);
    $data['liked'] = false;
} else {
    $db->query('INSERT INTO likes(note_id, user_id) VALUES(:note_id, :user_id)', [
        'note_id' => $data['noteId'],
        'user_id' => $user['id'],
    ]);
    $data['liked'] = true;
}


echo json_encode($data, JSON_UNESCAPED_UNICODE);
