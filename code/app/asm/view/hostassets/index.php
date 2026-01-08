{include file='public/head' /}
<div class="col-md-1 " style="padding-right: 0;" >
    {include file='public/asmLeftMenu' /}
</div>
<div class="col-md-11 " style="padding:0;">

<!-- Tab切换 -->
<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link <?php echo (empty($tab) || $tab == 'host') ? 'active' : '' ?>" href="<?php echo url('asm/hostassets/index', array_merge($_GET ?? [], ['tab' => 'host'])) ?>">主机汇总列表</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($tab == 'hids') ? 'active' : '' ?>" href="<?php echo url('asm/hostassets/index', array_merge($_GET ?? [], ['tab' => 'hids'])) ?>">HIDS列表</a>
    </li>
</ul>

<!-- 主机汇总列表 -->
<?php if (empty($tab) || $tab == 'host'): ?>
<?php
$searchArr = [
    'action' =>  $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'keyword', 'placeholder' => "实例名称/IP地址"],
        ['type' => 'select', 'name' => 'cloud_platform', 'options' => $platforms, 'frist_option' => '云平台'],
        ['type' => 'select', 'name' => 'status', 'options' => $instance_status, 'frist_option' => '实例状态'],
        ['type' => 'select', 'name' => 'hids_installed', 'options' => $hids_status, 'frist_option' => 'HIDS状态']
    ]]; ?>
{include file='public/search' /}

<div class="row tuchu">
    <div class="col-md-12 ">
        <table class="table  table-hover table-sm table-borderless">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>实例名称</th>
                <th>显示名称</th>
                <th>云平台</th>
                <th>状态</th>
                <th>私有IP</th>
                <th>公网IP</th>
                <th>HIDS状态</th>
                <th>创建时间</th>
                <th style="width: 200px">操作</th>
            </tr>
            </thead>
            <?php foreach ($list as $value) { ?>
                <tr>
                    <td><?php echo $value['id'] ?></td>
                    <td><?php echo $value['instance_name'] ?></td>
                    <td><?php echo $value['display_name'] ?></td>
                    <td><?php echo $platforms[$value['cloud_platform']] ?></td>
                    <td><?php echo $instance_status[$value['status']] ?? $value['status'] ?></td>
                    <td><?php echo $value['private_ip'] ?></td>
                    <td><?php echo $value['public_ip'] ?></td>
                    <td><?php echo $value['hids_installed'] ? '已安装' : '未安装' ?></td>
                    <td><?php echo $value['create_time'] ?></td>
                    <td>
                        <a href="<?php echo url('asm/hostassets/detail', ['id' => $value['id']]) ?>" class="btn btn-sm btn-outline-secondary">查看详情</a>
                        <?php if ($value['cloud_platform'] == 'idc') { ?>
                            <a href="<?php echo url('asm/hostassets/edit', ['id' => $value['id']]) ?>" class="btn btn-sm btn-outline-primary">编辑</a>
                            <a href="#" class="btn btn-sm btn-outline-danger" onclick="deleteHost(<?php echo $value['id'] ?>)">删除</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<!-- HIDS列表 -->
<?php elseif ($tab == 'hids'): ?>
<?php
$searchArr = [
    'action' =>  $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'keyword', 'placeholder' => "IP地址/实例名称"]
    ]]; ?>
{include file='public/search' /}

<div class="row tuchu">
    <div class="col-md-12 ">
        <table class="table  table-hover table-sm table-borderless">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>IP地址</th>
                <th>实例名称</th>
                <th>主机名</th>
                <th>操作系统</th>
                <th>内核版本</th>
                <th>在线状态</th>
                <th>最后同步时间</th>
                <th style="width: 200px">操作</th>
            </tr>
            </thead>
            <?php foreach ($hids_list as $value) { ?>
                <tr>
                    <td><?php echo $value['id'] ?></td>
                    <td><?php echo $value['ip_address'] ?></td>
                    <td><?php echo $value['instance_name'] ?? '-' ?></td>
                    <td><?php echo $value['hostname'] ?? '-' ?></td>
                    <td><?php echo $value['os_name'] ?? '-' ?></td>
                    <td><?php echo $value['kernel_version'] ?? '-' ?></td>
                    <td><?php echo $value['online_status'] ?? '-' ?></td>
                    <td><?php echo $value['sync_time'] ?? '-' ?></td>
                    <td>
                        <a href="<?php echo url('asm/hostassets/hidsDetail', ['id' => $value['id']]) ?>" class="btn btn-sm btn-outline-secondary">查看详情</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<?php endif; ?>

{include file='public/fenye' /}</div>
<script>
function deleteHost(id) {
    if (confirm('确定要删除该主机吗？')) {
        $.ajax({
            url: '<?php echo url('asm/hostassets/delete') ?>',
            type: 'post',
            data: {id: id},
            dataType: 'json',
            success: function(res) {
                if (res.code == 1) {
                    alert(res.msg);
                    window.location.reload();
                } else {
                    alert(res.msg);
                }
            }
        });
    }
}
</script>
{include file='public/footer' /}