{include file='public/head' /}
{include file='public/blackLeftMenu' /}

<!-- 页面标题 -->
<div class="flex justify-between items-start mb-6 p-6 pb-0">
    <div>
        <h1 class="text-2xl font-bold text-slate-800 mb-2">添加关键字</h1>
        <nav class="flex gap-2 text-sm text-slate-500">
            <a href="#" class="hover:text-blue-500 transition-colors">首页</a>
            <span class="text-slate-300">/</span>
            <a href="<?php echo url('index')?>" class="hover:text-blue-500 transition-colors">GitHub关键字监控</a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-700 font-medium">添加</span>
        </nav>
    </div>
</div>

<!-- 表单区域 -->
<div class="bg-white border border-slate-200 rounded-2xl shadow-sm mx-6 mb-6">
    <div class="px-6 py-4 border-b border-slate-100">
        <h3 class="text-lg font-semibold text-slate-800">关键字信息</h3>
    </div>
    <form method="post" action="" class="p-6">
        <div class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">关键字 <span class="text-red-500">*</span></label>
                <input type="text" name="title" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all" placeholder="请输入关键字">
            </div>
        </div>
        <div class="flex gap-3 mt-6 pt-4 border-t border-slate-100">
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold hover:shadow-lg transition-all duration-200">
                提交
            </button>
            <a href="<?php echo url('index') ?>" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-medium hover:bg-slate-50 transition-all duration-200">
                返回
            </a>
        </div>
    </form>
</div>

{include file='public/footer' /}
