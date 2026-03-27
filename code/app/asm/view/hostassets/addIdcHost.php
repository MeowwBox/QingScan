{include file='public/head' /}
{include file='public/asmLeftMenu' /}
<style>
    .form-wrapper {
        padding: 24px;
        background: #f8fafc;
        min-height: calc(100vh - 64px);
    }
    .form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 32px;
        max-width: 600px;
        margin: 0 auto;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
    }
    .form-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid #e2e8f0;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
    }
    .form-control {
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
    .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .form-control::placeholder {
        color: #94a3b8;
    }
    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
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
    }
    .btn-primary:hover {
        box-shadow: 0 4px 12px -2px rgb(0 0 0 / 0.1);
        transform: translateY(-1px);
    }
    .btn-outline {
        background: transparent;
        color: #64748b;
        border: 1px solid #cbd5e1;
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
    .btn-outline:hover {
        background: #f8fafc;
        border-color: #3b82f6;
        color: #3b82f6;
    }
</style>
<div class="form-wrapper">
    <div class="max-w-7xl mx-auto px-4">
        <div class="w-full md:w-1/2 mx-auto">
            <div class="form-card">
                <h1 class="form-title">添加线下IDC主机</h1>
                <form method="post" action="<?php echo url('asm/hostassets/saveIdcHost') ?>">
                    <div class="form-group">
                        <label class="form-label">实例名称 <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="instance_name" class="form-control" placeholder="请输入实例名称" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">显示名称</label>
                        <input type="text" name="display_name" class="form-control" placeholder="请输入显示名称">
                    </div>

                    <div class="form-group">
                        <label class="form-label">私有IP <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="private_ip" class="form-control" placeholder="请输入私有IP" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">公网IP</label>
                        <input type="text" name="public_ip" class="form-control" placeholder="请输入公网IP">
                    </div>

                    <div class="form-group">
                        <label class="form-label">MAC地址</label>
                        <input type="text" name="mac_address" class="form-control" placeholder="请输入MAC地址">
                    </div>

                    <div class="form-group">
                        <label class="form-label">操作系统类型</label>
                        <input type="text" name="os_type" class="form-control" placeholder="请输入操作系统类型">
                    </div>

                    <div class="form-group">
                        <label class="form-label">操作系统名称</label>
                        <input type="text" name="os_name" class="form-control" placeholder="请输入操作系统名称">
                    </div>

                    <div class="form-group">
                        <label class="form-label">CPU</label>
                        <input type="text" name="cpu" class="form-control" placeholder="请输入CPU">
                    </div>

                    <div class="form-group">
                        <label class="form-label">内存</label>
                        <input type="text" name="memory" class="form-control" placeholder="请输入内存">
                    </div>

                    <div class="form-group">
                        <label class="form-label">实例类型</label>
                        <input type="text" name="instance_type" class="form-control" placeholder="请输入实例类型">
                    </div>

                    <div class="form-group">
                        <label class="form-label">VPC ID</label>
                        <input type="text" name="vpc_id" class="form-control" placeholder="请输入VPC ID">
                    </div>

                    <div class="form-group">
                        <label class="form-label">VPC名称</label>
                        <input type="text" name="vpc_name" class="form-control" placeholder="请输入VPC名称">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 4v16m8-8H4"/>
                            </svg>
                            提交
                        </button>
                        <a href="<?php echo url('asm/hostassets/index') ?>" class="btn-outline">返回</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{include file='public/footer' /}
