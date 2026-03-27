{include file='public/head' /}
{include file='public/blackLeftMenu' /}

<?php
$searchArr = [
    'action' => url('one_for_all/index'),
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'placeholder' => "搜索的内容"],
        ['type' => 'select', 'name' => 'app_id', 'options' => $projectList, 'frist_option' => '项目列表'],
    ]];
?>
{include file='public/search' /}

<div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mt-4 mx-3">
    <!-- 表头 -->
    <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
        <div class="flex items-center gap-3">
            <h2 class="text-lg font-bold text-text-primary">子域名扫描结果</h2>
            <span class="bg-primary text-white text-xs px-2.5 py-1 rounded-full font-medium"><?php echo count($list) ?></span>
        </div>
        <div class="flex gap-2">
            {include file='public/batch_del' /}
        </div>
    </div>

    <!-- 表格 -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-surface-100">
                    <th class="w-16 px-5 py-4 text-left">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" value="-1" onclick="quanxuan(this)" class="w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20">
                            <span class="text-xs font-semibold text-text-secondary uppercase tracking-wider">全选</span>
                        </label>
                    </th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">所属项目</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">域名</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">端口</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">IP</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">状态</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">创建时间</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">操作</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-200">
                <?php foreach ($list as $value) { ?>
                <tr class="hover:bg-surface-50 transition-colors">
                    <td class="px-5 py-4">
                        <input type="checkbox" class="ids w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20 cursor-pointer" name="ids[]" value="<?php echo $value['id'] ?>">
                    </td>
                    <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                    <td class="px-5 py-4 text-text-secondary"><?php echo $value['app_name'] ?></td>
                    <td class="px-5 py-4">
                        <span class="font-mono text-sm text-primary"><?php echo $value['subdomain'] ?></span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-violet-50 text-violet-600 border border-violet-100">
                            <?php echo $value['port'] ?>
                        </span>
                    </td>
                    <td class="px-5 py-4 text-text-secondary font-mono text-sm"><?php echo $value['ip'] ?></td>
                    <td class="px-5 py-4">
                        <?php
                        $statusClass = '';
                        $statusText = $value['status'];
                        if (strpos($statusText, 'active') !== false || strpos($statusText, '200') !== false) {
                            $statusClass = 'bg-emerald-50 text-emerald-600 border-emerald-100';
                        } elseif (strpos($statusText, 'error') !== false || strpos($statusText, '404') !== false) {
                            $statusClass = 'bg-red-50 text-red-600 border-red-100';
                        } else {
                            $statusClass = 'bg-amber-50 text-amber-600 border-amber-100';
                        }
                        ?>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold border <?php echo $statusClass ?>">
                            <?php echo $value['status'] ?>
                        </span>
                    </td>
                    <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
                    <td class="px-5 py-4">
                        <div class="flex gap-1">
                            <a href="<?php echo url('one_for_all/del',['id'=>$value['id']])?>" class="w-9 h-9 rounded-xl bg-surface-100 text-red-500 hover:bg-red-50 transition-colors flex items-center justify-center" title="删除" onclick="return confirm('确定要删除吗？')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/xray')?>">

{include file='public/to_examine' /}
{include file='public/fenye' /}
{include file='public/footer' /}
