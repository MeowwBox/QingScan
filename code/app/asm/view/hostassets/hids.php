{include file='public/head' /}
<div class="col-md-1 " style="padding-right: 0;" >
    {include file='public/asmLeftMenu' /}
</div>
<div class="col-md-11 " style="padding:0;">

<!-- HIDS列表 -->
<?php
$searchArr = [
    'action' =>  $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'keyword', 'placeholder' => "IP地址/主机名"]
    ]]; ?>
{include file='public/search' /}

<div class="row tuchu">
    <div class="col-md-12 ">

        <!-- 引入子菜单 -->
        {include file='hostassets/sub_menu' /}

        <table class="table  table-hover">
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
                    <td>
                        <span class="badge <?php 
                            switch($value['online_status']) {
                                case '在线': echo 'bg-success bg-light text-success'; break;
                                case '离线': echo 'bg-danger bg-light text-danger'; break;
                                default: echo 'bg-light text-dark';
                            }
                        ?>">
                            <?php echo $value['online_status'] ?? '-' ?>
                        </span>
                    </td>
                    <td><?php echo $value['sync_time'] ?? '-' ?></td>
                    <td>
                        <a href="<?php echo url('asm/hostassets/hidsDetail', ['id' => $value['id']]) ?>" class="btn btn-sm btn-outline-secondary">查看详情</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

{include file='public/fenye' /}</div>
{include file='public/footer' /}