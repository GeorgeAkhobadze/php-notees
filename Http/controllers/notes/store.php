<?php

use Core\App;
use Core\Database;
use Core\Session;
use Core\Validator;
use Http\Forms\NoteForm;

$db = App::resolve(Database::class);


$user = Session::getCurrentUser();


$form = NoteForm::validate($attributes = [
    'body' => $_POST['body'],
    'image' => $_FILES['fileToUpload']
]);

$title = handleFileUpload($form);

$db->query('INSERT INTO notes(body, user_id, image) VALUES(:body, :user_id, :image)', [
    'body' => $_POST['body'],
    'user_id' => $user['id'],
    'image' => $title
]);

redirect('/notes');
