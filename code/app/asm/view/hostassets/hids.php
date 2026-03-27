{include file='public/head' /}
{include file='public/asmLeftMenu' /}

<style>
    /* 页面容器样式 */
    .page-container {
        background: #f8fafc;
        min-height: calc(100vh - 64px);
    }
    /* 表格容器样式 */
    .table-container {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        overflow: hidden;
    }
    /* 表头样式 */
    .table-container thead tr {
        background: #f1f5f9;
    }
    .table-container thead th {
        padding: 16px 20px;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e2e8f0;
    }
    /* 表格内容样式 */
    .table-container tbody td {
        padding: 16px 20px;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    .table-container tbody tr:hover {
        background: #f8fafc;
    }
    .table-container tbody tr:last-child td {
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
    /* 在线状态颜色 */
    .status-online { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .status-online .dot { background: #16a34a; }
    .status-offline { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
    .status-offline .dot { background: #dc2626; }
    /* 按钮样式 */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s;
        text-decoration: none;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #64748b;
    }
    .btn-action:hover {
        background: #f1f5f9;
        border-color: #3b82f6;
        color: #3b82f6;
        text-decoration: none;
    }
</style>

<!-- HIDS列表 -->
<?php
$searchArr = [
    'action' =>  $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'keyword', 'placeholder' => "IP地址/主机名"]
    ]]; ?>
{include file='public/search' /}

<div class="table-container">
    <div class="px-5 py-4 border-b border-slate-200 bg-slate-50">
        <div class="flex items-center gap-3">
            <h2 class="text-lg font-bold text-slate-800">HIDS列表</h2>
        </div>
    </div>

    <!-- 引入子菜单 -->
    {include file='hostassets/sub_menu' /}

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
            <tr>
                <th>ID</th>
                <th>IP地址</th>
                <th>实例名称</th>
                <th>主机名</th>
                <th>操作系统</th>
                <th>内核版本</th>
                <th>在线状态</th>
                <th>最后同步时间</th>
                <th style="width: 200px">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($hids_list as $value) { ?>
                <tr>
                    <td class="font-semibold"><?php echo $value['id'] ?></td>
                    <td class="font-mono"><?php echo $value['ip_address'] ?></td>
                    <td><?php echo $value['instance_name'] ?? '-' ?></td>
                    <td><?php echo $value['hostname'] ?? '-' ?></td>
                    <td><?php echo $value['os_name'] ?? '-' ?></td>
                    <td class="font-mono text-sm"><?php echo $value['kernel_version'] ?? '-' ?></td>
                    <td>
                        <span class="status-badge <?php
                            switch($value['online_status']) {
                                case '在线': echo 'status-online'; break;
                                case '离线': echo 'status-offline'; break;
                                default: echo 'bg-slate-50 text-slate-600 border border-slate-100';
                            }
                        ?>">
                            <span class="dot"></span>
                            <?php echo $value['online_status'] ?? '-' ?>
                        </span>
                    </td>
                    <td class="text-slate-500 text-sm"><?php echo $value['sync_time'] ?? '-' ?></td>
                    <td>
                        <a href="<?php echo url('asm/hostassets/hidsDetail', ['id' => $value['id']]) ?>" class="btn-action">查看详情</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

{include file='public/fenye' /}
{include file='public/footer' /}
