{include file='public/head' /}
{include file='public/blackLeftMenu' /}
<?php
$dengjiArr = ['Low', 'Medium', 'High', 'Critical'];
?>

<!-- 页面标题 -->
<div class="flex justify-between items-start mb-6 p-6 pb-0">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 mb-2">GitHub关键字监控</h1>
        <nav class="flex gap-2 text-sm text-slate-500">
            <a href="#" class="hover:text-blue-500 transition-colors">首页</a>
            <span class="text-slate-300">/</span>
            <a href="#" class="hover:text-blue-500 transition-colors">Web扫描</a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-700 font-medium">关键字列表</span>
        </nav>
    </div>
    <div class="flex gap-3">
        <a href="<?php echo url('add')?>" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold hover:shadow-lg transition-all duration-200 shadow-md">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                添加关键字
            </span>
        </a>
    </div>
</div>

<!-- 搜索区域 -->
<div class="bg-white border border-slate-200 rounded-2xl p-5 mb-6 mx-6 shadow-sm">
    <form method="get" action="">
        <div class="flex flex-wrap gap-4 items-end">
            <div class="flex flex-col gap-2">
                <label class="text-sm text-slate-600 font-medium">搜索</label>
                <input type="text" name="search" class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-700 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all w-[240px]" placeholder="search">
            </div>
            <div class="flex gap-3">
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold hover:shadow-lg transition-all duration-200">
                    <span class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        查询
                    </span>
                </button>
                <a href="<?php echo url('index')?>" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-medium hover:bg-slate-50 transition-all duration-200">
                    重置
                </a>
            </div>
        </div>
    </form>
</div>

<!-- 表格区域 -->
<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm mx-6">
    <!-- 表头 -->
    <div class="flex justify-between items-center px-5 py-4 border-b border-slate-100 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <h2 class="text-lg font-bold text-slate-800">关键字列表</h2>
            <span class="bg-blue-500 text-white text-xs px-2.5 py-1 rounded-full font-medium"><?php echo count($list) ?></span>
        </div>
    </div>

    <!-- 表格 -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">ID</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">关键字</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">添加时间</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">操作</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php foreach ($list as $value) { ?>
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-slate-700"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4 text-slate-600"><?php echo $value['title'] ?></td>
                        <td class="px-5 py-4 text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                        <td class="px-5 py-4">
                            <div class="flex gap-1">
                                <a href="<?php echo url('del',['id'=>$value['id']])?>" class="w-9 h-9 rounded-xl bg-slate-100 text-red-500 hover:bg-red-50 transition-colors flex items-center justify-center" title="删除">
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

{include file='public/fenye' /}
{include file='public/footer' /}
