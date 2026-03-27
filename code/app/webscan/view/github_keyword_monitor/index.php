{include file='public/head' /}
{include file='public/blackLeftMenu' /}
<?php
$dengjiArr = ['Low', 'Medium', 'High', 'Critical'];
?>

<!-- 页面标题 -->
<div class="flex justify-between items-start mb-6 p-6 pb-0">
    <div>
        <h1 class="text-2xl font-bold text-text-primary mb-2">GitHub关键字监控</h1>
        <nav class="flex gap-2 text-sm text-text-secondary">
            <a href="#" class="hover:text-primary transition-colors">首页</a>
            <span class="text-text-muted">/</span>
            <a href="#" class="hover:text-primary transition-colors">Web扫描</a>
            <span class="text-text-muted">/</span>
            <span class="text-text-primary font-medium">关键字列表</span>
        </nav>
    </div>
    <div class="flex gap-3">
        <a href="<?php echo url('add')?>" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold hover:shadow-lg transition-all duration-200 shadow-md">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                添加关键字
            </span>
        </a>
    </div>
</div>

<?php
$searchArr = [
    'action' => url('index'),
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'label' => '搜索', 'placeholder' => '搜索关键字'],
    ],
    'btnArr' => [
        ['text' => '添加关键字', 'ext' => [
            "class" => "btn-action",
            "href" => url('add'),
        ]]
    ],
];
?>
{include file='public/search' /}

<?php
$tableArr = [
    'title' => '关键字列表',
    'count' => count($list),
    'columns' => [
        ['title' => 'ID'],
        ['title' => '关键字'],
        ['title' => '添加时间'],
        ['title' => '操作'],
    ],
];
?>
{include file='public/table_start' /}

<?php foreach ($list as $value) { ?>
<tr class="hover:bg-surface-50 transition-colors">
    <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
    <td class="px-5 py-4 text-text-secondary"><?php echo $value['title'] ?></td>
    <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
    <td class="px-5 py-4">
        <div class="flex gap-1">
            <a href="<?php echo url('del',['id'=>$value['id']])?>" class="w-9 h-9 rounded-xl bg-surface-100 text-red-500 hover:bg-red-50 transition-colors flex items-center justify-center" title="删除">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </a>
        </div>
    </td>
</tr>
<?php } ?>

{include file='public/table_end' /}

{include file='public/fenye' /}
{include file='public/footer' /}
