<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$user = Session::getCurrentUser();

if (isset($user['id'])) {
    $posts = $db->query('
        SELECT n.*, 
               u.username, 
               u.image as userImage, 
               COUNT(l.id) as likeCount, 
               EXISTS (
                   SELECT 1 
                   FROM likes 
                   WHERE note_id = n.id AND user_id = :user
               ) as liked
        FROM notes n
        JOIN users u ON n.user_id = u.id
        LEFT JOIN likes l ON n.id = l.note_id
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
        GROUP BY n.id
        ORDER BY n.created_at;', [
        'user' => $user['id']
    ])->get();
}

view("index.view.php", [
    'heading' => 'Home',
    'posts' => $posts ?? null
]);
