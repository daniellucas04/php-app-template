<?php

namespace App\Controllers;

use App\Utils\View;

class HomeController extends View {
    public function index() {
        parent::view('public/home');
    }
}