<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\FriendForm;

$db = App::resolve(Database::class);

if($_GET['id'] == false) {
    redirect('/users');
    exit();
}

$user = $db->query('select * from users where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

$friendStatus = $db->query('
SELECT *
FROM friendships
WHERE (user = :user and friend = :friend)
OR (user = :friend and friend = :user)', [
    'user' => Session::getCurrentUser()['id'],
    'friend' => $_GET['id']
])->find();

if($friendStatus && $friendStatus['status'] === 'accepted') {
    $friendNotes = $db->query('select * from notes where user_id = :id', [
        'id' => $_GET['id']
    ])->get();

};

//var_dump($friendNotes);
view("users/show.view.php", [
    'heading' => 'User Profile',
    'user' => $user,
    'friendStatus' => $friendStatus,
    'friendNotes' => $friendNotes ?? null
]);

