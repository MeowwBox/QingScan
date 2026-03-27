{include file='public/head' /}
{include file='public/whiteLeftMenu' /}
<?php
$searchArr = [
    'action' => $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'placeholder' => "search"],
        ['type' => 'select', 'name' => 'code_id', 'options' => $projectList, 'frist_option' => '项目列表'],
    ]];
?>
{include file='public/search' /}

<?php
$tableArr = [
    'title' => 'MurphySec依赖漏洞列表',
    'count' => count($list),
    'checkbox' => true,
    'columns' => [
        ['title' => 'ID'],
        ['title' => '所属项目'],
        ['title' => '缺陷组件'],
        ['title' => '处置建议'],
        ['title' => '当前版本'],
        ['title' => '最小修复版本'],
        ['title' => '语言'],
        ['title' => '修复状态'],
        ['title' => '时间'],
        ['title' => '操作'],
    ],
    'toolbarRight' => '<a href="javascript:;" onclick="batch_repair()" class="inline-flex items-center gap-1 px-4 py-2 rounded-lg text-sm font-medium bg-emerald-50 text-emerald-600 border border-emerald-100 hover:bg-emerald-100 transition-colors">批量修复</a><a href="javascript:;" onclick="batch_del()" class="inline-flex items-center gap-1 px-4 py-2 rounded-lg text-sm font-medium bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 transition-colors">批量删除</a>',
];
?>
{include file='public/table_start' /}

<?php foreach ($list as $value) {
    $levelClass = '';
    if ($show_level[$value['show_level']] == '严重') $levelClass = 'bg-red-50 text-red-600 border-red-100';
    elseif ($show_level[$value['show_level']] == '高危') $levelClass = 'bg-orange-50 text-orange-600 border-orange-100';
    elseif ($show_level[$value['show_level']] == '中危') $levelClass = 'bg-amber-50 text-amber-600 border-amber-100';
    else $levelClass = 'bg-sky-50 text-sky-600 border-sky-100';
    ?>
    <tr class="hover:bg-surface-50 transition-colors">
        <td class="px-5 py-4">
            <input type="checkbox" class="ids w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20" name="ids[]" value="<?php echo $value['id'] ?>">
        </td>
        <td class="px-5 py-4 font-medium text-text-primary"><?php echo $value['id'] ?></td>
        <td class="px-5 py-4 text-text-secondary"><?php echo $value['code_name'] ?></td>
        <td class="px-5 py-4 text-text-secondary"><?php echo $value['comp_name'] ?></td>
        <td class="px-5 py-4">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium <?php echo $levelClass ?> border">
                <?php echo $show_level[$value['show_level']] ?>
            </span>
        </td>
        <td class="px-5 py-4 text-text-secondary font-mono text-sm"><?php echo $value['version'] ?></td>
        <td class="px-5 py-4 text-emerald-600 font-mono text-sm"><?php echo $value['min_fixed_version'] ?></td>
        <td class="px-5 py-4 text-text-secondary"><?php echo $value['language'] ?></td>
        <td class="px-5 py-4">
            <?php
            $repairClass = $value['repair_status'] == '已修复' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-amber-50 text-amber-600 border-amber-100';
            ?>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium <?php echo $repairClass ?> border">
                <?php echo $value['repair_status'] ?>
            </span>
        </td>
        <td class="px-5 py-4 text-text-muted text-sm"><?php echo $value['create_time'] ?></td>
        <td class="px-5 py-4">
            <a href="<?php echo url('murphysec/del',['id'=>$value['id']])?>" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 transition-colors">删除</a>
        </td>
    </tr>
<?php } ?>

{include file='public/table_end' /}

{include file='public/footer' /}

<script>
    function batch_repair(){
        var child = $('.table').find('.ids');
        var ids = ''
        child.each(function(index, item){
            if (item.value != -1 && item.checked) {
                if (ids == '') {
                    ids = item.value
                } else {
                    ids = ids+','+item.value
                }
            }
        })

        $.ajax({
            type: "post",
            url: "<?php echo url('batch_repair')?>",
            data: {ids: ids},
            dataType: "json",
            success: function (data) {
                alert(data.msg)
                if (data.code == 1) {
                    window.setTimeout(function () {
                        location.reload();
                    }, 2000)
                }
            }
        });
    }

    function batch_del(){
        var child = $('.table').find('.ids');
        var ids = ''
        child.each(function(index, item){
            if (item.value != -1 && item.checked) {
                if (ids == '') {
                    ids = item.value
                } else {
                    ids = ids+','+item.value
                }
            }
        })

        $.ajax({
            type: "post",
            url: "<?php echo url('batch_del')?>",
            data: {ids: ids},
            dataType: "json",
            success: function (data) {
                alert(data.msg)
                if (data.code == 1) {
                    window.setTimeout(function () {
                        location.reload();
                    }, 2000)
                }
            }
        });
    }
</script>