<?php

namespace App\Controllers;

use App\Utils\View;

class NotFoundController extends View {
    public static function index() {
        parent::view('components/404');
    }
}