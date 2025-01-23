<?php

namespace App\Utils;

use App\Models\User;

class Session {
    public static function create(array $data) {
        foreach($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    public static function get(string $key) {
        return $_SESSION[$key] ?? null;
    }

    public static function destroy() {
        session_unset();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }

    public static function check(string $key) {
        return isset($_SESSION[$key]) ? true : false;
    }

    public static function getUser() {
        if (self::get('session_token')) {
            return (new User)->fetchByToken(self::get('session_token'));
        }
    }
}