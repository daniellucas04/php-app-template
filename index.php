<?php

session_start();

use App\Core\Core;
use App\Models\User;
use App\Utils\Session;
use App\Utils\View;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/config/config.php';
require_once __DIR__ . '/src/router/routes.php';

$isAdminPage = str_contains($_SERVER['REQUEST_URI'], 'admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT AWESOME -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,container-queries"></script>
    <script src="https://kit.fontawesome.com/3a9cdcce8a.js" crossorigin="anonymous"></script>

    <!-- SWEET ALERT 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5/dark.css" />
    <link rel="shortcut icon" href="public\favicon.png" type="image/x-icon">

    <title>Movies Review</title>
</head>
<body class="bg-zinc-800 text-slate-200">
    <?php
    if ($isAdminPage AND !str_contains($_SERVER['REQUEST_URI'], 'login')) {
        View::view('components/sidebar', ['user' => (new User)->fetchByToken(Session::get('session_token'))]);
    } else {
        View::view('components/navbar');
    }
    ?>
    
    <main class="bg-zinc-800 overflow-y-auto w-full h-screen mt-4">
        <div class="<?= (!$isAdminPage) ? 'mx-auto max-w-7xl px-2 sm:px-6 lg:px-8' : 'ml-[16rem] mt-20 px-8'; ?>">
            <?php Core::run($routes); ?>
        </div>
    </main>
    
    <?php
    if (!$isAdminPage AND !str_contains($_SERVER['REQUEST_URI'], 'login')) {
        View::view('components/footer'); 
    }
    ?>
</body>
</html>