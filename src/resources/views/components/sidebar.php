<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidenav">
    <div class="overflow-y-auto py-5 px-3 h-full border-r border-zinc-200 bg-zinc-900 border-zinc-700">
        <div class="border-b border-zinc-100/20">
            <h1 class="text-lg mb-4 text-center">Welcome, <strong><?= ucfirst($user->username); ?></strong>!</h1>
        </div>
        <ul class="space-y-2 mt-16">
            <li>
                <a href="/admin/" class="flex transition-all p-2 items-center gap-4 text-base font-normal rounded-lg text-white hover:bg-zinc-100 hover:bg-zinc-700 group">
                    <span><i class="fa-solid fa-square-poll-horizontal"></i></span>
                    <span class="font-bold flex gap-4 items-center">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul class="space-y-2">
            <li>
                <a href="/admin/users" class="flex transition-all p-2 items-center gap-4 text-base font-normal rounded-lg text-white hover:bg-zinc-100 hover:bg-zinc-700 group">
                    <span><i class="fa-solid fa-user"></i></span>
                    <span class="font-bold flex gap-4 items-center"> Users</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="hidden absolute bottom-0 left-0 justify-center p-4 space-x-4 w-full lg:flex bg-zinc-900 z-20 border-r border-zinc-200 border-zinc-700">
        <a href="/logout" class="inline-flex transition-all bg-zinc-950 rounded-md justify-center p-2 px-4 gap-2 rounded cursor-pointer text-zinc-400 hover hover:text-white hover:bg-zinc-100 hover:bg-zinc-600">
            <span><i class="fa-solid fa-right-from-bracket"></i></span> Logout
        </a>
    </div>
</aside>