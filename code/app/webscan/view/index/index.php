{include file='public/head' /}
{include file='public/blackLeftMenu' /}

    <!-- 页面标题 -->
    <div class="flex justify-between items-start mb-6 opacity-0 animate-fadeIn">
        <div>
            <h1 class="text-2xl font-bold text-text-primary mb-2">扫描目标</h1>
            <nav class="flex gap-2 text-sm text-text-secondary">
                <a href="<?php echo url('index/index') ?>" class="hover:text-primary transition-colors">首页</a>
                <span class="text-text-muted">/</span>
                <a href="<?php echo url('index/index') ?>" class="hover:text-primary transition-colors">Web扫描</a>
                <span class="text-text-muted">/</span>
                <span class="text-text-primary font-medium">扫描目标</span>
            </nav>
        </div>
        <div class="flex gap-3">
            <button onclick="openWebscanDrawer()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary to-blue-600 text-white font-semibold hover:shadow-hover transition-all duration-200 shadow-md">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    新增扫描
                </span>
            </button>
        </div>
    </div>

<?php
    // 统计数据
    $totalTargets = count($list);
    $totalVulns = 0;
    $totalAssets = 0;
    $activeScans = 0;
    foreach ($list as $value) {
        $totalVulns += $value['awvs_num'] + $value['xray_num'] + $value['sqlmap_num'] + $value['vulmap_num'];
        $totalAssets += $value['urls_num'] + $value['namp_num'];
    }
?>

    <!-- 统计卡片 -->
    <div class="grid grid-cols-4 gap-5 mb-6">
        <div class="stat-card blue bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-primary/30 transition-all duration-300 opacity-0 animate-fadeIn">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-primary-light flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-text-primary mb-1"><?php echo number_format($totalTargets) ?></div>
            <div class="text-text-secondary text-sm">扫描目标</div>
        </div>

        <div class="stat-card red bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-red-300 transition-all duration-300 opacity-0 animate-fadeIn delay-100">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-text-primary mb-1"><?php echo number_format($totalVulns) ?></div>
            <div class="text-text-secondary text-sm">发现漏洞</div>
        </div>

        <div class="stat-card amber bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-amber-300 transition-all duration-300 opacity-0 animate-fadeIn delay-200">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-text-primary mb-1"><?php echo number_format($totalAssets) ?></div>
            <div class="text-text-secondary text-sm">资产数量</div>
        </div>

        <div class="stat-card green bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-emerald-300 transition-all duration-300 opacity-0 animate-fadeIn delay-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-text-primary mb-1"><?php echo number_format($totalTargets) ?></div>
            <div class="text-text-secondary text-sm">已完成扫描</div>
        </div>
    </div>

