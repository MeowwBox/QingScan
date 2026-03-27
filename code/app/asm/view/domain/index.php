{include file='public/head' /}
{include file='public/asmLeftMenu' /}
<?php if (!empty($flash_msg)) { ?>
<div class="fixed top-4 right-4 z-[9999] animate-fadeIn">
    <div class="bg-amber-50 border border-amber-200 text-amber-700 px-4 py-3 rounded-xl shadow-lg flex items-center gap-3">
        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
        <span class="font-medium"><?php echo $flash_msg; ?></span>
        <button type="button" class="ml-2 text-amber-500 hover:text-amber-700" onclick="this.parentElement.parentElement.remove()">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>
<?php } ?>

<!-- 页面标题区域 -->
<div class="flex justify-between items-start mb-6 opacity-0 animate-fadeIn">
    <div>
        <h1 class="text-2xl font-bold text-text-primary mb-2">域名列表</h1>
        <nav class="flex gap-2 text-sm text-text-secondary">
            <a href="#" class="hover:text-primary transition-colors">首页</a>
            <span class="text-text-muted">/</span>
            <a href="#" class="hover:text-primary transition-colors">资产管理</a>
            <span class="text-text-muted">/</span>
            <span class="text-text-primary font-medium">域名列表</span>
        </nav>
    </div>
    <div class="flex gap-3">
        <button onclick="openDomainDrawer()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary to-blue-600 text-white font-semibold hover:shadow-hover transition-all duration-200 shadow-md">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                添加域名
            </span>
        </button>
    </div>
</div>

<!-- 统计卡片 -->
<div class="grid grid-cols-4 gap-5 mb-6">
    <div class="stat-card blue bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-primary/30 transition-all duration-300 opacity-0 animate-fadeIn">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-primary-light flex items-center justify-center">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $total ?? count($list); ?></div>
        <div class="text-text-secondary text-sm">域名总数</div>
    </div>

    <div class="stat-card green bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-emerald-300 transition-all duration-300 opacity-0 animate-fadeIn delay-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $scanned_count ?? '-'; ?></div>
        <div class="text-text-secondary text-sm">已扫描</div>
    </div>

    <div class="stat-card amber bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-amber-300 transition-all duration-300 opacity-0 animate-fadeIn delay-200">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $pending_count ?? '-'; ?></div>
        <div class="text-text-secondary text-sm">待扫描</div>
    </div>

    <div class="stat-card red bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-red-300 transition-all duration-300 opacity-0 animate-fadeIn delay-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $vuln_count ?? '-'; ?></div>
        <div class="text-text-secondary text-sm">发现漏洞</div>
    </div>
</div>

<!-- 筛选区域 -->
<?php
$searchArr = [
    'action' => $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'domain', 'placeholder' => "搜索域名，如: baidu.com", 'label' => '域名'],
    ]
];
?>
{include file='public/search' /}

<!-- 表格区域 -->
<?php
$tableArr = [
    'title' => '域名列表',
    'count' => count($list),
    'columns' => [
        ['title' => 'ID'],
        ['title' => '主机'],
        ['title' => '域名'],
        ['title' => '主体信息'],
        ['title' => '创建时间'],
        ['title' => '操作'],
    ],
    'noPagination' => true,
];
?>
{include file='public/table_start' /}

<?php foreach ($list as $value) { ?>
<tr class="hover:bg-surface-50 transition-colors">
    <td class="px-5 py-4 font-semibold text-text-primary">#<?php echo $value['id'] ?></td>
    <td class="px-5 py-4">
        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-surface-100 text-text-secondary font-mono">
            <?php echo htmlspecialchars($value['domain']) ?>
        </span>
    </td>
    <td class="px-5 py-4 text-text-muted text-sm"><?php echo htmlspecialchars($value['domain'] ?? '-') ?></td>
    <td class="px-5 py-4 text-text-muted text-sm">-</td>
    <td class="px-5 py-4 text-text-muted text-sm"><?php echo $value['create_time'] ?? '-' ?></td>
    <td class="px-5 py-4">
        <div class="flex gap-1">
            <button onclick="showDomainDetail(<?php echo $value['id'] ?>)" class="w-9 h-9 rounded-xl bg-surface-100 text-primary hover:bg-primary/10 transition-colors flex items-center justify-center" title="查看详情">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </button>
            <a href="{:URL('_addTarget',['id'=>$value['id']])}" class="w-9 h-9 rounded-xl bg-surface-100 text-amber-500 hover:bg-amber-50 transition-colors flex items-center justify-center" title="添加扫描">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </a>
            <button onclick="deleteDomain(<?php echo $value['id'] ?>)" class="w-9 h-9 rounded-xl bg-surface-100 text-red-500 hover:bg-red-50 transition-colors flex items-center justify-center" title="删除">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </div>
    </td>
</tr>
<?php } ?>

{include file='public/table_end' /}

{include file='/domain/add_modal' /}
{include file='public/drawer' /}

<script>
// 查看域名详情
function showDomainDetail(id) {
    // 打开抽屉
    openDrawer('view', '域名详情', 520);

    // 显示加载状态
    setDrawerContent('<div class="flex items-center justify-center py-12"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div></div>');

    // 获取详情数据
    fetch('<?php echo url("detail"); ?>?id=' + id)
        .then(response => response.json())
        .then(res => {
            if (res.code === 1 && res.data) {
                const data = res.data;
                const html = `
                    <div class="space-y-6">
                        <div class="bg-surface-50 rounded-xl p-4">
                            <h4 class="text-sm font-semibold text-text-muted mb-3">基本信息</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-text-muted">ID</span>
                                    <span class="font-medium">#${data.id || '-'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-text-muted">域名</span>
                                    <span class="font-medium text-primary">${data.domain || '-'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-text-muted">应用ID</span>
                                    <span class="font-medium">${data.app_id || '-'}</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-surface-50 rounded-xl p-4">
                            <h4 class="text-sm font-semibold text-text-muted mb-3">时间信息</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-text-muted">创建时间</span>
                                    <span class="font-medium text-text-secondary">${data.create_time || '-'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-text-muted">更新时间</span>
                                    <span class="font-medium text-text-secondary">${data.update_time || '-'}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                setDrawerContent(html);
            } else {
                setDrawerContent('<div class="text-center py-12 text-red-500">' + (res.msg || '加载失败') + '</div>');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            setDrawerContent('<div class="text-center py-12 text-red-500">加载失败，请稍后重试</div>');
        });
}

// 删除域名
function deleteDomain(id) {
    if (confirm('确定要删除这条域名记录吗？')) {
        // 发送删除请求
        fetch('<?php echo url("delete"); ?>?id=' + id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.code === 200 || data.status === 'success' || data.code === 1) {
                // 刷新页面
                location.reload();
            } else {
                alert(data.msg || '删除失败');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('删除失败，请稍后重试');
        });
    }
}
</script>

{include file='public/footer' /}
