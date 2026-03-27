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
?>
{include file='public/search' /}

<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-100 bg-slate-50">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-slate-800">Webshell检测列表</h3>
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
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">类型</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">文件路径</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">扫描时间</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">状态</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($list as $value) { ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3">
                                <input type="checkbox" class="ids w-4 h-4 rounded border-slate-300 text-blue-500 focus:ring-blue-200" name="ids[]" value="<?php echo $value['id'] ?>">
                            </td>
                            <td class="px-4 py-3 font-medium text-slate-700"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-slate-600"><?php echo $value['name'] ?></td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium bg-red-50 text-red-600 border border-red-100">
                                    <?php echo $value['type'] ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-slate-600 font-mono text-sm bg-slate-50 rounded-lg px-2 py-1"><?php echo str_replace('./extend/codeCheck/','',$value['filename']) ?></td>
                            <td class="px-4 py-3 text-slate-500 text-sm"><?php echo $value['create_time']; ?></td>
                            <td class="px-4 py-3">
                                <select class="changCheckStatus bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-sm focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:outline-none" data-id="<?php echo $value['id'] ?>">
                                    <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                                    <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                                    <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                                </select>
                            </td>
                            <td class="px-4 py-3">
                                <a href="<?php echo url('code_webshell/del',['id'=>$value['id']])?>" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-medium bg-red-50 text-red-600 border border-red-100 hover:bg-red-100 transition-colors">删除</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/code_webshell')?>">

{include file='public/to_examine' /}
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