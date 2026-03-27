{include file='public/head' /}
{include file='public/asmLeftMenu' /}
<style>
    /* 页面标题样式 */
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

    /* 页面容器样式 */
    .page-container {
        background: #f8fafc;
        min-height: calc(100vh - 64px);
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

<!-- 页面标题 -->
<div class="flex justify-between items-start mb-6">
    <div>
        <h1 class="text-2xl font-bold text-text-primary mb-2">工单列表</h1>
        <nav class="flex gap-2 text-sm text-text-secondary">
            <a href="#" class="hover:text-primary transition-colors">首页</a>
            <span class="text-text-muted">/</span>
            <a href="#" class="hover:text-primary transition-colors">资产管理</a>
            <span class="text-text-muted">/</span>
            <span class="text-text-primary font-medium">工单列表</span>
        </nav>
    </div>
</div>

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

<?php
$tableArr = [
    'title' => '工单列表',
    'count' => count($list),
    'checkbox' => false,
    'columns' => [
        ['title' => 'ID'],
        ['title' => '工单标题'],
        ['title' => '工单类型'],
        ['title' => '状态'],
        ['title' => '安全owner'],
        ['title' => '业务owner'],
        ['title' => '修复人'],
        ['title' => '创建时间'],
        ['title' => '更新时间'],
        ['title' => '操作', 'class' => 'w-[200px]'],
    ],
];
?>
{include file='public/table_start' /}

<?php foreach ($list as $value) { ?>
    <tr class="hover:bg-surface-50 transition-colors">
        <td class="px-5 py-4 font-semibold"><?php echo $value['id'] ?></td>
        <td class="px-5 py-4"><?php echo $value['title'] ?></td>
        <td class="px-5 py-4">
            <span class="status-badge type-badge">
                <?php echo $work_order_type[$value['type']] ?? $value['type'] ?>
            </span>
        </td>
        <td class="px-5 py-4">
            <span class="status-badge status-<?php echo $value['status'] ?>">
                <span class="dot"></span>
                <?php echo $work_order_status[$value['status']] ?? $value['status'] ?>
            </span>
        </td>
        <td class="px-5 py-4"><?php echo $value['security_owner'] ?></td>
        <td class="px-5 py-4"><?php echo $value['business_owner'] ?></td>
        <td class="px-5 py-4"><?php echo $value['fixer'] ?></td>
        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['created_at'] ?></td>
        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['updated_at'] ?></td>
        <td class="px-5 py-4">
            <div class="flex gap-2">
                <a href="<?php echo url('asm/workorder/detail', ['id' => $value['id']]) ?>" class="btn-action">查看详情</a>
                <a href="javascript:void(0)" class="btn-action btn-primary" onclick="feishuCreateGroup(<?php echo $value['id'] ?>)">飞书拉群</a>
            </div>
        </td>
    </tr>
<?php } ?>

{include file='public/table_end' /}

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
