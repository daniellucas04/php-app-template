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

View::view('components/sidebar', ['user' => (new User)->fetchByToken(Session::get('session_token'))]);
?>

<section class="flex align-items-center gap-8">
    <div class="bg-rose-900 rounded-md w-fit h-fit p-8 shadow-lg border-2 border-rose-700">
        <h1 class="text-3xl font-bold">
            <span><i class="fa-solid fa-users"></i></span>
            Últimos usuários online
        </h1>
        <div>
            <?php 
            $users = (new User)->select()
                ->where("logged = 'T'")
                ->limit(5)
                ->fetch();
            ?>
            <?php ?>
            <?php if (!$users): ?>
                <p class="bg-sky-400 text-sky-950 p-3 mt-4 rounded-xl font-bold text-center">Sem usuários online.</p>
            <?php else: ?>
                <ul class="list-none mt-4">
                    <?php foreach ($users as $user): ?>
                        <li class="bg-rose-500 p-3"><?= ucfirst($user->username); ?> - <?= (new DateTime($user->created_at))->format('d/m/Y H:i:s') ?></li>
                        <li class="bg-rose-500 p-3"><?= ucfirst($user->username); ?> - <?= (new DateTime($user->created_at))->format('d/m/Y H:i:s') ?></li>
                        <li class="bg-rose-500 p-3"><?= ucfirst($user->username); ?> - <?= (new DateTime($user->created_at))->format('d/m/Y H:i:s') ?></li>
                        <li class="bg-rose-500 p-3"><?= ucfirst($user->username); ?> - <?= (new DateTime($user->created_at))->format('d/m/Y H:i:s') ?></li>
                        <li class="bg-rose-500 p-3"><?= ucfirst($user->username); ?> - <?= (new DateTime($user->created_at))->format('d/m/Y H:i:s') ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="bg-green-900 rounded-md w-fit h-fit p-8 shadow-lg border-2 border-green-700">
        <h1 class="text-3xl font-bold">
            <span><i class="fa-solid fa-user-plus"></i></span>
            Últimos clientes cadastrados
        </h1>
        <div>
            <?php 
            $users = (new User)->select()
                ->where("id_type = 2")
                ->order("created_at", "DESC")
                ->limit(5)
                ->fetch();
            ?>
            <?php if (!$users): ?>
                <p class="bg-red-500 text-red-950 p-3 mt-4 rounded-xl font-bold text-center">Sem clientes cadastrados nos últimos 5 dias.</p>
            <?php else: ?>
                <ul class="list-none mt-4">
                    <?php foreach ($users as $user): ?>
                        <li class="bg-green-700 p-3 rounded"><?= ucfirst($user->username); ?> - <?= (new DateTime($user->created_at))->format('d/m/Y H:i:s') ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-sky-900 rounded-md w-fit h-fit p-8 shadow-lg border-2 border-sky-700">
        <h1 class="text-3xl font-bold">
            <span><i class="fa-solid fa-calendar-days"></i></span>
            Últimos agendamentos
        </h1>
        <div>
            <?php 
            $users = (new User)->select()
                    ->where("id_type = 3")
                    ->fetch();
            ?>
            <?php if (!$users): ?>
                <p class="bg-yellow-500 text-yellow-950 p-3 mt-4 rounded-xl font-bold text-center">Sem agendamentos nos últimos 5 dias.</p>
            <?php else: ?>
                <ul class="list-none mt-4">
                    <?php foreach ($users as $user): ?>
                        <li class="bg-sky-700 p-3 rounded"><?= ucfirst($user->username); ?> - <?= (new DateTime($user->created_at))->format('d/m/Y H:i:s') ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</section>
