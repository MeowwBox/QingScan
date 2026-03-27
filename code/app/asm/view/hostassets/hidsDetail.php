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
    /* 状态标签 */
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
    .status-online { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .status-online .dot { background: #16a34a; }
    .status-offline { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
    .status-offline .dot { background: #dc2626; }
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
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="font-size: 24px; font-weight: 700; color: #1e293b; margin: 0;">HIDS详情</h2>
                <a href="<?php echo url('asm/hostassets/index', ['tab' => 'hids']) ?>" class="btn-action">返回HIDS列表</a>
            </div>

            <!-- HIDS基本信息 -->
            <div class="detail-title">基本信息</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">ID：</span>
                    <span class="info-value font-semibold"><?php echo $hids_data['id'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">IP地址：</span>
                    <span class="info-value font-mono"><?php echo $hids_data['ip_address'] ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">实例ID：</span>
                    <span class="info-value"><?php echo $hids_data['instance_id'] ?? '-' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">主机ID：</span>
                    <span class="info-value"><?php echo $hids_data['host_id'] ?? '-' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">创建时间：</span>
                    <span class="info-value text-slate-500"><?php echo $hids_data['created_time'] ?? '-' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">更新时间：</span>
                    <span class="info-value text-slate-500"><?php echo $hids_data['updated_time'] ?? '-' ?></span>
                </div>
            </div>
        </div>

        <?php if (isset($hids_data['original_data']['system'])): ?>
        <div class="detail-card">
            <div class="detail-title">系统信息</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">主机名：</span>
                    <span class="info-value"><?php echo $hids_data['original_data']['system']['hostname'] ?? '-' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">操作系统：</span>
                    <span class="info-value"><?php echo $hids_data['original_data']['system']['os_name'] ?? '-' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">内核版本：</span>
                    <span class="info-value font-mono text-sm"><?php echo $hids_data['original_data']['system']['kernel_version'] ?? '-' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">系统架构：</span>
                    <span class="info-value"><?php echo $hids_data['original_data']['system']['arch'] ?? '-' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">CPU核心数：</span>
                    <span class="info-value"><?php echo $hids_data['original_data']['system']['cpu_count'] ?? '-' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">内存大小：</span>
                    <span class="info-value"><?php echo $hids_data['original_data']['system']['memory_size'] ?? '-' ?></span>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (isset($hids_data['original_data']['network'])): ?>
        <div class="detail-card">
            <div class="detail-title">网络信息</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">MAC地址：</span>
                    <span class="info-value font-mono text-sm"><?php echo $hids_data['original_data']['network']['mac_address'] ?? '-' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">公网IP：</span>
                    <span class="info-value font-mono"><?php echo $hids_data['original_data']['network']['public_ip'] ?? '-' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">私有IP：</span>
                    <span class="info-value font-mono"><?php echo $hids_data['original_data']['network']['private_ip'] ?? '-' ?></span>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (isset($hids_data['original_data']['security'])): ?>
        <div class="detail-card">
            <div class="detail-title">安全信息</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">在线状态：</span>
                    <span class="info-value">
                        <span class="status-badge <?php echo isset($hids_data['original_data']['online']) && $hids_data['original_data']['online'] ? 'status-online' : 'status-offline' ?>">
                            <span class="dot"></span>
                            <?php echo isset($hids_data['original_data']['online']) && $hids_data['original_data']['online'] ? '在线' : '离线' ?>
                        </span>
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Agent版本：</span>
                    <span class="info-value"><?php echo $hids_data['original_data']['agent_version'] ?? '-' ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">最后在线时间：</span>
                    <span class="info-value text-slate-500"><?php echo $hids_data['original_data']['last_online_time'] ?? '-' ?></span>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="detail-card">
            <div class="detail-title">原始JSON数据</div>
            <div class="json-display">
                <?php echo json_encode($hids_data['original_data'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
            </div>
        </div>
    </div>
</div>
{include file='public/footer' /}
