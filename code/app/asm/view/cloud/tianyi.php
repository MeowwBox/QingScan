{include file='public/head' /}
<div class="col-md-1 " style="padding-right: 0;" >
    {include file='public/asmLeftMenu' /}
</div>
<div class="col-md-11 " style="padding:0;">

    <div class="col-md-12 ">
        <div class="row tuchu">
            <div class="col-md-12 ">
                {include file='cloud/cloud_sub_menu' /}
                
                <!-- 团队筛选 -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <form action="{:url('asm/cloud/tianyi')}" method="get" class="form-inline">
                            <div class="form-group mr-2">
                                <label for="team_id" class="mr-2">团队筛选:</label>
                                <select name="team_id" id="team_id" class="form-control" onchange="this.form.submit()">
                                    <option value="all" {:$current_team == 'all' ? 'selected' : ''}>所有团队</option>
                                    <option value="A" {:$current_team == 'A' ? 'selected' : ''}>A团队</option>
                                    <option value="B" {:$current_team == 'B' ? 'selected' : ''}>B团队</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>团队</th>
                        <th>资源名称</th>
                        <th>资源类型</th>
                        <th>地域</th>
                        <th>状态</th>
                        <th>公网IP</th>
                        <th>私网IP</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <?php foreach ($list as $item) { ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo $item['team_id']; ?></td>
                        <td><?php echo $item['resource_name']; ?></td>
                        <td><?php echo $item['resource_type']; ?></td>
                        <td><?php echo $item['region']; ?></td>
                        <td><?php echo $item['status']; ?></td>
                        <td><?php echo $item['public_ip']; ?></td>
                        <td><?php echo $item['private_ip']; ?></td>
                        <td><?php echo $item['create_time']; ?></td>
                        <td></td>
                    </tr>
                    <?php } ?>
                </table>
                {include file='public/fenye' /}
            </div>
        </div>
    </div>
</div>

{include file='public/footer' /}