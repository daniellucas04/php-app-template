<?php

use App\Models\User;
use App\Utils\View;

?>
<div class="flex justify-between">
    <h1 class="text-3xl">Create user</h1>
    <?php 
    View::view('components/subnav', [
        'title' => 'user',
        'back' => ADMIN_URL . '/users',
    ]);
    ?>
</div>
<div class="flex items-center justify-center mt-10 border border-zinc-700 shadow-lg p-8 rounded-xl">
    <form method="post" class="space-y-4 w-full">
        <div class="flex gap-4">
            <div class="flex items-center w-full">
                <label class="bg-zinc-900 text-slate-100 p-2 px-3 rounded-tl-md rounded-bl-md border-r border-r-zinc-700" for="username"><i class="fa-solid fa-user"></i></label>
                <input type="text" class="w-full bg-zinc-900 text-zinc-200 outline-0 border-0 rounded-tr-md rounded-br-md w-[20rem] focus:outline-none focus:ring focus:ring-slate-100 transition-all" placeholder="Username" name="username" id="username">
            </div>
            <div class="flex items-center w-full">
                <label class="bg-zinc-900 text-slate-100 p-2 px-3 rounded-tl-md rounded-bl-md border-r border-r-zinc-700" for="type"><i class="fa-solid fa-list-ul"></i></label>
                <select name="type" id="type" class="w-full bg-zinc-900 text-zinc-200 outline-0 border-0 rounded-tr-md rounded-br-md w-[20rem] focus:outline-none focus:ring">
                    <option>Select user type</option>
                    <?php foreach ((new User)->fetchUserTypes() as $type): ?>
                        <option value="<?= $type->id ?>"><?= ucfirst($type->type) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="flex gap-4">
            <div class="flex items-center w-full">
                <label class="bg-zinc-900 text-slate-100 p-2 px-3 rounded-tl-md rounded-bl-md border-r border-r-zinc-700" for="phone"><i class="fa-solid fa-phone"></i></label>
                <input type="tel" class="w-full bg-zinc-900 text-zinc-200 outline-0 border-0 rounded-tr-md rounded-br-md w-[20rem] focus:outline-none focus:ring focus:ring-slate-100 transition-all" placeholder="Phone" name="phone" id="phone">
            </div>
            <div class="flex items-center w-full">
                <label class="bg-zinc-900 text-slate-100 p-2 px-3 rounded-tl-md rounded-bl-md border-r border-r-zinc-700" for="email"><i class="fa-solid fa-envelope"></i></label>
                <input type="email" class="w-full bg-zinc-900 text-zinc-200 outline-0 border-0 rounded-tr-md rounded-br-md w-[20rem] focus:outline-none focus:ring focus:ring-slate-100 transition-all" placeholder="E-mail" name="email" id="email">
            </div>
        </div>
        <div class="flex items-center">
            <label class="bg-zinc-900 text-slate-100 p-2 px-3 rounded-tl-md rounded-bl-md border-r border-r-zinc-700" for="password"><i class="fa-solid fa-key"></i></label>
            <input type="password" class="w-full bg-zinc-900 text-zinc-200 outline-0 border-0 rounded-tr-md rounded-br-md w-[20rem] focus:outline-none focus:ring focus:ring-slate-100 transition-all" placeholder="Password" name="password" id="password">
        </div>
        <div class="flex items-center">
            <label class="bg-zinc-900 text-slate-100 p-2 px-3 rounded-tl-md rounded-bl-md border-r border-r-zinc-700" for="confirm-password"><i class="fa-solid fa-key"></i></label>
            <input type="password" class="w-full bg-zinc-900 text-zinc-200 outline-0 border-0 rounded-tr-md rounded-br-md w-[20rem] focus:outline-none focus:ring focus:ring-slate-100 transition-all" placeholder="Confirm password" name="confirm-password" id="confirm-password">
        </div>
        <div class="flex justify-end gap-4">
            <a href="/admin/users" class="bg-zinc-300 text-zinc-800 py-2 px-4 rounded-lg shadow-sm hover:bg-zinc-100 hover:text-zinc-950 transition-all">Cancel</a>
            <button type="submit" class="bg-zinc-950 py-2 px-4 rounded-lg shadow-sm hover:bg-zinc-900 hover:text-zinc-100 transition-all">Create user</button>
        </div>
    </form>
</div>
