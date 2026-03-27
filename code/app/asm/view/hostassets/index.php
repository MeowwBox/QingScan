{include file='public/head' /}
{include file='public/asmLeftMenu' /}

<!-- 主机汇总列表 -->
<style>
    /* 页面标题区域样式 */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
    }
    .page-header .title-area h1 {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 8px 0;
    }
    .page-header .breadcrumb {
        display: flex;
        gap: 8px;
        font-size: 14px;
        color: #64748b;
    }
    .page-header .breadcrumb a {
        color: #64748b;
        text-decoration: none;
        transition: color 0.2s;
    }
    .page-header .breadcrumb a:hover {
        color: #3b82f6;
    }
    .page-header .breadcrumb span.current {
        color: #1e293b;
        font-weight: 500;
    }
    .page-header .action-buttons {
        display: flex;
        gap: 12px;
    }
    .page-header .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        cursor: pointer;
    }
    .page-header .btn-secondary {
        background: #ffffff;
        border-color: #cbd5e1;
        color: #1e293b;
    }
    .page-header .btn-secondary:hover {
        background: #f8fafc;
        border-color: #3b82f6;
        color: #3b82f6;
    }
    .page-header .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: #ffffff;
        box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
    }
    .page-header .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px -2px rgba(59, 130, 246, 0.4);
    }

    /* 表格头部工具栏 */
    .table-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 20px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }
    .table-toolbar .toolbar-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .table-toolbar .table-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
    }
    .table-toolbar .table-badge {
        background: #3b82f6;
        color: #ffffff;
        font-size: 12px;
        font-weight: 600;
        padding: 2px 10px;
        border-radius: 20px;
    }
    .table-toolbar .toolbar-right {
        display: flex;
        gap: 8px;
    }
    .table-toolbar .toolbar-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        color: #64748b;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .table-toolbar .toolbar-btn:hover {
        background: #f8fafc;
        border-color: #3b82f6;
        color: #3b82f6;
    }

    /* 表格容器样式 */
    .table-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        overflow: hidden;
    }
    /* 表头样式 */
    .table-card table thead {
        background: #f8fafc;
    }
    .table-card table thead th {
        padding: 16px 20px;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e2e8f0;
    }
    /* 表格内容样式 */
    .table-card table tbody tr {
        transition: background 0.15s ease;
    }
    .table-card table tbody tr:hover {
        background: #f8fafc;
    }
    .table-card table tbody td {
        padding: 16px 20px;
        color: #1e293b;
        font-size: 14px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    .table-card table tbody tr:last-child td {
        border-bottom: none;
    }
    /* 状态标签样式 */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
    .status-badge .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }
    .status-running {
        background: #dcfce7;
        color: #16a34a;
        border: 1px solid #bbf7d0;
    }
    .status-running .dot { background: #22c55e; }
    .status-stopped {
        background: #fef3c7;
        color: #d97706;
        border: 1px solid #fde68a;
    }
    .status-stopped .dot { background: #f59e0b; }
    .status-terminated {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
    .status-terminated .dot { background: #ef4444; }
    .status-creating {
        background: #e0f2fe;
        color: #0284c7;
        border: 1px solid #bae6fd;
    }
    .status-creating .dot { background: #0ea5e9; }

    /* 云平台标签 */
    .platform-huoshan {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }
    .platform-tianyi {
        background: #e0f2fe;
        color: #0891b2;
        border: 1px solid #a5f3fc;
    }
    .platform-idc {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
    }
    .platform-baidu {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fcd34d;
    }

    /* HIDS状态标签 */
    .hids-installed {
        background: #dcfce7;
        color: #16a34a;
        border: 1px solid #bbf7d0;
    }
    .hids-not-installed {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    /* 操作按钮样式 */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1px solid transparent;
    }
    .btn-action:hover {
        transform: translateY(-1px);
        text-decoration: none;
    }
    .btn-view {
        background: #f1f5f9;
        color: #475569;
        border-color: #e2e8f0;
    }
    .btn-view:hover {
        background: #3b82f6;
        color: #ffffff;
        border-color: #3b82f6;
    }
    .btn-edit {
        background: #eff6ff;
        color: #2563eb;
        border-color: #bfdbfe;
    }
    .btn-edit:hover {
        background: #2563eb;
        color: #ffffff;
    }
    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fecaca;
    }
    .btn-delete:hover {
        background: #dc2626;
        color: #ffffff;
    }

    /* 多选框样式 */
    .checkbox-wrapper input[type="checkbox"] {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 2px solid #cbd5e1;
        cursor: pointer;
        accent-color: #3b82f6;
    }

    /* 分页信息样式 */
    .pagination-info {
        font-size: 14px;
        color: #64748b;
    }
    .pagination-info strong {
        color: #1e293b;
        font-weight: 600;
    }
</style>

<!-- 统计卡片 -->
<div class="grid grid-cols-4 gap-5 mb-6">
    <div class="bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover transition-all duration-300 opacity-0 animate-fadeIn">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-primary-light flex items-center justify-center">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $total ?? count($list); ?></div>
        <div class="text-text-secondary text-sm">主机总数</div>
    </div>

    <div class="bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover transition-all duration-300 opacity-0 animate-fadeIn delay-100">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $running_count ?? '-'; ?></div>
        <div class="text-text-secondary text-sm">运行中</div>
    </div>

    <div class="bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover transition-all duration-300 opacity-0 animate-fadeIn delay-200">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $stopped_count ?? '-'; ?></div>
        <div class="text-text-secondary text-sm">已停止</div>
    </div>

    <div class="bg-white border border-surface-300 rounded-2xl p-5 hover:shadow-hover transition-all duration-300 opacity-0 animate-fadeIn delay-300">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-text-primary mb-1"><?php echo $hids_installed_count ?? '-'; ?></div>
        <div class="text-text-secondary text-sm">已安装HIDS</div>
    </div>
</div>

<!-- 页面标题区域 -->
<div class="page-header">
    <div class="title-area">
        <h1>主机资产列表</h1>
        <nav class="breadcrumb">
            <a href="#">首页</a>
            <span>/</span>
            <a href="#">资产管理</a>
            <span>/</span>
            <span class="current">主机资产</span>
        </nav>
    </div>
    <div class="action-buttons">
        <a href="<?php echo url('asm/hostassets/export') ?>" class="btn btn-secondary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            导出数据
        </a>
        <a href="<?php echo url('asm/hostassets/add') ?>" class="btn btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            新增主机
        </a>
    </div>
</div>

<!-- 筛选/搜索区域 -->
<?php
$searchArr = [
    'action' =>  $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'keyword', 'label' => '关键词', 'placeholder' => "实例名称/IP地址"],
        ['type' => 'select', 'name' => 'cloud_platform', 'label' => '云平台', 'options' => $platforms, 'frist_option' => '全部平台'],
        ['type' => 'select', 'name' => 'status', 'label' => '实例状态', 'options' => $instance_status, 'frist_option' => '全部状态'],
        ['type' => 'select', 'name' => 'hids_installed', 'label' => 'HIDS状态', 'options' => $hids_status, 'frist_option' => '全部']
    ]]; ?>
{include file='public/search' /}

<div class="flex flex-wrap -mx-4" style="margin: 0;">
    <div class="w-full px-4">
        <!-- 引入子菜单 -->
        {include file='hostassets/sub_menu' /}

        <div class="table-card">
            <!-- 表格头部工具栏 -->
            <div class="table-toolbar">
                <div class="toolbar-left">
                    <span class="table-title">主机列表</span>
                    <span class="table-badge"><?php echo $total ?? count($list) ?></span>
                </div>
                <div class="toolbar-right">
                    <button class="toolbar-btn" onclick="exportSelected()">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        导出选中
                    </button>
                    <button class="toolbar-btn" onclick="refreshList()">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        刷新
                    </button>
                </div>
            </div>

            <table class="w-full" style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th style="width: 50px">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" id="selectAll" onchange="toggleSelectAll(this)">
                            </div>
                        </th>
                        <th>ID</th>
                        <th>实例名称</th>
                        <th>显示名称</th>
                        <th>云平台</th>
                        <th>状态</th>
                        <th>私有IP</th>
                        <th>公网IP</th>
                        <th>HIDS状态</th>
                        <th>创建时间</th>
                        <th style="width: 200px">操作</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $value) { ?>
                    <tr>
                        <td>
                            <div class="checkbox-wrapper">
                                <input type="checkbox" name="ids[]" value="<?php echo $value['id'] ?>" class="row-checkbox">
                            </div>
                        </td>
                        <td><strong><?php echo $value['id'] ?></strong></td>
                        <td><?php echo $value['instance_name'] ?></td>
                        <td><?php echo $value['display_name'] ?></td>
                        <td>
                            <span class="status-badge platform-<?php echo $value['cloud_platform'] ?>">
                                <?php echo $platforms[$value['cloud_platform']] ?>
                            </span>
                        </td>
                        <td>
                            <?php
                            $statusClass = '';
                            switch($value['status']) {
                                case 'RUNNING': $statusClass = 'running'; break;
                                case 'STOPPED':
                                case 'SHUTOFF':
                                case 'STOPPING': $statusClass = 'stopped'; break;
                                case 'TERMINATED': $statusClass = 'terminated'; break;
                                case 'CREATING':
                                case 'STARTING':
                                case 'REBOOTING': $statusClass = 'creating'; break;
                                default: $statusClass = 'stopped';
                            }
                            ?>
                            <span class="status-badge status-<?php echo $statusClass ?>">
                                <span class="dot"></span>
                                <?php echo $instance_status[$value['status']] ?? $value['status'] ?>
                            </span>
                        </td>
                        <td><code style="background: #f1f5f9; padding: 4px 8px; border-radius: 6px; font-size: 13px;"><?php echo $value['private_ip'] ?></code></td>
                        <td><code style="background: #f1f5f9; padding: 4px 8px; border-radius: 6px; font-size: 13px;"><?php echo $value['public_ip'] ?></code></td>
                        <td>
                            <span class="status-badge <?php echo $value['hids_installed'] ? 'hids-installed' : 'hids-not-installed' ?>">
                                <?php echo $value['hids_installed'] ? '已安装' : '未安装' ?>
                            </span>
                        </td>
                        <td style="color: #64748b;"><?php echo $value['create_time'] ?></td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <a href="<?php echo url('asm/hostassets/detail', ['id' => $value['id']]) ?>" class="btn-action btn-view">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    详情
                                </a>
                                <?php if ($value['cloud_platform'] == 'idc') { ?>
                                <a href="<?php echo url('asm/hostassets/edit', ['id' => $value['id']]) ?>" class="btn-action btn-edit">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    编辑
                                </a>
                                <a href="#" class="btn-action btn-delete" onclick="deleteHost(<?php echo $value['id'] ?>)">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    删除
                                </a>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

{include file='public/fenye' /}
<script>
// 全选/取消全选
function toggleSelectAll(checkbox) {
    const checkboxes = document.querySelectorAll('.row-checkbox');
    checkboxes.forEach(cb => cb.checked = checkbox.checked);
}

// 导出选中
function exportSelected() {
    const checkboxes = document.querySelectorAll('.row-checkbox:checked');
    if (checkboxes.length === 0) {
        alert('请先选择要导出的数据');
        return;
    }
    const ids = Array.from(checkboxes).map(cb => cb.value);
    window.location.href = '<?php echo url("asm/hostassets/export") ?>?ids=' + ids.join(',');
}

// 刷新列表
function refreshList() {
    window.location.reload();
}

// 删除主机
function deleteHost(id) {
    if (confirm('确定要删除该主机吗？')) {
        $.ajax({
            url: '<?php echo url('asm/hostassets/delete') ?>',
            type: 'post',
            data: {id: id},
            dataType: 'json',
            success: function(res) {
                if (res.code == 1) {
                    alert(res.msg);
                    window.location.reload();
                } else {
                    alert(res.msg);
                }
            }
        });
    }
}
</script>
{include file='public/footer' /}
