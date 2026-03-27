{include file='public/head' /}
{include file='public/blackLeftMenu' /}
<?php
$dengjiArr = ['Low', 'Medium', 'High', 'Critical'];
?>

<!-- 页面标题 -->
<div class="flex justify-between items-start mb-6 p-6 pb-0">
    <div>
        <h1 class="text-2xl font-bold text-text-primary mb-2">GitHub监控通知</h1>
        <nav class="flex gap-2 text-sm text-text-secondary">
            <a href="#" class="hover:text-primary transition-colors">首页</a>
            <span class="text-text-muted">/</span>
            <a href="#" class="hover:text-primary transition-colors">Web扫描</a>
            <span class="text-text-muted">/</span>
            <span class="text-text-primary font-medium">监控通知</span>
        </nav>
    </div>
    <div class="flex gap-3">
        <a href="<?php echo url('webscan/github_keyword_monitor/index')?>" class="px-5 py-2.5 rounded-xl border border-surface-400 text-text-secondary font-medium hover:bg-surface-50 transition-all duration-200">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                </svg>
                关键词管理
            </span>
        </a>
    </div>
</div>

<?php
$searchArr = [
    'action' => url('index'),
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'label' => '搜索', 'placeholder' => '搜索内容'],
    ],
];
?>
{include file='public/search' /}

<?php
$tableArr = [
    'title' => '监控结果',
    'count' => count($list),
    'checkbox' => true,
    'columns' => [
        ['title' => 'ID'],
        ['title' => '关键字'],
        ['title' => '名称'],
        ['title' => '文件路径'],
        ['title' => 'URL地址'],
    ],
    'showBatchDel' => true,
];
?>
{include file='public/table_start' /}

<?php foreach ($list as $value) { ?>
<tr class="hover:bg-surface-50 transition-colors">
    <td class="px-5 py-4">
        <input type="checkbox" class="ids w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20 cursor-pointer" name="ids[]" value="<?php echo $value['id'] ?>">
    </td>
    <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
    <td class="px-5 py-4">
        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-600 border border-blue-100">
            <?php echo $value['title'] ?>
        </span>
    </td>
    <td class="px-5 py-4 text-text-secondary"><?php echo $value['name'] ?></td>
    <td class="px-5 py-4 text-text-secondary text-sm font-mono"><?php echo $value['path'] ?></td>
    <td class="px-5 py-4">
        <a href="<?php echo $value['html_url'] ?>" target="_blank" class="text-primary hover:text-blue-600 hover:underline text-sm">
            <?php echo $value['html_url'] ?>
        </a>
    </td>
</tr>
<?php } ?>

{include file='public/table_end' /}

{include file='public/fenye' /}
{include file='public/footer' /}
