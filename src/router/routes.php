<?php

use App\Controllers\DashboardController;
use App\Controllers\HomeController;
use App\Controllers\LoginController;
use App\Controllers\UserController;

$routes = [
    // Public
    '/'                             => [HomeController::class, 'index'],
    '/login'                        => [LoginController::class, 'login'],
    '/logout'                       => [LoginController::class, 'logout'],

    // Users
    '/admin'                        => [DashboardController::class, 'index'],
    '/admin/users'                  => [UserController::class, 'index'],
    '/admin/user/store'             => [UserController::class, 'store'],
    '/admin/user/{id}/update'       => [UserController::class, 'update'],
    '/admin/user/{id}/destroy'      => [UserController::class, 'desctroy'],
];