{include file='public/head' /}
{include file='public/blackLeftMenu' /}

<?php
$searchArr = [
    'action' => $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'placeholder' => 'search'],
        ['type' => 'select', 'name' => 'app_id', 'options' => $projectList, 'frist_option' => '项目列表']
]];
?>
{include file='public/search' /}

<?php
$tableArr = [
    'title' => 'URL列表',
    'count' => count($list),
    'checkbox' => true,
    'columns' => [
        ['title' => 'ID'],
        ['title' => '所属项目'],
        ['title' => 'URL'],
        ['title' => '创建时间'],
        ['title' => '操作', 'class' => 'w-32'],
    ],
    'showBatchDel' => true,
];
?>
{include file='public/table_start' /}

<?php foreach ($list as $value) { ?>
<tr class="hover:bg-surface-50 transition-colors">
    <td class="px-4 py-3">
        <input type="checkbox" class="ids w-4 h-4 text-primary border-surface-400 rounded focus:ring-primary/20" name="ids[]" value="<?php echo $value['id'] ?>">
    </td>
    <td class="px-4 py-3 text-text-primary font-medium"><?php echo $value['id'] ?></td>
    <td class="px-4 py-3 text-text-primary"><?php echo isset($projectList[$value['app_id']]) ? $projectList[$value['app_id']] : '-' ?></td>
    <td class="px-4 py-3 text-text-primary font-mono text-sm truncate max-w-md"><?php echo $value['url'] ?></td>
    <td class="px-4 py-3 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
    <td class="px-4 py-3">
        <a href="<?php echo url('del', ['id' => $value['id']]) ?>" class="px-3 py-1.5 rounded-lg text-sm bg-red-50 text-red-600 hover:bg-red-100 transition-colors" onclick="return confirm('确定要删除吗?')">删除</a>
    </td>
</tr>
<?php } ?>

{include file='public/table_end' /}

{include file='public/footer' /}
