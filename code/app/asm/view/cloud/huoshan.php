{include file='public/head' /}
{include file='public/asmLeftMenu' /}

    <div class="bg-white rounded-2xl border border-surface-300 shadow-sm m-4 p-5">
        {include file='cloud/cloud_sub_menu' /}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-surface-100">
                <tr>
                    <th class="px-4 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                    <th class="px-4 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">资源名称</th>
                    <th class="px-4 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">资源类型</th>
                    <th class="px-4 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">地域</th>
                    <th class="px-4 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">状态</th>
                    <th class="px-4 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">公网IP</th>
                    <th class="px-4 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">私网IP</th>
                    <th class="px-4 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">创建时间</th>
                    <th class="px-4 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">操作</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                <?php foreach ($list as $item) { ?>
                <tr class="hover:bg-surface-50 transition-colors">
                    <td class="px-4 py-4 text-text-primary"><?php echo $item['id']; ?></td>
                    <td class="px-4 py-4 text-text-primary font-medium"><?php echo $item['resource_name']; ?></td>
                    <td class="px-4 py-4 text-text-secondary"><?php echo $item['resource_type']; ?></td>
                    <td class="px-4 py-4 text-text-secondary"><?php echo $item['region']; ?></td>
                    <td class="px-4 py-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-100">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                            <?php echo $item['status']; ?>
                        </span>
                    </td>
                    <td class="px-4 py-4 text-text-secondary font-mono text-sm"><?php echo $item['public_ip']; ?></td>
                    <td class="px-4 py-4 text-text-secondary font-mono text-sm"><?php echo $item['private_ip']; ?></td>
                    <td class="px-4 py-4 text-text-muted text-sm"><?php echo $item['create_time']; ?></td>
                    <td class="px-4 py-4"></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        {include file='public/fenye' /}
    </div>

{include file='public/footer' /}
