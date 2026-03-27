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
$tableArr = [
    'title' => 'Java依赖列表',
    'count' => count($list),
    'checkbox' => true,
    'columns' => [
        ['title' => 'ID'],
        ['title' => '所属项目'],
        ['title' => 'modelVersion'],
        ['title' => 'groupId'],
        ['title' => 'artifactId'],
        ['title' => 'version'],
        ['title' => 'name'],
        ['title' => '时间'],
        ['title' => '操作'],
    ],
    'showBatchDel' => true,
];
?>
{include file='public/search' /}
{include file='public/table_start' /}

<?php foreach ($list as $value) { ?>
<tr class="hover:bg-surface-50 transition-colors">
    <td class="px-5 py-4">
        <input type="checkbox" class="ids w-4 h-4 rounded border-surface-400 text-primary" name="ids[]" value="<?php echo $value['id'] ?>">
    </td>
    <td class="px-5 py-4 font-medium text-text-primary"><?php echo $value['id'] ?></td>
    <td class="px-5 py-4 text-text-secondary"><?php echo $value['code_name'] ?></td>
    <td class="px-5 py-4 text-text-secondary"><?php echo $value['modelVersion'] ?></td>
    <td class="px-5 py-4 text-text-secondary"><?php echo $value['groupId'] ?></td>
    <td class="px-5 py-4 text-text-secondary"><?php echo $value['artifactId'] ?></td>
    <td class="px-5 py-4 text-text-secondary"><?php echo $value['version'] ?></td>
    <td class="px-5 py-4 text-text-secondary"><?php echo $value['name'] ?></td>
    <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
    <td class="px-5 py-4">
        <a href="<?php echo url('del',['id'=>$value['id']])?>" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 transition-colors">删除</a>
    </td>
</tr>
<?php } ?>

{include file='public/table_end' /}
{include file='public/footer' /}

<script>
    function quanxuan(obj){
        var child = $('.table').find('.ids');
        child.each(function(index, item){
            if (obj.checked) {
                item.checked = true
            } else {
                item.checked = false
            }
        })
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
