<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);


$user = Session::getCurrentUser();


$chatrooms = $db->query('select * from chatrooms')->get();

view("chatroom/index.view.php", [
    'heading' => 'Chatroom',
    'errors' => [],
    'chatrooms' => $chatrooms
]);