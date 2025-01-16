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
?>
<div class="flex justify-between mt-20">
    <h1 class="text-3xl">All users</h1>
    <?php 
    View::view('components/subnav', [
        'title' => 'user',
        'new' => ADMIN_URL . '/user/store',
    ]);
    ?>
</div>

<div class="flex items-center justify-center mt-10">
    <table class="w-full">
        <thead class="rounded-lg">
            <tr class="bg-zinc-900">
                <th class="p-4 text-start">Username</th>
                <th class="p-4 text-start">Token</th>
                <th class="p-4 text-start">Logged</th>
                <th class="p-4 text-start">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $users = (new User)->fetch();
            foreach ($users as $user): 
            ?>
                <?php 
                switch ($user->logged) {
                    case 'T': $loggedBadge = '<span class="bg-green-700 text-green-100 p-1 rounded-lg text-sm font-bold">Online</span>'; break;
                    default: $loggedBadge = '<span class="bg-red-700 text-red-100 p-1 rounded-lg text-sm font-bold">Offline</span>'; break;
                }
                ?>
                <tr class="bg-zinc-900/50 border-b-zinc-100/90 hover:bg-zinc-700 transition-all">
                    <td class="p-4"><?= $user->username; ?></td>
                    <td class="p-4"><?= $user->token ?? 'Sem token gerado'; ?></td>
                    <td class="p-4"><?= $loggedBadge; ?></td>
                    <td class="p-4 space-x-2">
                        <a href="<?= ADMIN_URL ?>/user/<?= $user->id; ?>/update" class="bg-zinc-900 p-3 rounded-lg hover:bg-zinc-950 hover:text-zinc-100 shadow-md transition-all"><i class="fa-solid fa-pen"></i></a>
                        <a href="<?= ADMIN_URL ?>/user/<?= $user->id; ?>/destroy" class="bg-zinc-900 p-3 rounded-lg hover:bg-zinc-950 hover:text-zinc-100 shadow-md transition-all"><i class="fa-solid fa-circle-xmark"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>