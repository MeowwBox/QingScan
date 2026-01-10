{include file='public/head' /}
<div class="col-md-1 " style="padding-right: 0;" >
    {include file='public/asmLeftMenu' /}
</div>
<div class="col-md-11 " style="padding:0;">

<!-- 工单详情 -->
<div class="row tuchu">
    <div class="col-md-12">
        <h2>工单详情</h2>
        <hr>
        
        <!-- 返回按钮 -->
        <div class="mb-3">
            <a href="<?php echo url('asm/workorder/index') ?>" class="btn btn-sm btn-outline-secondary">返回工单列表</a>
        </div>
        
        <!-- 工单基本信息 -->
        <div class="card mb-3">
            <div class="card-header">
                基本信息
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>工单ID：</strong><?php echo $work_order['id'] ?></p>
                        <p><strong>工单标题：</strong><?php echo $work_order['title'] ?></p>
                        <p><strong>工单类型：</strong><?php echo $work_order['type'] ?></p>
                        <p><strong>工单状态：</strong>
                            <span class="badge <?php 
                                switch($work_order['status']) {
                                    case 'pending_dispatch': echo 'bg-warning bg-light text-warning'; break;
                                    case 'dispatched': echo 'bg-info bg-light text-info'; break;
                                    case 'confirmed': echo 'bg-primary bg-light text-primary'; break;
                                    case 'fixed_unconfirmed': echo 'bg-secondary bg-light text-secondary'; break;
                                    case 'fixed_confirmed': echo 'bg-success bg-light text-success'; break;
                                    default: echo 'bg-light text-dark';
                                }
                            ?>">
                                <?php echo $work_order_status[$work_order['status']] ?? $work_order['status'] ?>
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>安全owner：</strong><?php echo $work_order['security_owner'] ?? '' ?></p>
                        <p><strong>业务owner：</strong><?php echo $work_order['business_owner'] ?? '' ?></p>
                        <p><strong>修复人：</strong><?php echo $work_order['fixer'] ?? '' ?></p>
                        <p><strong>确认人：</strong><?php echo $work_order['confirmer'] ?? '' ?></p>
                    </div>
                    <div class="col-md-12 mt-3">
                        <p><strong>创建时间：</strong><?php echo $work_order['created_at'] ?></p>
                        <p><strong>更新时间：</strong><?php echo $work_order['updated_at'] ?></p>
                        <p><strong>飞书通知：</strong>
                            <span class="badge <?php echo $work_order['feishu_notified'] ? 'bg-success bg-light text-success' : 'bg-danger bg-light text-danger' ?>">
                                <?php echo $work_order['feishu_notified'] ? '已通知' : '未通知' ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 工单内容 -->
        <div class="card mb-3">
            <div class="card-header">
                工单内容
            </div>
            <div class="card-body">
                <p><?php echo $work_order['content'] ?></p>
            </div>
        </div>
        
        <!-- 关联漏洞信息 -->
        <?php if (!empty($vul_data)): ?>
        <div class="card mb-3">
            <div class="card-header">
                关联漏洞信息
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>漏洞名称：</strong><?php echo $vul_data['vul_name'] ?></p>
                        <p><strong>漏洞ID：</strong><?php echo $vul_data['id'] ?></p>
                        <p><strong>IP地址：</strong><?php echo $vul_data['ip_address'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>CVE编号：</strong><?php echo $vul_data['cve_id'] ?></p>
                        <p><strong>CNVD编号：</strong><?php echo $vul_data['cnvd_id'] ?></p>
                        <p><strong>严重程度：</strong>
                            <span class="badge <?php 
                                switch($vul_data['severity']) {
                                    case 'critical': echo 'bg-danger bg-light text-danger'; break;
                                    case 'high': echo 'bg-warning bg-light text-warning'; break;
                                    case 'medium': echo 'bg-info bg-light text-info'; break;
                                    case 'low': echo 'bg-success bg-light text-success'; break;
                                    case 'info': echo 'bg-secondary bg-light text-secondary'; break;
                                    default: echo 'bg-light text-dark';
                                }
                            ?>">
                                <?php echo $vul_data['severity'] ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- 工单操作 -->
        <div class="card mb-3">
            <div class="card-header">
                工单操作
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">更新状态</label>
                            <select class="form-select" id="status">
                                <?php foreach ($work_order_status as $key => $val): ?>
                                    <option value="<?php echo $key ?>" <?php echo $work_order['status'] == $key ? 'selected' : '' ?>><?php echo $val ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="security_owner" class="form-label">安全owner</label>
                            <input type="text" class="form-control" id="security_owner" value="<?php echo $work_order['security_owner'] ?? '' ?>" placeholder="请输入安全owner">
                        </div>
                        <div class="mb-3">
                            <label for="business_owner" class="form-label">业务owner</label>
                            <input type="text" class="form-control" id="business_owner" value="<?php echo $work_order['business_owner'] ?? '' ?>" placeholder="请输入业务owner">
                        </div>
                        <div class="mb-3">
                            <label for="fixer" class="form-label">修复人</label>
                            <input type="text" class="form-control" id="fixer" value="<?php echo $work_order['fixer'] ?? '' ?>" placeholder="请输入修复人">
                        </div>
                        <div class="mb-3">
                            <label for="confirmer" class="form-label">确认人</label>
                            <input type="text" class="form-control" id="confirmer" value="<?php echo $work_order['confirmer'] ?? '' ?>" placeholder="请输入确认人">
                        </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="updateStatus(<?php echo $work_order['id'] ?>)">更新状态</button>
                        <button type="button" class="btn btn-outline-primary" onclick="feishuCreateGroup(<?php echo $work_order['id'] ?>)">飞书拉群通知</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<script>
function updateStatus(id) {
    var status = $('#status').val();
    var security_owner = $('#security_owner').val();
    var business_owner = $('#business_owner').val();
    var fixer = $('#fixer').val();
    var confirmer = $('#confirmer').val();
    
    $.ajax({
        url: '<?php echo url('asm/workorder/updateStatus') ?>',
        type: 'post',
        data: {
            id: id, 
            status: status,
            security_owner: security_owner,
            business_owner: business_owner,
            fixer: fixer,
            confirmer: confirmer
        },
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