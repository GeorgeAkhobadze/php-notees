<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);


$user = Session::getCurrentUser();


$chatrooms = $db->query('
    SELECT 
        c.id AS chatroom_id,
        c.name AS chatroom_name,
        SUBSTRING_INDEX(GROUP_CONCAT(u.username), ",", 3) AS users,
        SUBSTRING_INDEX(GROUP_CONCAT(u.id), ",", 3) AS user_ids,
        SUBSTRING_INDEX(GROUP_CONCAT(u.image), ",", 3) AS user_images,
        COUNT(m.user_id) AS total_members
    FROM 
        chatrooms c
    JOIN 
        chatroom_members m ON c.id = m.chatroom_id
    JOIN 
        users u ON m.user_id = u.id
    GROUP BY 
        c.id, c.name;
')->get();

view("chatroom/index.view.php", [
    'heading' => 'Chatroom',
    'errors' => [],
    'chatrooms' => $chatrooms
]);