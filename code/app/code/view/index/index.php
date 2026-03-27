{include file='public/head' /}
{include file='public/whiteLeftMenu' /}

<style>
    /* 浅色主题样式 */
    .tuchu-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        border: 1px solid #e2e8f0;
    }

    /* 页面标题区域 */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
    }

    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .breadcrumb {
        display: flex;
        gap: 8px;
        font-size: 14px;
        color: #64748b;
    }

    .breadcrumb a {
        color: #3b82f6;
        text-decoration: none;
        transition: color 0.2s;
    }

    .breadcrumb a:hover {
        color: #2563eb;
    }

    .breadcrumb span {
        color: #94a3b8;
    }

    /* 统计卡片 */
    .stat-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .stat-card .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .stat-card.blue .stat-icon { background: #eff6ff; }
    .stat-card.blue .stat-icon svg { color: #3b82f6; }
    .stat-card.green .stat-icon { background: #f0fdf4; }
    .stat-card.green .stat-icon svg { color: #22c55e; }
    .stat-card.amber .stat-icon { background: #fffbeb; }
    .stat-card.amber .stat-icon svg { color: #f59e0b; }
    .stat-card.red .stat-icon { background: #fef2f2; }
    .stat-card.red .stat-icon svg { color: #ef4444; }

    .stat-card .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
    }

    .stat-card .stat-label {
        font-size: 14px;
        color: #64748b;
    }

    .table-modern {
        width: 100%;
        border-collapse: collapse;
    }

    .table-modern thead tr {
        background: #f8fafc;
    }

    .table-modern th {
        padding: 16px 20px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-modern td {
        padding: 16px 20px;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
    }

    .table-modern tbody tr:hover {
        background: #f8fafc;
    }

    .table-modern tbody tr:last-child td {
        border-bottom: none;
    }

    .btn-modern {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border: none;
    }

    .btn-primary:hover {
        box-shadow: 0 4px 12px -2px rgb(59 130 246 / 0.4);
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #f8fafc;
        color: #475569;
        border: 1px solid #e2e8f0;
    }

    .btn-secondary:hover {
        background: #f1f5f9;
        border-color: #3b82f6;
        color: #3b82f6;
    }

    .btn-danger {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .btn-danger:hover {
        background: #fee2e2;
        border-color: #dc2626;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 500;
    }

    .badge-blue {
        background: #eff6ff;
        color: #3b82f6;
        border: 1px solid #bfdbfe;
    }

    .badge-green {
        background: #f0fdf4;
        color: #22c55e;
        border: 1px solid #bbf7d0;
    }

    .badge-amber {
        background: #fffbeb;
        color: #d97706;
        border: 1px solid #fde68a;
    }

    .badge-red {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    /* 抽屉样式 */
    .drawer-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.3);
        z-index: 50;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease;
    }

    .drawer-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .drawer-panel {
        position: fixed;
        top: 0;
        right: 0;
        height: 100%;
        width: 520px;
        background: white;
        box-shadow: -8px 0 30px rgba(0, 0, 0, 0.1);
        z-index: 50;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .drawer-panel.active {
        transform: translateX(0);
    }

    .drawer-header {
        padding: 20px 24px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .drawer-content {
        flex: 1;
        overflow-y: auto;
        padding: 24px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .info-item {
        background: #f8fafc;
        border-radius: 12px;
        padding: 16px;
    }

    .info-item label {
        font-size: 11px;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .info-item .value {
        margin-top: 4px;
        font-weight: 600;
        color: #1e293b;
    }

    .code-block {
        background: #1e293b;
        border-radius: 12px;
        padding: 16px;
        overflow-x: auto;
    }

    .code-block pre {
        margin: 0;
        color: #e2e8f0;
        font-family: 'Monaco', 'Consolas', monospace;
        font-size: 13px;
        line-height: 1.6;
    }

    /* 工具栏样式 */
    .toolbar {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    /* 状态标签 */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-scanning {
        background: #eff6ff;
        color: #3b82f6;
    }

    .status-completed {
        background: #f0fdf4;
        color: #22c55e;
    }

    .status-paused {
        background: #fffbeb;
        color: #d97706;
    }
</style>

<?php
$dengjiArr = ['Low', 'Medium', 'High', 'Critical'];
$searchArr = [
    'action' => $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'select', 'name' => 'Folder', 'label' => '危险等级', 'options' => $dengjiArr, 'frist_option' => '全部等级'],
        ['type' => 'text', 'name' => 'search', 'label' => '关键词', 'placeholder' => "搜索项目名称"],
    ],
    'btnArr' => [
        ['text' => '添加项目', 'ext' => [
            "class" => "btn-modern btn-secondary",
            "onclick" => "openDrawer('" . url('code/index/add_modal') . "')",
        ]]
    ]]; ?>
{include file='public/search' /}

<!-- 页面标题区域 -->
<div class="page-header">
    <div>
        <h1 class="page-title">代码仓库</h1>
        <nav class="breadcrumb">
            <a href="<?php echo url('index/index') ?>">首页</a>
            <span>/</span>
            <a href="#">代码审计</a>
            <span>/</span>
            <span style="color: #1e293b; font-weight: 500;">代码仓库</span>
        </nav>
    </div>
</div>

<!-- 统计卡片 -->
<div class="stat-cards">
    <div class="stat-card blue">
        <div class="stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
            </svg>
        </div>
        <div class="stat-value"><?php echo count($list ?? []) ?></div>
        <div class="stat-label">项目总数</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="stat-value"><?php echo array_sum($fortifyNum ?? []) + array_sum($semgrepNum ?? []) + array_sum($mobsfscanNum ?? []) ?></div>
        <div class="stat-label">已发现漏洞</div>
    </div>
    <div class="stat-card amber">
        <div class="stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="stat-value"><?php echo count(array_filter($list ?? [], function($v) { return strpos($v['status'] ?? '', '完成') !== false; })) ?></div>
        <div class="stat-label">已完成扫描</div>
    </div>
    <div class="stat-card red">
        <div class="stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        <div class="stat-value"><?php echo count(array_filter($list ?? [], function($v) { return strpos($v['status'] ?? '', '扫描') !== false; })) ?></div>
        <div class="stat-label">扫描中</div>
    </div>
</div>

<!-- 工具栏 -->
<div class="toolbar">
    <form class="flex flex-wrap gap-3" id="frmUpload" action="<?php echo url('app/batch_import') ?>" method="post"
          enctype="multipart/form-data">
        <button type="button" onclick="suspend_scan(1)" class="btn-modern btn-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polygon points="5 3 19 12 5 21 5 3"></polygon>
            </svg>
            启用扫描
        </button>
        <button type="button" onclick="suspend_scan(2)" class="btn-modern btn-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="6" y="4" width="4" height="16"></rect>
                <rect x="14" y="4" width="4" height="16"></rect>
            </svg>
            暂停扫描
        </button>
        <button type="button" onclick="again_scan()" class="btn-modern btn-secondary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="23 4 23 10 17 10"></polyline>
                <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
            </svg>
            重新扫描
        </button>
        <button type="button" onclick="batch_del()" class="btn-modern btn-danger">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
            </svg>
            批量删除
        </button>
    </form>
</div>

<!-- 表格卡片 -->
<div class="tuchu-card">
    <!-- 表格标题区域 -->
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid #f1f5f9; background: #f8fafc; border-radius: 16px 16px 0 0;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <h2 style="font-size: 16px; font-weight: 700; color: #1e293b;">代码仓库列表</h2>
            <span style="background: #3b82f6; color: white; font-size: 12px; padding: 2px 10px; border-radius: 20px; font-weight: 500;"><?php echo count($list ?? []) ?></span>
        </div>
    </div>
    <table class="table-modern">
        <thead>
            <tr>
                <th style="width: 60px;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox" value="-1" onclick="quanxuan(this)" style="width: 16px; height: 16px; cursor: pointer;">
                        ID
                    </label>
                </th>
                <th>名称</th>
                <th>Fortify</th>
                <th>Semgrep</th>
                <th>mobsfscan</th>
                <th>murphysec</th>
                <th>webshell</th>
                <th>扫描状态</th>
                <th style="width: 180px;">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $value) { ?>
                <tr>
                    <td>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" class="ids" name="ids[]" value="<?php echo $value['id'] ?>" style="width: 16px; height: 16px; cursor: pointer;">
                            <span style="font-weight: 600;"><?php echo $value['id'] ?></span>
                        </label>
                    </td>
                    <td>
                        <a href="<?php echo $value['ssh_url'] ?>" style="color: #3b82f6; font-weight: 500; text-decoration: none;">
                            <?php echo $value['name'] ?>
                        </a>
                    </td>
                    <td>
                        <a title="扫描时间:<?php echo $value['scan_time'] ?>"
                           href="<?php echo url('code/bug_list', ['code_id' => $value['id']]); ?>"
                           class="badge badge-blue">
                            <?php echo $fortifyNum[$value['id']] ?? 0 ?>
                        </a>
                    </td>
                    <td>
                        <a title="扫描时间:<?php echo $value['semgrep_scan_time'] ?>"
                           href="<?php echo url('code/semgrep_list', ['code_id' => $value['id']]); ?>"
                           class="badge badge-blue">
                            <?php echo $semgrepNum[$value['id']] ?? 0 ?>
                        </a>
                    </td>
                    <td>
                        <a title="扫描时间:<?php echo $value['mobsfscan_scan_time'] ?>"
                           href="<?php echo url('mobsfscan/index', ['code_id' => $value['id']]); ?>"
                           class="badge badge-blue">
                            <?php echo $mobsfscanNum[$value['id']] ?? 0; ?>
                        </a>
                    </td>
                    <td>
                        <a title="扫描时间:<?php echo $value['murphysec_scan_time'] ?>"
                           href="<?php echo url('murphysec/index', ['code_id' => $value['id']]); ?>"
                           class="badge badge-blue">
                            <?php echo $murphysecNum[$value['id']] ?? 0; ?>
                        </a>
                    </td>
                    <td>
                        <a title="扫描时间:<?php echo $value['webshell_scan_time'] ?>"
                           href="<?php echo url('code_webshell/index', ['code_id' => $value['id']]); ?>"
                           class="badge badge-blue">
                            <?php echo $hemaNum[$value['id']] ?? 0 ?>
                        </a>
                    </td>
                    <td>
                        <?php
                        $statusClass = 'status-scanning';
                        if (strpos($value['status'], '完成') !== false) {
                            $statusClass = 'status-completed';
                        } elseif (strpos($value['status'], '暂停') !== false) {
                            $statusClass = 'status-paused';
                        }
                        ?>
                        <span class="status-badge <?php echo $statusClass ?>">
                            <span style="width: 6px; height: 6px; border-radius: 50%; background: currentColor;"></span>
                            <?php echo $value['status']; ?>
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <button onclick="openDrawer('<?php echo url('code/index/details', ['id' => $value['id']]) ?>')"
                                    class="btn-modern btn-secondary" title="查看详情">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                详情
                            </button>
                            <?php if ($value['is_online'] == 1) { ?>
                                <a href="<?php echo url('code/index/edit_modal', ['id' => $value['id']]) ?>"
                                   class="btn-modern btn-secondary" title="编辑">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    编辑
                                </a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            <?php if (empty($list)) { ?>
                <tr>
                    <td colspan="9" style="text-align: center; padding: 40px; color: #94a3b8;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin: 0 auto 16px;">
                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                            <polyline points="13 2 13 9 20 9"></polyline>
                        </svg>
                        <div>暂无代码仓库</div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    {include file='public/fenye' /}
</div>

<!-- 右侧抽屉 -->
<div id="drawerOverlay" class="drawer-overlay" onclick="closeDrawer()"></div>
<div id="drawerPanel" class="drawer-panel">
    <div class="drawer-header">
        <h3 style="font-size: 18px; font-weight: 700; color: #1e293b;">项目详情</h3>
        <button onclick="closeDrawer()" style="width: 36px; height: 36px; border-radius: 10px; border: none; background: #f8fafc; cursor: pointer; display: flex; align-items: center; justify-content: center;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>
    <div id="drawerContent" class="drawer-content">
        <!-- 内容将通过 AJAX 加载 -->
        <div style="text-align: center; padding: 40px; color: #94a3b8;">
            加载中...
        </div>
    </div>
</div>

{include file='index/tools' /}
{include file='index/add_modal' /}
{include file='public/footer' /}

<script>
    function quanxuan(obj) {
        var child = $('.table-modern').find('input[type="checkbox"]');
        child.each(function (index, item) {
            if (obj.checked) {
                item.checked = true
            } else {
                item.checked = false
            }
        })
    }

    function suspend_scan(status) {
        var child = $('.table-modern').find('input[type="checkbox"]');
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
            url: "<?php echo url('code/suspend_scan')?>",
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

    function batch_del() {
        var child = $('.table-modern').find('input[type="checkbox"]');
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
            url: "<?php echo url('code/batch_del')?>",
            data: {ids: ids},
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
        var child = $('.table-modern').find('input[type="checkbox"]');
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
            url: "<?php echo url('again_scan')?>",
            data: {ids: ids},
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

    // 抽屉功能
    function openDrawer(url) {
        var overlay = document.getElementById('drawerOverlay');
        var panel = document.getElementById('drawerPanel');
        var content = document.getElementById('drawerContent');

        overlay.classList.add('active');
        panel.classList.add('active');
        document.body.style.overflow = 'hidden';

        // 加载内容
        content.innerHTML = '<div style="text-align: center; padding: 40px; color: #94a3b8;">加载中...</div>';
        fetch(url)
            .then(response => response.text())
            .then(html => {
                content.innerHTML = html;
            })
            .catch(err => {
                content.innerHTML = '<div style="text-align: center; padding: 40px; color: #dc2626;">加载失败</div>';
            });
    }

    function closeDrawer() {
        var overlay = document.getElementById('drawerOverlay');
        var panel = document.getElementById('drawerPanel');

        overlay.classList.remove('active');
        panel.classList.remove('active');
        document.body.style.overflow = '';
    }

    // ESC 键关闭抽屉
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDrawer();
        }
    });
</script>
