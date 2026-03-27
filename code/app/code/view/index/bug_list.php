{include file='public/head' /}
{include file='public/whiteLeftMenu' /}

<?php
$dengjiArr = ['Low', 'Medium', 'High', 'Critical'];
$dengjiArrColor = ['Low' => 'low', 'Medium' => 'medium', 'High' => 'high', 'Critical' => 'critical'];

$fileTypeList = getFileType($fileList);
?>

<?php
$searchArr = [
    'action' => url('code/bug_list'),
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'placeholder' => "搜索的内容"],
        ['type' => 'select', 'name' => 'Folder', 'options' => $dengjiArr, 'frist_option' => '危险等级'],
        ['type' => 'select', 'name' => 'Category', 'options' => $CategoryList, 'frist_option' => '漏洞类别'],
        ['type' => 'select', 'name' => 'code_id', 'options' => $fortifyProjectList, 'frist_option' => '项目列表'],
        ['type' => 'select', 'name' => 'Primary_filename', 'options' => $fileList, 'frist_option' => '文件筛选'],
        ['type' => 'select', 'name' => 'filetype', 'options' => $fileTypeList, 'frist_option' => '文件后缀'],
        ['type' => 'select', 'name' => 'check_status', 'options' => $check_status_list, 'frist_option' => '审计状态', 'frist_option_value' => -1],
    ]]; ?>
{include file='public/search' /}

