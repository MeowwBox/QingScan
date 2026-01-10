<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link  <?php echo (app('request')->action() === 'index') ? 'active' : ''; ?>" href="<?php echo url('asm/hostassets/index') ?>">主机汇总</a>
    </li>
    <li class="nav-item">
        <a class="nav-link  <?php echo (app('request')->action() === 'hids') ? 'active' : ''; ?>" href="<?php echo url('asm/hostassets/hids') ?>">HIDS列表</a>
    </li>
</ul>