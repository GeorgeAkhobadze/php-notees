<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\FriendForm;


$db = App::resolve(Database::class);
$user = Session::getCurrentUser();

$form = FriendForm::validate($attributes = [
    'userId' => $_GET['id']
]);

$db->query('INSERT INTO friendships(user, friend, status) VALUES(:user, :friend, :status)', [
    'user' => $user['id'],
    'friend' => $_GET['id'],
    'status' => "pending"
]);

redirect('/user?id=' . $_GET['id']);
exit();
