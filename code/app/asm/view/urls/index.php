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
                <h1 class="text-2xl font-bold text-slate-800 mb-2">URL列表</h1>
                <nav class="flex gap-2 text-sm text-slate-500">
                    <a href="/" class="hover:text-blue-500 transition-colors">首页</a>
                    <span class="text-slate-400">/</span>
                    <a href="#" class="hover:text-blue-500 transition-colors">资产管理</a>
                    <span class="text-slate-400">/</span>
                    <span class="text-slate-800 font-medium">URL列表</span>
                </nav>
            </div>
        </div>

        <!-- 统计卡片区域 -->
        <div class="grid grid-cols-4 gap-5 mb-6">
            <div class="stat-card blue bg-white border border-slate-200 rounded-2xl p-5 hover:shadow-lg hover:border-blue-300 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-slate-800 mb-1"><?php echo $total ?? 0 ?></div>
                <div class="text-slate-500 text-sm">总URL数</div>
            </div>

            <div class="stat-card green bg-white border border-slate-200 rounded-2xl p-5 hover:shadow-lg hover:border-green-300 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-slate-800 mb-1"><?php echo $status200 ?? 0 ?></div>
                <div class="text-slate-500 text-sm">正常(2xx)</div>
            </div>

            <div class="stat-card amber bg-white border border-slate-200 rounded-2xl p-5 hover:shadow-lg hover:border-amber-300 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-slate-800 mb-1"><?php echo $status400 ?? 0 ?></div>
                <div class="text-slate-500 text-sm">客户端错误(4xx)</div>
            </div>

            <div class="stat-card red bg-white border border-slate-200 rounded-2xl p-5 hover:shadow-lg hover:border-red-300 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                    </div>
                </div>
                <div class="text-3xl font-bold text-slate-800 mb-1"><?php echo $status500 ?? 0 ?></div>
                <div class="text-slate-500 text-sm">服务器错误(5xx)</div>
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

        <div class="table-container">
            <div class="px-5 py-4 border-b border-slate-200 bg-slate-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg font-bold text-slate-800">URL列表</h2>
                        <span class="bg-blue-500 text-white text-xs px-2.5 py-1 rounded-full font-medium"><?php echo $total ?? 0 ?></span>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 rounded-xl border border-slate-300 text-slate-500 text-sm hover:bg-slate-50 hover:text-slate-700 hover:border-blue-400 transition-all">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                导出
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            {include file='public/batch_del' /}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                    <tr>
                        <th width="70">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" value="-1" onclick="quanxuan(this)" class="w-4 h-4 rounded border-slate-300">
                                ID
                            </label>
                        </th>
                        <th>URL</th>
                        <th>标题</th>
                        <th>状态码</th>
                        <th>server</th>
                        <th>ISP</th>
                        <th>IP</th>
                        <th>创建时间</th>
                        <th style="width: 200px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list as $value) { ?>
                        <tr>
                            <td>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" class="ids w-4 h-4 rounded border-slate-300" name="ids[]" value="<?php echo $value['id'] ?>">
                                    <?php echo $value['id'] ?>
                                </label>
                            </td>

                            <td class="truncate-td">
                                <a href="<?php echo $value['url'] ?>" target="_blank" title="<?php echo $value['url'] ?>"><?php echo $value['url'] ?></a>
                            </td>
                            <td class="truncate-td" title="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></td>
                            <td>
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
                                        echo 'bg-slate-50 text-slate-600 border border-slate-100';
                                    }
                                    ?>">
                                    <?php echo $value['status'] ?>
                                </span>
                            </td>
                            <td><?php echo $value['server'] ?></td>
                            <td><?php echo $value['isp'] ?></td>
                            <td class="truncate-td" title="<?php echo $value['ip'] ?>(<?php echo $value['address']?>)"><?php echo $value['ip'] ?> <?php echo $value['address']?> </td>
                            <td class="text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                            <td>
                                <div class="flex gap-1">
                                    <a href="<?php echo $value['url'] ?>" target="_blank" class="icon-btn view" title="访问URL">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </a>
                                    <a href="<?php echo url('urls/edit', ['id' => $value['id']]) ?>" class="icon-btn edit" title="编辑">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
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
                    </tbody>
                </table>
            </div>
        </div>
        {include file='public/fenye' /}
    </div>
{include file='public/footer' /}
