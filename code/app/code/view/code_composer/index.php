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
    'title' => 'Composer依赖列表',
    'count' => count($list),
    'checkbox' => true,
    'columns' => [
        ['title' => 'ID'],
        ['title' => '所属项目'],
        ['title' => 'name'],
        ['title' => 'version'],
        ['title' => 'source'],
        ['title' => 'authors'],
        ['title' => '时间'],
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
    <td class="px-5 py-4 text-text-secondary"><a href="javascript:void(0)" onclick="showDetail(<?php echo $value['id'] ?>)" class="text-primary hover:text-primary/80"><?php echo $value['name'] ?></a></td>
    <td class="px-5 py-4 text-text-secondary"><?php echo $value['version'] ?></td>
    <td class="px-5 py-4 text-text-secondary"><pre class="text-xs bg-surface-50 p-2 rounded-lg"><?php echo $value['source'] ?></pre></td>
    <td class="px-5 py-4 text-text-secondary"><pre class="text-xs bg-surface-50 p-2 rounded-lg"><?php echo $value['require'] ?></pre></td>
    <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
</tr>
<?php } ?>

{include file='public/table_end' /}
{include file='public/drawer' /}

<script>
function showDetail(id) {
    openDrawer('view', 'Composer依赖详情', 520);
    setDrawerContent('<div class="flex items-center justify-center py-12"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div></div>');

    fetch('<?php echo url("detail"); ?>?id=' + id)
        .then(response => response.json())
        .then(res => {
            if (res.code === 1 && res.data) {
                const data = res.data;
                const html = `
                    <div class="space-y-6">
                        <div class="bg-surface-50 rounded-xl p-4">
                            <h4 class="text-sm font-semibold text-text-secondary mb-3">基本信息</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-text-secondary">名称</span>
                                    <span class="font-medium text-primary">${data.name || '-'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-text-secondary">版本</span>
                                    <span class="font-medium">${data.version || '-'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-text-secondary">所属项目</span>
                                    <span class="font-medium">${data.code_name || '-'}</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-surface-50 rounded-xl p-4">
                            <h4 class="text-sm font-semibold text-text-secondary mb-3">来源信息</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-text-secondary">Source</span>
                                    <span class="font-medium max-w-[280px] text-right break-all">${data.source || '-'}</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-surface-50 rounded-xl p-4">
                            <h4 class="text-sm font-semibold text-text-secondary mb-3">时间信息</h4>
                            <div class="flex justify-between">
                                <span class="text-text-secondary">创建时间</span>
                                <span class="text-text-secondary">${data.create_time || '-'}</span>
                            </div>
                        </div>
                    </div>
                `;
                setDrawerContent(html);
            } else {
                setDrawerContent('<div class="text-center py-12 text-red-500">' + (res.msg || '加载失败') + '</div>');
            }
        });
}
</script>
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
