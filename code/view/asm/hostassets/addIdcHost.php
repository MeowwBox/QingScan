<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>添加线下IDC主机</title>
    <link href="__STATIC__/css/bootstrap.min.css" rel="stylesheet">
    <link href="__STATIC__/css/font-awesome.min.css" rel="stylesheet">
    <link href="__STATIC__/css/style.min.css" rel="stylesheet">
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
                        <h4>添加线下IDC主机</h4>
                        <h6>手动添加线下服务器资产信息</h6>
                    </div>
                    <div class="page-btn">
                        <a href="{:url('asm/hostassets/index')}" class="btn btn-light">
                            <i class="fa fa-arrow-left"></i> 返回列表
                        </a>
                    </div>
                </div>
                
                <!-- 表单区域 -->
                <div class="card">
                    <div class="card-body">
                        <form id="addForm">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>实例名称 <span class="text-danger">*</span></label>
                                        <input type="text" name="instance_name" class="form-control" placeholder="请输入实例名称">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>显示名称</label>
                                        <input type="text" name="display_name" class="form-control" placeholder="请输入显示名称（可选）">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>私有IP <span class="text-danger">*</span></label>
                                        <input type="text" name="private_ip" class="form-control" placeholder="请输入私有IP地址">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>公网IP</label>
                                        <input type="text" name="public_ip" class="form-control" placeholder="请输入公网IP地址（可选）">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>MAC地址</label>
                                        <input type="text" name="mac_address" class="form-control" placeholder="请输入MAC地址（可选）">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>操作系统类型</label>
                                        <select name="os_type" class="form-control">
                                            <option value="Linux">Linux</option>
                                            <option value="Windows">Windows</option>
                                            <option value="Other">其他</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>操作系统名称</label>
                                        <input type="text" name="os_name" class="form-control" placeholder="请输入操作系统名称（可选）">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>CPU核数</label>
                                        <input type="number" name="cpu" class="form-control" placeholder="请输入CPU核数" value="4">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>内存(GB)</label>
                                        <input type="number" name="memory" class="form-control" placeholder="请输入内存大小(GB)" value="8">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>实例类型</label>
                                        <input type="text" name="instance_type" class="form-control" placeholder="请输入实例类型（可选）">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>VPC ID</label>
                                        <input type="text" name="vpc_id" class="form-control" placeholder="请输入VPC ID（可选）">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label>VPC名称</label>
                                        <input type="text" name="vpc_name" class="form-control" placeholder="请输入VPC名称（可选）">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" onclick="saveHost()">保存</button>
                                        <button type="reset" class="btn btn-light">重置</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
        // 保存主机信息
        function saveHost() {
            var formData = $('#addForm').serialize();
            
            $.ajax({
                url: '{:url('asm/hostassets/saveIdcHost')}',
                type: 'post',
                data: formData,
                dataType: 'json',
                success: function(res) {
                    if (res.code == 1) {
                        alert('添加成功');
                        window.location.href = '{:url('asm/hostassets/index')}';
                    } else {
                        alert('添加失败：' + res.msg);
                    }
                },
                error: function() {
                    alert('网络错误，请稍后重试');
                }
            });
        }
        
        // 表单验证
        $('#addForm').on('submit', function(e) {
            e.preventDefault();
            saveHost();
        });
    </script>
</body>
</html>