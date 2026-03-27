<div class="bg-white border-b border-surface-300 px-4 py-3">
    <div class="flex gap-2">
        <a href="<?php echo url('asm/hostassets/index') ?>" class="px-4 py-2 rounded-lg text-sm font-medium transition-all <?php echo (app('request')->action() === 'index') ? 'bg-primary-light text-primary' : 'text-text-secondary hover:bg-surface-100'; ?>">主机汇总</a>
        <a href="<?php echo url('asm/hostassets/hids') ?>" class="px-4 py-2 rounded-lg text-sm font-medium transition-all <?php echo (app('request')->action() === 'hids') ? 'bg-primary-light text-primary' : 'text-text-secondary hover:bg-surface-100'; ?>">HIDS列表</a>
    </div>
</div>
