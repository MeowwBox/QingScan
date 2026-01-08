{include file='public/head' /}
<div class="row">
    <div class="col-md-1">
        {include file='public/asmLeftMenu' /}
    </div>
    <div class="col-md-11" style="padding: 0;">
        <div class="row tuchu">
            <div class="col-md-12">
                <h2>HIDS详情</h2>
                
                <!-- 返回按钮 -->
                <div class="mb-3">
                    <a href="<?php echo url('asm/hostassets/index', ['tab' => 'hids']) ?>" class="btn btn-sm btn-outline-secondary">返回HIDS列表</a>
                </div>
                
                <!-- HIDS基本信息 -->
                <div class="host-detail-section mb-5">
                    <div class="detail-title">基本信息</div>
                    <div class="detail-row">
                        <span class="detail-label">ID：</span>
                        <span class="detail-value"><?php echo $hids_data['id'] ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">IP地址：</span>
                        <span class="detail-value"><?php echo $hids_data['ip_address'] ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">实例ID：</span>
                        <span class="detail-value"><?php echo $hids_data['instance_id'] ?? '-' ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">主机ID：</span>
                        <span class="detail-value"><?php echo $hids_data['host_id'] ?? '-' ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">创建时间：</span>
                        <span class="detail-value"><?php echo $hids_data['created_time'] ?? '-' ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">更新时间：</span>
                        <span class="detail-value"><?php echo $hids_data['updated_time'] ?? '-' ?></span>
                    </div>
                </div>
                
                <!-- 系统信息 -->
                <?php if (isset($hids_data['original_data']['system'])): ?>
                <div class="host-detail-section mb-5">
                    <div class="detail-title">系统信息</div>
                    <div class="detail-row">
                        <span class="detail-label">主机名：</span>
                        <span class="detail-value"><?php echo $hids_data['original_data']['system']['hostname'] ?? '-' ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">操作系统：</span>
                        <span class="detail-value"><?php echo $hids_data['original_data']['system']['os_name'] ?? '-' ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">内核版本：</span>
                        <span class="detail-value"><?php echo $hids_data['original_data']['system']['kernel_version'] ?? '-' ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">系统架构：</span>
                        <span class="detail-value"><?php echo $hids_data['original_data']['system']['arch'] ?? '-' ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">CPU核心数：</span>
                        <span class="detail-value"><?php echo $hids_data['original_data']['system']['cpu_count'] ?? '-' ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">内存大小：</span>
                        <span class="detail-value"><?php echo $hids_data['original_data']['system']['memory_size'] ?? '-' ?></span>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- 网络信息 -->
                <?php if (isset($hids_data['original_data']['network'])): ?>
                <div class="host-detail-section mb-5">
                    <div class="detail-title">网络信息</div>
                    <div class="detail-row">
                        <span class="detail-label">MAC地址：</span>
                        <span class="detail-value"><?php echo $hids_data['original_data']['network']['mac_address'] ?? '-' ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">公网IP：</span>
                        <span class="detail-value"><?php echo $hids_data['original_data']['network']['public_ip'] ?? '-' ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">私有IP：</span>
                        <span class="detail-value"><?php echo $hids_data['original_data']['network']['private_ip'] ?? '-' ?></span>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- 安全信息 -->
                <?php if (isset($hids_data['original_data']['security'])): ?>
                <div class="host-detail-section mb-5">
                    <div class="detail-title">安全信息</div>
                    <div class="detail-row">
                        <span class="detail-label">在线状态：</span>
                        <span class="detail-value"><?php echo isset($hids_data['original_data']['online']) && $hids_data['original_data']['online'] ? '在线' : '离线' ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Agent版本：</span>
                        <span class="detail-value"><?php echo $hids_data['original_data']['agent_version'] ?? '-' ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">最后在线时间：</span>
                        <span class="detail-value"><?php echo $hids_data['original_data']['last_online_time'] ?? '-' ?></span>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- 原始JSON数据 -->
                <div class="host-detail-section">
                    <div class="detail-title">原始JSON数据</div>
                    <pre class="bg-light p-3 rounded"><?php echo json_encode($hids_data['original_data'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?></pre>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.detail-title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 15px;
    padding-bottom: 5px;
    border-bottom: 1px solid #e9ecef;
}

.detail-row {
    margin-bottom: 10px;
}

.detail-label {
    display: inline-block;
    width: 150px;
    font-weight: bold;
    color: #6c757d;
}

.detail-value {
    display: inline-block;
    word-break: break-all;
}

.host-detail-section {
    margin-bottom: 30px;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 5px;
}
</style>

{include file='public/footer' /}