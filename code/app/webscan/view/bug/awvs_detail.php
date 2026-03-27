{include file='public/head' /}
{include file='public/blackLeftMenu' /}
<?php
$dengjiArr = ['Low', 'Medium', 'High', 'Critical'];
?>

<!-- 页面标题 -->
<div class="flex justify-between items-start mb-6 p-6 pb-0">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 mb-2">AWVS漏洞详情</h1>
        <nav class="flex gap-2 text-sm text-slate-500">
            <a href="#" class="hover:text-blue-500 transition-colors">首页</a>
            <span class="text-slate-300">/</span>
            <a href="<?php echo url('bug/awvs_list')?>" class="hover:text-blue-500 transition-colors">AWVS漏洞列表</a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-700 font-medium">详情</span>
        </nav>
    </div>
    <div class="flex gap-3">
        <a href="<?php echo url('bug/awvs_list')?>" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-medium hover:bg-slate-50 transition-all duration-200">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                返回列表
            </span>
        </a>
    </div>
</div>

<!-- 详情卡片 -->
<div class="bg-white border border-slate-200 rounded-2xl shadow-sm mx-6 mb-6">
    <div class="px-6 py-4 border-b border-slate-100">
        <h3 class="text-lg font-semibold text-slate-800">基本信息</h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-2 gap-6">
            <?php foreach ($detail as $key => $item) {
                if (!in_array($key, ['id', 'affects_url', 'vt_name', 'details', 'recommendation', 'description'])) continue;
                $labelColors = [
                    'id' => 'text-slate-500',
                    'affects_url' => 'text-slate-500',
                    'vt_name' => 'text-slate-500',
                    'details' => 'text-slate-500',
                    'recommendation' => 'text-slate-500',
                    'description' => 'text-slate-500',
                ];
            ?>
                <div class="bg-slate-50 rounded-xl p-4">
                    <span class="text-xs text-slate-400 uppercase tracking-wider"><?php echo $key ?></span>
                    <div class="mt-1 font-medium text-slate-700"><?php echo empty($item) ? '-' : $item; ?></div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- 请求包 -->
<div class="bg-white border border-slate-200 rounded-2xl shadow-sm mx-6 mb-6">
    <div class="px-6 py-4 border-b border-slate-100">
        <h3 class="text-lg font-semibold text-slate-800">请求包</h3>
    </div>
    <div class="p-6">
        <textarea class="w-full bg-slate-800 text-slate-300 font-mono text-sm rounded-xl px-4 py-3 focus:outline-none resize-none" rows="8" disabled><?php echo rtrim($detail['request']) ?></textarea>
    </div>
</div>

<!-- AI解读 -->
<div class="bg-white border border-slate-200 rounded-2xl shadow-sm mx-6 mb-6">
    <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2">
        <h3 class="text-lg font-semibold text-slate-800">AI解读</h3>
        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium bg-blue-50 text-blue-600 border border-blue-100">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            AI
        </span>
    </div>
    <div class="p-6">
        <textarea class="w-full bg-slate-50 border border-slate-200 text-slate-600 font-mono text-sm rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 resize-none" rows="8" disabled></textarea>
    </div>
</div>

{include file='public/footer' /}
