{include file='public/head' /}
{include file='public/whiteLeftMenu' /}
<div class="max-w-2xl mx-auto py-8">
    <div class="bg-white border border-slate-200 rounded-2xl shadow-card p-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">添加白盒项目</h1>
            <p class="text-slate-500 text-sm mt-1">上传代码压缩包进行白盒扫描</p>
        </div>
        <form method="post" action="<?php echo url('code/add_file')?>" enctype="multipart/form-data">
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">项目类型</label>
                    <select name="project_type" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all" required>
                        <option value="1">PHP项目</option>
                        <option value="2">JAVA项目</option>
                        <option value="3">Python项目</option>
                        <option value="4">Golang项目</option>
                        <option value="5">APP项目</option>
                        <option value="6">其他</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">项目文件压缩包 <span class="text-slate-400 font-normal">(zip格式，小于100M)</span></label>
                    <input type="file" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-800 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all cursor-pointer" name="file" accept=".zip" required/>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-3">需要调用的工具</label>
                    <div class="flex flex-wrap gap-4">
                        <?php foreach ($tools_list as $k=>$v) { ?>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="tools[]" value="<?php echo $k;?>" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                            <span class="text-sm text-slate-700"><?php echo $v;?></span>
                        </label>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="flex gap-3 mt-8">
                <a href="<?php echo url('code/index')?>" class="px-6 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-medium hover:bg-slate-50 transition-all duration-200">返回</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold hover:shadow-lg transition-all duration-200">提交</button>
            </div>
        </form>
    </div>
</div>
{include file='public/footer' /}
