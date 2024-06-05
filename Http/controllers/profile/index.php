<?php

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$user = Session::getCurrentUser();

$userData = $db->query('select * from users where id = :id;', [
    'id' => $user['id']
])->find();

if(!file_exists(base_path("storage/images/{$userData["image"]}"))) {
    $userData['image'] = 'user_profile.svg';
};

view("profile/index.view.php", [
    'heading' => 'Profile',
    'user' => $userData,
    'errors' => Session::get('errors')
]);


