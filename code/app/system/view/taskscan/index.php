{include file='public/head' /}
{include file='public/systemLeftMenu' /}

<?php
$colorArr = ['secondary','success'];
$statusDescArr = ['待执行','已执行'];
?>
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
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-secondary {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }
    .badge-success {
        background: #dcfce7;
        color: #16a34a;
        border: 1px solid #bbf7d0;
    }
    .form-control-modern {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 16px;
        font-size: 14px;
        color: #1e293b;
        transition: all 0.2s;
    }
    .form-control-modern:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }
    .form-control-modern:disabled {
        background: #f1f5f9;
        color: #64748b;
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
    <!-- 页面标题 -->
    <div class="flex justify-between items-start mb-6 opacity-0 animate-fadeIn">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 mb-2">扫描任务列表</h1>
            <nav class="flex gap-2 text-sm text-slate-500">
                <a href="/" class="hover:text-blue-500 transition-colors">首页</a>
                <span class="text-slate-300">/</span>
                <a href="#" class="hover:text-blue-500 transition-colors">系统管理</a>
                <span class="text-slate-300">/</span>
                <span class="text-slate-700 font-medium">扫描任务列表</span>
            </nav>
        </div>
    </div>

    <div class="card-table opacity-0 animate-fadeIn" style="animation-delay: 0.1s;">
        <div class="p-5 border-b border-slate-200 bg-slate-50">
            <div class="flex items-center gap-3">
                <h2 class="text-lg font-bold text-slate-800">扫描任务列表</h2>
                <span class="bg-blue-500 text-white text-xs px-2.5 py-1 rounded-full font-medium"><?= count($list) ?></span>
            </div>
        </div>
        <table class="w-full border-0 text-sm mb-0">
            <thead>
            <tr>
                <th>ID</th>
                <th>数据来源</th>
                <th>队列名称</th>
                <th>目标</th>
                <th>状态</th>
                <th>创建时间</th>
                <th>更新时间</th>
                <th>执行命令</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($list as $value) {
                $extInfo = json_decode($value['ext_info'], true);
                $targetId = isset($extInfo['id']) ? $extInfo['id'] : '';
                // 根据tool字段推断数据来源
                $targetTable = '';
                if (strpos($value['tool'], 'asm_') === 0) {
                    if (strpos($value['tool'], 'domain_') !== false) {
                        $targetTable = 'asm_domain';
                    } elseif (strpos($value['tool'], 'ip_') !== false) {
                        $targetTable = 'asm_ip';
                    } elseif (strpos($value['tool'], 'urls') !== false) {
                        $targetTable = 'asm_urls';
                    } elseif ($value['tool'] == 'asm_discover') {
                        $targetTable = 'asm_discover';
                    }
                } elseif (strpos($value['tool'], 'scan_app_') === 0) {
                    $targetTable = 'app';
                } elseif (strpos($value['tool'], 'code_') === 0) {
                    $targetTable = 'code';
                }
            ?>
                <tr>
                    <td>{$value['id']}</td>
                    <td><?php echo $targetTable; ?></td>
                    <td>{$value['tool']}</td>
                    <td><?php echo $targetId; ?></td>
                    <td>
                        <span class="badge-status badge-<?= $colorArr[$value['status']] ?>">
                            <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                            {$statusDescArr[$value['status']]}
                        </span>
                    </td>
                    <td><?php echo date('Y-m-d H:i', strtotime($value['create_time'])) ?></td>
                    <td><?php echo $value['update_time'] ?></td>
                    <td><input class="form-control-modern w-100" value="<?php echo 'php think scan '.$value['tool'].' -vvv' ?>" disabled /></td>
                    <td>
                        <div class="flex gap-1">
                            <button onclick="copyCommand('<?php echo 'php think scan '.$value['tool'].' -vvv' ?>')" class="btn-action bg-slate-100 text-blue-500 hover:bg-blue-50" title="复制命令">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
            <?php if (empty($list)) { ?>
                <tr>
                    <td colspan="9" class="text-center py-8 text-slate-400">暂无数据</td>
                </tr>
            <?php } ?>
        </table>
        <div class="p-4 border-t border-slate-200 bg-slate-50">
            {include file='public/fenye' /}
        </div>
    </div>
</div>

<script>
    function copyCommand(command) {
        navigator.clipboard.writeText(command).then(function() {
            alert('命令已复制到剪贴板');
        }).catch(function(err) {
            // Fallback for older browsers
            var textArea = document.createElement("textarea");
            textArea.value = command;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('命令已复制到剪贴板');
        });
    }
</script>

{include file='public/footer' /}
