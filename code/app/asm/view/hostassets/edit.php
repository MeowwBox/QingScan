{include file='public/head' /}
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 tuchu">
        <h1>编辑线下IDC主机</h1>
        <form method="post" action="<?php echo url('asm/hostassets/update', ['id' => $host['id']]) ?>">
            <input type="hidden" name="id" value="<?php echo $host['id'] ?>">
            <div class="mb-3">
                <label class="form-label">实例名称</label>
                <input type="text" name="instance_name" class="form-control" value="<?php echo $host['instance_name'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">显示名称</label>
                <input type="text" name="display_name" class="form-control" value="<?php echo $host['display_name'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">私有IP</label>
                <input type="text" name="private_ip" class="form-control" value="<?php echo $host['private_ip'] ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">公网IP</label>
                <input type="text" name="public_ip" class="form-control" value="<?php echo $host['public_ip'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">MAC地址</label>
                <input type="text" name="mac_address" class="form-control" value="<?php echo $host['mac_address'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">操作系统类型</label>
                <input type="text" name="os_type" class="form-control" value="<?php echo $host['os_type'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">操作系统名称</label>
                <input type="text" name="os_name" class="form-control" value="<?php echo $host['os_name'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">CPU</label>
                <input type="text" name="cpu" class="form-control" value="<?php echo $host['cpu'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">内存</label>
                <input type="text" name="memory" class="form-control" value="<?php echo $host['memory'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">实例类型</label>
                <input type="text" name="instance_type" class="form-control" value="<?php echo $host['instance_type'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">VPC ID</label>
                <input type="text" name="vpc_id" class="form-control" value="<?php echo $host['vpc_id'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">VPC名称</label>
                <input type="text" name="vpc_name" class="form-control" value="<?php echo $host['vpc_name'] ?>">
            </div>
            <button type="submit" class="btn btn-sm btn-outline-secondary">更新</button>
            <a href="<?php echo url('asm/hostassets/index') ?>" class="btn btn-sm btn-outline-secondary">返回</a>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>
{include file='public/footer' /}