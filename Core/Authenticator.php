<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)->query('select * from users where email = :email', [
            'email' => $email
        ])->find();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email,
                    'id' => $user['id'],
                    'image' => $user['image']
                ]);

                return true;
            }
        }
        return false;
    }

    public function register($email, $password)
    {
        $db = App::resolve(Database::class);

        $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
    }

    public function userExists($email)
    {
        $user = App::resolve(Database::class)->query('select * from users where email = :email', [
            'email' => $email
        ])->find();

        if ($user) {
            return true;
        }

        return false;
    }


    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email'],
            'id' => $user['id'],
            'image' => $user['image']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}