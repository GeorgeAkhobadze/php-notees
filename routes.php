<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

$router->get('/notes', 'notes/index.php')->only('auth');
$router->get('/note', 'notes/show.php')->only('auth');
$router->delete('/note', 'notes/destroy.php')->only('auth');

$router->get('/note/edit', 'notes/edit.php')->only('auth');
$router->patch('/note', 'notes/update.php')->only('auth');

$router->get('/notes/create', 'notes/create.php')->only('auth');
$router->post('/notes/create', 'notes/store.php')->only('auth');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/login', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');

$router->get('/storage', 'storage/show.php')->only('auth');

$router->get('/users', 'users/index.php')->only('auth');
$router->post('/users', 'users/add.php')->only('auth');
$router->delete('/users', 'users/destroy.php')->only('auth');

$router->get('/user', 'users/show.php')->only('auth');
$router->post('/user', 'users/request.php')->only('auth');
$router->patch('/user', 'users/add.php')->only('auth');
$router->delete('/user', 'users/destroy.php')->only('auth');

$router->get('/profile', 'profile/index.php')->only('auth');
$router->post('/profile', 'profile/update.php')->only('auth');

$router->get('/chat', 'chat/index.php')->only('auth');

$router->get('/test', 'test/test.php');
$router->post('/test', 'test/test2.php');

$router->get('/chatroom', 'chatroom/index.php')->only('auth');