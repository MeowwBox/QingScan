{include file='public/head' /}
{include file='public/asmLeftMenu' /}
<style>
    .page-header {
        margin-bottom: 24px;
    }
    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }
    .breadcrumb-nav {
        display: flex;
        gap: 8px;
        font-size: 14px;
        color: #64748b;
    }
    .breadcrumb-nav a {
        color: #64748b;
        text-decoration: none;
        transition: color 0.2s;
    }
    .breadcrumb-nav a:hover {
        color: #3b82f6;
    }
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
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-primary:hover {
        box-shadow: 0 4px 12px -2px rgb(0 0 0 / 0.1);
        transform: translateY(-1px);
    }
    .btn-outline {
        background: transparent;
        color: #64748b;
        border: 1px solid #cbd5e1;
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 500;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-outline:hover {
        background: #f8fafc;
        border-color: #3b82f6;
        color: #3b82f6;
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
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    .empty-state-icon {
        width: 64px;
        height: 64px;
        background: #f1f5f9;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }
    .sub-menu {
        display: flex;
        gap: 8px;
        margin-bottom: 20px;
        padding: 4px;
        background: #f1f5f9;
        border-radius: 12px;
        width: fit-content;
    }
    .sub-menu a {
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        color: #64748b;
        text-decoration: none;
        transition: all 0.2s;
    }
    .sub-menu a:hover {
        color: #1e293b;
    }
    .sub-menu a.active {
        background: #ffffff;
        color: #3b82f6;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.05);
    }
</style>
    <?php
    $searchArr = [
        'action' => $_SERVER['REQUEST_URI'],
        'method' => 'get',
        'inputs' => [
            ['type' => 'text', 'name' => 'keyword', 'value' => $keyword, 'placeholder' => "dedecms"],
        ], 'btnArr' => [

        ]
    ];
    ?>
    {include file='public/search' /}

    <div class="content-card">
        {include file='discover/sub_menu' /}

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>标题</th>
                        <th>IP</th>
                        <th>Host</th>
                        <th>端口</th>
                        <th>产品类型</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $value) { ?>
                        <tr>
                            <td><span class="badge badge-blue">#<?php echo $value['id'] ?></span></td>
                            <td><?php echo substr($value['title'], 0, 27) ?></td>
                            <td><?php echo $value['ip'] ?></td>
                            <td><?php echo $value['host'] ?></td>
                            <td><?php echo $value['port'] ?></td>
                            <td><?php echo $value['product_category'] ?></td>
                            <td style="color: #64748b;"><?php echo $value['create_time'] ?></td>
                            <td>
                                <a href="{:URL('_del',['id'=>$value['id']])}" class="btn-danger">删除</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        {include file='public/fenye' /}
    </div>
<script>
    $("#scan_result").addClass("active");
</script>
{include file='public/footer' /}
