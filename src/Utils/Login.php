<?php

namespace App\Utils;

use App\Models\User;

class Login {
    public static function login(string $username, $password) {
        $userFound = (new User)->fetchUser("username = '{$username}'");
        if (!$userFound) return false;
        if (!password_verify($password, $userFound[0]->password)) return false;

        $sessionToken = Randomizer::token();
        $user = new User();
        if (!$user->renovate($userFound[0]->id, ['token' => $sessionToken, 'logged' => 'T'])) {
            return false;
        }

        Session::create([
            'session_token' => $sessionToken,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return true;
    }

    public static function logout() {
        $userFound = (new User)->fetchByToken(Session::get('session_token'));
        $user = new User();
        $user->renovate($userFound->id, ['token' => null, 'logged' => 'F']);
        
        Session::destroy();
        View::redirect('login');
    }
}