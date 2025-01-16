<?php

namespace App\Utils;

class Prepare {
    /**
     * User
     */
    public static function createUser(array $data) {
        if ($data['password'] != $data['confirm-password']) return false;

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        unset($data['confirm-password']);

        return $data;
    }

    public static function updateUser(array $data) {
        return self::createUser($data);
    }
}