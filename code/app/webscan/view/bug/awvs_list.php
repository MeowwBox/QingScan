{include file='public/head' /}
{include file='public/blackLeftMenu' /}
<?php
$dengjiArr = ['Low', 'Medium', 'High', 'Critical'];
?>

<!-- 页面标题 -->
<div class="flex justify-between items-start mb-6 p-6 pb-0">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 mb-2">AWVS漏洞列表</h1>
        <nav class="flex gap-2 text-sm text-slate-500">
            <a href="#" class="hover:text-blue-500 transition-colors">首页</a>
            <span class="text-slate-300">/</span>
            <a href="#" class="hover:text-blue-500 transition-colors">Web扫描</a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-700 font-medium">AWVS漏洞</span>
        </nav>
    </div>
    <div class="flex gap-3">
        <button onclick="batchDel()" class="px-4 py-2.5 rounded-xl border border-red-200 text-red-500 font-medium hover:bg-red-50 transition-all duration-200">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                批量删除
            </span>
        </button>
    </div>
</div>

<!-- 搜索区域 -->
<div class="bg-white border border-slate-200 rounded-2xl p-5 mb-6 mx-6 shadow-sm">
    <form method="get" action="">
        <div class="flex flex-wrap gap-4 items-end">
            <div class="flex flex-col gap-2">
                <label class="text-sm text-slate-600 font-medium">搜索</label>
                <input type="text" name="search" class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-700 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all w-[180px]" placeholder="搜索的内容">
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-sm text-slate-600 font-medium">危险等级</label>
                <select name="Folder" class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all w-[140px]">
                    <option value="">危险等级</option>
                    <?php foreach ($dengjiArr as $v) { ?>
                        <option value="<?php echo $v ?>"><?php echo $v ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-sm text-slate-600 font-medium">漏洞类别</label>
                <select name="Category" class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all w-[160px]">
                    <option value="">漏洞类别</option>
                    <?php foreach ($CategoryList as $k => $v) { ?>
                        <option value="<?php echo $k ?>"><?php echo $v ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-sm text-slate-600 font-medium">URL筛选</label>
                <select name="Primary_filename" class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all w-[160px]">
                    <option value="">URL筛选</option>
                    <?php foreach ($fileList as $k => $v) { ?>
                        <option value="<?php echo $k ?>"><?php echo $v ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-sm text-slate-600 font-medium">项目列表</label>
                <select name="app_id" class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all w-[160px]">
                    <option value="">项目列表</option>
                    <?php foreach ($projectList as $k => $v) { ?>
                        <option value="<?php echo $k ?>"><?php echo $v ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="flex flex-col gap-2">
                <label class="text-sm text-slate-600 font-medium">审计状态</label>
                <select name="check_status" class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all w-[140px]">
                    <option value="">审计状态</option>
                    <option value="0">未审核</option>
                    <option value="1">有效漏洞</option>
                    <option value="2">无效漏洞</option>
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
            </div>
        </div>
    </form>
</div>

<!-- 表格区域 -->
<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm mx-6">
    <!-- 表头 -->
    <div class="flex justify-between items-center px-5 py-4 border-b border-slate-100 bg-slate-50/50">
        <div class="flex items-center gap-3">
            <h2 class="text-lg font-bold text-slate-800">漏洞列表</h2>
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
                    <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Severity</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">URL</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">发现时间</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">状态</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">操作</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php foreach ($list as $value) {
                    $severityColors = [
                        'Critical' => 'bg-red-50 text-red-600 border-red-100',
                        'High' => 'bg-orange-50 text-orange-600 border-orange-100',
                        'Medium' => 'bg-amber-50 text-amber-600 border-amber-100',
                        'Low' => 'bg-sky-50 text-sky-600 border-sky-100',
                    ];
                    $severityClass = $severityColors[$value['vt_name']] ?? 'bg-slate-50 text-slate-600 border-slate-100';
                ?>
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-5 py-4">
                            <input type="checkbox" class="ids w-4 h-4 rounded border-slate-300 text-blue-500 focus:ring-blue-500/20 cursor-pointer" name="ids[]" value="<?php echo $value['id'] ?>">
                        </td>
                        <td class="px-5 py-4 font-semibold text-slate-700"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-violet-50 text-violet-600 border border-violet-100">
                                <?php echo isset($projectList[$value['app_id']]) ? $projectList[$value['app_id']] : '' ?>
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold <?php echo $severityClass ?> border">
                                <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                <?php echo $value['vt_name'] ?>
                            </span>
                        </td>
                        <td class="px-5 py-4 text-slate-500 text-sm font-mono break-all max-w-xs"><?php echo $value['affects_url'] ?></td>
                        <td class="px-5 py-4 text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                        <td class="px-5 py-4">
                            <select class="changCheckStatus bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-sm focus:border-blue-500 focus:outline-none transition-all" data-id="<?php echo $value['id'] ?>">
                                <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                                <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                                <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                            </select>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex gap-1">
                                <a href="<?php echo url('code_check/bug_detail',['id'=>$value['id']])?>" class="w-9 h-9 rounded-xl bg-slate-100 text-blue-500 hover:bg-blue-50 transition-colors flex items-center justify-center" title="查看漏洞">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="<?php echo url('bug/awvs_del',['id'=>$value['id']])?>" class="w-9 h-9 rounded-xl bg-slate-100 text-red-500 hover:bg-red-50 transition-colors flex items-center justify-center" title="删除">
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

<input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/awvs')?>">
<input type="hidden" id="batch_del_url" value="<?php echo url('awvs_batch_del')?>">

{include file='public/to_examine' /}
{include file='public/fenye' /}
{include file='public/footer' /}
