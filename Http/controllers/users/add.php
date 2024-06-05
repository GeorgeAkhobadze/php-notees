<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\FriendForm;

$db = App::resolve(Database::class);
$user = Session::getCurrentUser();
$router = new \Core\Router();
$friendId = $_GET['id'] ?? $_POST['id'];


$friendStatus = $db->query([
'user' => Session::getCurrentUser()['id'],
'friend' => $_GET['id']
], 'SELECT count(*) FROM friendships WHERE  status = "pending" AND
    (
        (user = :user AND friend = :friend ) OR 
        (user = :friend AND friend = :user )
<<<<<<< Updated upstream
        )', [
    'user' => Session::getCurrentUser()['id'],
    'friend' => $friendId
])->find();

=======
        )')->find();

dd($friendStatus);


>>>>>>> Stashed changes
if ($friendStatus['count(*)']) {
    $db->query('UPDATE friendships SET status = "accepted" WHERE 
        (user = :user AND friend = :friend AND status = "pending") OR 
        (user = :friend AND friend = :user AND status = "pending")', [
        'user' => Session::getCurrentUser()['id'],
        'friend' => $friendId
    ]);
}

redirect($router->previousUrl());
exit();
