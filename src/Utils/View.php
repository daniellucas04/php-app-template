<?php

namespace App\Utils;

class View {
    public static function view(string $view, array $args = []) {
        extract($args);

        require_once __DIR__ . "/../resources/views/$view.php";
    }

    public static function redirect(string $uri, int $seconds = 3000) {
        echo "<script>
            setTimeout(() => window.location.href='/{$uri}', {$seconds})
        </script>";        
    }
}