<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\ProfileForm;

$db = App::resolve(Database::class);
$user = Session::getCurrentUser();

$userData = $db->query('select * from users where id = :id;', [
    'id' => $user['id']
])->find();

$form = ProfileForm::validate($attributes = [
    'image' => $_FILES['profilePicture']
]);


$title = handleFileUpload($form, 'profilePicture');

unlink(base_path("storage/images/{$userData['image']}"));

$db->query('update users set image = :image where id = :id;', [
    'image' => $title,
    'id' => $user['id']
]);
//
//$db->query('INSERT INTO users(body, user_id, image) VALUES(:body, :user_id, :image)', [
//    'body' => $_POST['body'],
//    'user_id' => $user['id'],
//    'image' => $title
//]);

redirect('/profile');

