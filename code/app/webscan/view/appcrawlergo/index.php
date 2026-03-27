{include file='public/head' /}
{include file='public/blackLeftMenu' /}

<!-- 页面标题 -->
<div class="flex justify-between items-start mb-6 p-6 pb-0">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 mb-2">Crawlergo爬虫结果</h1>
        <nav class="flex gap-2 text-sm text-slate-500">
            <a href="#" class="hover:text-blue-500 transition-colors">首页</a>
            <span class="text-slate-300">/</span>
            <a href="#" class="hover:text-blue-500 transition-colors">Web扫描</a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-700 font-medium">Crawlergo爬虫</span>
        </nav>
    </div>
</div>

<?php
$searchArr = [
    'action' => url('app_crawlergo/index'),
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'label' => '搜索', 'placeholder' => '搜索的内容'],
        ['type' => 'select', 'name' => 'app_id', 'options' => $projectList, 'frist_option' => '项目列表'],
    ],
];
?>
{include file='public/search' /}

<!-- 表格区域 -->
<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm mx-6">
    <!-- 表头 -->
    <div class="flex justify-between items-center px-5 py-4 border-b border-slate-100 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <h2 class="text-lg font-bold text-slate-800">爬虫结果</h2>
        </div>
        <div class="flex gap-2">
            {include file='public/batch_del' /}
        </div>
    </div>

    <!-- 表格 -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="w-12 px-5 py-4 text-left">
                        <input type="checkbox" value="-1" onclick="quanxuan(this)" class="w-4 h-4 rounded border-slate-300 text-blue-500 focus:ring-blue-500/20 cursor-pointer">
                    </th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">ID</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">所属项目</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">URL</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">扫描时间</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php foreach ($list as $value) { ?>
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-5 py-4">
                            <input type="checkbox" class="ids w-4 h-4 rounded border-slate-300 text-blue-500 focus:ring-blue-500/20 cursor-pointer" name="ids[]" value="<?php echo $value['id'] ?>">
                        </td>
                        <td class="px-5 py-4 font-semibold text-slate-700"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-emerald-50 text-emerald-600 border border-emerald-100">
                                <?php echo $value['app_name'] ?>
                            </span>
                        </td>
                        <td class="px-5 py-4 text-slate-500 text-sm font-mono break-all max-w-md"><?php echo $value['url'] ?></td>
                        <td class="px-5 py-4 text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

{include file='public/fenye' /}
{include file='public/footer' /}
