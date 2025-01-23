<div class="flex gap-5 items-center">
    <?php if (isset($new)): ?>
        <a href="<?= $new ?>" class="bg-indigo-800 p-2 rounded-md hover:bg-indigo-900 hover:text-slate-200 shadow-sm transition-all"><i class="fa-solid fa-circle-plus"></i> New <?= $title ?></a>
    <?php endif; ?>

    <?php if (isset($back)): ?>
        <a href="<?= $back ?>" class="bg-zinc-100 p-2 text-zinc-900 rounded-md hover:bg-zinc-200 hover:text-zinc-800 shadow-sm transition-all"><i class="fa-solid fa-rotate-left"></i> Back</a>
    <?php endif; ?>
</div>