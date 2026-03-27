{include file='public/head' /}
{include file='public/whiteLeftMenu' /}
<div class="max-w-2xl mx-auto py-8">
    <div class="bg-white border border-slate-200 rounded-2xl shadow-card overflow-hidden">
        <div class="px-8 py-5 border-b border-slate-200 bg-slate-50">
            <h1 class="text-xl font-bold text-slate-800">编辑项目</h1>
        </div>
        <form method="post" action="<?= url("code/edit_modal") ?>">
            <input type="hidden" name="id" value="<?php echo $info['id'] ?>">
            <div class="p-8 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">项目名称</label>
                    <input type="text" name="name" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all" placeholder="应用名称" required value="<?php echo $info['name'] ?>">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">项目类型</label>
                    <select name="project_type" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all">
                        <option value="1" <?php if ($info['project_type'] == 1) echo 'selected' ?>>PHP项目</option>
                        <option value="2" <?php if ($info['project_type'] == 2) echo 'selected' ?>>JAVA项目</option>
                        <option value="3" <?php if ($info['project_type'] == 3) echo 'selected' ?>>Python项目</option>
                        <option value="4" <?php if ($info['project_type'] == 4) echo 'selected' ?>>Golang项目</option>
                        <option value="5" <?php if ($info['project_type'] == 5) echo 'selected' ?>>APP项目</option>
                        <option value="6" <?php if ($info['project_type'] == 6) echo 'selected' ?>>其他</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">是否私有仓库</label>
                    <select name="is_private" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-800 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all">
                        <option value="0" <?php if ($info['is_private'] == 0) echo 'selected' ?>>公共仓库</option>
                        <option value="1" <?php if ($info['is_private'] == 1) echo 'selected' ?>>私有仓库</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">地址</label>
                    <input type="text" name="ssh_url" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all font-mono text-sm" placeholder="URL" required value="<?php echo $info['ssh_url'] ?>">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">账号</label>
                        <input type="text" name="username" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all" placeholder="账号" value="<?php echo $info['username'] ?>">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">密码</label>
                        <input type="text" name="password" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all" placeholder="密码" value="<?php echo $info['password'] ?>">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">私钥</label>
                    <textarea name="private_key" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all resize-none font-mono text-sm" rows="15"><?php echo $info['private_key'] ?></textarea>
                </div>
            </div>
            <div class="px-8 py-4 border-t border-slate-200 bg-slate-50 flex justify-end gap-3">
                <a href="javascript:history.back()" class="px-6 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-medium hover:bg-white transition-all duration-200">关闭</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold hover:shadow-lg transition-all duration-200">提交</button>
            </div>
        </form>
    </div>
</div>
{include file='public/footer' /}
