{include file='public/head' /}
{include file='public/asmLeftMenu' /}
<style>
    .detail-wrapper {
        padding: 24px;
        background: #f8fafc;
        min-height: calc(100vh - 64px);
    }
    .page-header {
        margin-bottom: 24px;
    }
    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }
    .btn-outline {
        background: transparent;
        color: #64748b;
        border: 1px solid #cbd5e1;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-outline:hover {
        background: #f8fafc;
        border-color: #3b82f6;
        color: #3b82f6;
    }
    .content-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04);
        overflow: hidden;
    }
    .card-header {
        padding: 16px 24px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        font-size: 15px;
        font-weight: 600;
        color: #1e293b;
    }
    .card-body {
        padding: 24px;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px 32px;
    }
    .info-item {
        display: flex;
        gap: 8px;
    }
    .info-item strong {
        color: #64748b;
        font-weight: 500;
        min-width: 80px;
    }
    .info-item span {
        color: #1e293b;
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
    .badge-warning {
        background: #fef3c7;
        color: #d97706;
        border: 1px solid #fcd34d;
    }
    .badge-info {
        background: #cffafe;
        color: #0891b2;
        border: 1px solid #67e8f9;
    }
    .badge-primary {
        background: #dbeafe;
        color: #2563eb;
        border: 1px solid #93c5fd;
    }
    .badge-success {
        background: #dcfce7;
        color: #16a34a;
        border: 1px solid #86efac;
    }
    .badge-secondary {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
    }
    .badge-danger {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fca5a5;
    }
    .form-group {
        margin-bottom: 16px;
    }
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
    }
    .form-control, .form-select {
        width: 100%;
        padding: 12px 16px;
        font-size: 14px;
        color: #1e293b;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.2s;
        box-sizing: border-box;
    }
    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: #3b82f6;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .form-control::placeholder {
        color: #94a3b8;
    }
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: #ffffff;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-right: 8px;
    }
    .btn-primary:hover {
        box-shadow: 0 4px 12px -2px rgb(0 0 0 / 0.1);
        transform: translateY(-1px);
    }
    .btn-outline-primary {
        background: transparent;
        color: #3b82f6;
        border: 1px solid #3b82f6;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-outline-primary:hover {
        background: #eff6ff;
    }
