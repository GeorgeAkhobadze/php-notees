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

$title = null;
if ($form->hasFile) {
    $title = time() . ".jpg";
    $target_file = base_path('storage/images/') . $title;
    if (!move_uploaded_file($_FILES['fileToUpload']["tmp_name"], $target_file)){
        $form->error('image', 'Error uploading file.')->throw();
    }
}

$db->query('INSERT INTO notes(body, user_id, image) VALUES(:body, :user_id, :image)', [
    'body' => $_POST['body'],
    'user_id' => $user['id'],
    'image' => $title
]);

redirect('/notes');
