{include file='public/head' /}
{include file='public/blackLeftMenu' /}

<!-- 页面标题 -->
<div class="flex justify-between items-start mb-6 p-6 pb-0">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 mb-2">指纹识别结果</h1>
        <nav class="flex gap-2 text-sm text-slate-500">
            <a href="#" class="hover:text-blue-500 transition-colors">首页</a>
            <span class="text-slate-300">/</span>
            <a href="#" class="hover:text-blue-500 transition-colors">Web扫描</a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-700 font-medium">指纹识别</span>
        </nav>
    </div>
</div>

<?php
$searchArr = [
    'action' => url('index'),
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'label' => '搜索', 'placeholder' => '搜索内容'],
    ],
];
?>
{include file='public/search' /}

<!-- 表格区域 -->
<div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mx-6">
    <!-- 表头 -->
    <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
        <div class="flex items-center gap-3">
            <h2 class="text-lg font-bold text-text-primary">指纹识别结果</h2>
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
                    <th class="w-12 px-5 py-4 text-left">
                        <input type="checkbox" value="-1" onclick="quanxuan(this)" class="w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20 cursor-pointer">
                    </th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">添加者</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">添加时间</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">过滤器</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">关键字</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">MD5</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">供应商</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">标签</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">标题</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-200">
                <?php foreach ($list as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4">
                            <input type="checkbox" class="ids w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20 cursor-pointer" name="ids[]" value="<?php echo $value['id'] ?>">
                        </td>
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['add_by'] ?></td>
                        <td class="px-5 py-4 text-text-muted text-sm"><?php echo date('Y-m-d H:i:s',substr($value['add_time'],0,10)) ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['filters'] ?></td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-primary-light text-primary border border-blue-100">
                                <?php echo $value['keyword'] ?>
                            </span>
                        </td>
                        <td class="px-5 py-4 text-text-muted text-sm font-mono"><?php echo $value['md5'] ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['supplier'] ?></td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-violet-50 text-violet-600 border border-violet-100">
                                <?php echo $value['tags'] ?>
                            </span>
                        </td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['title'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

{include file='public/fenye' /}
{include file='public/footer' /}
