<?php

namespace Core\Middleware;

use Core\Session;

class Auth
{
    public function handle()
    {
        if (!Session::getCurrentUser()) {
            redirect('/');
            exit();
        }
    }
}