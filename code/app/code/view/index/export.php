<html>
<head>
    <title>白盒项目扫描结果 Sec</title>
    <link rel="shortcut icon" href="/static/favicon.svg" type="image/x-icon"/>
    <script src="/static/js/jquery.min.js"></script>
    <link href="/static/css/qingscan.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        'primary-hover': '#2563eb',
                        'primary-light': '#eff6ff',
                        surface: {
                            50: '#ffffff',
                            100: '#f8fafc',
                            200: '#f1f5f9',
                            300: '#e2e8f0',
                            400: '#cbd5e1',
                        },
                        text: {
                            primary: '#1e293b',
                            secondary: '#64748b',
                            muted: '#94a3b8',
                        }
                    },
                    boxShadow: {
                        'card': '0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04)',
                        'hover': '0 4px 12px -2px rgb(0 0 0 / 0.1)',
                    }
                }
            }
        }
    </script>
    <style>
        .tuchu_col { break-inside: avoid; }
    </style>
</head>
<body class="bg-surface-100 min-h-screen">
<?php
$dengjiArr = ['Low', 'Medium', 'High', 'Critical'];
$dengjiArrColor = ['Low' => 'sky', 'Medium' => 'amber', 'High' => 'orange', 'Critical' => 'red'];
$show_level = [
    1=>'强烈建议修复',
    2=>'建议修复',
    3=>'可选修复'
];
?>

