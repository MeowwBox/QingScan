{include file='public/head' /}
{include file='public/blackLeftMenu' /}

<!-- 页面标题 -->
<div class="flex justify-between items-start mb-6 p-6 pb-0">
    <div>
        <h1 class="text-2xl font-bold text-text-primary mb-2">Xray漏洞列表</h1>
        <nav class="flex gap-2 text-sm text-text-secondary">
            <a href="#" class="hover:text-primary transition-colors">首页</a>
            <span class="text-text-muted">/</span>
            <a href="#" class="hover:text-primary transition-colors">Web扫描</a>
            <span class="text-text-muted">/</span>
            <span class="text-text-primary font-medium">Xray漏洞</span>
        </nav>
    </div>
</div>

<!-- 搜索区域 -->
<div class="bg-white border border-surface-300 rounded-2xl p-5 mb-6 mx-6 shadow-card">
    <form method="get" action="/index.php">
        <input type="hidden" name="s" value="code_check/bug_list">
        <div class="flex flex-wrap gap-4 items-end">
            <div class="flex flex-col gap-2">
                <label class="text-sm text-text-secondary font-medium">搜索</label>
                <input type="text" name="search" class="bg-surface-50 border border-surface-300 rounded-xl px-4 py-2.5 text-text-primary placeholder-text-muted focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none transition-all w-[240px]" placeholder="搜索的内容">
            </div>
            <div class="flex gap-3">
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary to-blue-600 text-white font-semibold hover:shadow-lg transition-all duration-200">
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

<?php
$tableArr = [
    'title' => '漏洞列表',
    'count' => count($list),
    'columns' => [
        ['title' => 'ID'],
        ['title' => 'Severity'],
        ['title' => 'URL'],
        ['title' => '操作'],
    ],
    'noPagination' => true,
];
?>
{include file='public/table_start' /}

<?php foreach ($list as $value) { ?>
    <tr class="hover:bg-surface-50 transition-colors">
        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
        <td class="px-5 py-4">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-100">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                <?php echo $value['vt_name'] ?>
            </span>
        </td>
        <td class="px-5 py-4 text-text-secondary text-sm font-mono break-all max-w-md"><?php echo $value['affects_url'] ?></td>
        <td class="px-5 py-4">
            <div class="flex gap-1">
                <a href="/index.php?s=code_check/bug_detail&id=<?php echo $value['id'] ?>" class="w-9 h-9 rounded-xl bg-surface-100 text-primary hover:bg-blue-50 transition-colors flex items-center justify-center" title="查看漏洞">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </a>
                <button class="w-9 h-9 rounded-xl bg-surface-100 text-text-muted cursor-not-allowed flex items-center justify-center" disabled title="删除">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
        </td>
    </tr>
<?php } ?>

{include file='public/table_end' /}

{include file='public/fenye' /}
{include file='public/footer' /}
