{include file='public/head' /}
{include file='public/whiteLeftMenu' /}

<style>
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
    .level-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }
    .level-critical .level-dot { background: #dc2626; }
    .level-high .level-dot { background: #ea580c; }
    .level-medium .level-dot { background: #d97706; }
    .level-low .level-dot { background: #2563eb; }
    /* 按钮样式 */
    .btn-view {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #f8fafc;
        color: #3b82f6;
        border: none;
        transition: all 0.2s;
        text-decoration: none;
    }
    .btn-view:hover {
        background: #eff6ff;
        color: #2563eb;
    }
    .btn-edit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #f8fafc;
        color: #f59e0b;
        border: none;
        transition: all 0.2s;
        text-decoration: none;
    }
    .btn-edit:hover {
        background: #fffbeb;
        color: #d97706;
    }
    .btn-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #f8fafc;
        color: #ef4444;
        border: none;
        transition: all 0.2s;
        text-decoration: none;
    }
    .btn-delete:hover {
        background: #fef2f2;
        color: #dc2626;
    }
    /* 统计卡片 */
    .stat-card {
        position: relative;
        height: 155px;
        margin-bottom: 20px;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        transition: all 0.3s;
        overflow: hidden;
    }
    .stat-card:hover {
        box-shadow: 0 4px 12px -2px rgb(0 0 0 / 0.1);
        border-color: #3b82f6;
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
    .stat-card .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }
    .stat-card .stat-title {
        color: #94a3b8;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 4px;
    }
    .stat-card .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
    }
    .stat-card .stat-detail {
        color: #94a3b8;
        font-size: 13px;
        margin-top: 8px;
    }
    .stat-card .stat-detail span {
        color: #64748b;
    }
    /* 筛选按钮组 */
    .filter-group {
        display: flex;
        gap: 8px;
    }
    .filter-btn {
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #64748b;
        text-decoration: none;
        transition: all 0.2s;
    }
    .filter-btn:hover {
        background: #f8fafc;
        border-color: #3b82f6;
        color: #3b82f6;
    }
    .filter-btn.active {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: #3b82f6;
        border-color: #3b82f6;
        font-weight: 600;
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
        color: #64748b;
        text-decoration: none;
        transition: color 0.2s;
    }
    .breadcrumb a:hover {
        color: #3b82f6;
    }
    /* 表格标题栏 */
    .table-title-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 20px;
        background: #f8fafc;
        border-bottom: 1px solid #f1f5f9;
    }
    .table-title-bar h3 {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .table-title-bar .count-badge {
        background: #3b82f6;
        color: white;
        font-size: 12px;
        padding: 2px 10px;
        border-radius: 20px;
        font-weight: 500;
    }
    /* 文件路径标签 */
    .file-path {
        display: inline-block;
        font-size: 12px;
        color: #94a3b8;
        background: #f1f5f9;
        padding: 2px 8px;
        border-radius: 4px;
        margin-top: 4px;
        font-family: monospace;
    }
</style>

<?php
// 漏洞等级映射
$levelMap = [
    'HIGHT' => 'high',
    'MEDIUM' => 'medium',
    'LOW' => 'low'
];
$levelLabels = [
    'high' => '高危',
    'medium' => '中危',
    'low' => '低危'
];
$levelColors = [
    'high' => ['bg' => '#fff7ed', 'text' => '#ea580c', 'border' => '#fed7aa'],
    'medium' => ['bg' => '#fffbeb', 'text' => '#d97706', 'border' => '#fde68a'],
    'low' => ['bg' => '#eff6ff', 'text' => '#2563eb', 'border' => '#bfdbfe']
];
?>

<div class="page-card" style="margin: 20px;">
    <!-- 页面标题 -->
    <div class="page-header" style="padding: 20px 20px 0;">
        <div>
            <h1 class="page-title">CodeQL 漏洞列表</h1>
            <nav class="breadcrumb">
                <a href="#">首页</a>
                <span>/</span>
                <a href="#">代码审计</a>
                <span>/</span>
                <span style="color: #1e293b; font-weight: 500;">CodeQL</span>
            </nav>
        </div>
    </div>

    <!-- 统计卡片 -->
    <div class="flex flex-wrap -mx-4" style="padding: 20px 20px 0;">
        <?php
        $cardColors = ['blue', 'red', 'amber', 'green'];
        $iconColors = ['#eff6ff', '#fef2f2', '#fffbeb', '#f0fdf4'];
        $iconTextColors = ['#3b82f6', '#ef4444', '#f59e0b', '#22c55e'];
        $cardIndex = 0;
        ?>
        <?php foreach ($countList as $item) { ?>
            <div class="w-full md:w-1/4 px-4">
                <div class="stat-card <?php echo $cardColors[$cardIndex % 4]; ?>">
                    <div class="stat-icon" style="background: <?php echo $iconColors[$cardIndex % 4]; ?>;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="<?php echo $iconTextColors[$cardIndex % 4]; ?>" stroke-width="1.5">
                            <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <p class="stat-title">{$item['name']}</p>
                    <h4 class="stat-value">{$item['num']}</h4>
                    <div class="stat-detail">
                        <?php foreach ($item['lists'] as $tag => $num) { ?>
                            <span>{$tag}</span> <span>{$num}</span>&nbsp;
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php $cardIndex++; ?>
        <?php } ?>
    </div>

    <!-- 筛选按钮 -->
    <div class="flex flex-wrap" style="padding: 0 20px 20px;">
        <div class="w-full px-4">
            <div class="filter-group">
                <a class="filter-btn <?php echo isset($param['extra']) ? '' : 'active' ?>"
                   href="{:URL('index')}">全部</a>
                <a class="filter-btn <?php echo isset($param['extra']) && $param['extra'] == 'HIGHT' ? 'active' : '' ?>"
                   href="{:URL('index',['extra'=>'HIGHT'])}">高危</a>
                <a class="filter-btn <?php echo isset($param['extra']) && $param['extra'] == 'MEDIUM' ? 'active' : '' ?>"
                   href="{:URL('index',['extra'=>'MEDIUM'])}">中危</a>
                <a class="filter-btn <?php echo isset($param['extra']) && $param['extra'] == 'LOW' ? 'active' : '' ?>"
                   href="{:URL('index',['extra'=>'LOW'])}">低危</a>
            </div>
        </div>
    </div>

    <!-- 数据表格 -->
    <div class="flex flex-wrap">
        <div class="w-full p-0">
            <!-- 表格标题栏 -->
            <div class="table-title-bar">
                <h3>
                    漏洞列表
                    <span class="count-badge">{$bugList['count']|default=0}</span>
                </h3>
            </div>

            <table style="width: 100%;">
                <thead class="table-header">
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>漏洞信息</th>
                    <th style="width: 100px;">等级</th>
                    <th style="width: 160px;">发现时间</th>
                    <th style="width: 140px;">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($bugList['list'] as $item) {
                    $level = isset($item['extra']) && isset($levelMap[$item['extra']]) ? $levelMap[$item['extra']] : 'low';
                    $levelLabel = isset($levelLabels[$level]) ? $levelLabels[$level] : '低危';
                ?>
                    <tr class="table-row">
                        <td style="font-weight: 600;">{$item['id']}</td>
                        <td>
                            <div style="font-weight: 500; color: #1e293b;">{$item['ruleId']}</div>
                            <?php if(isset($item['file_path']) && $item['file_path']) { ?>
                                <div class="file-path">{$item['file_path']}</div>
                            <?php } ?>
                        </td>
                        <td>
                            <span class="level-badge level-<?php echo $level; ?>">
                                <span class="level-dot"></span>
                                <?php echo $levelLabel; ?>
                            </span>
                        </td>
                        <td>{$item['create_time']}</td>
                        <td>
                            <div style="display: flex; gap: 4px;">
                                <a class="btn-view" href="{:URL('detail',['id'=>$item['id']])}" title="查看详情">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a class="btn-edit" href="{:URL('edit',['id'=>$item['id']])}" title="编辑">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <a class="btn-delete" href="{:URL('delete',['id'=>$item['id']])}" title="删除" onclick="return confirm('确定要删除这条记录吗？');">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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

    <!-- 分页 -->
    <div class="flex flex-wrap" style="padding: 16px 20px; border-top: 1px solid #f1f5f9; background: #f8fafc;">
        <div class="w-full px-4">
            {include file='public/fenye' /}
        </div>
    </div>
</div>
{include file='public/footer' /}
