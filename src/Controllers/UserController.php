<?php

namespace App\Controllers;

use App\Models\User;
use App\Utils\Notify;
use App\Utils\Prepare;
use App\Utils\Session;
use App\Utils\Validator;
use App\Utils\View;

class UserController extends View {
    private string $module = 'users';

    public function index() {
        parent::view('admin/users/list');
    }

    public function store(array $data) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = $data['post'];

            try {
                Validator::requiredFields([
                    'username' => $post['username'],
                    'password' => $post['password'],
                    'confirm-password' => $post['confirm-password'],
                ]);
                Validator::hasPermission(Session::get('session_token'), $this->module, CAN_CREATE);

                $user = new User();
                $post = Prepare::createUser($post);
                if (!$user->store($post)) {
                    Notify::notify('error', 'Cannot create the user. Try again.');
                    parent::view('admin/users/store');
                    return;
                }

                Notify::notify('success', 'User created successfully.');
            } catch (\PDOException $e) {
                parent::view('admin/users/store');
                Notify::notify('error', $e->getMessage());
                return;
            } catch (\Exception $e) {
                parent::view('admin/users/store');
                Notify::notify('error', $e->getMessage());
                return;
            }

            parent::view('admin/users/list');
            parent::redirect('admin/users');
        } 
        
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            parent::view('admin/users/store');
        }
    }

    public function update(array $data) {
        $idUser = $data[0];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = $data['post'];

            try {
                Validator::requiredFields([
                    'username' => $post['username'],
                    'password' => $post['password'],
                    'confirm-password' => $post['confirm-password'],
                ]);
    
                $user = new User();
                $post = Prepare::updateUser($post);
                if (!$user->renovate($idUser, $post)) {
                    Notify::notify('error', 'Cannot create the user. Try again.');
                    parent::view('admin/users/update');
                    return;
                }
                
                Notify::notify('success', 'User updated successfully.');
            } catch (\PDOException $e) {
                Notify::notify('error', $e->getMessage());
                parent::view('admin/users/update');
                return;
            } catch (\Exception $e) {
                Notify::notify('error', $e->getMessage());
                parent::view('admin/users/update');
                return;
            }

            parent::view('admin/users/list');
            parent::redirect('admin/users');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            parent::view('admin/users/update', ['user' => (new User)->fetchById($idUser)]);
        }
    }

    public function destroy(array $data) {
        $idUser = (int) $data[0];
        $user = new User;

        try {
            Validator::deleteUser(Session::get('session_token'));

            (!$user->destroy($idUser))
                ? Notify::notify('error', 'Unable to destroy the user.')
                : Notify::notify('success', 'User successfully destoyed.');
                
        } catch (\Exception $e) {
            Notify::notify('error', $e->getMessage());
        }

        parent::view('admin/users/list');
        parent::redirect('admin/users');
    }
}