<?php

namespace App\Utils;

use App\Models\User;
use Exception;

class Validator {
    public static function requiredFields(array $fields) {
        foreach ($fields as $field => $value) {
            if (empty(trim($value))) {
                $formatedField = str_replace('-', ' ', ucfirst($field));
                throw new Exception("The field <strong>{$formatedField}</strong> is required.");
            }
        }
    }

    public static function deleteUser(int $idUser) {
        $user = (new User)->select('token, logged')
            ->where("id = {$idUser}")->fetch()[0];

        if ($user->token === Session::get('session_token')) {
            throw new Exception("You cannot delete yourself.");
        }

        if ($user->logged === 'T') {
            throw new Exception("Cannot delete the user when he is online.");
        }
    }

    public static function hasPermission(string $token, string $module, string $permission) {
        $user = new User();
        $userFound = $user->fetchByToken($token);
        $permissions = $user->permissions((int) $userFound->id, $module);

        if($permissions[$permission] != 'T') {
            throw new Exception("Your user doesn't have permission for this action.");
        }
    }
}