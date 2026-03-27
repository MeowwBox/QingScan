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


<div class="w-full px-4">
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 bg-slate-50">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-800">MurphySec依赖漏洞列表</h3>
            </div>
        </div>
        <div class="p-5">
            <form class="flex gap-3 mb-4">
                <a href="javascript:;" onclick="batch_repair()"
                   class="inline-flex items-center gap-1 px-4 py-2 rounded-lg text-sm font-medium bg-emerald-50 text-emerald-600 border border-emerald-100 hover:bg-emerald-100 transition-colors">批量修复</a>
                <a href="javascript:;" onclick="batch_del()"
                   class="inline-flex items-center gap-1 px-4 py-2 rounded-lg text-sm font-medium bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 transition-colors">批量删除</a>
            </form>
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
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">缺陷组件</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">处置建议</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">当前版本</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">最小修复版本</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">语言</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">修复状态</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">时间</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">操作</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach ($list as $value) {
                            $levelClass = '';
                            if ($show_level[$value['show_level']] == '严重') $levelClass = 'bg-red-50 text-red-600 border-red-100';
                            elseif ($show_level[$value['show_level']] == '高危') $levelClass = 'bg-orange-50 text-orange-600 border-orange-100';
                            elseif ($show_level[$value['show_level']] == '中危') $levelClass = 'bg-amber-50 text-amber-600 border-amber-100';
                            else $levelClass = 'bg-sky-50 text-sky-600 border-sky-100';
                            ?>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3">
                                    <input type="checkbox" class="ids w-4 h-4 rounded border-slate-300 text-blue-500 focus:ring-blue-200" name="ids[]" value="<?php echo $value['id'] ?>">
                                </td>
                                <td class="px-4 py-3 font-medium text-slate-700"><?php echo $value['id'] ?></td>
                                <td class="px-4 py-3 text-slate-600"><?php echo $value['code_name'] ?></td>
                                <td class="px-4 py-3 text-slate-600"><?php echo $value['comp_name'] ?></td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium <?php echo $levelClass ?> border">
                                        <?php echo $show_level[$value['show_level']] ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-slate-600 font-mono text-sm"><?php echo $value['version'] ?></td>
                                <td class="px-4 py-3 text-emerald-600 font-mono text-sm"><?php echo $value['min_fixed_version'] ?></td>
                                <td class="px-4 py-3 text-slate-600"><?php echo $value['language'] ?></td>
                                <td class="px-4 py-3">
                                    <?php
                                    $repairClass = $value['repair_status'] == '已修复' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-amber-50 text-amber-600 border-amber-100';
                                    ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium <?php echo $repairClass ?> border">
                                        <?php echo $value['repair_status'] ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                                <td class="px-4 py-3">
                                    <a href="<?php echo url('murphysec/del',['id'=>$value['id']])?>" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 transition-colors">删除</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {include file='public/fenye' /}
</div>
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