<?php

namespace App\Core;

use App\Controllers\NotFoundController;

class Core {
    public static function run(array $routes) {
        $url = '/';

        isset($_GET['url']) && $url .= $_GET['url'];

        ($url != '/') && $url = rtrim($url, '/');

        $routerFound = false;

        foreach ($routes as $path => $controller) {
            $pattern = '#^' . preg_replace('/{id}/', '(\w+)', $path) . '$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                $routerFound = true;

                [$currentController, $action] = explode('@', $controller);
                $matches['post'] = $_POST ?? null;

                $currentController = 'App\\Controllers\\' . $currentController; 
                $extendController = new $currentController;
                $extendController->$action($matches);
            }
        }

        if (!$routerFound) {
            require_once __DIR__ . "/../controllers/NotFoundController.php";
            NotFoundController::index();
        }
    }
}