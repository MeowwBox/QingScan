{include file='public/head' /}
{include file='public/whiteLeftMenu' /}
<?php
$dengjiArr = ['Low', 'Medium', 'High', 'Critical'];
$dengjiArrColor = [
    'Low' => 'low',
    'Medium' => 'medium',
    'High' => 'high',
    'Critical' => 'critical'
];

$fileTypeList = getFileType($fileList);

// 统计数据计算
$totalCount = count($list ?? []);
$criticalCount = 0;
$highCount = 0;
$pendingCount = 0;
$fixedCount = 0;

// 遍历统计各级别漏洞数量
if (!empty($list)) {
    foreach ($list as $item) {
        if (($item['Friority'] ?? '') === 'Critical') $criticalCount++;
        if (($item['Friority'] ?? '') === 'High') $highCount++;
        if (($item['check_status'] ?? 0) == 0) $pendingCount++;
        if (($item['check_status'] ?? 0) == 1) $fixedCount++;
    }
}
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

    /* 统计卡片 */
    .stat-card {
        position: relative;
        overflow: hidden;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        box-shadow: 0 4px 12px -2px rgb(0 0 0 / 0.1);
    }
    .stat-card.blue:hover { border-color: rgba(59, 130, 246, 0.3); }
    .stat-card.red:hover { border-color: rgba(239, 68, 68, 0.3); }
    .stat-card.amber:hover { border-color: rgba(245, 158, 11, 0.3); }
    .stat-card.green:hover { border-color: rgba(34, 197, 94, 0.3); }

    /* Tailwind 风格样式 */
    .page-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        overflow: hidden;
    }
    .table-header {
        background: #f8fafc;
        border-bottom: 1px solid #f1f5f9;
    }
    .table-header th {
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 14px 16px;
    }
    .table-row {
        border-bottom: 1px solid #f1f5f9;
        transition: background-color 0.2s;
    }
    .table-row:hover {
        background-color: #f8fafc;
    }
    .table-row td {
        padding: 14px 16px;
        color: #1e293b;
        vertical-align: middle;
    }
    /* 漏洞等级标签 */
    .level-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
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
    .level-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }
    .level-critical .level-dot { background: #dc2626; }
    .level-high .level-dot { background: #ea580c; }
    .level-medium .level-dot { background: #d97706; }
    .level-low .level-dot { background: #2563eb; }
    /* 状态选择器 */
    .status-select {
        padding: 6px 10px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        font-size: 13px;
        color: #1e293b;
        cursor: pointer;
    }
    .status-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    }
    /* 按钮 */
    .btn-view {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #3b82f6;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-view:hover {
        background: #eff6ff;
        border-color: #3b82f6;
    }
    /* 复选框 */
    .custom-checkbox {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 1px solid #cbd5e1;
        cursor: pointer;
        accent-color: #3b82f6;
    }
    /* 批量操作按钮 */
    .batch-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #64748b;
        cursor: pointer;
        transition: all 0.2s;
    }
    .batch-btn:hover {
        background: #f8fafc;
        border-color: #3b82f6;
        color: #3b82f6;
    }
    .batch-btn.danger:hover {
        border-color: #ef4444;
        color: #ef4444;
        background: #fef2f2;
    }
</style>

<?php
$searchArr = [
    'action' => url('/code/fortify/index'),
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'placeholder' => "搜索的内容"],
        ['type' => 'select', 'name' => 'Folder', 'options' => $dengjiArr, 'frist_option' => '危险等级'],
        ['type' => 'select', 'name' => 'Category', 'options' => $CategoryList, 'frist_option' => '漏洞类别'],
        ['type' => 'select', 'name' => 'code_id', 'options' => $fortifyProjectList, 'frist_option' => '项目列表'],
        ['type' => 'select', 'name' => 'Primary_filename', 'options' => $fileList, 'frist_option' => '文件筛选'],
        ['type' => 'select', 'name' => 'filetype', 'options' => $fileTypeList, 'frist_option' => '文件后缀'],
        ['type' => 'select', 'name' => 'check_status', 'options' => $check_status_list, 'frist_option' => '审计状态', 'frist_option_value' => -1],
    ]]; ?>

<!-- 页面标题区域 -->
<div class="flex justify-between items-start mb-6 opacity-0 animate-fadeIn">
    <div>
        <h1 class="text-2xl font-bold text-text-primary mb-2">Fortify漏洞列表</h1>
        <nav class="flex gap-2 text-sm text-text-secondary">
            <a href="<?php echo url('index/index') ?>" class="hover:text-primary transition-colors">首页</a>
            <span class="text-text-muted">/</span>
            <a href="<?php echo url('code/index') ?>" class="hover:text-primary transition-colors">代码审计</a>
            <span class="text-text-muted">/</span>
            <span class="text-text-primary font-medium">Fortify漏洞列表</span>
        </nav>
    </div>
</div>

<!-- 统计卡片区域 -->
<div class="grid grid-cols-4 gap-5 mb-6">
    <div class="stat-card blue opacity-0 animate-fadeIn">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $totalCount ?></div>
        <div class="text-text-secondary text-sm">当前页漏洞数</div>
    </div>

    <div class="stat-card red opacity-0 animate-fadeIn delay-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $criticalCount + $highCount ?></div>
        <div class="text-text-secondary text-sm">高危漏洞</div>
    </div>

    <div class="stat-card amber opacity-0 animate-fadeIn delay-200">
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

    <div class="stat-card green opacity-0 animate-fadeIn delay-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $fixedCount ?></div>
        <div class="text-text-secondary text-sm">已确认为有效漏洞</div>
    </div>
