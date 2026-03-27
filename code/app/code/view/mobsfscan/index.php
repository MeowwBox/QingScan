{include file='public/head' /}
{include file='public/whiteLeftMenu' /}
<?php
$dengjiArr = ['ERROR', 'Low', 'Medium', 'High', 'Critical'];

$fileList = str_replace('./extend/codeCheck/', '', $fileList);
$CategoryList = str_replace('data.tools.semgrep.', '', $CategoryList);
$fileTypeList = getFileType($fileList);
?>
<?php
$searchArr = [
    'action' => $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'placeholder' => "搜索的内容"],
        ['type' => 'select', 'name' => 'level', 'options' => $dengjiArr, 'frist_option' => '危险等级'],
        ['type' => 'select', 'name' => 'Category', 'options' => $CategoryList, 'frist_option' => '漏洞类别'],
        ['type' => 'select', 'name' => 'code_id', 'options' => $projectList, 'frist_option' => '项目列表'],
        ['type' => 'select', 'name' => 'filename', 'options' => $fileList, 'frist_option' => '文件筛选'],
        ['type' => 'select', 'name' => 'filetype', 'options' => $fileTypeList, 'frist_option' => '文件后缀'],
        ['type' => 'select', 'name' => 'check_status', 'options' => $check_status_list, 'frist_option' => '审计状态', 'frist_option_value' => -1],
    ]];
?>
{include file='public/search' /}

<div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-100 bg-slate-50">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-slate-800">MobSF扫描结果</h3>
        </div>
    </div>
    <div class="p-5">
        {include file='public/batch' /}
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
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">危险等级</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">漏洞类型</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">cwe</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">漏洞描述</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">masvs</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">owasp_mobile</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">参考地址</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">扫描时间</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">状态</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($list as $value) {
                        $project = $projectList[$value['code_id']];
                        $severityClass = '';
                        if ($value['severity'] == 'Critical') $severityClass = 'bg-red-50 text-red-600 border-red-100';
                        elseif ($value['severity'] == 'High') $severityClass = 'bg-orange-50 text-orange-600 border-orange-100';
                        elseif ($value['severity'] == 'Medium') $severityClass = 'bg-amber-50 text-amber-600 border-amber-100';
                        elseif ($value['severity'] == 'Low') $severityClass = 'bg-sky-50 text-sky-600 border-sky-100';
                        else $severityClass = 'bg-slate-50 text-slate-600 border-slate-100';
                        ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3">
                                <input type="checkbox" class="ids w-4 h-4 rounded border-slate-300 text-blue-500 focus:ring-blue-200" name="ids[]" value="<?php echo $value['id'] ?>">
                            </td>
                            <td class="px-4 py-3 font-medium text-slate-700"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3">
                                <a href="<?php echo url('code/index', ['id' => $value['code_id']]) ?>" class="text-blue-500 hover:text-blue-600 hover:underline">
                                    <?php echo $value['code_name'] ?>
                                </a>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold <?php echo $severityClass ?> border">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                    <?php echo $value['severity']; ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-slate-600"><?php echo $value['type']; ?></td>
                            <td class="px-4 py-3 text-slate-600"><?php echo $value['cwe']; ?></td>
                            <td class="px-4 py-3 text-slate-600 text-sm max-w-xs truncate" title="<?php echo $value['description']; ?>"><?php echo $value['description']; ?></td>
                            <td class="px-4 py-3 text-slate-600"><?php echo $value['masvs']; ?></td>
                            <td class="px-4 py-3 text-slate-600"><?php echo $value['owasp_mobile']; ?></td>
                            <td class="px-4 py-3"><a href="<?php echo $value['reference']; ?>" target="_blank" class="text-blue-500 hover:text-blue-600 text-sm truncate max-w-xs block"><?php echo $value['reference']; ?></a></td>
                            <td class="px-4 py-3 text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                            <td class="px-4 py-3">
                                <select class="changCheckStatus bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-sm focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:outline-none" data-id="<?php echo $value['id'] ?>">
                                    <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                                    <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                                    <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                                </select>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/mobsfscan') ?>">

{include file='public/to_examine' /}
{include file='public/fenye' /}
{include file='public/footer' /}