<?php
    $searchArr = [
        'action' => url('index/index'),
        'method' => 'get',
        'inputs' => [
            ['type' => 'select', 'name' => 'statuscode', 'options' => $statuscodeArr, 'frist_option' => '全部状态', 'label' => '状态码'],
            ['type' => 'select', 'name' => 'cms', 'options' => $cmsArr, 'frist_option' => '全部CMS', 'label' => 'CMS系统'],
            ['type' => 'select', 'name' => 'server', 'options' => $serverArr, 'frist_option' => '全部服务', 'label' => '服务类型'],
        ],
        'btnArr' => [
            ['text' => '添加', 'ext' => [
                "class" => "btn-action",
                "onclick" => "openWebscanDrawer()",
            ]]
        ],
    ];
    ?>
    {include file='public/search' /}

    <!-- 操作按钮区 -->
    <div class="bg-white border border-surface-300 rounded-2xl p-5 mb-6 shadow-card opacity-0 animate-fadeIn delay-400">
        <div class="flex flex-wrap gap-3">
            <button onclick="suspend_scan(1)" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary to-blue-600 text-white font-semibold hover:shadow-hover transition-all duration-200">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    启用扫描
                </span>
            </button>
            <button onclick="suspend_scan(2)" class="px-5 py-2.5 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 hover:border-amber-400 hover:text-amber-600 transition-all duration-200">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    暂停扫描
                </span>
            </button>
            <button onclick="again_scan()" class="px-5 py-2.5 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 hover:border-primary hover:text-primary transition-all duration-200">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    重新扫描
                </span>
            </button>
            <button onclick="batch_del()" class="px-5 py-2.5 rounded-xl border border-red-200 text-red-500 font-medium hover:bg-red-50 transition-all duration-200">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    批量删除
                </span>
            </button>
        </div>
    </div>

    <!-- 表格区域 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card">
        <!-- 表头 -->
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <div class="flex items-center gap-3">
                <h2 class="text-lg font-bold text-text-primary">扫描目标</h2>
                <span class="bg-primary text-white text-xs px-2.5 py-1 rounded-full font-medium"><?php echo count($list) ?></span>
            </div>
        </div>

        <!-- 表格 -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="w-12 px-5 py-4 text-left">
                            <input type="checkbox" value="-1" onclick="quanxuan(this)" class="w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20 cursor-pointer">
                        </th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">目标信息</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">漏洞</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">资产</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">创建时间</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider w-[150px]">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($list as $value) { ?>
                    <?php $vulnCount = $value['awvs_num'] + $value['xray_num'] + $value['sqlmap_num'] + $value['vulmap_num']; ?>
                    <?php $assetCount = $value['urls_num'] + $value['namp_num'] + $value['sqlmap_num'] + $value['vulmap_num']; ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4">
                            <input type="checkbox" class="ids w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20 cursor-pointer" name="ids[]" value="<?php echo $value['id'] ?>">
                        </td>
                        <td class="px-5 py-4 font-semibold text-text-primary">#<?php echo $value['id'] ?></td>
                        <td class="px-5 py-4">
                            <a href="<?= $value['url'] ?? '' ?>" title="<?= $value['url'] ?? '' ?>" target="_blank" class="font-medium text-primary hover:underline">
                                <?= $value['name'] ?? '' ?>
                            </a>
                            <div class="text-sm text-text-muted mt-1 truncate max-w-[300px]"><?= $value['url'] ?? '' ?></div>
                        </td>
                        <td class="px-5 py-4">
                            <?php if ($vulnCount > 0) { ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-50 text-red-600 border border-red-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                <?php echo $vulnCount ?>
                            </span>
                            <?php } else { ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                0
                            </span>
                            <?php } ?>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-primary-light text-primary border border-blue-100">
                                <?php echo $assetCount ?>
                            </span>
                        </td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo date('Y-m-d H:i', strtotime($value['create_time'])) ?></td>
                        <td class="px-5 py-4">
                            <div class="flex gap-1">
                                <a href="<?php echo url('details', ['id' => $value['id']]) ?>" class="w-9 h-9 rounded-xl bg-surface-100 text-primary hover:bg-primary-light transition-colors flex items-center justify-center" title="查看详情">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($list)) { ?>
                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center text-text-muted">暂无扫描目标</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- 分页 -->
        <div class="flex justify-between items-center px-5 py-4 border-t border-surface-200 bg-surface-50">
            <div class="text-sm text-text-secondary">
                共 <span class="text-text-primary font-semibold"><?php echo count($list) ?></span> 条记录
            </div>
            {include file='public/fenye' /}
        </div>
    </div>

    {include file='index/add_modal' /}
    {include file='index/set_modal' /}

    <style>
        .stat-card {
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            opacity: 0.05;
            transform: translate(30%, -30%);
        }
        .stat-card.blue::before { background: #3b82f6; }
        .stat-card.red::before { background: #ef4444; }
        .stat-card.amber::before { background: #f59e0b; }
        .stat-card.green::before { background: #22c55e; }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
    </style>

    <script>
        function suspend_scan(status) {
            var child = $('table').find('input[type="checkbox"]');
            var ids = ''
            child.each(function (index, item) {
                if (item.value != -1 && item.checked) {
                    if (ids == '') {
                        ids = item.value
                    } else {
                        ids = ids + ',' + item.value
                    }
                }
            })

            $.ajax({
                type: "post",
                url: "<?php echo url('index/suspend_scan')?>",
                data: {ids: ids, status: status},
                dataType: "json",
                success: function (data) {
                    alert(data.msg)
                    if (data.code == 1) {
                        window.setTimeout(function () {
                            location.reload();
                        }, 2000)
                    }
                }
            });
        }

        function again_scan() {
            var child = $('table').find('input[type="checkbox"]');
            var ids = ''
            child.each(function (index, item) {
                if (item.value != -1 && item.checked) {
                    if (ids == '') {
                        ids = item.value
                    } else {
                        ids = ids + ',' + item.value
                    }
                }
            })

            $.ajax({
                type: "post",
                url: "<?php echo url('index/again_scan')?>",
                data: {ids: ids},
                dataType: "json",
                success: function (data) {
                    alert(data.msg)
                    window.setTimeout(function () {
                        location.reload();
                    }, 1000)
                }
            });
        }

        function batch_del() {
            var child = $('table').find('input[type="checkbox"]');
            var ids = ''
            child.each(function (index, item) {
                if (item.value != -1 && item.checked) {
                    if (ids == '') {
                        ids = item.value
                    } else {
                        ids = ids + ',' + item.value
                    }
                }
            })

            $.ajax({
                type: "post",
                url: "<?php echo url('index/batch_del')?>",
                data: {ids: ids},
                dataType: "json",
                success: function (data) {
                    alert(data.msg)
                    window.setTimeout(function () {
                        location.reload();
                    }, 1000)
                }
            });
        }
    </script>

{include file='public/footer' /}
