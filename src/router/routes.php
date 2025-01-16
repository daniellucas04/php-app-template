<?php

$routes = [
    // Public
    '/'                             => 'HomeController@index',
    '/login'                        => 'LoginController@login',
    '/logout'                       => 'LoginController@logout',
    
    // Users
    '/admin'                        => 'DashboardController@index',
    '/admin/users'                  => 'UserController@index',
    '/admin/user/store'             => 'UserController@store',
    '/admin/user/{id}/update'       => 'UserController@update',
    '/admin/user/{id}/destroy'      => 'UserController@destroy',
];