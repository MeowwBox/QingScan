{include file='public/head' /}
{include file='public/asmLeftMenu' /}

<style>
    /* 页面容器 */
    .detail-container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 0 20px;
    }
    /* 卡片样式 */
    .detail-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        padding: 24px;
        margin-bottom: 20px;
    }
    .detail-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .detail-title::before {
        content: '';
        width: 4px;
        height: 20px;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border-radius: 2px;
    }
    /* 信息网格 */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px 32px;
    }
    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    .info-label {
        min-width: 120px;
        font-weight: 500;
        color: #64748b;
        font-size: 14px;
    }
    .info-value {
        color: #1e293b;
        font-size: 14px;
        word-break: break-all;
    }
    /* 安全组项 */
    .security-group-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #3b82f6;
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 12px;
    }
    .security-group-item:last-child {
        margin-bottom: 0;
    }
    /* 按钮样式 */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 24px;
        border-radius: 10px;
        font-size: 14px;
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
    /* JSON展示 */
    .json-display {
        background: #1e293b;
        border-radius: 12px;
        padding: 16px;
        overflow-x: auto;
        font-family: monospace;
        font-size: 13px;
        color: #e2e8f0;
        line-height: 1.6;
    }
</style>
<div class="detail-container">
    <div class="w-full">
        <div class="detail-card">
            <div class="detail-title">主机基本信息</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">实例ID：</span>
                    <span class="info-value"><?php echo $host['instance_id'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">实例名称：</span>
                    <span class="info-value"><?php echo $host['instance_name'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">显示名称：</span>
                    <span class="info-value"><?php echo $host['display_name'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">云平台：</span>
                    <span class="info-value"><?php echo $host['cloud_platform'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">状态：</span>
                    <span class="info-value">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold
                            <?php
                            $status = strtolower($host['status'] ?? '');
                            if (in_array($status, ['running', 'active', '运行中'])) {
                                echo 'bg-emerald-50 text-emerald-600 border border-emerald-100';
                            } elseif (in_array($status, ['stopped', 'inactive', '已停止'])) {
                                echo 'bg-red-50 text-red-600 border border-red-100';
                            } else {
                                echo 'bg-slate-50 text-slate-600 border border-slate-100';
                            }
                            ?>">
                            <span class="w-1.5 h-1.5 rounded-full <?php
                            if (in_array($status, ['running', 'active', '运行中'])) {
                                echo 'bg-emerald-500';
                            } elseif (in_array($status, ['stopped', 'inactive', '已停止'])) {
                                echo 'bg-red-500';
                            } else {
                                echo 'bg-slate-400';
                            }
                            ?>"></span>
                            <?php echo $host['status'] ?>
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <div class="detail-card">
            <div class="detail-title">网络信息</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">私有IP：</span>
                    <span class="info-value"><?php echo $host['private_ip'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">公网IP：</span>
                    <span class="info-value"><?php echo $host['public_ip'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">MAC地址：</span>
                    <span class="info-value font-mono text-sm"><?php echo $host['mac_address'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">VPC ID：</span>
                    <span class="info-value"><?php echo $host['vpc_id'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">VPC名称：</span>
                    <span class="info-value"><?php echo $host['vpc_name'] ?></span>
                </div>
            </div>
        </div>

        <div class="detail-card">
            <div class="detail-title">系统信息</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">操作系统类型：</span>
                    <span class="info-value"><?php echo $host['os_type'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">操作系统名称：</span>
                    <span class="info-value"><?php echo $host['os_name'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">CPU：</span>
                    <span class="info-value"><?php echo $host['cpu'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">内存：</span>
                    <span class="info-value"><?php echo $host['memory'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">实例类型：</span>
                    <span class="info-value"><?php echo $host['instance_type'] ?></span>
                </div>
            </div>
        </div>

        <div class="detail-card">
            <div class="detail-title">HIDS信息</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">HIDS安装状态：</span>
                    <span class="info-value">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold
                            <?php echo $host['hids_installed'] ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-red-50 text-red-600 border border-red-100' ?>">
                            <span class="w-1.5 h-1.5 rounded-full <?php echo $host['hids_installed'] ? 'bg-emerald-500' : 'bg-red-500' ?>"></span>
                            <?php echo $host['hids_installed'] ? '已安装' : '未安装' ?>
                        </span>
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">HIDS版本：</span>
                    <span class="info-value"><?php echo $host['hids_version'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">HIDS最后检查时间：</span>
                    <span class="info-value text-slate-500"><?php echo $host['hids_last_check'] ?></span>
                </div>
            </div>
        </div>

        <div class="detail-card">
            <div class="detail-title">安全组信息</div>
            <?php if (!empty($host['security_groups'])) { ?>
                <?php foreach ($host['security_groups'] as $group) { ?>
                    <div class="security-group-item">
                        <div class="info-grid" style="grid-template-columns: 1fr;">
                            <div class="info-item">
                                <span class="info-label">安全组ID：</span>
                                <span class="info-value font-mono text-sm"><?php echo $group['sg_id'] ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">安全组名称：</span>
                                <span class="info-value"><?php echo $group['sg_name'] ?></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="text-slate-500">无安全组信息</div>
            <?php } ?>
        </div>

        <div class="detail-card">
            <div class="detail-title">时间信息</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">创建时间：</span>
                    <span class="info-value text-slate-500"><?php echo $host['create_time'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">更新时间：</span>
                    <span class="info-value text-slate-500"><?php echo $host['update_time'] ?></span>
                </div>
            </div>
        </div>

        <?php if (($host['cloud_platform'] == 'huoshan' || $host['cloud_platform'] == 'tianyi' || $host['cloud_platform'] == 'baidu') && !empty($original_data)) { ?>
        <div class="detail-card">
            <div class="detail-title">原始信息</div>
            <div class="json-display">
                <?php echo json_encode($original_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
            </div>
        </div>
        <?php } ?>

        <div class="text-center" style="margin-top: 30px; margin-bottom: 30px;">
            <a href="<?php echo url('asm/hostassets/index') ?>" class="btn-action">返回列表</a>
            <?php if ($host['cloud_platform'] == 'idc') { ?>
                <a href="<?php echo url('asm/hostassets/edit', ['id' => $host['id']]) ?>" class="btn-action btn-primary">编辑主机</a>
            <?php } ?>
        </div>
    </div>
</div>
{include file='public/footer' /}
