<?php

use App\Utils\Session;

?>
<nav class="sticky top-0 bg-zinc-800 border-b border-zinc-700 shadow-md">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-20 items-center justify-between">
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <a href="<?= PUBLIC_URL ?>/" class="flex flex-shrink-0 items-center gap-2 text-lg hover:text-zinc-100 transition-all">
                    Movies Review
                    <span class="text-xl"><i class="fa-solid fa-clapperboard"></i></span>
                </a>
                <div class="hidden sm:ml-6 sm:block w-full">
                    <ul class="flex items-center justify-between">
                        <div class="flex space-x-4 items-center ml-5">
                            <li><a href="<?= PUBLIC_URL ?>/series" class="text-sm font-medium text-slate-100 hover:text-slate-300 transition-all" aria-current="page">Series</a></li>
                            <li><a href="<?= PUBLIC_URL ?>/reviews" class="text-sm font-medium text-slate-100 hover:text-slate-300 transition-all" aria-current="page">Reviews</a></li>
                            <li>
                                <form action="<?= PUBLIC_URL ?>/search" id="search">
                                    <div class="relative">
                                        <input type="text" class="outline-0 border-0 rounded-md text-zinc-800 w-[20rem] transition-all" placeholder="Find movies, series and reviews" name="filter">
                                        <button type="submit" class="absolute right-2 top-1 text-zinc-100 bg-zinc-700 p-1 px-3 rounded-lg"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </form>
                            </li>
                        </div>
                        <div class="flex space-x-4 items-center">
                            <?php if (!Session::check('session_token')): ?>
                                <li><a href="<?= PUBLIC_URL ?>/login" class="rounded-md bg-zinc-300 px-6 py-3 text-sm font-medium text-black flex items-center gap-3 hover:bg-zinc-200 hover:text-black-100 transition-all" aria-current="page">Login <span><i class="fa-solid fa-right-to-bracket"></i></span></a></li>
                            <?php else: ?>
                                <li><a href="<?= PUBLIC_URL ?>/admin" class="rounded-md bg-zinc-300 px-6 py-3 text-sm font-medium text-black flex items-center gap-3 hover:bg-zinc-100 transition-all" aria-current="page">Dashboard <span><i class="fa-solid fa-user-tie"></i></span></a></li>
                                <li><a href="<?= PUBLIC_URL ?>/logout" class="rounded-md bg-red-700 px-6 py-3 text-sm font-bold text-slate-200 flex items-center gap-3 hover:bg-red-900 hover:text-slate-200 transition-all" aria-current="page">Log out <span><i class="fa-solid fa-right-from-bracket"></i></span></a></li>
                            <?php endif; ?>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>