<div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card">
    <div class="px-5 py-4 border-b border-surface-200 flex items-center gap-3">
        {include file='public/batch_del' /}
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-surface-100">
                    <th class="w-14 px-5 py-4 text-left">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" value="-1" onclick="quanxuan(this)" class="w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20 cursor-pointer">
                            <span class="text-xs font-semibold text-text-secondary uppercase">全选</span>
                        </label>
                    </th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">漏洞类型</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">危险等级</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">污染来源</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">执行位置</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">所属项目</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">创建时间</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">状态</th>
                    <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider w-40">操作</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-200">
                <?php foreach ($list as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4">
                            <input type="checkbox" class="ids w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20 cursor-pointer" name="ids[]" value="<?php echo $value['id'] ?>">
                        </td>
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4 text-sm text-text-primary"><?php echo $value['Category'] ?></td>
                        <td class="px-5 py-4">
                            <?php
                            $levelColors = [
                                'critical' => 'bg-red-50 text-red-600 border-red-100',
                                'high' => 'bg-orange-50 text-orange-600 border-orange-100',
                                'medium' => 'bg-amber-50 text-amber-600 border-amber-100',
                                'low' => 'bg-blue-50 text-blue-600 border-blue-100'
                            ];
                            $levelColor = $levelColors[$dengjiArrColor[$value['Friority']]] ?? 'bg-slate-50 text-slate-600 border-slate-100';
                            ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold <?php echo $levelColor; ?> border">
                                <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                <?php echo $value['Friority'] ?>
                            </span>
                        </td>
                        <?php
                            if ($projectArr[$value['code_id']]['is_online'] == 1) {
                                $url = isset($projectArr[$value['code_id']]) ? $projectArr[$value['code_id']]['domain_name'] : '';
                                $url .= '/';
                                $url .= isset($value['Source']['FilePath']) ? $value['Source']['FilePath'].'#L'.$value['Source']['LineStart'] :'';
                            } else {
                                $url = url('get_code',['id'=>$value['id'],'type'=>1]);
                            }
                        ?>
                        <td class="px-5 py-4" title="<?php echo htmlentities($value['Source']['Snippet'] ?? '') ?>">
                            <a href="<?php echo $url; ?>" target="_blank" class="text-primary hover:underline text-sm">
                                <span class="font-mono text-xs text-text-secondary bg-surface-100 px-2 py-1 rounded"><?php echo $value['Source']['FileName'] ?? '' ?></span>
                            </a>
                        </td>
                        <?php
                            if ($projectArr[$value['code_id']]['is_online'] == 1) {
                                $url = isset($projectArr[$value['code_id']]) ? $projectArr[$value['code_id']]['domain_name'] : '';
                                $url .= '/'.$value['Primary']['FilePath'].'#L'.$value['Primary']['LineStart'];
                            } else {
                                $url = url('get_code',['id'=>$value['id'],'type'=>1]);
                            }
                        ?>
                        <td class="px-5 py-4" title="<?php echo htmlentities($value['Primary']['Snippet'] ?? '') ?>">
                            <a href="<?php echo $url; ?>" target="_blank" class="text-primary hover:underline text-sm">
                                <span class="font-mono text-xs text-text-secondary bg-surface-100 px-2 py-1 rounded"><?php echo $value['Primary']['FileName'] ?></span>
                            </a>
                        </td>
                        <td class="px-5 py-4">
                            <a href="<?php echo url('code/index', ['id' => $value['code_id']]) ?>" class="text-primary hover:underline text-sm">
                                <?php echo isset($projectArr[$value['code_id']]) ? $projectArr[$value['code_id']]['name'] : '' ?>
                            </a>
                        </td>
                        <td class="px-5 py-4 text-sm text-text-secondary"><?php echo $value['create_time'] ?></td>
                        <td class="px-5 py-4">
                            <select class="changCheckStatus bg-surface-100 border border-surface-300 rounded-lg px-3 py-1.5 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none" data-id="<?php echo $value['id'] ?>">
                                <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                                <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                                <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                            </select>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex gap-1">
                                <button onclick="openDrawer('<?php echo url('code/bug_details', ['id' => $value['id']]) ?>')"
                                        class="w-9 h-9 rounded-xl bg-surface-100 text-primary hover:bg-primary-light transition-colors flex items-center justify-center" title="查看漏洞">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                <a href="<?php echo url('code/bug_del', ['id' => $value['id']]) ?>"
                                   class="w-9 h-9 rounded-xl bg-surface-100 text-red-500 hover:bg-red-50 transition-colors flex items-center justify-center" title="删除"
                                   onclick="return confirm('确定要删除这条记录吗？')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                <?php if (empty($list)) { ?>
                    <tr>
                        <td colspan="10" class="px-5 py-10 text-center">
                            <div class="flex flex-col items-center text-text-muted">
                                <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                                <span class="text-sm">暂无漏洞数据</span>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- 右侧抽屉 -->
<div id="drawerOverlay" class="fixed inset-0 bg-black/30 z-50 opacity-0 invisible transition-opacity duration-300" onclick="closeDrawer()"></div>
<div id="drawerPanel" class="fixed top-0 right-0 h-full w-[560px] bg-white shadow-xl z-50 transform translate-x-full transition-transform duration-300 flex flex-col">
    <div class="px-6 py-5 border-b border-surface-200 bg-surface-50 flex items-center justify-between">
        <h3 class="text-lg font-bold text-text-primary">漏洞详情</h3>
        <button onclick="closeDrawer()" class="w-9 h-9 rounded-xl hover:bg-surface-100 flex items-center justify-center transition-colors">
            <svg class="w-5 h-5 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    <div id="drawerContent" class="flex-1 overflow-y-auto p-6">
        <div class="text-center py-10 text-text-muted">
            加载中...
        </div>
    </div>
</div>

<input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/fortify') ?>">

{include file='public/to_examine' /}
{include file='public/fenye' /}
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

        fetch("<?php echo url('bug_batch_del')?>", {
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

    // 抽屉功能
    function openDrawer(url) {
        var overlay = document.getElementById('drawerOverlay');
        var panel = document.getElementById('drawerPanel');
        var content = document.getElementById('drawerContent');

        overlay.classList.remove('opacity-0', 'invisible');
        overlay.classList.add('opacity-100', 'visible');
        panel.classList.remove('translate-x-full');
        panel.classList.add('translate-x-0');
        document.body.style.overflow = 'hidden';

        // 加载内容
        content.innerHTML = '<div class="text-center py-10 text-text-muted">加载中...</div>';
        fetch(url)
            .then(response => response.text())
            .then(html => {
                content.innerHTML = html;
            })
            .catch(err => {
                content.innerHTML = '<div class="text-center py-10 text-red-500">加载失败</div>';
            });
    }

    function closeDrawer() {
        var overlay = document.getElementById('drawerOverlay');
        var panel = document.getElementById('drawerPanel');

        overlay.classList.remove('opacity-100', 'visible');
        overlay.classList.add('opacity-0', 'invisible');
        panel.classList.remove('translate-x-0');
        panel.classList.add('translate-x-full');
        document.body.style.overflow = '';
    }

    // ESC 键关闭抽屉
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDrawer();
        }
    });
</script>