<div class="max-w-7xl mx-auto p-6">
    <!-- 基本信息 -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h2 class="text-xl font-bold text-text-primary text-center">基本信息</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">ID</span>
                    <div class="mt-1 font-semibold text-text-primary"><?php echo $info['id'] ?></div>
                </div>
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">名称</span>
                    <div class="mt-1 font-semibold text-text-primary"><?php echo $info['name'] ?></div>
                </div>
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">扫描状态</span>
                    <div class="mt-1 font-semibold text-text-primary"><?php echo $info['status'] ?></div>
                </div>
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">项目描述</span>
                    <div class="mt-1 text-sm text-text-secondary"><?php echo $info['desc'] ?></div>
                </div>
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">SSH URL</span>
                    <div class="mt-1 font-mono text-sm text-text-primary break-all"><?php echo $info['ssh_url'] ?></div>
                </div>
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">创建时间</span>
                    <div class="mt-1 font-semibold text-text-primary"><?php echo $info['create_time'] ?></div>
                </div>
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">Star</span>
                    <div class="mt-1 font-semibold text-text-primary"><?php echo $info['star'] ?></div>
                </div>
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">密码</span>
                    <div class="mt-1 font-mono text-sm text-text-primary"><?php echo $info['password'] ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- 工具扫描动态 -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h2 class="text-xl font-bold text-text-primary text-center">工具扫描动态</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-4 gap-4">
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">Fortify</span>
                    <div class="mt-1 text-sm text-text-secondary"><?php echo $info['scan_time'] ?></div>
                </div>
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">SemGrep</span>
                    <div class="mt-1 text-sm text-text-secondary"><?php echo $info['semgrep_scan_time'] ?></div>
                </div>
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">MobSFScan</span>
                    <div class="mt-1 text-sm text-text-secondary"><?php echo $info['mobsfscan_scan_time'] ?></div>
                </div>
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">MurphySec</span>
                    <div class="mt-1 text-sm text-text-secondary"><?php echo $info['murphysec_scan_time'] ?></div>
                </div>
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">Composer组件</span>
                    <div class="mt-1 text-sm text-text-secondary"><?php echo $info['composer_scan_time'] ?></div>
                </div>
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">Java组件</span>
                    <div class="mt-1 text-sm text-text-secondary"><?php echo $info['java_scan_time'] ?></div>
                </div>
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">Python组件</span>
                    <div class="mt-1 text-sm text-text-secondary"><?php echo $info['python_scan_time'] ?></div>
                </div>
                <div class="bg-surface-50 rounded-xl p-4">
                    <span class="text-xs text-text-muted uppercase tracking-wider">河马WebShell</span>
                    <div class="mt-1 text-sm text-text-secondary"><?php echo $info['webshell_scan_time'] ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- 工具扫描结果 - 网格布局 -->
    <div class="columns-1 lg:columns-2 gap-6">

        <!-- Fortify -->
        <div class="tuchu_col bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-surface-200 bg-surface-50 flex justify-between items-center">
                <h4 class="text-lg font-bold text-text-primary">Fortify</h4>
                <div class="flex gap-2">
                    <a href="<?php echo url('code/rescan', ['id'=>$info['id'],'tools_name' => 'fortify']) ?>"
                       onClick="return confirm('确定要清空该工具数据重新扫描吗?')"
                       class="px-3 py-1.5 rounded-lg border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:border-primary hover:text-primary transition-all">重新扫描</a>
                    <a href="<?php echo url('fortify/index', ['code_id' => $info['id']]) ?>"
                       class="px-3 py-1.5 rounded-lg bg-primary-light text-primary text-sm font-medium hover:bg-blue-100 transition-all">查看更多</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-surface-100">
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">漏洞类型</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">危险等级</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">污染来源</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">执行位置</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">扫描时间</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">状态</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-200">
                        <?php foreach ($fortify as $value) {
                            $value['Source'] = json_decode($value['Source'],true);
                            $value['Primary'] = json_decode($value['Primary'],true);
                        ?>
                        <tr class="hover:bg-surface-50 transition-colors">
                            <td class="px-4 py-3 text-sm font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-primary"><?php echo $value['Category'] ?></td>
                            <td class="px-4 py-3">
                                <?php $color = $dengjiArrColor[$value['Friority']] ?? 'slate'; ?>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-semibold bg-<?php echo $color ?>-50 text-<?php echo $color ?>-600">
                                    <?php echo $value['Friority'] ?>
                                </span>
                            </td>
                            <?php
                                if ($projectArr[$value['code_id']]['is_online'] == 1) {
                                    $url = isset($projectArr[$value['code_id']]) ? $projectArr[$value['code_id']]['ssh_url'] : '';
                                    $url .= '/-/blob/master/';
                                    $url .= $value['Source']['FilePath'] ?? '';
                                } else {
                                    $url = url('get_code',['id'=>$value['id'],'type'=>1]);
                                }
                            ?>
                            <td class="px-4 py-3" title="<?php echo htmlentities($value['Source']['Snippet'] ?? '') ?>">
                                <a href="<?php echo $url; ?>" target="_blank" class="text-primary hover:underline text-sm font-mono">
                                    <?php echo $value['Source']['FileName'] ?? '' ?>
                                </a>
                            </td>
                            <?php
                                if ($projectArr[$value['code_id']]['is_online'] == 1) {
                                    $url = isset($projectArr[$value['code_id']]) ? $projectArr[$value['code_id']]['ssh_url'] : '';
                                    $url .= '/-/blob/master/'.$value['Primary']['FilePath'];
                                } else {
                                    $url = url('get_code',['id'=>$value['id'],'type'=>1]);
                                }
                            ?>
                            <td class="px-4 py-3" title="<?php echo htmlentities($value['Primary']['Snippet'] ?? '') ?>">
                                <a href="<?php echo $url; ?>" target="_blank" class="text-primary hover:underline text-sm font-mono">
                                    <?php echo isset($value['Primary'])?$value['Primary']['FileName']:'' ?>
                                </a>
                            </td>
                            <td class="px-4 py-3 text-sm text-text-secondary"><?php echo $value['create_time'] ?></td>
                            <td class="px-4 py-3">
                                <select class="changCheckStatus bg-surface-100 border border-surface-300 rounded-lg px-2 py-1 text-sm focus:border-primary focus:outline-none" data-id="<?php echo $value['id'] ?>">
                                    <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                                    <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                                    <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                                </select>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($fortify)) { ?>
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'fortifyScan', 2); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SemGrep -->
        <div class="tuchu_col bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-surface-200 bg-surface-50 flex justify-between items-center">
                <h4 class="text-lg font-bold text-text-primary">SemGrep</h4>
                <div class="flex gap-2">
                    <a href="<?php echo url('code/rescan', ['id'=>$info['id'],'tools_name' => 'semgrep']) ?>"
                       onClick="return confirm('确定要清空该工具数据重新扫描吗?')"
                       class="px-3 py-1.5 rounded-lg border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:border-primary hover:text-primary transition-all">重新扫描</a>
                    <a href="<?php echo url('semgrep/index', ['code_id' => $info['id']]) ?>"
                       class="px-3 py-1.5 rounded-lg bg-primary-light text-primary text-sm font-medium hover:bg-blue-100 transition-all">查看更多</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-surface-100">
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">漏洞类型</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">危险等级</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">污染来源</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">代码行号</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">扫描时间</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">状态</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-200">
                        <?php foreach ($semgrep as $value) {
                            $project = getCodeInfo($value['code_id']);
                        ?>
                        <tr class="hover:bg-surface-50 transition-colors">
                            <td class="px-4 py-3 text-sm font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-primary font-mono"><?php echo str_replace('data.tools.semgrep.', "", $value['check_id']) ?></td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-semibold bg-orange-50 text-orange-600">
                                    <?php echo $value['extra_severity'] ?>
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <?php
                                $path = preg_replace("/\/data\/codeCheck\/[a-zA-Z0-9]*\//", "", $value['path']);
                                if ($projectArr[$value['code_id']]['is_online'] == 1) {
                                    $url = getGitAddr($project['name'], $project['ssh_url'], $value['path'], $value['end_line']);
                                } else {
                                    $url = url('get_code',['id'=>$value['id'],'type'=>2]);
                                }
                                ?>
                                <a title="<?php echo htmlentities($value['extra_lines']) ?>" href="<?php echo $url ?>"
                                   target="_blank" class="text-primary hover:underline text-sm font-mono"><?php echo $path ?></a>
                            </td>
                            <td class="px-4 py-3 text-sm text-text-secondary"><?php echo $value['end_line'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-secondary"><?php echo $value['create_time'] ?></td>
                            <td class="px-4 py-3">
                                <select class="changCheckStatus bg-surface-100 border border-surface-300 rounded-lg px-2 py-1 text-sm focus:border-primary focus:outline-none" data-id="<?php echo $value['id'] ?>">
                                    <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                                    <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                                    <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                                </select>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($semgrep)) { ?>
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'semgrepScan'); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- mobsfscan -->
        <div class="tuchu_col bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-surface-200 bg-surface-50 flex justify-between items-center">
                <h4 class="text-lg font-bold text-text-primary">mobsfscan</h4>
                <div class="flex gap-2">
                    <a href="<?php echo url('code/rescan', ['id'=>$info['id'],'tools_name' => 'mobsfscan']) ?>"
                       onClick="return confirm('确定要清空该工具数据重新扫描吗?')"
                       class="px-3 py-1.5 rounded-lg border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:border-primary hover:text-primary transition-all">重新扫描</a>
                    <a href="<?php echo url('mobsfscan/index', ['code_id' => $info['id']]) ?>"
                       class="px-3 py-1.5 rounded-lg bg-primary-light text-primary text-sm font-medium hover:bg-blue-100 transition-all">查看更多</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-surface-100">
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">漏洞类型</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">CWE</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">危险等级</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">扫描时间</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">状态</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-200">
                        <?php foreach ($mobsfscan as $value) { ?>
                        <tr class="hover:bg-surface-50 transition-colors">
                            <td class="px-4 py-3 text-sm font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-primary"><?php echo $value['type']; ?></td>
                            <td class="px-4 py-3 text-sm text-text-secondary font-mono"><?php echo $value['cwe']; ?></td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-semibold bg-red-50 text-red-600">
                                    <?php echo $value['severity']; ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-text-secondary"><?php echo $value['create_time'] ?></td>
                            <td class="px-4 py-3">
                                <select class="changCheckStatus bg-surface-100 border border-surface-300 rounded-lg px-2 py-1 text-sm focus:border-primary focus:outline-none" data-id="<?php echo $value['id'] ?>">
                                    <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                                    <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                                    <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                                </select>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($mobsfscan)) { ?>
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'mobsfscan'); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- murphysec -->
        <div class="tuchu_col bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-surface-200 bg-surface-50 flex justify-between items-center">
                <h4 class="text-lg font-bold text-text-primary">murphysec</h4>
                <div class="flex gap-2">
                    <a href="<?php echo url('code/rescan', ['id'=>$info['id'],'tools_name' => 'murphysec']) ?>"
                       onClick="return confirm('确定要清空该工具数据重新扫描吗?')"
                       class="px-3 py-1.5 rounded-lg border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:border-primary hover:text-primary transition-all">重新扫描</a>
                    <a href="<?php echo url('murphysec/index', ['code_id' => $info['id']]) ?>"
                       class="px-3 py-1.5 rounded-lg bg-primary-light text-primary text-sm font-medium hover:bg-blue-100 transition-all">查看更多</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-surface-100">
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">缺陷组件</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">处置建议</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">当前版本</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">修复状态</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">时间</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-200">
                        <?php foreach ($murphysec as $value) { ?>
                        <tr class="hover:bg-surface-50 transition-colors">
                            <td class="px-4 py-3 text-sm font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-primary"><?php echo $value['comp_name'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-secondary"><?php echo $show_level[$value['show_level']] ?></td>
                            <td class="px-4 py-3 text-sm text-text-secondary font-mono"><?php echo $value['version'] ?></td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-semibold <?php echo $value['repair_status']==1 ? 'bg-red-50 text-red-600' : 'bg-emerald-50 text-emerald-600' ?>">
                                    <?php echo $value['repair_status']==1?'未修复':'已修复' ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-text-secondary"><?php echo $value['create_time'] ?></td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($murphysec)) { ?>
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'crawlergoScan'); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 河马 WebShell -->
        <div class="tuchu_col bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-surface-200 bg-surface-50 flex justify-between items-center">
                <h4 class="text-lg font-bold text-text-primary">河马 (WebShell)</h4>
                <div class="flex gap-2">
                    <a href="<?php echo url('code/rescan', ['id'=>$info['id'],'tools_name' => 'webshell']) ?>"
                       onClick="return confirm('确定要清空该工具数据重新扫描吗?')"
                       class="px-3 py-1.5 rounded-lg border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:border-primary hover:text-primary transition-all">重新扫描</a>
                    <a href="<?php echo url('code_webshell/index', ['code_id' => $info['id']]) ?>"
                       class="px-3 py-1.5 rounded-lg bg-primary-light text-primary text-sm font-medium hover:bg-blue-100 transition-all">查看更多</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-surface-100">
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">类型</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">文件路径</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">扫描时间</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">状态</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-200">
                        <?php foreach ($hema as $value) { ?>
                        <tr class="hover:bg-surface-50 transition-colors">
                            <td class="px-4 py-3 text-sm font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-primary"><?php echo $value['type'] ?></td>
                            <td class="px-4 py-3 text-sm font-mono text-text-secondary"><?php echo str_replace('./extend/codeCheck/', '', $value['filename']) ?></td>
                            <td class="px-4 py-3 text-sm text-text-secondary"><?php echo $value['create_time']; ?></td>
                            <td class="px-4 py-3">
                                <select class="changCheckStatus bg-surface-100 border border-surface-300 rounded-lg px-2 py-1 text-sm focus:border-primary focus:outline-none" data-id="<?php echo $value['id'] ?>">
                                    <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                                    <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                                    <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                                </select>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($hema)) { ?>
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'code_webshell_scan', 2); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- JAVA -->
        <div class="tuchu_col bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-surface-200 bg-surface-50 flex justify-between items-center">
                <h4 class="text-lg font-bold text-text-primary">JAVA</h4>
                <div class="flex gap-2">
                    <a href="<?php echo url('code/rescan', ['id'=>$info['id'],'tools_name' => 'java']) ?>"
                       onClick="return confirm('确定要清空该工具数据重新扫描吗?')"
                       class="px-3 py-1.5 rounded-lg border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:border-primary hover:text-primary transition-all">重新扫描</a>
                    <a href="<?php echo url('code_java/index', ['code_id' => $info['id']]) ?>"
                       class="px-3 py-1.5 rounded-lg bg-primary-light text-primary text-sm font-medium hover:bg-blue-100 transition-all">查看更多</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-surface-100">
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">groupId</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">artifactId</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">version</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">时间</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-200">
                        <?php foreach ($java as $value) { ?>
                        <tr class="hover:bg-surface-50 transition-colors">
                            <td class="px-4 py-3 text-sm font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-secondary font-mono"><?php echo $value['groupId'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-primary font-mono"><?php echo $value['artifactId'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-secondary font-mono"><?php echo $value['version'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-secondary"><?php echo $value['create_time'] ?></td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($java)) { ?>
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'code_java', 2); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Python依赖 -->
        <div class="tuchu_col bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-surface-200 bg-surface-50 flex justify-between items-center">
                <h4 class="text-lg font-bold text-text-primary">Python 依赖</h4>
                <div class="flex gap-2">
                    <a href="<?php echo url('code/rescan', ['id'=>$info['id'],'tools_name' => 'python']) ?>"
                       onClick="return confirm('确定要清空该工具数据重新扫描吗?')"
                       class="px-3 py-1.5 rounded-lg border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:border-primary hover:text-primary transition-all">重新扫描</a>
                    <a href="<?php echo url('code_python/index', ['code_id' => $info['id']]) ?>"
                       class="px-3 py-1.5 rounded-lg bg-primary-light text-primary text-sm font-medium hover:bg-blue-100 transition-all">查看更多</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-surface-100">
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">依赖库</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">时间</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-200">
                        <?php foreach ($python as $value) { ?>
                        <tr class="hover:bg-surface-50 transition-colors">
                            <td class="px-4 py-3 text-sm font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-primary font-mono"><?php echo $value['name'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-secondary"><?php echo $value['create_time'] ?></td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($python)) { ?>
                        <tr>
                            <td colspan="3" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'code_python', 2); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PHP依赖 -->
        <div class="tuchu_col bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-surface-200 bg-surface-50 flex justify-between items-center">
                <h4 class="text-lg font-bold text-text-primary">PHP 依赖 (Composer)</h4>
                <div class="flex gap-2">
                    <a href="<?php echo url('code/rescan', ['id'=>$info['id'],'tools_name' => 'php']) ?>"
                       onClick="return confirm('确定要清空该工具数据重新扫描吗?')"
                       class="px-3 py-1.5 rounded-lg border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:border-primary hover:text-primary transition-all">重新扫描</a>
                    <a href="<?php echo url('code_composer/index', ['code_id' => $info['id']]) ?>"
                       class="px-3 py-1.5 rounded-lg bg-primary-light text-primary text-sm font-medium hover:bg-blue-100 transition-all">查看更多</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-surface-100">
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">name</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">version</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-text-secondary uppercase">时间</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-200">
                        <?php foreach ($php as $value) { ?>
                        <tr class="hover:bg-surface-50 transition-colors">
                            <td class="px-4 py-3 text-sm font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-primary font-mono"><?php echo $value['name'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-secondary font-mono"><?php echo $value['version'] ?></td>
                            <td class="px-4 py-3 text-sm text-text-secondary"><?php echo $value['create_time'] ?></td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($php)) { ?>
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'code_php', 2); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<footer class="bg-white border-t border-surface-200 py-4 mt-6">
    <div class="max-w-7xl mx-auto px-6">
        <p class="text-center text-sm text-text-muted">
            QingScan 产品仅授权你在遵守《<a class="text-primary hover:underline"
                        href="https://baike.baidu.com/item/%E4%B8%AD%E5%8D%8E%E4%BA%BA%E6%B0%91%E5%85%B1%E5%92%8C%E5%9B%BD%E7%BD%91%E7%BB%9C%E5%AE%89%E5%85%A8%E6%B3%95"
                        target="_blank">中华人民共和国网络安全法</a>》前提下使用，如果你有二次开发需求,可以微信联系我<code class="bg-surface-100 px-2 py-0.5 rounded text-text-secondary">songboy8888</code>
        </p>
    </div>
</footer>
</body>
</html>
