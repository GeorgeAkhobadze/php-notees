<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Session;
use Http\Forms\RegisterForm;

$db = App::resolve(Database::class);
$authenticator = new Authenticator();

$form = RegisterForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    'confirmpassword' => $_POST['password_confirm']
]);

$authenticator->register($attributes['email'], $attributes['password']);

$signedIn = $authenticator->attempt($attributes['email'], $attributes['password']);

if (!$signedIn) {
    $form->error('email', 'These credentials do not match our records.')->throw();
}

redirect('/');


