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
    /* 工单状态颜色 */
    .status-pending_dispatch { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
    .status-pending_dispatch .dot { background: #d97706; }
    .status-dispatched { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }
    .status-dispatched .dot { background: #2563eb; }
    .status-confirmed { background: #f0f9ff; color: #0284c7; border: 1px solid #bae6fd; }
    .status-confirmed .dot { background: #0284c7; }
    .status-fixed_unconfirmed { background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; }
    .status-fixed_unconfirmed .dot { background: #64748b; }
    .status-fixed_confirmed { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .status-fixed_confirmed .dot { background: #16a34a; }
    /* 工单类型颜色 */
    .type-badge {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }
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
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border: none;
        color: #ffffff;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border: none;
        color: #ffffff;
        box-shadow: 0 4px 12px -2px rgb(59 130 246 / 0.3);
    }
</style>

<!-- 工单列表 -->
<?php
$searchArr = [
    'action' =>  $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'keyword', 'placeholder' => "工单标题/内容"],
        ['type' => 'select', 'name' => 'status', 'options' => $work_order_status, 'frist_option' => '工单状态'],
        ['type' => 'select', 'name' => 'type', 'options' => $work_order_type, 'frist_option' => '工单类型']
    ]]; ?>
{include file='public/search' /}

<div class="table-container">
    <div class="px-5 py-4 border-b border-slate-200 bg-slate-50">
        <div class="flex items-center gap-3">
            <h2 class="text-lg font-bold text-slate-800">工单列表</h2>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
            <tr>
                <th>ID</th>
                <th>工单标题</th>
                <th>工单类型</th>
                <th>状态</th>
                <th>安全owner</th>
                <th>业务owner</th>
                <th>修复人</th>
                <th>创建时间</th>
                <th>更新时间</th>
                <th style="width: 200px">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($list as $value) { ?>
                <tr>
                    <td class="font-semibold"><?php echo $value['id'] ?></td>
                    <td><?php echo $value['title'] ?></td>
                    <td>
                        <span class="status-badge type-badge">
                            <?php echo $work_order_type[$value['type']] ?? $value['type'] ?>
                        </span>
                    </td>
                    <td>
                        <span class="status-badge status-<?php echo $value['status'] ?>">
                            <span class="dot"></span>
                            <?php echo $work_order_status[$value['status']] ?? $value['status'] ?>
                        </span>
                    </td>
                    <td><?php echo $value['security_owner'] ?></td>
                    <td><?php echo $value['business_owner'] ?></td>
                    <td><?php echo $value['fixer'] ?></td>
                    <td class="text-slate-500 text-sm"><?php echo $value['created_at'] ?></td>
                    <td class="text-slate-500 text-sm"><?php echo $value['updated_at'] ?></td>
                    <td>
                        <div class="flex gap-2">
                            <a href="<?php echo url('asm/workorder/detail', ['id' => $value['id']]) ?>" class="btn-action">查看详情</a>
                            <a href="javascript:void(0)" class="btn-action btn-primary" onclick="feishuCreateGroup(<?php echo $value['id'] ?>)">飞书拉群</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

{include file='public/fenye' /}
<script>
function feishuCreateGroup(id) {
    if (confirm('确定要通过飞书机器人创建群组并发送工单通知吗？')) {
        $.ajax({
            url: '<?php echo url('asm/workorder/feishuCreateGroup') ?>',
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
