{include file='public/head' /}
{include file='public/asmLeftMenu' /}
<style>
    /* 页面容器样式 */
    .page-container {
        background: #f8fafc;
        min-height: calc(100vh - 64px);
    }
    /* 表格容器样式 */
    .table-container {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        overflow: hidden;
    }
    /* 表头样式 */
    .table-container thead tr {
        background: #f1f5f9;
    }
    .table-container thead th {
        padding: 16px 20px;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e2e8f0;
    }
    /* 表格内容样式 */
    .table-container tbody td {
        padding: 16px 20px;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    .table-container tbody tr:hover {
        background: #f8fafc;
    }
    .table-container tbody tr:last-child td {
        border-bottom: none;
    }
    /* 链接样式 */
    .table-container a {
        color: #3b82f6;
        text-decoration: none;
    }
    .table-container a:hover {
        text-decoration: underline;
    }
    /* 按钮样式 */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s;
        text-decoration: none;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #64748b;
    }
    .btn-action:hover {
        background: #f1f5f9;
        border-color: #3b82f6;
        color: #3b82f6;
        text-decoration: none;
    }
    .btn-danger {
        border-color: #fca5a5;
        color: #ef4444;
    }
    .btn-danger:hover {
        background: #fef2f2;
        border-color: #ef4444;
        color: #dc2626;
    }
    /* 搜索区域样式 */
    .search-container {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
    }
    /* 文本截断 */
    .truncate-td {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    /* 图标按钮样式 */
    .icon-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        text-decoration: none;
    }
    .icon-btn:hover {
        text-decoration: none;
    }
    .icon-btn.view {
        background: #f1f5f9;
        color: #3b82f6;
    }
    .icon-btn.view:hover {
        background: #eff6ff;
    }
    .icon-btn.edit {
        background: #f1f5f9;
        color: #f59e0b;
    }
    .icon-btn.edit:hover {
        background: #fffbeb;
    }
    .icon-btn.delete {
        background: #f1f5f9;
        color: #ef4444;
    }
    .icon-btn.delete:hover {
        background: #fef2f2;
    }
    /* 统计卡片样式 */
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
    .stat-card.green::before { background: #22c55e; }
    .stat-card.amber::before { background: #f59e0b; }
    .stat-card.red::before { background: #ef4444; }
</style>

    <div class="w-full">
        <!-- 页面标题区域 -->
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold text-text-primary mb-2">URL列表</h1>
                <nav class="flex gap-2 text-sm text-text-secondary">
                    <a href="/" class="hover:text-primary transition-colors">首页</a>
                    <span class="text-text-muted">/</span>
                    <a href="#" class="hover:text-primary transition-colors">资产管理</a>
                    <span class="text-text-muted">/</span>
                    <span class="text-text-primary font-medium">URL列表</span>
                </nav>
            </div>
        </div>

        <!-- 统计卡片区域 -->
        <div class="grid grid-cols-4 gap-5 mb-6">
            <div class="stat-card blue bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-primary/30 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-primary-light flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $total ?? 0 ?></div>
                <div class="text-text-secondary text-sm">总URL数</div>
            </div>

            <div class="stat-card green bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-emerald-300 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $status200 ?? 0 ?></div>
                <div class="text-text-secondary text-sm">正常(2xx)</div>
            </div>

            <div class="stat-card amber bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-amber-300 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $status400 ?? 0 ?></div>
                <div class="text-text-secondary text-sm">客户端错误(4xx)</div>
            </div>

            <div class="stat-card red bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-red-300 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $status500 ?? 0 ?></div>
                <div class="text-text-secondary text-sm">服务器错误(5xx)</div>
            </div>
        </div>

        <?php
        $searchArr = [
            'action' => $_SERVER['REQUEST_URI'],
            'method' => 'get',
            'inputs' => [
                ['type' => 'text', 'name' => 'search', 'placeholder' => '请输入要搜索的关键字'],
            ],
            'btnArr' => [
                ['text' => '添加URL', 'ext' => [
                    "href" => url('urls/add'),
                    "class" => "btn-action"
                ]]
            ]]; ?>
        {include file='public/search' /}

        <?php
        $tableArr = [
            'title' => 'URL列表',
            'count' => $total ?? count($list),
            'checkbox' => true,
            'columns' => [
                ['title' => 'ID'],
                ['title' => 'URL'],
                ['title' => '标题'],
                ['title' => '状态码'],
                ['title' => '主机'],
                ['title' => '内容类型'],
                ['title' => '关键词'],
                ['title' => '创建时间'],
                ['title' => '操作', 'class' => 'w-[200px]'],
            ],
            'showBatchDel' => true,
        ];
        ?>
        {include file='public/table_start' /}

        <?php foreach ($list as $value) { ?>
        <tr class="hover:bg-surface-50 transition-colors">
            <td class="px-5 py-4">
                <input type="checkbox" class="ids w-4 h-4 rounded border-surface-400 text-primary" name="ids[]" value="<?php echo $value['id'] ?>">
            </td>
            <td class="px-5 py-4 font-medium text-text-primary"><?php echo $value['id'] ?></td>
            <td class="px-5 py-4">
                <a href="<?php echo $value['url'] ?>" target="_blank" title="<?php echo $value['url'] ?>" class="text-primary hover:underline truncate-td"><?php echo $value['url'] ?></a>
            </td>
            <td class="px-5 py-4 truncate-td" title="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></td>
            <td class="px-5 py-4">
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium
                    <?php
                    if ($value['status'] >= 200 && $value['status'] < 300) {
                        echo 'bg-emerald-50 text-emerald-600 border border-emerald-100';
                    } elseif ($value['status'] >= 300 && $value['status'] < 400) {
                        echo 'bg-blue-50 text-blue-600 border border-blue-100';
                    } elseif ($value['status'] >= 400 && $value['status'] < 500) {
                        echo 'bg-amber-50 text-amber-600 border border-amber-100';
                    } elseif ($value['status'] >= 500) {
                        echo 'bg-red-50 text-red-600 border border-red-100';
                    } else {
                        echo 'bg-surface-50 text-text-secondary border border-surface-200';
                    }
                    ?>">
                    <?php echo $value['status'] ?>
                </span>
            </td>
            <td class="px-5 py-4"><?php echo $value['host'] ?? '-' ?></td>
            <td class="px-5 py-4"><?php echo $value['content_type'] ?? '-' ?></td>
            <td class="px-5 py-4 truncate-td"><?php echo $value['keywords'] ?? '-' ?></td>
            <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
            <td class="px-5 py-4">
                <div class="flex gap-1">
                    <button onclick="showUrlDetail(<?php echo $value['id'] ?>)" class="icon-btn view" title="查看详情">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                    <a href="<?php echo $value['url'] ?>" target="_blank" class="icon-btn view" title="访问URL">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <a href="<?php echo url('urls/del', ['id' => $value['id']]) ?>" class="icon-btn delete" title="删除" onclick="return confirm('确定要删除吗？')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </a>
                </div>
            </td>
        </tr>
        <?php } ?>

        {include file='public/table_end' /}
    </div>
{include file='public/drawer' /}

<script>
function showUrlDetail(id) {
    openDrawer('view', 'URL详情', 560);
    setDrawerContent('<div class="flex items-center justify-center py-12"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div></div>');

    fetch('<?php echo url("detail"); ?>?id=' + id)
        .then(response => response.json())
        .then(res => {
            if (res.code === 1 && res.data) {
                const data = res.data;
                const html = `
                    <div class="space-y-6">
                        <div class="bg-surface-50 rounded-xl p-4">
                            <h4 class="text-sm font-semibold text-text-muted mb-3">URL信息</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-text-muted">URL</span>
                                    <a href="${data.url || '#'}" target="_blank" class="font-medium text-primary max-w-[300px] text-right break-all">${data.url || '-'}</a>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-text-muted">标题</span>
                                    <span class="font-medium">${data.title || '-'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-text-muted">主机</span>
                                    <span class="font-medium">${data.host || '-'}</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-surface-50 rounded-xl p-4">
                            <h4 class="text-sm font-semibold text-text-muted mb-3">响应信息</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-text-muted">状态码</span>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-emerald-50 text-emerald-600">${data.status || '-'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-text-muted">内容类型</span>
                                    <span class="font-medium">${data.content_type || '-'}</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-surface-50 rounded-xl p-4">
                            <h4 class="text-sm font-semibold text-text-muted mb-3">时间信息</h4>
                            <div class="flex justify-between">
                                <span class="text-text-muted">创建时间</span>
                                <span class="text-text-secondary">${data.create_time || '-'}</span>
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
</script>
{include file='public/footer' /}
