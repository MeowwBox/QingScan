{include file='public/head' /}
{include file='public/asmLeftMenu' /}
<?php
$searchArr = [
    'action' => $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'name', 'placeholder' => "HostName"],
        ['type' => 'text', 'name' => 'url', 'placeholder' => "URL"],
        ['type' => 'select', 'name' => 'app_id', 'options' => $projectList, 'frist_option' => '项目列表']
    ]]; ?>
{include file='public/search' /}

<style>
    /* 表格容器样式 */
    .table-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        overflow: hidden;
        margin: 24px 0;
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
    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fecaca;
    }
    .btn-delete:hover {
        background: #dc2626;
        color: #ffffff;
    }
    /* 项目名称标签 */
    .project-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }
    /* 代码样式 */
    code.host-info {
        background: #f1f5f9;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 13px;
        color: #475569;
    }
</style>

<div class="table-card">
    <table class="w-full" style="margin-bottom: 0;">
        <thead>
        <tr>
            <th>ID</th>
            <th>所属项目</th>
            <th>域名</th>
            <th>HostName</th>
            <th>国家</th>
            <th>省份</th>
            <th>城市</th>
            <th>ISP</th>
            <th>创建时间</th>
            <th style="width: 120px">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $value) { ?>
            <tr>
                <td><strong><?php echo $value['id'] ?></strong></td>
                <td>
                    <span class="project-tag">
                        <?php echo $projectList[$value['app_id']] ?>
                    </span>
                </td>
                <td><code class="host-info"><?php echo $value['domain'] ?></code></td>
                <td><code class="host-info"><?php echo $value['host'] ?></code></td>
                <td><?php echo $value['country'] ?></td>
                <td><?php echo $value['region'] ?></td>
                <td><?php echo $value['city'] ?></td>
                <td><?php echo $value['isp'] ?></td>
                <td style="color: #64748b;"><?php echo $value['create_time'] ?></td>
                <td>
                    <a href="#" class="btn-action btn-delete">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        删除
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

{include file='public/fenye' /}
{include file='public/footer' /}
