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
    .alert-warning {
        background: #fffbeb;
        border: 1px solid #fcd34d;
        color: #92400e;
        padding: 20px 24px;
        border-radius: 12px;
        margin: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .alert-warning a {
        color: #d97706;
        font-weight: 600;
        text-decoration: none;
    }
    .alert-warning a:hover {
        text-decoration: underline;
    }
</style>
<div class="w-full md:w-[91.67%]" style="padding: 0 24px 24px;">
    <?php
    $searchArr = [
        'action' => $_SERVER['REQUEST_URI'],
        'method' => 'get',
        'inputs' => [
            ['type' => 'text', 'name' => 'keyword', 'placeholder' => "dedecms"],
        ], 'btnArr' => [
            ['text' => '添加', 'ext' => [
                "class" => "btn-outline",
                "onclick" => "openKeywordDrawer()",
            ]]
        ]
    ];
    ?>
    {include file='public/search' /}

    <div class="content-card">
        <?php if (empty($fofa_user) || empty($fofa_token)) { ?>
            <div class="alert-warning">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <a class="btn-outline" href="{:URL('/config/index',['keyword'=>'fofa'])}">未配置FOFA账户，点击配置后方可使用</a>
            </div>
        <?php } else { ?>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>关键词</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $value) { ?>
                            <tr>
                                <td><span class="badge badge-blue">#<?php echo $value['id'] ?></span></td>
                                <td><?php echo $value['keyword'] ?></td>
                                <td style="color: #64748b;"><?php echo $value['create_time'] ?></td>
                                <td>
                                    <a href="{:URL('_del_keyword',['id'=>$value['id']])}" class="btn-danger">删除</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
        {include file='public/fenye' /}
    </div>
    {include file='/discover/add_modal_keyword' /}
</div>
<script>
    $("#keyword_conf").addClass("active");
</script>
{include file='public/footer' /}
