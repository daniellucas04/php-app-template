<?php

use App\Utils\View;

?>
<div class="flex justify-between">
    <h1 class="text-3xl">Update user</h1>
    <?php 
    View::view('components/subnav', [
        'title' => 'user',
        'back' => ADMIN_URL . '/users',
        'new' => ADMIN_URL . '/user/store'
    ]);
    ?>
</div>
<div class="flex items-center justify-center mt-10">
    <form method="post" class="space-y-4 mt-4 border border-slate-100/20 shadow-md p-10 rounded-md">
        <div class="flex items-center">
            <label class="bg-zinc-900 text-slate-100 p-2 px-3 rounded-tl-md rounded-bl-md border-r border-r-zinc-700" for="username"><i class="fa-solid fa-user"></i></label>
            <input type="text" class="bg-zinc-900 text-zinc-200 outline-0 border-0 rounded-tr-md rounded-br-md w-[20rem] focus:outline-none focus:ring focus:ring-slate-100" placeholder="Username" name="username" id="username" value="<?= $user->username ?>">
        </div>
        <div class="flex items-center">
            <label class="bg-zinc-900 text-slate-100 p-2 px-3 rounded-tl-md rounded-bl-md border-r border-r-zinc-700" for="password"><i class="fa-solid fa-key"></i></label>
            <input type="password" class="bg-zinc-900 text-zinc-200 outline-0 border-0 rounded-tr-md rounded-br-md w-[20rem] focus:outline-none focus:ring focus:ring-slate-100" placeholder="Password" name="password" id="password">
        </div>
        <div class="flex items-center">
            <label class="bg-zinc-900 text-slate-100 p-2 px-3 rounded-tl-md rounded-bl-md border-r border-r-zinc-700" for="confirm-password"><i class="fa-solid fa-key"></i></label>
            <input type="password" class="bg-zinc-900 text-zinc-200 outline-0 border-0 rounded-tr-md rounded-br-md w-[20rem] focus:outline-none focus:ring focus:ring-slate-100" placeholder="Confirm password" name="confirm-password" id="confirm-password">
        </div>
        <div class="w-full">
            <button type="submit" class="w-full bg-zinc-950 py-2 px-4 rounded-lg shadow-sm hover:bg-zinc-900 hover:text-zinc-100">Update user</button>
        </div>
    </form>
</div>
