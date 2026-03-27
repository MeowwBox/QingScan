{include file='public/head' /}
{include file='public/blackLeftMenu' /}

<div class="p-6 bg-surface-100 min-h-screen font-sans">
    <!-- 页面标题 -->
    <div class="flex justify-between items-start mb-6 opacity-0 animate-fadeIn">
        <div>
            <h1 class="text-2xl font-bold text-text-primary mb-2">扫描详情</h1>
            <nav class="flex gap-2 text-sm text-text-secondary">
                <a href="<?php echo url('index/index') ?>" class="hover:text-primary transition-colors">首页</a>
                <span class="text-text-muted">/</span>
                <a href="<?php echo url('index/index') ?>" class="hover:text-primary transition-colors">Web扫描</a>
                <span class="text-text-muted">/</span>
                <a href="<?php echo url('index/index') ?>" class="hover:text-primary transition-colors">扫描目标</a>
                <span class="text-text-muted">/</span>
                <span class="text-text-primary font-medium">扫描详情</span>
            </nav>
        </div>
    </div>

<?php
$typeArr = [
    'whatweb' => 'whatweb',
    'oneforall' => 'oneforall',
    'hydra' => 'hydra',
    'dirmap' => 'dirmap',
    'sqlmap' => 'sqlmap',
];
?>
    <!-- 基本信息卡片 -->
    <div class="bg-white border border-surface-300 rounded-2xl p-6 mb-6 shadow-card">
        <h3 class="text-lg font-bold text-text-primary mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            基本信息
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <div class="bg-surface-100 rounded-xl p-4">
                <span class="text-xs text-text-muted uppercase tracking-wider">ID</span>
                <div class="mt-1 font-semibold text-text-primary"><?php echo $info['id'] ?></div>
            </div>
            <div class="bg-surface-100 rounded-xl p-4">
                <span class="text-xs text-text-muted uppercase tracking-wider">状态</span>
                <div class="mt-1">
                    <?php if ($info['status'] == 1) { ?>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        启用
                    </span>
                    <?php } else { ?>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-100">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        暂停
                    </span>
                    <?php } ?>
                </div>
            </div>
            <div class="bg-surface-100 rounded-xl p-4">
                <span class="text-xs text-text-muted uppercase tracking-wider">名称</span>
                <div class="mt-1 font-medium text-text-primary"><?php echo $info['name'] ?></div>
            </div>
            <div class="bg-surface-100 rounded-xl p-4">
                <span class="text-xs text-text-muted uppercase tracking-wider">URL</span>
                <div class="mt-1 font-medium text-primary truncate" title="<?php echo $info['url'] ?>"><?php echo $info['url'] ?></div>
            </div>
            <div class="bg-surface-100 rounded-xl p-4">
                <span class="text-xs text-text-muted uppercase tracking-wider">创建时间</span>
                <div class="mt-1 font-medium text-text-primary"><?php echo $info['create_time'] ?></div>
            </div>
            <?php if ($info['username']) { ?>
            <div class="bg-surface-100 rounded-xl p-4">
                <span class="text-xs text-text-muted uppercase tracking-wider">用户名</span>
                <div class="mt-1 font-medium text-text-primary"><?php echo $info['username'] ?></div>
            </div>
            <?php } ?>
        </div>
        <?php if ($info['username']) { ?>
        <div class="grid grid-cols-2 gap-4 mt-4">
            <div class="bg-surface-100 rounded-xl p-4">
                <span class="text-xs text-text-muted uppercase tracking-wider">密码</span>
                <div class="mt-1 font-medium text-text-primary"><?php echo $info['password'] ?></div>
            </div>
        </div>
        <?php } ?>
    </div>

    <!-- RAD URL爬虫 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <div class="flex items-center gap-3">
                <h3 class="text-lg font-bold text-text-primary">RAD</h3>
                <span class="text-text-muted text-sm">(URL爬虫)</span>
            </div>
            <div class="flex gap-2">
                <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'rad']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">
                    ReScan
                </a>
                <a href="<?php echo url('urls/index', ['app_id' => $info['id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">
                    More
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">URL</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">APP</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ICP</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">邮箱</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">创建时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($urls as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4"><a href="<?php echo $value['url'] ?>" target="_blank" class="text-primary hover:underline ellipsis-type inline-block"><?php echo $value['url'] ?></a></td>
                        <td class="px-5 py-4 text-text-secondary"><a href="<?php echo U('urls/index', ['app_id' => $value['app_id']]) ?>" class="text-primary hover:underline"><?php echo isset($appArr[$value['app_id']]) ? $appArr[$value['app_id']] : '' ?></a></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['icp'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['email'] ?? '' ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($urls)) { ?>
                    <tr><td colspan="6" class="px-5 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'rad'); ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- crawlergo URL爬虫扫描 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <div class="flex items-center gap-3">
                <h3 class="text-lg font-bold text-text-primary">crawlergo</h3>
                <span class="text-text-muted text-sm">(URL爬虫扫描)</span>
            </div>
            <div class="flex gap-2">
                <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'crawlergoScan']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">ReScan</a>
                <a href="<?php echo url('app_crawlergo/index', ['app_id' => $info['id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">More</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">URL</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">创建时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($crawlergo as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4 text-text-secondary AutoNewline"><?php echo $value['url'] ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($crawlergo)) { ?>
                    <tr><td colspan="3" class="px-5 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'crawlergoScan'); ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- AWVS 综合扫描 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <div class="flex items-center gap-3">
                <h3 class="text-lg font-bold text-text-primary">AWVS</h3>
                <span class="text-text-muted text-sm">(综合扫描)</span>
            </div>
            <div class="flex gap-2">
                <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'awvsScan']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">ReScan</a>
                <a href="<?php echo url('bug/awvs', ['app_id' => $info['id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">More</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">严重程度</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">URL</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">发现时间</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($awvs as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4">
                            <?php
                            $severity = strtolower($value['vt_name']);
                            $severityClass = 'bg-surface-100 text-text-secondary';
                            if (strpos($severity, 'critical') !== false || strpos($severity, 'high') !== false) {
                                $severityClass = 'bg-red-50 text-red-600 border border-red-100';
                            } elseif (strpos($severity, 'medium') !== false) {
                                $severityClass = 'bg-amber-50 text-amber-600 border border-amber-100';
                            } elseif (strpos($severity, 'low') !== false) {
                                $severityClass = 'bg-sky-50 text-sky-600 border border-sky-100';
                            }
                            ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold <?php echo $severityClass ?>"><?php echo $value['vt_name'] ?></span>
                        </td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['affects_url'] ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
                        <td class="px-5 py-4">
                            <a href="<?php echo url('code_check/bug_detail', ['id' => $value['id']]) ?>" class="w-9 h-9 rounded-xl bg-surface-100 text-primary hover:bg-primary-light transition-colors flex items-center justify-center inline-flex" title="查看漏洞">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($awvs)) { ?>
                    <tr><td colspan="5" class="px-5 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'awvsScan'); ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- nuclei POC扫描 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <div class="flex items-center gap-3">
                <h3 class="text-lg font-bold text-text-primary">nuclei</h3>
                <span class="text-text-muted text-sm">(POC扫描)</span>
            </div>
            <div class="flex gap-2">
                <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'nucleiScan']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">ReScan</a>
                <a href="<?php echo url('app_nuclei/index', ['app_id' => $info['id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">More</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">名称</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">主机</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">创建时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($nuclei as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-50 text-red-600 border border-red-100"><?php echo $value['name'] ?></span></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['host'] ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($nuclei)) { ?>
                    <tr><td colspan="4" class="px-5 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'nucleiScan'); ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- XRAY 黑盒+POC -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <div class="flex items-center gap-3">
                <h3 class="text-lg font-bold text-text-primary">XRAY</h3>
                <span class="text-text-muted text-sm">(黑盒+POC)</span>
            </div>
            <div class="flex gap-2">
                <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'xray']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">ReScan</a>
                <a href="<?php echo url('xray/index', ['app_id' => $info['id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">More</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">漏洞类型</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">URL地址</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">创建时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($xray as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-50 text-red-600 border border-red-100"><?php echo $value['plugin'] ?></span></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo json_decode($value['target'], true)['url'] ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo date('Y-m-d H:i:s', substr($value['create_time'], 0, 10)) ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($xray)) { ?>
                    <tr><td colspan="4" class="px-5 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'xray'); ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- app信息 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">APP信息</h3>
            <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'getBaseInfo']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">ReScan</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">APP ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">CMS</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">服务器</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">状态码</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">长度</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">页面标题</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">Header</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">图标</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">截图</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($app_info as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['app_id'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['cms'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['server'] ?></td>
                        <td class="px-5 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100"><?php echo $value['statuscode'] ?></span></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['length'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['page_title'] ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm max-w-[200px] truncate"><?php echo $value['header'] ?></td>
                        <td class="px-5 py-4"><?php if($value['icon']) { ?><img src="<?php echo str_replace('/root/qingscan/code/public/', "", $value['icon']) ?>" class="w-8 h-8 rounded"><?php } ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['url_screenshot'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($app_info)) { ?>
                    <tr><td colspan="9" class="px-5 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'getBaseInfo'); ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- whatweb 指纹识别 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <div class="flex items-center gap-3">
                <h3 class="text-lg font-bold text-text-primary">whatweb</h3>
                <span class="text-text-muted text-sm">(指纹识别)</span>
            </div>
            <div class="flex gap-2">
                <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'whatweb']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">ReScan</a>
                <a href="<?php echo url('whatweb/index', ['app_id' => $info['id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">More</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">目标</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">HTTP状态</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">请求配置</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">插件</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">发布时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($whatweb as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['target'] ?></td>
                        <td class="px-5 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100"><?php echo $value['http_status'] ?></span></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['request_config'] ?></td>
                        <td class="px-5 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-primary-light text-primary border border-blue-100"><?php echo $value['plugins'] ?></span></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($whatweb)) { ?>
                    <tr><td colspan="6" class="px-5 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'whatweb'); ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- sqlmap SQL注入 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <div class="flex items-center gap-3">
                <h3 class="text-lg font-bold text-text-primary">sqlmap</h3>
                <span class="text-text-muted text-sm">(SQL注入)</span>
            </div>
            <div class="flex gap-2">
                <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'sqlmapScan']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">ReScan</a>
                <a href="<?php echo url('sqlmap/index', ['app_id' => $info['id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">More</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">URLs ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">类型</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">标题</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">Payload</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">DBMS</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">应用</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($sqlmap as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['urls_id'] ?></td>
                        <td class="px-5 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-50 text-red-600 border border-red-100"><?php echo $value['type'] ?></span></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['title'] ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm AutoNewline max-w-[200px]"><?php echo $value['payload'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['dbms'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['application'] ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($sqlmap)) { ?>
                    <tr><td colspan="8" class="px-5 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'sqlmapScan'); ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- oneforall 子域名 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <div class="flex items-center gap-3">
                <h3 class="text-lg font-bold text-text-primary">oneforall</h3>
                <span class="text-text-muted text-sm">(子域名)</span>
            </div>
            <div class="flex gap-2">
                <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'subdomainScan']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">ReScan</a>
                <a href="<?php echo url('one_for_all/index', ['app_id' => $info['id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">More</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">域名</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">端口</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">IP</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">状态</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">创建时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($oneforall as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4 text-primary"><?php echo $value['subdomain'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['port'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['ip'] ?></td>
                        <td class="px-5 py-4">
                            <?php if ($value['status'] == '200') { ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100"><?php echo $value['status'] ?></span>
                            <?php } else { ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-surface-100 text-text-secondary"><?php echo $value['status'] ?></span>
                            <?php } ?>
                        </td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($oneforall)) { ?>
                    <tr><td colspan="6" class="px-5 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'subdomainScan'); ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- hydra 主机暴力破解 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <div class="flex items-center gap-3">
                <h3 class="text-lg font-bold text-text-primary">hydra</h3>
                <span class="text-text-muted text-sm">(主机暴力破解)</span>
            </div>
            <div class="flex gap-2">
                <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'sshScan']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">ReScan</a>
                <a href="<?php echo url('hydra/index', ['app_id' => $info['id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">More</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">主机</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">类型</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">用户名</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">创建时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($hydra as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['host'] ?></td>
                        <td class="px-5 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-100"><?php echo $value['type'] ?></span></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['username'] ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo date('Y-m-d H:i:s', substr($value['create_time'], 0, 10)) ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($hydra)) { ?>
                    <tr><td colspan="5" class="px-5 py-8 text-center text-text-muted"><?php echo getScanStatus($host_id, 'sshScan'); ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- dirmap 扫后台 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <div class="flex items-center gap-3">
                <h3 class="text-lg font-bold text-text-primary">dirmap</h3>
                <span class="text-text-muted text-sm">(扫后台)</span>
            </div>
            <div class="flex gap-2">
                <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'dirmapScan']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">ReScan</a>
                <a href="<?php echo url('dirmap/index', ['app_id' => $info['id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">More</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">状态码</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">大小</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">类型</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">URL</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($dirmap as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100"><?php echo $value['code'] ?></span></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['size'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['type'] ?></td>
                        <td class="px-5 py-4 text-primary text-sm truncate max-w-[300px]"><?php echo $value['url'] ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($dirmap)) { ?>
                    <tr><td colspan="6" class="px-5 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'dirmapScan'); ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- masscan列表 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">masscan列表</h3>
            <div class="flex gap-2">
                <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'NmapPortScan']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">ReScan</a>
                <a href="<?php echo url('host_port/index', ['app_id' => $info['id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">More</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">端口</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">主机</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">类型</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">服务</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">关闭</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">创建时间</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">更新时间</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">OS</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">HTML</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">Headers</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">扫描时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($host_port as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-primary-light text-primary border border-blue-100"><?php echo $value['port'] ?></span></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['host'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['type'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['service'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['is_close'] ?></td>
                        <td class="px-5 py-4 text-text-muted"><?php echo $value['create_time'] ?></td>
                        <td class="px-5 py-4 text-text-muted"><?php echo $value['update_time'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['os'] ?></td>
                        <td class="px-5 py-4 text-text-secondary truncate max-w-[100px]"><?php echo $value['html'] ?></td>
                        <td class="px-5 py-4 text-text-secondary truncate max-w-[100px]"><?php echo $value['headers'] ?></td>
                        <td class="px-5 py-4 text-text-muted"><?php echo $value['scan_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($host_port)) { ?>
                    <tr><td colspan="12" class="px-5 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'NmapPortScan'); ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- vulmap信息 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">vulmap信息</h3>
            <div class="flex gap-2">
                <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'vulmapPocTest']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">ReScan</a>
                <a href="<?php echo url('vulmap/index', ['app_id' => $info['id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">More</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">APP ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">URLs ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">作者</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">描述</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">主机</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">端口</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">参数</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">插件</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">漏洞类型</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($app_vulmap as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['app_id'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['user_id'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['author'] ?></td>
                        <td class="px-5 py-4 text-text-secondary truncate max-w-[150px]"><?php echo $value['description'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['host'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['port'] ?></td>
                        <td class="px-5 py-4 text-text-secondary AutoNewline"><?php echo $value['param'] ?></td>
                        <td class="px-5 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-50 text-red-600 border border-red-100"><?php echo $value['plugin'] ?></span></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['vuln_class'] ?></td>
                        <td class="px-5 py-4 text-text-muted"><?php echo $value['create_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($app_vulmap)) { ?>
                    <tr><td colspan="11" class="px-5 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'vulmapPocTest'); ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 主机列表 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">主机列表</h3>
            <div class="flex gap-2">
                <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'autoAddHost']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">ReScan</a>
                <a href="<?php echo url('host/index', ['app_id' => $info['id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">More</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">APP ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">域名</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">主机</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">状态</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">创建时间</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ISP</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">国家</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">地区</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">城市</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($host as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['app_id'] ?></td>
                        <td class="px-5 py-4 text-primary"><?php echo $value['domain'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['host'] ?></td>
                        <td class="px-5 py-4">
                            <?php if ($value['status'] == 'active') { ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100"><?php echo $value['status'] ?></span>
                            <?php } else { ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-surface-100 text-text-secondary"><?php echo $value['status'] ?></span>
                            <?php } ?>
                        </td>
                        <td class="px-5 py-4 text-text-muted"><?php echo $value['create_time'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['isp'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['country'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['region'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['city'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($host)) { ?>
                    <tr><td colspan="10" class="px-5 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'autoAddHost'); ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- DisMap CMS指纹识别 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <div class="flex items-center gap-3">
                <h3 class="text-lg font-bold text-text-primary">DisMap</h3>
                <span class="text-text-muted text-sm">(CMS指纹识别)</span>
            </div>
            <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'dismapScan']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">ReScan</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">结果</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($app_dismap as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['result'] ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($app_dismap)) { ?>
                    <tr><td colspan="3" class="px-5 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'dismapScan'); ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 自定义插件 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">自定义插件</h3>
            <div class="flex gap-2">
                <a href="<?php echo url('app/rescan', ['id' => $info['id'], 'tools_name' => 'plugin']) ?>" onClick="return confirm('确定要清空该工具数据ReScan吗?')" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">ReScan</a>
                <a href="<?php echo url('plugin_result/index', ['app_id' => $info['id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">More</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">插件名称</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">内容</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($pluginScanLog as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-violet-50 text-violet-600 border border-violet-100"><?php echo $value['plugin_name'] ?></span></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo htmlspecialchars($value['content']) ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($pluginScanLog)) { ?>
                    <tr><td colspan="3" class="px-5 py-8 text-center text-text-muted">暂无数据</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- github 关键词监控结果 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card mb-6">
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <div class="flex items-center gap-3">
                <h3 class="text-lg font-bold text-text-primary">github</h3>
                <span class="text-text-muted text-sm">(关键词监控结果)</span>
            </div>
            <a href="<?php echo url('github_keyword_monitor_notice/index', ['app_id' => $info['id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-secondary text-sm hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">More</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">关键词名称</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">Github名称</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">路径</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">URL地址</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($monitor_notice as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4"><span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-primary-light text-primary border border-blue-100"><?php echo $value['keyword'] ?></span></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['name'] ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['path'] ?></td>
                        <td class="px-5 py-4"><a href="<?php echo $value['html_url'] ?>" target="_blank" class="text-primary hover:underline text-sm"><?php echo $value['html_url'] ?></a></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($monitor_notice)) { ?>
                    <tr><td colspan="6" class="px-5 py-8 text-center text-text-muted">暂无数据</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $("#download_pdf").click(function () {
        var element = $(":root").html()
        html2pdf().from(element).set({
            margin: 1,
            filename: 'resume.pdf',
            html2canvas: {scale: 2},
            jsPDF: {orientation: 'portrait', unit: 'in', format: 'letter', compressPDF: false}
        }).save();
    });
</script>
{include file='public/footer' /}