</div>

{include file='public/search' /}

<div class="page-card">
    <!-- 批量操作区域 -->
    <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
        <div class="flex items-center gap-3">
            <h2 class="text-lg font-bold text-text-primary">漏洞列表</h2>
            <span class="bg-primary text-white text-xs px-2.5 py-1 rounded-full font-medium"><?php echo $totalCount ?></span>
        </div>
        <div class="flex gap-2">
            <button onclick="batch_audit()" class="batch-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                批量审核
            </button>
            <button onclick="batch_del()" class="batch-btn danger">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                批量删除
            </button>
        </div>
    </div>
    <table class="table" style="width: 100%;">
        <thead class="table-header">
        <tr>
            <th style="width: 70px;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="checkbox" class="custom-checkbox" value="-1" onclick="quanxuan(this)">
                    <span>全选</span>
                </label>
            </th>
            <th>ID</th>
            <th>所属项目</th>
            <th>漏洞类型</th>
            <th>危险等级</th>
            <th>污染来源</th>
            <th>执行位置</th>
            <th>创建时间</th>
            <th>状态</th>
            <th style="width: 100px;">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $value) { ?>
            <tr class="table-row">
                <td>
                    <label style="display: flex; align-items: center;">
                        <input type="checkbox" class="custom-checkbox ids" name="ids[]" value="<?php echo $value['id'] ?>">
                    </label>
                </td>
                <td><?php echo $value['id'] ?></td>
                <td><a href="<?php echo url('code/index', ['id' => $value['code_id']]) ?>" style="color: #3b82f6; text-decoration: none;">
                        <?php echo isset($projectArr[$value['code_id']]) ? $projectArr[$value['code_id']]['name'] : '' ?></a>
                </td>
                <td><?php echo $value['Category'] ?></td>
                <td>
                    <?php $levelClass = $dengjiArrColor[$value['Friority']] ?? 'low'; ?>
                    <span class="level-badge level-<?php echo $levelClass ?>">
                        <span class="level-dot"></span>
                        <?php echo $value['Friority'] ?>
                    </span>
                </td>
                <td title="<?php echo htmlentities($value['Source']['Snippet'] ?? '') ?>">
                    <span style="color: #64748b; font-size: 13px;">
                        <?php echo $value['Source']['FileName'] ?? '' ?>
                    </span>
                </td>
                <td title="<?php echo htmlentities($value['Primary']['Snippet'] ?? '') ?>">
                    <span style="color: #64748b; font-size: 13px;">
                        <?php echo isset($value['Primary']) ? $value['Primary']['FileName'] : '' ?>
                    </span>
                </td>
                <td><span style="color: #64748b; font-size: 13px;"><?php echo $value['create_time'] ?></span></td>
                <td>
                    <select class="status-select changCheckStatus" data-id="<?php echo $value['id'] ?>">
                        <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                        <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                        <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                    </select>
                </td>
                <td>
                    <a href="<?php echo url('fortify/details', ['id' => $value['id']]) ?>" class="btn-view">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        查看漏洞
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
{include file='public/fenye' /}

<input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/fortify') ?>">

<!-- 批量审核弹窗 -->
<div class="modal fade" id="batch_auditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" style="padding-top: 10%;text-align: center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">批量审核</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div style="display: flex; gap: 20px; justify-content: center;">
                        <label style="cursor: pointer;">
                            <input type="radio" name="batch_check_status" value="1"> 有效漏洞
                        </label>
                        <label style="cursor: pointer;">
                            <input type="radio" name="batch_check_status" value="2"> 无效漏洞
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="batch_submit" class="btn btn-sm btn-primary">提交</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function batch_audit() {
        $('#batch_auditModal').modal('show')
    }

    $('#batch_submit').click(function () {
        var check_status = $("input[name='batch_check_status']:checked").val();
        if (!check_status) {
            alert('请选择审核状态');
            return false;
        }
        var ids = getIds();
        if (ids == '') {
            alert('请先选择要审核的数据');
            return false;
        }
        $.ajax({
            type: "post",
            url: "<?php echo url('batch_audit')?>",
            data: {ids: ids, check_status: check_status},
            dataType: "json",
            success: function (data) {
                alert(data.msg);
                if (data.code == 1) {
                    setTimeout(function () {
                        location.reload();
                    }, 1500)
                }
            }
        });
    });

    function batch_del() {
        var ids = getIds();
        if (ids == '') {
            alert('请先选择要删除的数据');
            return false;
        }
        if (!confirm('确定要删除选中的数据吗？')) {
            return false;
        }
        $.ajax({
            type: "post",
            url: "<?php echo url('batch_del')?>",
            data: {ids: ids},
            dataType: "json",
            success: function (data) {
                alert(data.msg);
                if (data.code == 1) {
                    setTimeout(function () {
                        location.reload();
                    }, 1500)
                }
            }
        });
    }

    function getIds() {
        var child = $('.table').find('.ids');
        var ids = '';
        child.each(function (index, item) {
            if (item.value != -1 && item.checked) {
                if (ids == '') {
                    ids = item.value;
                } else {
                    ids = ids + ',' + item.value;
                }
            }
        });
        return ids;
    }
</script>

{include file='public/to_examine' /}
{include file='public/footer' /}