</style>
<div class="w-full md:w-[91.67%]" style="padding: 0;">
    <div class="detail-wrapper">
        <div class="page-header">
            <a href="<?php echo url('asm/workorder/index') ?>" class="btn-outline">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                返回工单列表
            </a>
        </div>

        <!-- 工单基本信息 -->
        <div class="content-card">
            <div class="card-header">基本信息</div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item"><strong>工单ID：</strong><span><?php echo $work_order['id'] ?></span></div>
                    <div class="info-item"><strong>工单标题：</strong><span><?php echo $work_order['title'] ?></span></div>
                    <div class="info-item"><strong>工单类型：</strong><span><?php echo $work_order['type'] ?></span></div>
                    <div class="info-item"><strong>工单状态：</strong>
                        <span class="badge <?php
                            switch($work_order['status']) {
                                case 'pending_dispatch': echo 'badge-warning'; break;
                                case 'dispatched': echo 'badge-info'; break;
                                case 'confirmed': echo 'badge-primary'; break;
                                case 'fixed_unconfirmed': echo 'badge-secondary'; break;
                                case 'fixed_confirmed': echo 'badge-success'; break;
                                default: echo 'badge-secondary';
                            }
                        ?>">
                            <?php echo $work_order_status[$work_order['status']] ?? $work_order['status'] ?>
                        </span>
                    </div>
                    <div class="info-item"><strong>安全owner：</strong><span><?php echo $work_order['security_owner'] ?? '' ?></span></div>
                    <div class="info-item"><strong>业务owner：</strong><span><?php echo $work_order['business_owner'] ?? '' ?></span></div>
                    <div class="info-item"><strong>修复人：</strong><span><?php echo $work_order['fixer'] ?? '' ?></span></div>
                    <div class="info-item"><strong>确认人：</strong><span><?php echo $work_order['confirmer'] ?? '' ?></span></div>
                    <div class="info-item"><strong>创建时间：</strong><span><?php echo $work_order['created_at'] ?></span></div>
                    <div class="info-item"><strong>更新时间：</strong><span><?php echo $work_order['updated_at'] ?></span></div>
                    <div class="info-item"><strong>飞书通知：</strong>
                        <span class="badge <?php echo $work_order['feishu_notified'] ? 'badge-success' : 'badge-danger' ?>">
                            <?php echo $work_order['feishu_notified'] ? '已通知' : '未通知' ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 工单内容 -->
        <div class="content-card">
            <div class="card-header">工单内容</div>
            <div class="card-body">
                <p style="color: #475569; line-height: 1.8; margin: 0;"><?php echo $work_order['content'] ?></p>
            </div>
        </div>

        <!-- 关联漏洞信息 -->
        <?php if (!empty($vul_data)): ?>
        <div class="content-card">
            <div class="card-header">关联漏洞信息</div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item"><strong>漏洞名称：</strong><span><?php echo $vul_data['vul_name'] ?></span></div>
                    <div class="info-item"><strong>漏洞ID：</strong><span><?php echo $vul_data['id'] ?></span></div>
                    <div class="info-item"><strong>IP地址：</strong><span><?php echo $vul_data['ip_address'] ?></span></div>
                    <div class="info-item"><strong>CVE编号：</strong><span><?php echo $vul_data['cve_id'] ?></span></div>
                    <div class="info-item"><strong>CNVD编号：</strong><span><?php echo $vul_data['cnvd_id'] ?></span></div>
                    <div class="info-item"><strong>严重程度：</strong>
                        <span class="badge <?php
                            switch($vul_data['severity']) {
                                case 'critical': echo 'badge-danger'; break;
                                case 'high': echo 'badge-warning'; break;
                                case 'medium': echo 'badge-info'; break;
                                case 'low': echo 'badge-success'; break;
                                case 'info': echo 'badge-secondary'; break;
                                default: echo 'badge-secondary';
                            }
                        ?>">
                            <?php echo $vul_data['severity'] ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- 工单操作 -->
        <div class="content-card">
            <div class="card-header">工单操作</div>
            <div class="card-body">
                <div class="info-grid" style="margin-bottom: 24px;">
                    <div class="form-group">
                        <label for="status" class="form-label">更新状态</label>
                        <select class="form-select" id="status">
                            <?php foreach ($work_order_status as $key => $val): ?>
                                <option value="<?php echo $key ?>" <?php echo $work_order['status'] == $key ? 'selected' : '' ?>><?php echo $val ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="security_owner" class="form-label">安全owner</label>
                        <input type="text" class="form-control" id="security_owner" value="<?php echo $work_order['security_owner'] ?? '' ?>" placeholder="请输入安全owner">
                    </div>
                    <div class="form-group">
                        <label for="business_owner" class="form-label">业务owner</label>
                        <input type="text" class="form-control" id="business_owner" value="<?php echo $work_order['business_owner'] ?? '' ?>" placeholder="请输入业务owner">
                    </div>
                    <div class="form-group">
                        <label for="fixer" class="form-label">修复人</label>
                        <input type="text" class="form-control" id="fixer" value="<?php echo $work_order['fixer'] ?? '' ?>" placeholder="请输入修复人">
                    </div>
                    <div class="form-group">
                        <label for="confirmer" class="form-label">确认人</label>
                        <input type="text" class="form-control" id="confirmer" value="<?php echo $work_order['confirmer'] ?? '' ?>" placeholder="请输入确认人">
                    </div>
                </div>
                <div style="margin-top: 24px;">
                    <button type="button" class="btn-primary" onclick="updateStatus(<?php echo $work_order['id'] ?>)">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 13l4 4L19 7"/>
                        </svg>
                        更新状态
                    </button>
                    <button type="button" class="btn-outline-primary" onclick="feishuCreateGroup(<?php echo $work_order['id'] ?>)">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        飞书拉群通知
                    </button>
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
