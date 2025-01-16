<?php

namespace App\Controllers;

use App\Utils\Login;
use App\Utils\Notify;
use App\Utils\Validator;
use App\Utils\View;

class LoginController extends View {

    public function login(array $data) {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $post = $data['post'];

            try {
                Validator::requiredFields([
                    'username' => $post['username'] ?? '',
                    'password' => $post['password'] ?? ''
                ]);

                if (!Login::login($post['username'], $post['password'])) {
                    Notify::notify('error', 'Failed to login. Try again later.');
                }

                Notify::notify('success', 'Logged successfully.');
                parent::redirect('admin');
            } catch (\PDOException $e) {
                return $e->getMessage();
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            parent::view('login');
        }
    }

    public function logout() {
        Login::logout();
    }
}