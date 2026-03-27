{include file='public/head' /}
{include file='public/blackLeftMenu' /}
<main class="p-6 min-h-screen">
    <!-- 页面标题 -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800 mb-2">Hydra 暴力破解结果</h1>
        <nav class="flex gap-2 text-sm text-slate-500">
            <a href="/" class="hover:text-blue-500 transition-colors">首页</a>
            <span class="text-slate-300">/</span>
            <a href="#" class="hover:text-blue-500 transition-colors">Web扫描</a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-700 font-medium">Hydra</span>
        </nav>
    </div>

    <?php
    $searchArr = [
        'action' => url('hydra/index'),
        'method' => 'get',
        'inputs' => [
            ['type' => 'text', 'name' => 'search', 'placeholder' => '搜索的内容'],
            ['type' => 'select', 'name' => 'app_id', 'options' => $projectList, 'frist_option' => '项目列表'],
    ]];
    ?>
    {include file='public/search' /}

    <!-- 表格卡片 -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="flex justify-between items-center px-5 py-4 border-b border-slate-100 bg-slate-50">
            <div class="flex items-center gap-3">
                <h2 class="text-lg font-bold text-slate-800">破解结果列表</h2>
                <span class="bg-blue-500 text-white text-xs px-2.5 py-1 rounded-full font-medium"><?php echo count($list) ?? 0 ?></span>
            </div>
            {include file='public/batch_del' /}
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="w-12 px-5 py-4 text-left">
                            <input type="checkbox" value="-1" onclick="quanxuan(this)" class="w-4 h-4 rounded border-slate-300 text-blue-500 focus:ring-blue-200 cursor-pointer">
                        </th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">所属项目</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Host</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Type</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Username</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">时间</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($list as $value) { ?>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-4">
                            <input type="checkbox" class="ids w-4 h-4 rounded border-slate-300 text-blue-500 focus:ring-blue-200 cursor-pointer" name="ids[]" value="<?php echo $value['id'] ?>">
                        </td>
                        <td class="px-5 py-4 font-semibold text-slate-700"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4 text-slate-600"><?php echo $projectList[$value['app_id']]['name'] ?></td>
                        <td class="px-5 py-4">
                            <span class="font-mono text-sm bg-slate-100 px-2 py-1 rounded text-slate-700"><?php echo $value['host'] ?></span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-violet-50 text-violet-600 border border-violet-100">
                                <?php echo $value['type'] ?>
                            </span>
                        </td>
                        <td class="px-5 py-4 text-slate-700 font-medium"><?php echo $value['username'] ?></td>
                        <td class="px-5 py-4 text-slate-500 text-sm"><?php echo date('Y-m-d H:i:s', substr($value['create_time'],0,10)) ?></td>
                        <td class="px-5 py-4">
                            <a href="<?php echo url('hydra/del',['id'=>$value['id']])?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                删除
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- 分页 -->
        <div class="flex justify-between items-center px-5 py-4 border-t border-slate-100 bg-slate-50">
            <div class="text-sm text-slate-500">
                共找到相关记录
            </div>
            {include file='public/fenye' /}
        </div>
    </div>

    <input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/xray')?>">
    {include file='public/to_examine' /}
</main>
{include file='public/footer' /}
