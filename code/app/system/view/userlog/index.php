{include file='public/head' /}
{include file='public/systemLeftMenu' /}

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn { animation: fadeIn 0.3s ease-out forwards; }
    .page-container { padding: 24px; }
    .card-table {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }
    .card-table thead {
        background: #f8fafc;
    }
    .card-table thead th {
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 16px 20px;
        border-bottom: 1px solid #e2e8f0;
    }
    .card-table tbody td {
        padding: 16px 20px;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
    }
    .card-table tbody tr:hover {
        background: #f8fafc;
    }
    .card-table tbody tr:last-child td {
        border-bottom: none;
    }
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .btn-action:hover {
        transform: scale(1.05);
    }
</style>
<div class="page-container">
    <div class="flex justify-between items-start mb-6 opacity-0 animate-fadeIn">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 mb-2">用户日志</h1>
            <nav class="flex gap-2 text-sm text-slate-500">
                <a href="/" class="hover:text-blue-500 transition-colors">首页</a>
                <span class="text-slate-300">/</span>
                <a href="#" class="hover:text-blue-500 transition-colors">系统管理</a>
                <span class="text-slate-300">/</span>
                <span class="text-slate-700 font-medium">用户日志</span>
            </nav>
        </div>
        <div>
            <a href="/system/user_log/clear_all" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors text-sm font-medium">清空日志</a>
        </div>
    </div>

    <div class="card-table opacity-0 animate-fadeIn" style="animation-delay: 0.1s;">
        <div class="p-5 border-b border-slate-200 bg-slate-50">
            <div class="flex items-center gap-3">
                <h2 class="text-lg font-bold text-slate-800">用户日志列表</h2>
                <span class="bg-blue-500 text-white text-xs px-2.5 py-1 rounded-full font-medium"><?= count($list) ?></span>
            </div>
        </div>
        <table class="w-full border-0 text-sm mb-0">
            <thead>
            <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>操作模块</th>
                <th>操作内容</th>
                <th>IP地址</th>
                <th>操作时间</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($list as $value) { ?>
                <tr>
                    <td>{$value['id']}</td>
                    <td>{$value['username']}</td>
                    <td>{$value['module']}</td>
                    <td>{$value['content']}</td>
                    <td>{$value['ip']}</td>
                    <td><?php echo date('Y-m-d H:i:s', strtotime($value['create_time'])) ?></td>
                </tr>
            <?php } ?>
            </tbody>
            <?php if (empty($list)) { ?>
                <tr>
                    <td colspan="6" class="text-center py-8 text-slate-400">暂无数据</td>
                </tr>
            <?php } ?>
        </table>
        <div class="p-4 border-t border-slate-200 bg-slate-50">
            {include file='public/fenye' /}
        </div>
    </div>
</div>

{include file='public/footer' /}
