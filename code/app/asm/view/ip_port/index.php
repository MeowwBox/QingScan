{include file='public/head' /}
{include file='public/asmLeftMenu' /}
<style>
    .content-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        overflow: hidden;
    }
    .table-container {
        overflow-x: auto;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table thead {
        background: #f8fafc;
    }
    .table th {
        padding: 16px 20px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e2e8f0;
    }
    .table td {
        padding: 16px 20px;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
        font-size: 14px;
    }
    .table tbody tr:hover {
        background: #f8fafc;
    }
    .table tbody tr:last-child td {
        border-bottom: none;
    }
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-blue {
        background: #eff6ff;
        color: #3b82f6;
        border: 1px solid #bfdbfe;
    }
    .btn-danger {
        background: transparent;
        color: #ef4444;
        border: 1px solid #fecaca;
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 500;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }
    .btn-danger:hover {
        background: #fef2f2;
        border-color: #ef4444;
    }
</style>
    <?php
    $searchArr = [
        'action' => $_SERVER['REQUEST_URI'],
        'method' => 'get',
        'inputs' => [
            ['type' => 'text', 'name' => 'domain', 'placeholder' => "baidu.com"],
        ]
    ];
    ?>
    {include file='public/search' /}

    <div class="content-card">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>IP</th>
                        <th>端口</th>
                        <th>位置</th>
                        <th>ISP</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $value) { ?>
                        <tr>
                            <td><span class="badge badge-blue">#<?php echo $value['id'] ?></span></td>
                            <td><?php echo $value['ip'] ?></td>
                            <td><?php echo $value['port'] ?></td>
                            <td><?php echo $value['location'] ?></td>
                            <td><?php echo $value['isp'] ?></td>
                            <td style="color: #64748b;"><?php echo $value['create_time'] ?></td>
                            <td>
                                <a href="#" class="btn-danger">删除</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        {include file='public/fenye' /}
    </div>
{include file='public/footer' /}
