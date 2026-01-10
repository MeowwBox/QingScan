{include file='public/head' /}
<div class="col-md-1 " style="padding-right: 0;" >
    {include file='public/asmLeftMenu' /}
</div>
<div class="col-md-11 " style="padding:0;">

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

<div class="row tuchu">
    <div class="col-md-12 ">
        <table class="table  table-hover table-sm table-borderless">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>工单标题</th>
                <th>工单类型</th>
                <th>状态</th>
                <th>创建时间</th>
                <th>更新时间</th>
                <th style="width: 200px">操作</th>
            </tr>
            </thead>
            <?php foreach ($list as $value) { ?>
                <tr>
                    <td><?php echo $value['id'] ?></td>
                    <td><?php echo $value['title'] ?></td>
                    <td>
                        <span class="badge bg-info bg-light text-info">
                            <?php echo $work_order_type[$value['type']] ?? $value['type'] ?>
                        </span>
                    </td>
                    <td>
                        <span class="badge <?php 
                            switch($value['status']) {
                                case 'open': echo 'bg-warning bg-light text-warning'; break;
                                case 'processing': echo 'bg-info bg-light text-info'; break;
                                case 'closed': echo 'bg-success bg-light text-success'; break;
                                case 'rejected': echo 'bg-danger bg-light text-danger'; break;
                                default: echo 'bg-light text-dark';
                            }
                        ?>">
                            <?php echo $work_order_status[$value['status']] ?? $value['status'] ?>
                        </span>
                    </td>
                    <td><?php echo $value['create_time'] ?></td>
                    <td><?php echo $value['update_time'] ?></td>
                    <td>
                        <a href="<?php echo url('asm/workorder/detail', ['id' => $value['id']]) ?>" class="btn btn-sm btn-outline-secondary">查看详情</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary" onclick="feishuCreateGroup(<?php echo $value['id'] ?>)">飞书拉群</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

{include file='public/fenye' /}</div>
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