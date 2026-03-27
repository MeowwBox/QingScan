{include file='public/head' /}
{include file='public/blackLeftMenu' /}
<main class="p-6 min-h-screen">
    <!-- 页面标题 -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-text-primary mb-2">WhatWeb 扫描结果</h1>
        <nav class="flex gap-2 text-sm text-text-secondary">
            <a href="/" class="hover:text-primary transition-colors">首页</a>
            <span class="text-primary">/</span>
            <a href="#" class="hover:text-primary transition-colors">Web扫描</a>
            <span class="text-primary">/</span>
            <span class="text-text-primary font-medium">WhatWeb</span>
        </nav>
    </div>

    <?php
    $searchArr = [
        'action' => $_SERVER['REQUEST_URI'],
        'method' => 'get',
        'inputs' => [
            ['type' => 'text', 'name' => 'search', 'placeholder' => '搜索内容'],
            ['type' => 'select', 'name' => 'app_id', 'options' => $projectList, 'frist_option' => '项目列表']
    ]]; ?>
    {include file='public/search' /}

    <?php
    $tableArr = [
        'title' => '扫描结果列表',
        'count' => count($list ?? []),
        'checkbox' => true,
        'columns' => [
            ['title' => 'ID'],
            ['title' => '所属项目'],
            ['title' => 'Target'],
            ['title' => 'HTTP Status'],
            ['title' => 'Plugins'],
            ['title' => '发布时间'],
            ['title' => '操作', 'class' => 'w-[100px]'],
        ],
        'showBatchDel' => true,
    ];
    ?>
    {include file='public/table_start' /}

    <?php foreach ($list as $value) { ?>
    <tr class="hover:bg-surface-50 transition-colors">
        <td class="px-5 py-4">
            <input type="checkbox" class="ids w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20 cursor-pointer" name="ids[]" value="<?php echo $value['id'] ?>">
        </td>
        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
        <td class="px-5 py-4 text-text-secondary"><?php echo $value['app_name'] ?></td>
        <td class="px-5 py-4">
            <?php
            $targetArr = json_decode($value['target'], true);
            $targetUrl = is_array($targetArr) && isset($targetArr[0]) ? $targetArr[0] : $value['target'];
            ?>
            <span class="text-text-primary font-mono text-sm bg-surface-100 px-2 py-1 rounded"><?php echo htmlspecialchars($targetUrl); ?></span>
        </td>
        <td class="px-5 py-4">
            <?php
            $statusArr = json_decode($value['http_status'], true);
            $status = is_array($statusArr) && isset($statusArr[0]) ? $statusArr[0] : $value['http_status'];
            $statusClass = 'bg-surface-50 text-text-secondary border-surface-200';
            if ($status >= 200 && $status < 300) {
                $statusClass = 'bg-emerald-50 text-emerald-600 border-emerald-100';
            } elseif ($status >= 300 && $status < 400) {
                $statusClass = 'bg-amber-50 text-amber-600 border-amber-100';
            } elseif ($status >= 400) {
                $statusClass = 'bg-red-50 text-red-600 border-red-100';
            }
            ?>
            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium border <?php echo $statusClass ?>">
                <?php echo htmlspecialchars($status); ?>
            </span>
        </td>
        <td class="px-5 py-4 text-text-secondary max-w-xs truncate" title="<?php echo htmlspecialchars($value['plugins']); ?>">
            <?php
            $pluginsArr = json_decode($value['plugins'], true);
            $plugins = is_array($pluginsArr) && isset($pluginsArr[0]) ? $pluginsArr[0] : $value['plugins'];
            echo htmlspecialchars($plugins);
            ?>
        </td>
        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
        <td class="px-5 py-4">
            <a href="<?php echo url('whatweb/del', ['id' => $value['id']]) ?>"
               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                删除
            </a>
        </td>
    </tr>
    <?php } ?>

    {include file='public/table_end' /}

    <input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/xray') ?>">
    {include file='public/to_examine' /}
</main>
{include file='public/footer' /}
