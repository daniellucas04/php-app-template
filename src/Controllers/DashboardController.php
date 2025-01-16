<?php

namespace App\Controllers;

use App\Utils\View;

class DashboardController extends View {
    public function index() {
        parent::view('admin/dashboard');
    }
}