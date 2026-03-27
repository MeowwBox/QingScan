{include file='public/head' /}
{include file='public/blackLeftMenu' /}
<main class="p-6 min-h-screen font-sans bg-surface-100">
    <!-- 页面标题 -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-text-primary mb-2">VulMap 漏洞扫描</h1>
        <nav class="flex gap-2 text-sm text-text-secondary">
            <a href="/" class="hover:text-primary transition-colors">首页</a>
            <span class="text-text-muted">/</span>
            <a href="#" class="hover:text-primary transition-colors">Web扫描</a>
            <span class="text-text-muted">/</span>
            <span class="text-text-primary font-medium">VulMap</span>
        </nav>
    </div>

    <?php
    $searchArr = [
        'action' => url('vulmap/index'),
        'method' => 'get',
        'inputs' => [
            ['type' => 'text', 'name' => 'search', 'placeholder' => '搜索的内容'],
            ['type' => 'select', 'name' => 'app_id', 'options' => $projectList, 'frist_option' => '项目列表'],
    ]];
    ?>
    {include file='public/search' /}

    <?php
    $tableArr = [
        'title' => '漏洞列表',
        'count' => count($list) ?? 0,
        'checkbox' => true,
        'columns' => [
            ['title' => 'ID'],
            ['title' => 'APP'],
            ['title' => 'Author'],
            ['title' => 'Host'],
            ['title' => 'Port'],
            ['title' => 'URL'],
            ['title' => 'Plugin'],
            ['title' => 'Vuln Class'],
            ['title' => '时间'],
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
        <td class="px-5 py-4 text-text-secondary"><?php echo $value['author'] ?></td>
        <td class="px-5 py-4">
            <span class="font-mono text-sm bg-surface-100 px-2 py-1 rounded text-text-primary"><?php echo $value['host'] ?></span>
        </td>
        <td class="px-5 py-4">
            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-blue-50 text-blue-600 border border-blue-100">
                <?php echo $value['port'] ?>
            </span>
        </td>
        <td class="px-5 py-4 max-w-xs truncate">
            <span class="font-mono text-sm text-text-secondary"><?php echo $value['url'] ?></span>
        </td>
        <td class="px-5 py-4">
            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-violet-50 text-violet-600 border border-violet-100">
                <?php echo $value['plugin'] ?>
            </span>
        </td>
        <td class="px-5 py-4">
            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-red-50 text-red-600 border border-red-100">
                <?php echo $value['vuln_class'] ?>
            </span>
        </td>
        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo date('Y-m-d H:i:s',$value['create_time']) ?></td>
        <td class="px-5 py-4">
            <a href="<?php echo url('del', ['id' => $value['id']]) ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                删除
            </a>
        </td>
    </tr>
    <?php } ?>

    {include file='public/table_end' /}

    <input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/xray')?>">
    {include file='public/to_examine' /}
</main>
{include file='public/footer' /}
