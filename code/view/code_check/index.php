{include file='public/head' /}
{include file='public/whiteLeftMenu' /}

<style>
    .line-limit-length {
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<!-- 页面标题 -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-text-primary mb-2">代码检查记录</h1>
    <nav class="flex gap-2 text-sm text-text-secondary">
        <a href="<?php echo url('code/index') ?>" class="hover:text-primary transition-colors">代码审计</a>
        <span class="text-text-muted">/</span>
        <span class="text-text-primary font-medium">代码检查记录</span>
    </nav>
</div>

<!-- 筛选区域 -->
<div class="bg-white border border-surface-300 rounded-2xl p-5 mb-6 shadow-card">
    <form class="flex flex-wrap gap-4 items-end" method="get" action="/index.php">
        <input type="hidden" name="s" value="code_check/index">
        <div class="flex flex-col gap-2">
            <label class="text-sm text-text-secondary font-medium">提交人</label>
            <select class="bg-surface-100 border border-surface-300 rounded-xl px-4 py-2.5 text-text-primary focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none transition-all min-w-[160px]" name="author">
                <option value="">全部</option>
                <?php foreach ($authList as $value) { ?>
                <option value="<?php echo $value ?>" <?php echo (($_GET['author'] ?? '') == $value) ? 'selected' : '' ?>><?php echo $value ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="flex flex-col gap-2">
            <label class="text-sm text-text-secondary font-medium">项目列表</label>
            <select class="bg-surface-100 border border-surface-300 rounded-xl px-4 py-2.5 text-text-primary focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none transition-all min-w-[200px]" name="code_id">
                <option value="">全部</option>
                <?php foreach ($projectList as $value) { ?>
                <option value="<?php echo $value ?>" <?php echo (($_GET['code_id'] ?? '') == $value) ? 'selected' : '' ?>><?php echo $projectArr[$value]['name'] ?? '' ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary to-blue-600 text-white font-semibold hover:shadow-hover transition-all">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                查询
            </span>
        </button>
    </form>
</div>

<!-- 表格卡片 -->
<div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card">
    <!-- 表头 -->
    <div class="flex justify-between items-center px-6 py-4 border-b border-surface-200 bg-surface-50">
        <div class="flex items-center gap-3">
            <h2 class="text-lg font-bold text-text-primary">检查记录</h2>
            <span class="bg-primary text-white text-xs px-2.5 py-1 rounded-full font-medium"><?php echo count($list) ?></span>
        </div>
    </div>

    <!-- 表格 -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-surface-100">
                    <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">项目ID</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">提交人</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">文件列表</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">提交时间</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">操作</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-200">
                <?php foreach ($list as $value) { ?>
                <tr class="hover:bg-surface-50 transition-colors">
                    <td class="px-6 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                    <td class="px-6 py-4 text-sm text-text-primary"><?php echo $value['name'] ?? '' ?></td>
                    <td class="px-6 py-4 text-sm text-text-primary"><?php echo htmlentities($value['author']) ?></td>
                    <td class="px-6 py-4 text-sm">
                        <?php foreach (explode("\n", $value['bugFile']) as $val) { ?>
                        <a target="_blank" class="text-primary hover:underline font-mono text-xs block mb-1"
                           href="<?php echo $value['web_url'] ?? '' ?>/-/blob/master<?php echo $val ?>"><?php echo $val ?></a>
                        <?php } ?>
                    </td>
                    <td class="px-6 py-4 text-sm text-text-secondary"><?php echo $value['create_time'] ?></td>
                    <td class="px-6 py-4">
                        <div class="flex gap-1">
                            <a href="<?php echo url('code_check/hook_detail', ['id' => $value['id']]) ?>"
                               class="w-9 h-9 rounded-xl bg-surface-100 text-primary hover:bg-primary-light transition-colors flex items-center justify-center" title="查看详情">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- 分页 -->
    <div class="px-6 py-4 border-t border-surface-200 bg-surface-50">
        {include file='public/fenye' /}
    </div>
</div>

{include file='public/footer' /}
