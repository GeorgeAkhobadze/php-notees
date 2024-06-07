<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$chatroom = $db->query('select * from chatrooms where id = :id', [
    'id' => $_GET['id']
])->find();



view("chat/index.view.php", [
    'heading' => $chatroom['name'],
    'errors' => [],
    'chatroom' => $chatroom
]);