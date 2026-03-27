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

    .table-modern {
        width: 100%;
        border-collapse: collapse;
    }

    .table-modern thead tr {
        background: #f8fafc;
    }

    .table-modern th {
        padding: 14px 16px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-modern td {
        padding: 14px 16px;
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
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
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

    /* 搜索栏样式 */
    .search-bar {
        background: white;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04);
        border: 1px solid #e2e8f0;
    }

    .search-bar input {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 16px;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .search-bar input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* 文本截断 */
    .line-limit-length {
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* 页面标题 */
    .page-title {
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 20px;
    }

    /* 状态标签 */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-active {
        background: #dcfce7;
        color: #16a34a;
    }

    .status-inactive {
        background: #fee2e2;
        color: #dc2626;
    }

    /* 扫描数量徽章 */
    .scan-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 24px;
        height: 24px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        padding: 0 8px;
        margin: 2px;
    }

    .scan-badge.fortify { background: #dbeafe; color: #2563eb; }
    .scan-badge.semgrep { background: #fef3c7; color: #d97706; }
    .scan-badge.mobsfscan { background: #e0e7ff; color: #4f46e5; }
    .scan-badge.murphysec { background: #d1fae5; color: #059669; }
    .scan-badge.hema { background: #fee2e2; color: #dc2626; }
    .scan-badge.php { background: #f3e8ff; color: #7c3aed; }
    .scan-badge.python { background: #cffafe; color: #0891b2; }
    .scan-badge.java { background: #fed7aa; color: #ea580c; }
</style>

<div class="search-bar">
    <form class="form-inline" method="get" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
        <input type="text" name="search" class="form-control" placeholder="搜索项目名称" value="<?php echo htmlentities($_GET['search'] ?? '') ?>">
        <button type="submit" class="btn-modern btn-secondary" style="margin-left: 10px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
            搜索
        </button>
    </form>
</div>

<div class="tuchu-card">
    <table class="table-modern">
        <thead>
            <tr>
                <th>ID</th>
                <th>项目名称</th>
                <th>SSH URL</th>
                <th>扫描结果统计</th>
                <th>状态</th>
                <th>创建时间</th>
                <th style="width: 180px;">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $value) { ?>
                <tr>
                    <td style="font-weight: 600;"><?php echo $value['id'] ?></td>
                    <td>
                        <a href="<?php echo url('code/details', ['id' => $value['id']]) ?>" class="text-primary hover:underline font-medium">
                            <?php echo htmlentities($value['name']) ?>
                        </a>
                    </td>
                    <td style="font-family: monospace; color: #64748b; font-size: 13px;" class="line-limit-length">
                        <?php echo htmlentities($value['ssh_url']) ?>
                    </td>
                    <td>
                        <?php
                        $id = $value['id'];
                        if (!empty($fortifyNum[$id])) { ?>
                            <span class="scan-badge fortify" title="Fortify">F: <?php echo $fortifyNum[$id] ?></span>
                        <?php } ?>
                        <?php if (!empty($semgrepNum[$id])) { ?>
                            <span class="scan-badge semgrep" title="Semgrep">S: <?php echo $semgrepNum[$id] ?></span>
                        <?php } ?>
                        <?php if (!empty($mobsfscanNum[$id])) { ?>
                            <span class="scan-badge mobsfscan" title="Mobsfscan">M: <?php echo $mobsfscanNum[$id] ?></span>
                        <?php } ?>
                        <?php if (!empty($murphysecNum[$id])) { ?>
                            <span class="scan-badge murphysec" title="Murphysec">Mu: <?php echo $murphysecNum[$id] ?></span>
                        <?php } ?>
                        <?php if (!empty($hemaNum[$id])) { ?>
                            <span class="scan-badge hema" title="WebShell">W: <?php echo $hemaNum[$id] ?></span>
                        <?php } ?>
                        <?php if (!empty($phpNum[$id])) { ?>
                            <span class="scan-badge php" title="PHP">P: <?php echo $phpNum[$id] ?></span>
                        <?php } ?>
                        <?php if (!empty($pythonNum[$id])) { ?>
                            <span class="scan-badge python" title="Python">Py: <?php echo $pythonNum[$id] ?></span>
                        <?php } ?>
                        <?php if (!empty($javaNum[$id])) { ?>
                            <span class="scan-badge java" title="Java">J: <?php echo $javaNum[$id] ?></span>
                        <?php } ?>
                        <?php if (empty($fortifyNum[$id]) && empty($semgrepNum[$id]) && empty($mobsfscanNum[$id]) && empty($murphysecNum[$id]) && empty($hemaNum[$id]) && empty($phpNum[$id]) && empty($pythonNum[$id]) && empty($javaNum[$id])) { ?>
                            <span class="text-text-muted text-sm">暂无扫描结果</span>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if ($value['status'] == '启用') { ?>
                            <span class="status-badge status-active"><?php echo $value['status'] ?></span>
                        <?php } else { ?>
                            <span class="status-badge status-inactive"><?php echo $value['status'] ?></span>
                        <?php } ?>
                    </td>
                    <td style="color: #64748b;"><?php echo $value['create_time'] ?></td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="<?php echo url('code/details', ['id' => $value['id']]) ?>" class="btn-modern btn-secondary">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                详情
                            </a>
                            <a href="<?php echo url('code/code_del', ['id' => $value['id']]) ?>" class="btn-modern btn-danger" onclick="return confirm('确定要删除吗？')">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                                删除
                            </a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            <?php if (empty($list)) { ?>
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: #94a3b8;">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin: 0 auto 16px;">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <div>暂无数据</div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

{include file='public/fenye' /}
{include file='public/footer' /}
