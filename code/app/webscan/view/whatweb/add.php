{include file='public/head' /}
{include file='public/blackLeftMenu' /}
<main class="p-6 min-h-screen">
    <!-- 页面标题 -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800 mb-2">添加扫描任务</h1>
        <nav class="flex gap-2 text-sm text-slate-500">
            <a href="/" class="hover:text-blue-500 transition-colors">首页</a>
            <span class="text-slate-300">/</span>
            <a href="#" class="hover:text-blue-500 transition-colors">Web扫描</a>
            <span class="text-slate-300">/</span>
            <span class="text-slate-700 font-medium">添加任务</span>
        </nav>
    </div>

    <!-- 表单卡片 -->
    <div class="max-w-2xl mx-auto">
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <!-- 卡片头部 -->
            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50">
                <h2 class="text-lg font-bold text-slate-800">任务配置</h2>
                <p class="text-sm text-slate-500 mt-1">请填写扫描任务的相关信息</p>
            </div>

            <!-- 表单内容 -->
            <div class="p-6">
                <form method="post" action="/index.php?s=urls/_add">
                    <div class="space-y-5">
                        <!-- 所属项目 -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">所属项目 <span class="text-red-500">*</span></label>
                            <select name="app_id" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all">
                                <?php foreach ($app_list as $item){ ?>
                                <option value="<?php echo $item['id']?>"><?php echo $item['name']?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- URL地址 -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">URL地址 <span class="text-red-500">*</span></label>
                            <input type="url" name="url" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-700 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all font-mono text-sm" placeholder="https://example.com">
                        </div>

                        <!-- 启用爬虫 -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">启用爬虫</label>
                            <select name="is_crawl" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all">
                                <option value="1">启用</option>
                                <option value="0">不启用</option>
                            </select>
                        </div>

                        <!-- 自定义header -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">自定义Header</label>
                            <textarea class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-700 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all resize-none font-mono text-sm" rows="3" placeholder="Content-Type: application/json&#10;Authorization: Bearer xxx"></textarea>
                        </div>

                        <!-- 自定义Cookie -->
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">自定义Cookie</label>
                            <textarea class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-700 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all resize-none font-mono text-sm" rows="3" placeholder="session=xxx; token=yyy"></textarea>
                        </div>
                    </div>

                    <!-- 按钮组 -->
                    <div class="flex gap-3 mt-8 pt-6 border-t border-slate-100">
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold hover:shadow-lg transition-all">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                提交
                            </span>
                        </button>
                        <a href="/index.php?s=urls/index" class="px-6 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-medium hover:bg-slate-50 transition-colors">
                            返回
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
{include file='public/footer' /}
