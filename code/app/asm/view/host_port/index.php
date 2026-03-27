{include file='public/head' /}
{include file='public/asmLeftMenu' /}
<?php
$searchArr = [
    'action' => $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'placeholder' =>'输入搜索的内容'],
        ['type' => 'select', 'name' => 'host', 'options' => $host, 'frist_option' => '主机名称'],
        ['type' => 'select', 'name' => 'port', 'options' => $port, 'frist_option' => '端口号'],
        ['type' => 'select', 'name' => 'service', 'options' => $service, 'frist_option' => '组件名称'],
        ['type' => 'select', 'name' => 'check_status', 'options' => $check_status_list, 'frist_option' => '审计状态','frist_option_value'=>-1],
    ]]; ?>
{include file='public/search' /}

<style>
    /* 分类卡片样式 */
    .classify-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        overflow: hidden;
    }
    .classify-card table {
        margin-bottom: 0;
    }
    .classify-card table th {
        padding: 14px 16px;
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }
    .classify-card table td {
        padding: 12px 16px;
        font-size: 14px;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
    }
    .classify-card table tr:last-child td {
        border-bottom: none;
    }
    .classify-card table td a {
        color: #3b82f6;
        text-decoration: none;
        transition: color 0.15s ease;
    }
    .classify-card table td a:hover {
        color: #2563eb;
        text-decoration: underline;
    }
    .classify-card table td:last-child {
        text-align: right;
        font-weight: 600;
        color: #1e293b;
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
    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fecaca;
    }
    .btn-delete:hover {
        background: #dc2626;
        color: #ffffff;
    }
    /* 主机链接样式 */
    .host-link {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.15s ease;
    }
    .host-link:hover {
        color: #2563eb;
        text-decoration: underline;
    }
    /* 端口标签 */
    .port-tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }
    /* 服务标签 */
    .service-tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        background: #f1f5f9;
        color: #475569;
    }
</style>

<div class="flex flex-wrap -mx-4" style="margin: 0;">
    <div class="w-full md:w-2/12 px-4">
        <div class="classify-card">
            <?php foreach ($classify as $value) { ?>
                <table class="w-full">
                    <tr>
                        <th colspan="2"><?php echo $value[0] ?></th>
                    </tr>
                    <?php foreach ($value[1] as $val) { ?>
                        <tr>
                            <td>
                                <a href=" {$_SERVER['REQUEST_URI']}&{$value[2]}={$val['name']} "><?php echo $val['name'] ?></a>
                            </td>
                            <td><?php echo $val['num'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        </div>
    </div>
    <div class="w-full md:w-10/12 px-4">
        <div class="table-card">
            <table class="w-full" style="margin-bottom: 0;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>HostName</th>
                    <th>Port</th>
                    <th>端口类型</th>
                    <th>服务名称</th>
                    <th>创建时间</th>
                    <th style="width: 160px">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $value) { ?>
                    <tr>
                        <td><strong><?php echo $value['id'] ?></strong></td>
                        <td><a href="" class="host-link"><?php echo $value['host'] ?></a></td>
                        <td><span class="port-tag"><?php echo $value['port'] ?></span></td>
                        <td><?php echo $value['type'] ?></td>
                        <td><span class="service-tag"><?php echo $value['service'] ?></span></td>
                        <td style="color: #64748b;"><?php echo $value['create_time'] ?></td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <a href="<?php echo url('host_port/details',['id'=>$value['id']])?>" class="btn-action btn-view">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    详情
                                </a>
                                <a href="<?php echo url('host_port/del',['id'=>$value['id']])?>" class="btn-action btn-delete">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    删除
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        {include file='public/fenye' /}
    </div>
</div>
<script>
    /*$("#starScan").click(function () {
        id = 100;
        $.get("/index.php?s=host/_start_scan&url_id=" + id, function (result) {
            alert("操作成功")
            location.reload();
        });
    });*/
</script>
{include file='public/footer' /}
