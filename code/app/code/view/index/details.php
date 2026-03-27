{include file='public/head' /}
{include file='public/whiteLeftMenu' /}

<?php
$dengjiArr = ['Low', 'Medium', 'High', 'Critical'];
        $dengjiArrColor = ['Low' => 'slate', 'Medium' => 'blue', 'High' => 'amber', 'Critical' => 'red'];
        $dengjiArrBg = ['Low' => 'bg-slate-100 text-slate-600', 'Medium' => 'bg-blue-100 text-blue-600', 'High' => 'bg-amber-100 text-amber-600', 'Critical' => 'bg-red-100 text-red-600'];
        $show_level = [
            1 => '强烈建议修复',
            2 => '建议修复',
            3 => '可选修复'
        ];
        ?>

        <!-- 基本信息卡片 -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-card p-6 mb-6">
            <h2 class="text-lg font-bold text-slate-800 mb-4 pb-4 border-b border-slate-200">基本信息</h2>
            <div class="grid grid-cols-3 gap-6">
                <div>
                    <span class="text-slate-500 text-sm">ID</span>
                    <p class="text-slate-800 font-medium mt-1"><?php echo $info['id'] ?></p>
                </div>
                <div>
                    <span class="text-slate-500 text-sm">名称</span>
                    <p class="text-slate-800 font-medium mt-1"><?php echo $info['name'] ?></p>
                </div>
                <div>
                    <span class="text-slate-500 text-sm">扫描状态</span>
                    <p class="text-slate-800 font-medium mt-1"><?php echo $info['status'] ?></p>
                </div>
                <div>
                    <span class="text-slate-500 text-sm">项目描述</span>
                    <p class="text-slate-800 font-medium mt-1"><?php echo $info['desc'] ?></p>
                </div>
                <div>
                    <span class="text-slate-500 text-sm">SSH URL</span>
                    <p class="text-slate-800 font-medium mt-1 font-mono text-sm truncate"><?php echo $info['ssh_url'] ?></p>
                </div>
                <div>
                    <span class="text-slate-500 text-sm">创建时间</span>
                    <p class="text-slate-800 font-medium mt-1"><?php echo $info['create_time'] ?></p>
                </div>
                <div>
                    <span class="text-slate-500 text-sm">Star</span>
                    <p class="text-slate-800 font-medium mt-1"><?php echo $info['star'] ?></p>
                </div>
            </div>
        </div>

        <!-- 工具扫描动态卡片 -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-card p-6 mb-6">
            <h2 class="text-lg font-bold text-slate-800 mb-4 pb-4 border-b border-slate-200">工具扫描动态</h2>
            <div class="grid grid-cols-3 gap-6">
                <div>
                    <span class="text-slate-500 text-sm">Fortify</span>
                    <p class="text-slate-800 font-medium mt-1"><?php echo $info['scan_time'] ?></p>
                </div>
                <div>
                    <span class="text-slate-500 text-sm">SemGrep</span>
                    <p class="text-slate-800 font-medium mt-1"><?php echo $info['semgrep_scan_time'] ?></p>
                </div>
                <div>
                    <span class="text-slate-500 text-sm">MobSFScan</span>
                    <p class="text-slate-800 font-medium mt-1"><?php echo $info['mobsfscan_scan_time'] ?></p>
                </div>
                <div>
                    <span class="text-slate-500 text-sm">MurphySec</span>
                    <p class="text-slate-800 font-medium mt-1"><?php echo $info['murphysec_scan_time'] ?></p>
                </div>
                <div>
                    <span class="text-slate-500 text-sm">Composer组件</span>
                    <p class="text-slate-800 font-medium mt-1"><?php echo $info['composer_scan_time'] ?></p>
                </div>
                <div>
                    <span class="text-slate-500 text-sm">Java组件</span>
                    <p class="text-slate-800 font-medium mt-1"><?php echo $info['java_scan_time'] ?></p>
                </div>
                <div>
                    <span class="text-slate-500 text-sm">Python组件</span>
                    <p class="text-slate-800 font-medium mt-1"><?php echo $info['python_scan_time'] ?></p>
                </div>
                <div>
                    <span class="text-slate-500 text-sm">河马WebShell</span>
                    <p class="text-slate-800 font-medium mt-1"><?php echo $info['webshell_scan_time'] ?></p>
                </div>
            </div>
        </div>

        <!-- Fortify 扫描结果 -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">Fortify</h3>
                <div class="flex gap-2">
                    <a href="<?php echo url('fortify/index', ['code_id' => $info['id']]) ?>" class="px-4 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-100 transition-colors">查看更多</a>
                    <a href="<?php echo url('code/rescan', ['id' => $info['id'], 'tools_name' => 'fortify']) ?>" onClick="return confirm('确定要清空该工具数据重新扫描吗?')" class="px-4 py-2 rounded-lg text-sm bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors">重新扫描</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-100 text-left">
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">ID</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">漏洞类型</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">危险等级</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">污染来源</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">执行位置</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">扫描时间</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">状态</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <?php foreach ($fortify as $value) {
                            $value['Source'] = json_decode(($value['Source'] === null) ? '[]' : $value['Source'], true);
                            $value['Primary'] = json_decode($value['Primary'], true);
                        ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['Category'] ?></td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium <?php echo $dengjiArrBg[$value['Friority']] ?>"><?php echo $value['Friority'] ?></span>
                            </td>
                            <?php
                            if ($projectArr[$value['code_id']]['is_online'] == 1) {
                                $url = isset($projectArr[$value['code_id']]) ? $projectArr[$value['code_id']]['ssh_url'] : '';
                                $url .= '/-/blob/master/';
                                $url .= $value['Source']['FilePath'] ?? '';
                            } else {
                                $url = url('get_code', ['id' => $value['id'], 'type' => 1]);
                            }
                            ?>
                            <td class="px-4 py-3 text-slate-700 font-mono text-sm truncate max-w-xs" title="<?php echo htmlentities($value['Source']['Snippet'] ?? '') ?>">
                                <a href="<?php echo $url; ?>" target="_blank" class="text-blue-600 hover:underline"><?php echo $value['Source']['FileName'] ?? '' ?></a>
                            </td>
                            <?php
                            if ($projectArr[$value['code_id']]['is_online'] == 1) {
                                $url = isset($projectArr[$value['code_id']]) ? $projectArr[$value['code_id']]['ssh_url'] : '';
                                $url .= '/-/blob/master/' . $value['Primary']['FilePath'];
                            } else {
                                $url = url('get_code', ['id' => $value['id'], 'type' => 1]);
                            }
                            ?>
                            <td class="px-4 py-3 text-slate-700 font-mono text-sm truncate max-w-xs" title="<?php echo htmlentities($value['Primary']['Snippet'] ?? '') ?>">
                                <a href="<?php echo $url; ?>" target="_blank" class="text-blue-600 hover:underline"><?php echo isset($value['Primary']) ? $value['Primary']['FileName'] : '' ?></a>
                            </td>
                            <td class="px-4 py-3 text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                            <td class="px-4 py-3">
                                <select class="changCheckStatus bg-slate-50 border border-slate-300 rounded-lg px-3 py-1.5 text-sm focus:border-blue-500 focus:outline-none" data-id="<?php echo $value['id'] ?>">
                                    <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?>>未审核</option>
                                    <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?>>有效漏洞</option>
                                    <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?>>无效漏洞</option>
                                </select>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($fortify)) { ?>
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-slate-500"><?php echo getScanStatus($info['id'], 'fortifyScan', 2); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SemGrep 扫描结果 -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">SemGrep</h3>
                <div class="flex gap-2">
                    <a href="<?php echo url('semgrep/index', ['code_id' => $info['id']]) ?>" class="px-4 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-100 transition-colors">查看更多</a>
                    <a href="<?php echo url('code/rescan', ['id' => $info['id'], 'tools_name' => 'semgrep']) ?>" onClick="return confirm('确定要清空该工具数据重新扫描吗?')" class="px-4 py-2 rounded-lg text-sm bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors">重新扫描</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-100 text-left">
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">ID</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">漏洞类型</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">危险等级</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">污染来源</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">代码行号</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">扫描时间</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">状态</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <?php foreach ($semgrep as $value) {
                            $project = getCodeInfo($value['code_id']);
                        ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-slate-700 text-sm"><?php echo str_replace('data.tools.semgrep.', "", $value['check_id']) ?></td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['extra_severity'] ?></td>
                            <td class="px-4 py-3 text-slate-700 font-mono text-sm truncate max-w-xs">
                                <?php
                                $path = preg_replace("/\/data\/codeCheck\/[a-zA-Z0-9]*\//", "", $value['path']);
                                if ($projectArr[$value['code_id']]['is_online'] == 1) {
                                    $url = getGitAddr($project['name'], $project['ssh_url'], $value['path'], $value['end_line']);
                                } else {
                                    $url = url('get_code', ['id' => $value['id'], 'type' => 2]);
                                }
                                ?>
                                <a title="<?php echo htmlentities($value['extra_lines'] ?? '') ?>" href="<?php echo $url ?>" target="_blank" class="text-blue-600 hover:underline"><?php echo $path ?></a>
                            </td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['end_line']; ?></td>
                            <td class="px-4 py-3 text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                            <td class="px-4 py-3">
                                <select class="changCheckStatus bg-slate-50 border border-slate-300 rounded-lg px-3 py-1.5 text-sm focus:border-blue-500 focus:outline-none" data-id="<?php echo $value['id'] ?>">
                                    <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?>>未审核</option>
                                    <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?>>有效漏洞</option>
                                    <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?>>无效漏洞</option>
                                </select>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($semgrep)) { ?>
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-slate-500"><?php echo getScanStatus($info['id'], 'semgrepScan'); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- mobsfscan 扫描结果 -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">mobsfscan</h3>
                <div class="flex gap-2">
                    <a href="<?php echo url('mobsfscan/index', ['code_id' => $info['id']]) ?>" class="px-4 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-100 transition-colors">查看更多</a>
                    <a href="<?php echo url('code/rescan', ['id' => $info['id'], 'tools_name' => 'mobsfscan']) ?>" onClick="return confirm('确定要清空该工具数据重新扫描吗?')" class="px-4 py-2 rounded-lg text-sm bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors">重新扫描</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-100 text-left">
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">ID</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">漏洞类型</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">CWE</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">漏洞描述</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">危险等级</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">扫描时间</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">状态</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <?php foreach ($mobsfscan as $value) { ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-slate-700 text-sm"><?php echo $value['type']; ?></td>
                            <td class="px-4 py-3 text-slate-700 text-sm"><?php echo $value['cwe']; ?></td>
                            <td class="px-4 py-3 text-slate-700 text-sm truncate max-w-xs"><?php echo $value['description']; ?></td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['severity']; ?></td>
                            <td class="px-4 py-3 text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                            <td class="px-4 py-3">
                                <select class="changCheckStatus bg-slate-50 border border-slate-300 rounded-lg px-3 py-1.5 text-sm focus:border-blue-500 focus:outline-none" data-id="<?php echo $value['id'] ?>">
                                    <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?>>未审核</option>
                                    <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?>>有效漏洞</option>
                                    <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?>>无效漏洞</option>
                                </select>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($mobsfscan)) { ?>
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-slate-500"><?php echo getScanStatus($info['id'], 'mobsfscan'); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- murphysec 扫描结果 -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">murphysec</h3>
                <div class="flex gap-2">
                    <a href="<?php echo url('murphysec/index', ['code_id' => $info['id']]) ?>" class="px-4 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-100 transition-colors">查看更多</a>
                    <a href="<?php echo url('code/rescan', ['id' => $info['id'], 'tools_name' => 'murphysec']) ?>" onClick="return confirm('确定要清空该工具数据重新扫描吗?')" class="px-4 py-2 rounded-lg text-sm bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors">重新扫描</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-100 text-left">
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">ID</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">缺陷组件</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">处置建议</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">当前版本</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">最小修复版本</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">语言</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">修复状态</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">时间</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <?php foreach ($murphysec as $value) { ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['comp_name'] ?></td>
                            <td class="px-4 py-3 text-slate-700 text-sm"><?php echo $show_level[$value['show_level']] ?></td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['version'] ?></td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['min_fixed_version'] ?></td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['language'] ?></td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium <?php echo $value['repair_status'] == 1 ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' ?>">
                                    <?php echo $value['repair_status'] == 1 ? '未修复' : '已修复' ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($murphysec)) { ?>
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-slate-500"><?php echo getScanStatus($info['id'], 'crawlergoScan'); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 河马WebShell 扫描结果 -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">河马(WebShell)</h3>
                <div class="flex gap-2">
                    <a href="<?php echo url('code_webshell/index', ['code_id' => $info['id']]) ?>" class="px-4 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-100 transition-colors">查看更多</a>
                    <a href="<?php echo url('code/rescan', ['id' => $info['id'], 'tools_name' => 'webshell']) ?>" onClick="return confirm('确定要清空该工具数据重新扫描吗?')" class="px-4 py-2 rounded-lg text-sm bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors">重新扫描</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-100 text-left">
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">ID</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">类型</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">文件路径</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">扫描时间</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">状态</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <?php foreach ($hema as $value) { ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['type'] ?></td>
                            <td class="px-4 py-3 text-slate-700 font-mono text-sm"><?php echo str_replace('./extend/codeCheck/', '', $value['filename']) ?></td>
                            <td class="px-4 py-3 text-slate-500 text-sm"><?php echo $value['create_time']; ?></td>
                            <td class="px-4 py-3">
                                <select class="changCheckStatus bg-slate-50 border border-slate-300 rounded-lg px-3 py-1.5 text-sm focus:border-blue-500 focus:outline-none" data-id="<?php echo $value['id'] ?>">
                                    <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?>>未审核</option>
                                    <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?>>有效漏洞</option>
                                    <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?>>无效漏洞</option>
                                </select>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($hema)) { ?>
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-slate-500"><?php echo getScanStatus($info['id'], 'code_webshell_scan', 2); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Java组件 -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">JAVA</h3>
                <div class="flex gap-2">
                    <a href="<?php echo url('code_java/index', ['code_id' => $info['id']]) ?>" class="px-4 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-100 transition-colors">查看更多</a>
                    <a href="<?php echo url('code/rescan', ['id' => $info['id'], 'tools_name' => 'java']) ?>" onClick="return confirm('确定要清空该工具数据重新扫描吗?')" class="px-4 py-2 rounded-lg text-sm bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors">重新扫描</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-100 text-left">
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">ID</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">modelVersion</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">groupId</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">artifactId</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">version</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">时间</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <?php foreach ($java as $value) { ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['modelVersion'] ?></td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['groupId'] ?></td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['artifactId'] ?></td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['version'] ?></td>
                            <td class="px-4 py-3 text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($java)) { ?>
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-500"><?php echo getScanStatus($info['id'], 'code_java', 2); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Python依赖 -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">Python依赖</h3>
                <div class="flex gap-2">
                    <a href="<?php echo url('code_python/index', ['code_id' => $info['id']]) ?>" class="px-4 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-100 transition-colors">查看更多</a>
                    <a href="<?php echo url('code/rescan', ['id' => $info['id'], 'tools_name' => 'python']) ?>" onClick="return confirm('确定要清空该工具数据重新扫描吗?')" class="px-4 py-2 rounded-lg text-sm bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors">重新扫描</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-100 text-left">
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">ID</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">依赖库</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">时间</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <?php foreach ($python as $value) { ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['name'] ?></td>
                            <td class="px-4 py-3 text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($python)) { ?>
                        <tr>
                            <td colspan="3" class="px-4 py-8 text-center text-slate-500"><?php echo getScanStatus($info['id'], 'code_python', 2); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PHP依赖(Composer) -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-800">PHP依赖(Composer)</h3>
                <div class="flex gap-2">
                    <a href="<?php echo url('code_composer/index', ['code_id' => $info['id']]) ?>" class="px-4 py-2 rounded-lg text-sm text-slate-600 hover:bg-slate-100 transition-colors">查看更多</a>
                    <a href="<?php echo url('code/rescan', ['id' => $info['id'], 'tools_name' => 'php']) ?>" onClick="return confirm('确定要清空该工具数据重新扫描吗?')" class="px-4 py-2 rounded-lg text-sm bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors">重新扫描</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-100 text-left">
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">ID</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">name</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">version</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">source</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">require</th>
                            <th class="px-4 py-3 text-xs font-semibold text-slate-500 uppercase">时间</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <?php foreach ($php as $value) { ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['id'] ?></td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['name'] ?></td>
                            <td class="px-4 py-3 text-slate-700"><?php echo $value['version'] ?></td>
                            <td class="px-4 py-3 text-slate-700 text-sm"><pre class="whitespace-pre-wrap"><?php echo $value['source'] ?></pre></td>
                            <td class="px-4 py-3 text-slate-700 text-sm"><pre class="whitespace-pre-wrap"><?php echo $value['require'] ?></pre></td>
                            <td class="px-4 py-3 text-slate-500 text-sm"><?php echo $value['create_time'] ?></td>
                        </tr>
                        <?php } ?>
                        <?php if (empty($php)) { ?>
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-500"><?php echo getScanStatus($info['id'], 'code_php', 2); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
{include file='public/footer' /}
