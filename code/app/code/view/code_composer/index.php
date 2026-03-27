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

<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 bg-slate-50">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-800">Composer依赖列表</h3>
            </div>
        </div>
        <div class="p-5">
            {include file='public/batch_del' /}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="w-16 px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" value="-1" onclick="quanxuan(this)" class="w-4 h-4 rounded border-slate-300 text-blue-500 focus:ring-blue-200">
                                    <span>全选</span>
                                </label>
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">所属项目</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">name</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">version</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">source</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">authors</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">时间</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach ($list as $value) { ?>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3">
                                    <input type="checkbox" class="ids w-4 h-4 rounded border-slate-300 text-blue-500 focus:ring-blue-200" name="ids[]" value="<?php echo $value['id'] ?>">
                                </td>
                                <td class="px-4 py-3 font-medium text-slate-700"><?php echo $value['id'] ?></td>
                                <td class="px-4 py-3 text-slate-600"><?php echo $value['code_name'] ?></td>
                                <td class="px-4 py-3 text-slate-600"><?php echo $value['name'] ?></td>
                                <td class="px-4 py-3 text-slate-600"><?php echo $value['version'] ?></td>
                                <td class="px-4 py-3 text-slate-600"><pre class="text-xs bg-slate-50 p-2 rounded-lg"><?php echo $value['source'] ?></pre></td>
                                <td class="px-4 py-3 text-slate-600"><pre class="text-xs bg-slate-50 p-2 rounded-lg"><?php echo $value['require'] ?></pre></td>
                                <td class="px-4 py-3 text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

{include file='public/fenye' /}
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