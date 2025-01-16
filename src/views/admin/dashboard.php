<?php

use App\Models\User;
use App\Utils\Notify;
use App\Utils\Session;
use App\Utils\View;

if (!Session::check('session_token')) {
    View::redirect('admin/login');
}

if (isset($success)) {
    ($success) ? Notify::notify('success', $message) : Notify::notify('error', $message);
}

View::view('components/sidebar', ['user' => (new User)->fetchByToken(Session::get('session_token')) ]);
?>