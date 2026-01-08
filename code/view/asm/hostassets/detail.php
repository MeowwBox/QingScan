<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>主机资产详情</title>
    <link href="__STATIC__/css/bootstrap.min.css" rel="stylesheet">
    <link href="__STATIC__/css/font-awesome.min.css" rel="stylesheet">
    <link href="__STATIC__/css/style.min.css" rel="stylesheet">
    <style>
        .detail-label {
            font-weight: bold;
            color: #333;
        }
        .detail-value {
            color: #666;
        }
        .hids-status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }
        .hids-installed { background-color: #d4edda; color: #155724; }
        .hids-not-installed { background-color: #f8d7da; color: #721c24; }
        .cloud-platform {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
        }
        .cloud-huoshan { background-color: #e6f7ff; color: #1890ff; }
        .cloud-tianyi { background-color: #f6ffed; color: #52c41a; }
        .cloud-idc { background-color: #fff2e8; color: #fa8c16; }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- 左侧菜单 -->
        {include file='public/LeftMenuStyle' /}
        
        <!-- 右侧主内容区 -->
        <div class="right-wrapper">
            <!-- 顶部导航 -->
            {include file='public/TopHeader' /}
            
            <!-- 内容区域 -->
            <div class="main-content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>主机资产详情</h4>
                        <h6>查看服务器详细信息</h6>
                    </div>
                    <div class="page-btn">
                        <a href="{:url('asm/hostassets/index')}" class="btn btn-light">
                            <i class="fa fa-arrow-left"></i> 返回列表
                        </a>
                    </div>
                </div>
                
                <!-- 详情卡片 -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- 基本信息 -->
                                    <div class="col-lg-6">
                                        <div class="card-title">基本信息</div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">实例ID</label>
                                                    <div class="detail-value">{$host.instance_id}</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">实例名称</label>
                                                    <div class="detail-value">{$host.instance_name}</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">显示名称</label>
                                                    <div class="detail-value">{$host.display_name}</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">云平台</label>
                                                    <div class="detail-value">
                                                        <span class="cloud-platform cloud-{$host.cloud_platform}">
                                                            {if $host.cloud_platform == 'huoshan'}火山云
                                                            {elseif $host.cloud_platform == 'tianyi'}天翼云
                                                            {else}线下IDC
                                                            {/if}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">状态</label>
                                                    <div class="detail-value">
                                                        <span class="status-badge status-{$host.status}">
                                                            {if $host.status == 'running'}运行中
                                                            {elseif $host.status == 'stopped' || $host.status == 'shutoff'}已停止
                                                            {elseif $host.status == 'terminated'}已终止
                                                            {elseif $host.status == 'creating'}创建中
                                                            {elseif $host.status == 'starting'}启动中
                                                            {elseif $host.status == 'stopping'}停止中
                                                            {elseif $host.status == 'rebooting'}重启中
                                                            {else}{$host.status}
                                                            {/if}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">创建时间</label>
                                                    <div class="detail-value">{$host.create_time}</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">更新时间</label>
                                                    <div class="detail-value">{$host.update_time}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- 网络信息 -->
                                    <div class="col-lg-6">
                                        <div class="card-title">网络信息</div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">私有IP</label>
                                                    <div class="detail-value">{$host.private_ip}</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">公网IP</label>
                                                    <div class="detail-value">{$host.public_ip ?: '-'}</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">MAC地址</label>
                                                    <div class="detail-value">{$host.mac_address ?: '-'}</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">VPC ID</label>
                                                    <div class="detail-value">{$host.vpc_id ?: '-'}</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">VPC名称</label>
                                                    <div class="detail-value">{$host.vpc_name ?: '-'}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- 配置信息 -->
                                    <div class="col-lg-6">
                                        <div class="card-title">配置信息</div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">CPU</label>
                                                    <div class="detail-value">{$host.cpu}核</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">内存</label>
                                                    <div class="detail-value">{$host.memory}GB</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">实例类型</label>
                                                    <div class="detail-value">{$host.instance_type ?: '-'}</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">操作系统类型</label>
                                                    <div class="detail-value">{$host.os_type}</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="detail-label">操作系统名称</label>
                                                    <div class="detail-value">{$host.os_name}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- HIDS信息 -->
                                    <div class="col-lg-6">
                                        <div class="card-title">HIDS信息</div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">HIDS状态</label>
                                                    <div class="detail-value">
                                                        <span class="hids-status hids-{if $host.hids_installed}installed{else}not-installed{/if}">
                                                            {if $host.hids_installed}已安装{else}未安装{/if}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="detail-label">HIDS版本</label>
                                                    <div class="detail-value">{$host.hids_version ?: '-'}</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="detail-label">最后检查时间</label>
                                                    <div class="detail-value">{$host.hids_last_check ?: '-'}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- 安全组信息 -->
                                    <div class="col-lg-12">
                                        <div class="card-title">安全组信息</div>
                                        <div class="form-group">
                                            <div class="detail-value">
                                                {if empty($host.security_groups)}
                                                    <p>无安全组信息</p>
                                                {else}
                                                    <ul>
                                                        {foreach $host.security_groups as $sg}
                                                            <li>{$sg.id} - {$sg.name}</li>
                                                        {/foreach}
                                                    </ul>
                                                {/if}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script src="__STATIC__/js/jquery-3.6.0.min.js"></script>
    <script src="__STATIC__/js/bootstrap.bundle.min.js"></script>
    <script src="__STATIC__/js/jquery.slimscroll.min.js"></script>
    <script src="__STATIC__/js/app.min.js"></script>
</body>
</html>