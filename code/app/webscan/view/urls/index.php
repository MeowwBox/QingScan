{include file='public/head' /}
{include file='public/blackLeftMenu' /}

<?php
$searchArr = [
    'action' => $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'placeholder' => 'search'],
        ['type' => 'select', 'name' => 'app_id', 'options' => $projectList, 'frist_option' => '项目列表']
]];
?>
{include file='public/search' /}

<div class="bg-white border border-slate-200 rounded-2xl shadow-card overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <h2 class="text-lg font-bold text-slate-800">URL列表</h2>
            <span class="bg-blue-500 text-white text-xs px-2.5 py-1 rounded-full font-medium"><?php echo count($list) ?></span>
        </div>
        {include file='public/batch_del' /}
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-100 text-left">
                    <th class="w-16 px-4 py-3">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" value="-1" onclick="quanxuan(this)" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                            <span class="text-xs font-semibold text-slate-500 uppercase">全选</span>
                        </label>
                    </th>
                    <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">ID</th>
                    <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">所属项目</th>
                    <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">URL</th>
                    <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">创建时间</th>
                    <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase w-32">操作</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                <?php foreach ($list as $value) { ?>
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3">
                        <input type="checkbox" class="ids w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500" name="ids[]" value="<?php echo $value['id'] ?>">
                    </td>
                    <td class="px-4 py-3 text-slate-700 font-medium"><?php echo $value['id'] ?></td>
                    <td class="px-4 py-3 text-slate-700"><?php echo isset($projectList[$value['app_id']]) ? $projectList[$value['app_id']] : '-' ?></td>
                    <td class="px-4 py-3 text-slate-700 font-mono text-sm truncate max-w-md"><?php echo $value['url'] ?></td>
                    <td class="px-4 py-3 text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                    <td class="px-4 py-3">
                        <a href="<?php echo url('del', ['id' => $value['id']]) ?>" class="px-3 py-1.5 rounded-lg text-sm bg-red-50 text-red-600 hover:bg-red-100 transition-colors" onclick="return confirm('确定要删除吗?')">删除</a>
                    </td>
                </tr>
                <?php } ?>
                <?php if (empty($list)) { ?>
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-slate-500">暂无数据</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
        {include file='public/fenye' /}
    </div>
</div>

{include file='public/footer' /}
