<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>主机资产总表</title>
    <link href="__STATIC__/css/bootstrap.min.css" rel="stylesheet">
    <link href="__STATIC__/css/font-awesome.min.css" rel="stylesheet">
    <link href="__STATIC__/css/style.min.css" rel="stylesheet">
    <style>
        .search-box {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .table th {
            background-color: #f8f9fa;
            border-top: none;
        }
        .status-badge {
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-running { background-color: #d4edda; color: #155724; }
        .status-stopped { background-color: #f8d7da; color: #721c24; }
        .status-creating { background-color: #fff3cd; color: #856404; }
        .status-terminated { background-color: #e2e3e5; color: #383d41; }
        .hids-installed { color: #28a745; font-weight: bold; }
        .hids-not-installed { color: #dc3545; font-weight: bold; }
        .cloud-platform { padding: 3px 8px; border-radius: 3px; font-size: 12px; }
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
                        <h4>主机资产总表</h4>
                        <h6>查看所有服务器资产信息</h6>
                    </div>
                    <div class="page-btn">
                        <a href="{:url('asm/hostassets/addIdcHost')}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> 添加线下IDC主机
                        </a>
                        <a href="javascript:void(0);" class="btn btn-success" onclick="syncCloudAssets()">
                            <i class="fa fa-refresh"></i> 同步云资产
                        </a>
                    </div>
                </div>
                
                <!-- 搜索框 -->
                <div class="search-box">
                    <form action="{:url('asm/hostassets/index')}" method="get">
                        <div class="row">
                            <div class="col-lg-2 col-md-3">
                                <div class="form-group">
                                    <label>关键字搜索</label>
                                    <input type="text" name="keyword" class="form-control" placeholder="实例名称/IP地址" value="{$keyword}">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3">
                                <div class="form-group">
                                    <label>云平台</label>
                                    <select name="cloud_platform" class="form-control">
                                        {foreach $platforms as $key => $value}
                                            <option value="{$key}" {if $cloud_platform == $key}selected{/if}>{$value}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3">
                                <div class="form-group">
                                    <label>实例状态</label>
                                    <select name="status" class="form-control">
                                        {foreach $instance_status as $key => $value}
                                            <option value="{$key}" {if $status == $key}selected{/if}>{$value}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3">
                                <div class="form-group">
                                    <label>HIDS安装状态</label>
                                    <select name="hids_installed" class="form-control">
                                        {foreach $hids_status as $key => $value}
                                            <option value="{$key}" {if $hids_installed == $key}selected{/if}>{$value}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">搜索</button>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <a href="{:url('asm/hostassets/index')}" class="btn btn-light btn-block">重置</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- 数据表格 -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>序号</th>
                                        <th>实例ID</th>
                                        <th>实例名称</th>
                                        <th>云平台</th>
                                        <th>状态</th>
                                        <th>私有IP</th>
                                        <th>公网IP</th>
                                        <th>操作系统</th>
                                        <th>配置</th>
                                        <th>HIDS状态</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {if empty($list->items())}
                                        <tr>
                                            <td colspan="12" style="text-align: center;">暂无数据</td>
                                        </tr>
                                    {else}
                                        {foreach $list->items() as $index => $host}
                                            <tr>
                                                <td>{$index + 1 + ($list->currentPage - 1) * $list->listRows}</td>
                                                <td>{$host.instance_id}</td>
                                                <td>{$host.display_name}</td>
                                                <td>
                                                    <span class="cloud-platform cloud-{$host.cloud_platform}">
                                                        {if $host.cloud_platform == 'huoshan'}火山云
                                                        {elseif $host.cloud_platform == 'tianyi'}天翼云
                                                        {else}线下IDC
                                                        {/if}
                                                    </span>
                                                </td>
                                                <td>
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
                                                </td>
                                                <td>{$host.private_ip}</td>
                                                <td>{$host.public_ip ?: '-'}</td>
                                                <td>{$host.os_name}</td>
                                                <td>{$host.cpu}核 {$host.memory}GB</td>
                                                <td>
                                                    {if $host.hids_installed == 1}
                                                        <span class="hids-installed">已安装</span>
                                                    {else}
                                                        <span class="hids-not-installed">未安装</span>
                                                    {/if}
                                                </td>
                                                <td>{$host.create_time}</td>
                                                <td>
                                                    <a href="{:url('asm/hostassets/detail', ['id' => $host.id])}" class="btn btn-sm btn-info">详情</a>
                                                    {if $host.cloud_platform == 'idc'}
                                                        <a href="{:url('asm/hostassets/edit', ['id' => $host.id])}" class="btn btn-sm btn-warning">编辑</a>
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="deleteHost({$host.id})">删除</a>
                                                    {/if}
                                                </td>
                                            </tr>
                                        {/foreach}
                                    {/if}
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- 分页 -->
                        <div class="pagination-box">
                            {include file='public/fenye' /}
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
    <script>
        // 同步云资产
        function syncCloudAssets() {
            if (confirm('确定要同步云资产数据吗？')) {
                $.ajax({
                    url: '{:url('asm/hostassets/syncCloudAssets')}',
                    type: 'post',
                    dataType: 'json',
                    success: function(res) {
                        if (res.code == 1) {
                            alert('同步成功');
                            window.location.reload();
                        } else {
                            alert('同步失败：' + res.msg);
                        }
                    },
                    error: function() {
                        alert('网络错误，请稍后重试');
                    }
                });
            }
        }
        
        // 删除主机
        function deleteHost(id) {
            if (confirm('确定要删除该主机吗？')) {
                $.ajax({
                    url: '{:url('asm/hostassets/delete')}',
                    type: 'post',
                    data: {id: id},
                    dataType: 'json',
                    success: function(res) {
                        if (res.code == 1) {
                            alert('删除成功');
                            window.location.reload();
                        } else {
                            alert('删除失败：' + res.msg);
                        }
                    },
                    error: function() {
                        alert('网络错误，请稍后重试');
                    }
                });
            }
        }
    </script>
</body>
</html>