<?php

namespace App\Controllers;

use App\Utils\View;

class HomeController extends View {
    public function index(array $data) {
        parent::view('public/home', ['data' => $data]);
    }
}