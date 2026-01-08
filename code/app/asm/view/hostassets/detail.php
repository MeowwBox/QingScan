{include file='public/head' /}
<style>
    .host-detail-section {
        background-color: #fff;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .detail-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }
    .detail-row {
        margin-bottom: 10px;
    }
    .detail-label {
        font-weight: 500;
        color: #666;
        min-width: 120px;
        display: inline-block;
    }
    .detail-value {
        color: #333;
    }
    .security-group-item {
        background-color: #f8f9fa;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 3px;
        border-left: 3px solid #0d6efd;
    }
</style>
<div class="container" style="margin-top: 20px;">
    <div class="row">
        <div class="col-md-12">
            <div class="host-detail-section">
                <div class="detail-title">主机基本信息</div>
                <div class="detail-row">
                    <span class="detail-label">实例ID：</span>
                    <span class="detail-value"><?php echo $host['instance_id'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">实例名称：</span>
                    <span class="detail-value"><?php echo $host['instance_name'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">显示名称：</span>
                    <span class="detail-value"><?php echo $host['display_name'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">云平台：</span>
                    <span class="detail-value"><?php echo $host['cloud_platform'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">状态：</span>
                    <span class="detail-value"><?php echo $host['status'] ?></span>
                </div>
            </div>
            
            <div class="host-detail-section">
                <div class="detail-title">网络信息</div>
                <div class="detail-row">
                    <span class="detail-label">私有IP：</span>
                    <span class="detail-value"><?php echo $host['private_ip'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">公网IP：</span>
                    <span class="detail-value"><?php echo $host['public_ip'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">MAC地址：</span>
                    <span class="detail-value"><?php echo $host['mac_address'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">VPC ID：</span>
                    <span class="detail-value"><?php echo $host['vpc_id'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">VPC名称：</span>
                    <span class="detail-value"><?php echo $host['vpc_name'] ?></span>
                </div>
            </div>
            
            <div class="host-detail-section">
                <div class="detail-title">系统信息</div>
                <div class="detail-row">
                    <span class="detail-label">操作系统类型：</span>
                    <span class="detail-value"><?php echo $host['os_type'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">操作系统名称：</span>
                    <span class="detail-value"><?php echo $host['os_name'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">CPU：</span>
                    <span class="detail-value"><?php echo $host['cpu'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">内存：</span>
                    <span class="detail-value"><?php echo $host['memory'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">实例类型：</span>
                    <span class="detail-value"><?php echo $host['instance_type'] ?></span>
                </div>
            </div>
            
            <div class="host-detail-section">
                <div class="detail-title">HIDS信息</div>
                <div class="detail-row">
                    <span class="detail-label">HIDS安装状态：</span>
                    <span class="detail-value"><?php echo $host['hids_installed'] ? '已安装' : '未安装' ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">HIDS版本：</span>
                    <span class="detail-value"><?php echo $host['hids_version'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">HIDS最后检查时间：</span>
                    <span class="detail-value"><?php echo $host['hids_last_check'] ?></span>
                </div>
            </div>
            
            <div class="host-detail-section">
                <div class="detail-title">安全组信息</div>
                <?php if (!empty($host['security_groups'])) { ?>
                    <?php foreach ($host['security_groups'] as $group) { ?>
                        <div class="security-group-item">
                            <div class="detail-row">
                                <span class="detail-label">安全组ID：</span>
                                <span class="detail-value"><?php echo $group['sg_id'] ?></span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">安全组名称：</span>
                                <span class="detail-value"><?php echo $group['sg_name'] ?></span>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="detail-value">无安全组信息</div>
                <?php } ?>
            </div>
            
            <div class="host-detail-section">
                <div class="detail-title">时间信息</div>
                <div class="detail-row">
                    <span class="detail-label">创建时间：</span>
                    <span class="detail-value"><?php echo $host['create_time'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">更新时间：</span>
                    <span class="detail-value"><?php echo $host['update_time'] ?></span>
                </div>
            </div>
            
            <?php if (($host['cloud_platform'] == 'huoshan' || $host['cloud_platform'] == 'tianyi') && !empty($original_data)) { ?>
            <div class="host-detail-section">
                <div class="detail-title">原始信息</div>
                <div class="detail-row">
                    <pre style="background-color: #f8f9fa; padding: 10px; border-radius: 5px; overflow-x: auto;">
                        <?php echo json_encode($original_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
                    </pre>
                </div>
            </div>
            <?php } ?>
            
            <div class="text-center" style="margin-top: 30px;">
                <a href="<?php echo url('asm/hostassets/index') ?>" class="btn btn-outline-secondary">返回列表</a>
                <?php if ($host['cloud_platform'] == 'idc') { ?>
                    <a href="<?php echo url('asm/hostassets/edit', ['id' => $host['id']]) ?>" class="btn btn-outline-primary">编辑主机</a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
{include file='public/footer' /}