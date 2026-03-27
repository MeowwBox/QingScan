{include file='public/head' /}
{include file='public/whiteLeftMenu' /}
<?php
$searchArr = [
    'action' => url('code_webshell/index'),
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'placeholder' => "搜索的内容"],
        ['type' => 'select', 'name' => 'code_id', 'options' => $projectList, 'frist_option' => '项目列表'],
    ]];
$tableArr = [
    'title' => 'Webshell检测列表',
    'count' => count($list),
    'checkbox' => true,
    'columns' => [
        ['title' => 'ID'],
        ['title' => '所属项目'],
        ['title' => '类型'],
        ['title' => '文件路径'],
        ['title' => '扫描时间'],
        ['title' => '状态'],
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
    <td class="px-5 py-4 text-text-secondary"><?php echo $value['name'] ?></td>
    <td class="px-5 py-4">
        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium bg-red-50 text-red-600 border border-red-100">
            <?php echo $value['type'] ?>
        </span>
    </td>
    <td class="px-5 py-4 text-text-secondary font-mono text-sm bg-surface-50 rounded-lg px-2 py-1"><?php echo str_replace('./extend/codeCheck/','',$value['filename']) ?></td>
    <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time']; ?></td>
    <td class="px-5 py-4">
        <select class="changCheckStatus bg-surface-50 border border-surface-300 rounded-lg px-3 py-1.5 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none" data-id="<?php echo $value['id'] ?>">
            <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
            <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
            <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
        </select>
    </td>
    <td class="px-5 py-4">
        <a href="<?php echo url('code_webshell/del',['id'=>$value['id']])?>" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 transition-colors">删除</a>
    </td>
</tr>
<?php } ?>

{include file='public/table_end' /}
<input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/code_webshell')?>">

{include file='public/to_examine' /}
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
