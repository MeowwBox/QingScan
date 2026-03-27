{include file='public/head' /}
{include file='public/blackLeftMenu' /}
<div class="max-w-2xl mx-auto py-8">
    <div class="bg-white border border-slate-200 rounded-2xl shadow-card p-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">添加扫描任务</h1>
            <p class="text-slate-500 text-sm mt-1">配置SQLMap扫描任务参数</p>
        </div>
        <form method="post" action="/index.php?s=urls/_add">
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">所属项目</label>
                    <select name="app_id" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all">
                        <?php foreach ($app_list as $item){ ?>
                        <option value="<?php echo $item['id']?>"><?php echo $item['name']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">URL地址</label>
                    <input type="url" name="url" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all" placeholder="请输入URL地址">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">启用爬虫</label>
                    <select name="is_crawl" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all">
                        <option value="1">启用</option>
                        <option value="0">不启用</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">自定义Header</label>
                    <textarea class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all resize-none" rows="3" placeholder="填写header消息"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">自定义Cookie</label>
                    <textarea class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all resize-none" rows="3" placeholder="自定义cookie"></textarea>
                </div>
            </div>
            <div class="flex gap-3 mt-8">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold hover:shadow-lg transition-all duration-200">提交</button>
                <a href="/index.php?s=urls/index" class="px-6 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-medium hover:bg-slate-50 transition-all duration-200">返回</a>
            </div>
        </form>
    </div>
</div>
{include file='public/footer' /}
