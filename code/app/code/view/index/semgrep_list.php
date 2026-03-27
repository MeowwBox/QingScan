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
    ]]; ?>
{include file='public/search' /}

<div class="min-h-screen bg-surface-100 p-6">
    <div class="max-w-7xl mx-auto">
        <!-- 页面标题 -->
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold text-text-primary mb-2">SemGrep 漏洞列表</h1>
                <nav class="flex gap-2 text-sm text-text-secondary">
                    <a href="<?php echo url('code/index') ?>" class="hover:text-primary transition-colors">代码审计</a>
                    <span class="text-text-muted">/</span>
                    <span class="text-text-primary font-medium">SemGrep 漏洞列表</span>
                </nav>
            </div>
            {include file='public/batch_del' /}
        </div>

        <!-- 表格卡片 -->
        <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card">
            <!-- 表头 -->
            <div class="flex justify-between items-center px-6 py-4 border-b border-surface-200 bg-surface-50">
                <div class="flex items-center gap-3">
                    <h2 class="text-lg font-bold text-text-primary">漏洞列表</h2>
                    <span class="bg-primary text-white text-xs px-2.5 py-1 rounded-full font-medium"><?php echo count($list) ?></span>
                </div>
            </div>

            <!-- 表格 -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-surface-100">
                            <th class="w-12 px-6 py-4 text-left">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" value="-1" onclick="quanxuan(this)" class="w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20 cursor-pointer">
                                    <span class="text-xs font-semibold text-text-secondary uppercase">全选</span>
                                </label>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">漏洞类型</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">危险等级</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">污染来源</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">所属项目</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">创建时间</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">状态</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">操作</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-200">
                        <?php foreach ($list as $value) {
                            $project = $projectArr[$value['code_id']];
                        ?>
                        <tr class="hover:bg-surface-50 transition-colors">
                            <td class="px-6 py-4">
                                <input type="checkbox" class="ids w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20 cursor-pointer" name="ids[]" value="<?php echo $value['id'] ?>">
                            </td>
                            <td class="px-6 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                            <td class="px-6 py-4 text-sm text-text-primary font-mono"><?php echo str_replace('data.tools.semgrep.', "", $value['check_id']) ?></td>
                            <td class="px-6 py-4">
                                <?php
                                $levelColors = [
                                    'ERROR' => 'bg-red-50 text-red-600 border-red-100',
                                    'Critical' => 'bg-red-50 text-red-600 border-red-100',
                                    'High' => 'bg-orange-50 text-orange-600 border-orange-100',
                                    'Medium' => 'bg-amber-50 text-amber-600 border-amber-100',
                                    'Low' => 'bg-blue-50 text-blue-600 border-blue-100'
                                ];
                                $levelColor = $levelColors[$value['extra_severity']] ?? 'bg-slate-50 text-slate-600 border-slate-100';
                                ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold <?php echo $levelColor; ?> border">
                                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                    <?php echo $value['extra_severity'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <?php
                                    $path = preg_replace("/\/data\/codeCheck\/[a-zA-Z0-9]*\//", "", $value['path']);
                                    if ($projectArr[$value['code_id']]['is_online'] == 1) {
                                        $url = getGitAddr($projectArr[$value['code_id']]['name'], $projectArr[$value['code_id']]['ssh_url'], $value['path'], $value['end_line']);
                                    } else {
                                        $url = url('get_code',['id'=>$value['id'],'type'=>2]);
                                    }
                                ?>
                                <a title="<?php echo htmlentities($value['extra_lines']) ?>" href="<?php echo $url ?>"
                                   target="_blank" class="text-primary hover:underline font-mono text-sm">
                                    <?php echo $path ?>:<?php echo $value['end_line'] ?>
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="<?php echo url('code/index', ['id' => $value['code_id']]) ?>" class="text-primary hover:underline text-sm">
                                    <?php echo isset($projectArr[$value['code_id']]) ? $projectArr[$value['code_id']]['name'] : '' ?>
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-text-secondary"><?php echo $value['create_time'] ?></td>
                            <td class="px-6 py-4">
                                <select class="changCheckStatus bg-surface-100 border border-surface-300 rounded-lg px-3 py-1.5 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none" data-id="<?php echo $value['id'] ?>">
                                    <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                                    <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                                    <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                                </select>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-1">
                                    <a href="<?php echo url('code/semgrep_details', ['id' => $value['id']]) ?>"
                                       class="w-9 h-9 rounded-xl bg-surface-100 text-primary hover:bg-primary-light transition-colors flex items-center justify-center" title="查看详情">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="<?php echo url('code/semgrep_del', ['id' => $value['id']]) ?>"
                                       class="w-9 h-9 rounded-xl bg-surface-100 text-red-500 hover:bg-red-50 transition-colors flex items-center justify-center" title="删除">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- 分页 -->
            <div class="px-6 py-4 border-t border-surface-200 bg-surface-50">
                {include file='public/fenye' /}
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/semgrep') ?>">

{include file='public/to_examine' /}
{include file='public/footer' /}

<script>
    function quanxuan(obj) {
        var child = document.querySelectorAll('.ids');
        child.forEach(function(item) {
            item.checked = obj.checked;
        });
    }

    function batch_del() {
        var child = document.querySelectorAll('.ids');
        var ids = '';
        child.forEach(function(item) {
            if (item.value != -1 && item.checked) {
                if (ids == '') {
                    ids = item.value;
                } else {
                    ids = ids + ',' + item.value;
                }
            }
        });

        fetch("<?php echo url('semgrep_batch_del')?>", {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'ids=' + ids
        })
        .then(response => response.json())
        .then(data => {
            alert(data.msg);
            if (data.code == 1) {
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
        });
    }
</script>
