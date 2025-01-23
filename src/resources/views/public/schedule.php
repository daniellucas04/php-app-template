<?php

use App\Models\Service;
use App\Models\User;
use App\Utils\Session;
use App\Utils\View;

if (!Session::get('session_token')) {
    View::redirect('login', 0);
}
?>

<section>
    <h3 class="text-2xl mb-5">Schedule</h3>
    <form method="post" class="space-y-6">
        <div class="flex flex-col">
            <select name="service" id="service" class="bg-zinc-800 rounded-md border-2 text-slate-100">
                <option value="">Select a service</option>
                <?php 
                $services = (new Service())->select()
                    ->where("available = 'T'")
                    ->fetch();
                ?>

                <?php foreach ($services as $service): ?>
                    <option value="<?= $service->id; ?>"><?= $service->name; ?></option>
                <?php endforeach; ?>
            </select>
            <div id="availability" class="text-gray-300 ml-1"></div>
        </div>

        <div class="flex flex-col">
            <select name="professional" id="professional" class="bg-zinc-800 rounded-md border-2 text-slate-100">
                <option value="">Select a professional</option>
                <?php
                $professionals = (new User)->select()
                    ->where("id_type = " . PROFESSIONAL)
                    ->fetch();
                ?>

                <?php foreach ($professionals as $professional): ?>
                    <option value="<?= $professional->id; ?>"><?= ucfirst($professional->username); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="flex flex-col">
            <label for=""></label>
            <input type="datetime-local" name="schedule_date" class="bg-zinc-800 rounded-md border-2 text-slate-100">
        </div>
    </form>
</section>