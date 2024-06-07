<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$user = Session::getCurrentUser();

if(isset($user['id'])) {
    $posts = $db->query('SELECT n.*, u.username, u.image as userImage
FROM notes n
         JOIN users u ON n.user_id = u.id
WHERE n.user_id IN (
    SELECT
        CASE
            WHEN user = :user THEN friend
            ELSE user
            END AS friend_id
    FROM
        friendships
    WHERE
        (user = :user OR friend = :user)
      AND status = "accepted"
    
)
OR n.user_id = :user
ORDER BY n.created_at;', [
        'user' => $user['id']
    ])->get();
}

view("index.view.php", [
    'heading' => 'Home',
    'posts' => $posts ?? null
]);
