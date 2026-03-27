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
                    <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">项目名称</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">提交人</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">文件列表</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">提交时间</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">操作</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-200">
                <?php if (!empty($list)) { ?>
                <?php foreach ($list as $value) { ?>
                <tr class="hover:bg-surface-50 transition-colors">
                    <td class="px-6 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                    <td class="px-6 py-4 text-sm text-text-primary"><?php echo $value['name'] ?? '' ?></td>
                    <td class="px-6 py-4 text-sm text-text-primary"><?php echo htmlentities($value['author'] ?? '') ?></td>
                    <td class="px-6 py-4 text-sm">
                        <?php if (!empty($value['bugFile'])) { ?>
                        <?php foreach (explode("\n", $value['bugFile']) as $val) { ?>
                        <?php if (!empty($value['web_url'])) { ?>
                        <a target="_blank" class="text-primary hover:underline font-mono text-xs block mb-1"
                           href="<?php echo $value['web_url'] ?>/-/blob/master<?php echo $val ?>"><?php echo $val ?></a>
                        <?php } else { ?>
                        <span class="font-mono text-xs block mb-1"><?php echo $val ?></span>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>
                    </td>
                    <td class="px-6 py-4 text-sm text-text-secondary"><?php echo $value['create_time'] ?? '' ?></td>
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
                <?php } else { ?>
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-text-secondary">暂无数据</td>
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
