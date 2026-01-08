{include file='public/head' /}
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 tuchu">
        <h1>添加线下IDC主机</h1>
        <form method="post" action="<?php echo url('asm/hostassets/saveIdcHost') ?>">
            <div class="mb-3">
                <label class="form-label">实例名称</label>
                <input type="text" name="instance_name" class="form-control" placeholder="实例名称" required>
            </div>
            <div class="mb-3">
                <label class="form-label">显示名称</label>
                <input type="text" name="display_name" class="form-control" placeholder="显示名称">
            </div>
            <div class="mb-3">
                <label class="form-label">私有IP</label>
                <input type="text" name="private_ip" class="form-control" placeholder="私有IP" required>
            </div>
            <div class="mb-3">
                <label class="form-label">公网IP</label>
                <input type="text" name="public_ip" class="form-control" placeholder="公网IP">
            </div>
            <div class="mb-3">
                <label class="form-label">MAC地址</label>
                <input type="text" name="mac_address" class="form-control" placeholder="MAC地址">
            </div>
            <div class="mb-3">
                <label class="form-label">操作系统类型</label>
                <input type="text" name="os_type" class="form-control" placeholder="操作系统类型">
            </div>
            <div class="mb-3">
                <label class="form-label">操作系统名称</label>
                <input type="text" name="os_name" class="form-control" placeholder="操作系统名称">
            </div>
            <div class="mb-3">
                <label class="form-label">CPU</label>
                <input type="text" name="cpu" class="form-control" placeholder="CPU">
            </div>
            <div class="mb-3">
                <label class="form-label">内存</label>
                <input type="text" name="memory" class="form-control" placeholder="内存">
            </div>
            <div class="mb-3">
                <label class="form-label">实例类型</label>
                <input type="text" name="instance_type" class="form-control" placeholder="实例类型">
            </div>
            <div class="mb-3">
                <label class="form-label">VPC ID</label>
                <input type="text" name="vpc_id" class="form-control" placeholder="VPC ID">
            </div>
            <div class="mb-3">
                <label class="form-label">VPC名称</label>
                <input type="text" name="vpc_name" class="form-control" placeholder="VPC名称">
            </div>
            <button type="submit" class="btn btn-sm btn-outline-secondary">提交</button>
            <a href="<?php echo url('asm/hostassets/index') ?>" class="btn btn-sm btn-outline-secondary">返回</a>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
{include file='public/footer' /}