{include file='public/head' /}
{include file='public/blackLeftMenu' /}

<!-- 页面标题 -->
<div class="flex justify-between items-start mb-6 p-6 pb-0">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 mb-2">Nuclei扫描结果</h1>
        <nav class="flex gap-2 text-sm text-slate-500">
            <a href="#" class="hover:text-blue-500 transition-colors">首页</a>
            <span class="text-slate-300">/</span>
            <a href="#" class="hover:text-blue-500 transition-colors">Web扫描</a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-700 font-medium">Nuclei扫描</span>
        </nav>
    </div>
</div>

<!-- 搜索区域 -->
<div class="bg-white border border-slate-200 rounded-2xl p-5 mb-6 mx-6 shadow-sm">
    <form method="get" action="<?php echo url('app_nuclei/index')?>">
        <div class="flex flex-wrap gap-4 items-end">
            <div class="flex flex-col gap-2">
                <label class="text-sm text-slate-600 font-medium">搜索</label>
                <input type="text" name="search" class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-700 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all w-[200px]" placeholder="搜索的内容">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-sm text-slate-600 font-medium">项目列表</label>
                <select name="app_id" class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all w-[180px]">
                    <option value="">项目列表</option>
                    <?php foreach ($projectList as $k => $v) { ?>
                        <option value="<?php echo $k ?>"><?php echo $v ?></option>
                    <?php } ?>
                </select>
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
                <a href="<?php echo url('app_nuclei/index')?>" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-medium hover:bg-slate-50 transition-all duration-200">
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
            <h2 class="text-lg font-bold text-slate-800">扫描结果</h2>
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
                    <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Name</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Host</th>
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
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-violet-50 text-violet-600 border border-violet-100">
                                <?php echo $value['app_name'] ?>
                            </span>
                        </td>
                        <td class="px-5 py-4 text-slate-600"><?php echo $value['name'] ?></td>
                        <td class="px-5 py-4 text-slate-500 text-sm font-mono"><?php echo $value['host'] ?></td>
                        <td class="px-5 py-4 text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

{include file='public/fenye' /}
{include file='public/footer' /}
