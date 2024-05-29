<?php

namespace Core\Middleware;

use Core\Session;

class Guest
{
    public function handle()
    {
        if (Session::getCurrentUser()) {
            redirect('/');
            exit();
        }
    }
}