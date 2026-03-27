{include file='public/head' /}
{include file='public/whiteLeftMenu' /}
<?php
$dengjiArr = ['ERROR', 'Low', 'Medium', 'High', 'Critical'];

$fileList = str_replace('./extend/codeCheck/', '', $fileList);
$CategoryList = str_replace('data.tools.semgrep.', '', $CategoryList);
$fileTypeList = getFileType($fileList);
?>

<style>
    /* 动画效果 */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn { animation: fadeIn 0.3s ease-out forwards; }
    .delay-100 { animation-delay: 0.1s; opacity: 0; }
    .delay-200 { animation-delay: 0.2s; opacity: 0; }
    .delay-300 { animation-delay: 0.3s; opacity: 0; }

    /* 统计卡片装饰 */
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

    /* 表格卡片 */
    .page-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        overflow: hidden;
    }
    .table-header {
        background: #f8fafc;
    }
    .table-header th {
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 16px 20px;
    }
    .table-row {
        border-bottom: 1px solid #f1f5f9;
        transition: background-color 0.2s;
    }
    .table-row:hover {
        background-color: #f8fafc;
    }
    .table-row td {
        padding: 16px 20px;
        color: #1e293b;
        vertical-align: middle;
    }
    /* 漏洞等级标签 */
    .level-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
    .level-critical {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
    .level-high {
        background: #fff7ed;
        color: #ea580c;
        border: 1px solid #fed7aa;
    }
    .level-medium {
        background: #fffbeb;
        color: #d97706;
        border: 1px solid #fde68a;
    }
    .level-low {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }
    .level-error {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
    .level-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }
    .level-critical .level-dot,
    .level-error .level-dot { background: #dc2626; }
    .level-high .level-dot { background: #ea580c; }
    .level-medium .level-dot { background: #d97706; }
    .level-low .level-dot { background: #2563eb; }
    /* 状态标签 */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .status-badge:hover {
        transform: scale(1.02);
    }
    .status-pending {
        background: #f0f9ff;
        color: #0284c7;
        border: 1px solid #bae6fd;
    }
    .status-valid {
        background: #dcfce7;
        color: #16a34a;
        border: 1px solid #bbf7d0;
    }
    .status-invalid {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }
    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }
    .status-pending .status-dot { background: #0284c7; }
    .status-valid .status-dot { background: #16a34a; }
    .status-invalid .status-dot { background: #64748b; }
    /* 复选框 */
    .custom-checkbox {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 1px solid #cbd5e1;
        cursor: pointer;
        accent-color: #3b82f6;
    }
    /* 操作按钮 */
    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    .action-btn.view {
        background: #f1f5f9;
        color: #3b82f6;
    }
    .action-btn.view:hover {
        background: #eff6ff;
    }
</style>

<?php
$searchArr = [
    'action' => $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'placeholder' => "搜索的内容"],
        ['type' => 'select', 'name' => 'level', 'options' => $dengjiArr, 'frist_option' => '危险等级'],
        ['type' => 'select', 'name' => 'Category', 'options' => $CategoryList, 'frist_option' => '漏洞类别'],
        ['type' => 'select', 'name' => 'code_id', 'options' => $projectList, 'frist_option' => '项目列表'],
        ['type' => 'select', 'name' => 'filename', 'options' => $fileList, 'frist_option' => '文件筛选'],
        ['type' => 'select', 'name' => 'filetype', 'options' => $fileTypeList, 'frist_option' => '文件后缀'],
        ['type' => 'select', 'name' => 'check_status', 'options' => $check_status_list, 'frist_option' => '审计状态', 'frist_option_value' => -1],
    ]];
?>
{include file='public/search' /}

<!-- 页面标题和面包屑导航 -->
<div class="flex justify-between items-start mb-6 opacity-0 animate-fadeIn">
    <div>
        <h1 class="text-2xl font-bold text-text-primary mb-2">Semgrep 漏洞列表</h1>
        <nav class="flex gap-2 text-sm text-text-secondary">
            <a href="<?php echo url('index/index') ?>" class="hover:text-primary transition-colors">首页</a>
            <span class="text-text-muted">/</span>
            <a href="<?php echo url('code/index') ?>" class="hover:text-primary transition-colors">代码审计</a>
            <span class="text-text-muted">/</span>
            <span class="text-text-primary font-medium">Semgrep</span>
        </nav>
    </div>
    <div class="flex gap-3">
        <button onclick="exportData()" class="px-4 py-2.5 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 hover:border-primary hover:text-primary transition-all duration-200 shadow-soft">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                导出报告
            </span>
        </button>
    </div>
</div>

<!-- 统计卡片 -->
<?php
// 统计数据
$totalCount = count($list ?? []);
$criticalCount = 0;
$highCount = 0;
$pendingCount = 0;
$validCount = 0;

if (isset($list) && is_array($list)) {
    foreach ($list as $item) {
        if (($item['extra_severity'] ?? '') === 'Critical') $criticalCount++;
        if (($item['extra_severity'] ?? '') === 'High') $highCount++;
        if (($item['check_status'] ?? 0) == 0) $pendingCount++;
        if (($item['check_status'] ?? 0) == 1) $validCount++;
    }
}
?>

<div class="grid grid-cols-4 gap-5 mb-6">
    <div class="stat-card blue bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-primary/30 transition-all duration-300 opacity-0 animate-fadeIn">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-primary-light flex items-center justify-center">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $total ?? ($totalCount ?? 0) ?></div>
        <div class="text-text-secondary text-sm">总漏洞数</div>
    </div>

    <div class="stat-card red bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-red-300 transition-all duration-300 opacity-0 animate-fadeIn delay-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $criticalCount ?></div>
        <div class="text-text-secondary text-sm">严重漏洞</div>
    </div>

    <div class="stat-card amber bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-amber-300 transition-all duration-300 opacity-0 animate-fadeIn delay-200">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $pendingCount ?></div>
        <div class="text-text-secondary text-sm">待处理</div>
    </div>

    <div class="stat-card green bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover hover:border-emerald-300 transition-all duration-300 opacity-0 animate-fadeIn delay-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $validCount ?></div>
        <div class="text-text-secondary text-sm">有效漏洞</div>
    </div>
</div>

<div class="page-card opacity-0 animate-fadeIn delay-300">
    <!-- 表格工具栏 -->
    <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
        <div class="flex items-center gap-3">
            <h2 class="text-lg font-bold text-text-primary">漏洞列表</h2>
            <span class="bg-primary text-white text-xs px-2.5 py-1 rounded-full font-medium"><?php echo $total ?? count($list ?? []) ?></span>
        </div>
        <div class="flex gap-2">
            <button onclick="toggleFilter()" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    筛选
                </span>
            </button>
        </div>
    </div>

    {include file='public/batch' /}
    <div class="overflow-x-auto">
        <table class="w-full">
        <thead class="table-header">
        <tr>
            <th class="w-12">
                <input type="checkbox" class="custom-checkbox" value="-1" onclick="quanxuan(this)">
            </th>
            <th>ID</th>
            <th>漏洞信息</th>
            <th>等级</th>
            <th>扫描工具</th>
            <th>状态</th>
            <th>发现时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-surface-200">
        <?php foreach ($list as $value) { ?>
            <tr class="hover:bg-surface-50 transition-colors">
                <td class="px-5 py-4">
                    <input type="checkbox" class="custom-checkbox ids" name="ids[]" value="<?php echo $value['id'] ?>">
                </td>
                <td class="px-5 py-4 font-semibold text-text-primary">#<?php echo $value['id'] ?></td>
                <td class="px-5 py-4">
                    <div class="font-medium text-text-primary">
                        <?php
                        $tmpArr = explode(".", $value['check_id']);
                        echo end($tmpArr);
                        ?>
                    </div>
                    <div class="text-sm text-text-muted font-mono bg-surface-100 px-2 py-0.5 rounded mt-1 inline-block" title="<?php echo $value['path'] ?>">
                        <?php echo basename($value['path']) ?>
                    </div>
                </td>
                <td class="px-5 py-4">
                    <?php
                    $levelMap = ['ERROR' => 'error', 'Critical' => 'critical', 'High' => 'high', 'Medium' => 'medium', 'Low' => 'low'];
                    $levelClass = $levelMap[$value['extra_severity']] ?? 'low';
                    ?>
                    <span class="level-badge level-<?php echo $levelClass ?>">
                        <span class="level-dot"></span>
                        <?php echo $value['extra_severity'] ?>
                    </span>
                </td>
                <td class="px-5 py-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-violet-50 text-violet-600 border border-violet-100">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                        SemGrep
                    </span>
                </td>
                <td class="px-5 py-4">
                    <select class="status-select changCheckStatus" data-id="<?php echo $value['id'] ?>" style="padding: 6px 10px; border-radius: 8px; border: 1px solid #e2e8f0; background: #ffffff; font-size: 13px; color: #1e293b; cursor: pointer;">
                        <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                        <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                        <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                    </select>
                </td>
                <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
                <td class="px-5 py-4">
                    <div class="flex gap-1">
                        <a href="<?php echo url('semgrep/details', ['id' => $value['id']]) ?>" class="action-btn view" title="查看详情">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>
    <!-- 分页 -->
    <div class="flex justify-between items-center px-5 py-4 border-t border-surface-200 bg-surface-50">
        {include file='public/fenye' /}
    </div>
</div>

<input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/semgrep') ?>">
{include file='public/to_examine' /}
{include file='public/footer' /}
