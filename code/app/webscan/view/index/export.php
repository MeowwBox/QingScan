<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>黑盒项目扫描结果</title>
    <link rel="shortcut icon" href="/static/favicon.svg" type="image/x-icon"/>
    <script src="/static/js/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                    fontFamily: {
                        sans: ['Inter', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 1px 3px 0 rgb(0 0 0 / 0.05), 0 1px 2px -1px rgb(0 0 0 / 0.05)',
                        'card': '0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04)',
                    }
                }
            }
        }
    </script>
    <style>
        * { scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent; }
        *::-webkit-scrollbar { width: 6px; height: 6px; }
        *::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        *::-webkit-scrollbar-track { background: transparent; }
    </style>
</head>
<body class="bg-surface-100 text-text-primary font-sans min-h-screen">
<div class="py-6 px-4 max-w-7xl mx-auto">
    <!-- 基本信息卡片 -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card p-6 mb-6">
        <h2 class="text-lg font-bold text-text-primary mb-4 pb-4 border-b border-surface-200">基本信息</h2>
        <div class="grid grid-cols-3 gap-6">
            <div>
                <span class="text-text-muted text-sm">ID</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['id'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">状态</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['status'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">名称</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['name'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">URL</span>
                <p class="text-text-primary font-medium mt-1 font-mono text-sm truncate"><?php echo $info['url'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">创建时间</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['create_time'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">是否删除</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['is_delete'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">用户名称</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['username'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">密码</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['password'] ?></p>
            </div>
        </div>
    </div>

    <!-- 扫描动态卡片 -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card p-6 mb-6">
        <h2 class="text-lg font-bold text-text-primary mb-4 pb-4 border-b border-surface-200">扫描动态</h2>
        <div class="grid grid-cols-3 gap-6">
            <div>
                <span class="text-text-muted text-sm">RAD(爬虫)</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['crawler_time'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">WhatWeb(指纹扫描)</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['whatweb_scan_time'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">V2子域名扫描时间</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['subdomain_scan_time'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">获取基本信息时间</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['screenshot_time'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">Xray扫描时间</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['xray_scan_time'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">Dirmap扫描时间</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['dirmap_scan_time'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">DisMap扫描时间</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['dismap_scan_time'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">Crawlergo扫描时间</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['crawlergo_scan_time'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">Vulmap扫描时间</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['vulmap_scan_time'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">AWVS扫描时间</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['awvs_scan_time'] ?></p>
            </div>
            <div>
                <span class="text-text-muted text-sm">子域名扫描时间</span>
                <p class="text-text-primary font-medium mt-1"><?php echo $info['subdomain_time'] ?></p>
            </div>
        </div>
    </div>

    <!-- RAD(URL爬虫) -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">RAD(URL爬虫)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100 text-left">
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">URL</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">APP</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">ICP</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">邮箱</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">sqlmap扫描时间</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">创建时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($urls as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm truncate max-w-xs">
                            <a href="<?php echo $value['url'] ?>" target="_blank" class="text-primary hover:underline"><?php echo $value['url'] ?></a>
                        </td>
                        <td class="px-4 py-3 text-text-primary">
                            <a href="<?php echo U('urls/index', ['app_id' => $value['app_id']]) ?>" class="text-primary hover:underline"><?php echo isset($appArr[$value['app_id']]) ? $appArr[$value['app_id']] : '' ?></a>
                        </td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['icp'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['email'] ?></td>
                        <td class="px-4 py-3 text-text-primary text-sm"><?php echo ($value['sqlmap_scan_time'] == "2000-01-01 00:00:00") ? "未扫描" : ((strtotime($value['sqlmap_scan_time']) > time()) ? '扫描失败' : $value['sqlmap_scan_time']) ?></td>
                        <td class="px-4 py-3 text-text-muted text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($urls)) { ?>
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'rad'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Crawlergo(URL爬虫扫描) -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">Crawlergo(URL爬虫扫描)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100 text-left">
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">URL</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">扫描时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($crawlergo as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm break-all"><?php echo $value['url'] ?></td>
                        <td class="px-4 py-3 text-text-muted text-sm"><?php echo $value['create_time']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($crawlergo)) { ?>
                    <tr>
                        <td colspan="3" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'crawlergoScan'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- AWVS(综合扫描) -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">AWVS(综合扫描)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100 text-left">
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Severity</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">URL</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">发现时间</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($awvs as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['vt_name'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm truncate max-w-xs"><?php echo $value['affects_url'] ?></td>
                        <td class="px-4 py-3 text-text-muted text-sm"><?php echo $value['create_time'] ?></td>
                        <td class="px-4 py-3">
                            <a href="<?php echo url('code_check/bug_detail', ['id' => $value['id']]) ?>" class="px-3 py-1.5 rounded-lg text-sm bg-primary-light text-primary hover:bg-blue-100 transition-colors">查看漏洞</a>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($awvs)) { ?>
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'awvsScan'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Nuclei(POC扫描) -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">Nuclei(POC扫描)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100 text-left">
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Name</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Host</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">扫描时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($nuclei as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['name'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm"><?php echo $value['host'] ?></td>
                        <td class="px-4 py-3 text-text-muted text-sm"><?php echo $value['create_time']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($nuclei)) { ?>
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'nucleiScan'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- XRAY(黑盒+POC) -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">XRAY(黑盒+POC)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100 text-left">
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">漏洞类型</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">URL地址</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">创建时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($xray as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['plugin'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm truncate max-w-xs"><?php echo json_decode($value['target'], true)['url'] ?></td>
                        <td class="px-4 py-3 text-text-muted text-sm"><?php echo date('Y-m-d H:i:s', substr($value['create_time'], 0, 10)) ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($xray)) { ?>
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'xray'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- App信息 -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">App信息</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100 text-left">
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">App ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">CMS</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Server</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Status</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Title</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Length</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Page Title</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Header</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Icon</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Screenshot</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($app_info as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['app_id'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['cms'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['server'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['statuscode'] ?></td>
                        <td class="px-4 py-3 text-text-primary text-sm break-all"><?php echo $value['title'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['length'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['page_title'] ?></td>
                        <td class="px-4 py-3 text-text-primary text-sm truncate max-w-xs"><?php echo $value['header'] ?></td>
                        <td class="px-4 py-3 text-text-primary text-sm truncate"><?php echo $value['icon'] ?></td>
                        <td class="px-4 py-3 text-text-primary text-sm truncate"><?php echo $value['url_screenshot'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($app_info)) { ?>
                    <tr>
                        <td colspan="10" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'getBaseInfo'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- WhatWeb(指纹识别) -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">WhatWeb(指纹识别)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100 text-left">
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Target</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">HTTP Status</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Request Config</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Plugins</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">发布时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($whatweb as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm"><?php echo $value['target'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['http_status'] ?></td>
                        <td class="px-4 py-3 text-text-primary text-sm truncate max-w-xs"><?php echo $value['request_config'] ?></td>
                        <td class="px-4 py-3 text-text-primary text-sm"><?php echo $value['plugins'] ?></td>
                        <td class="px-4 py-3 text-text-muted text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($whatweb)) { ?>
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'whatweb'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- SQLMap(SQL注入) -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">SQLMap(SQL注入)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100 text-left">
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">URLs ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Type</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Title</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Payload</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">DBMS</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Application</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($sqlmap as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['urls_id'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['type'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['title'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm break-all"><?php echo $value['payload'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['dbms'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['application'] ?></td>
                        <td class="px-4 py-3 text-text-muted text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($sqlmap)) { ?>
                    <tr>
                        <td colspan="8" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'sqlmapScan'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- OneForAll(子域名) -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">OneForAll(子域名)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100 text-left">
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">域名</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">端口</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">IP</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">状态</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($oneforall as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm"><?php echo $value['subdomain'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['port'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm"><?php echo $value['ip'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['status'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($oneforall)) { ?>
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'subdomainScan'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Hydra(主机暴力破解) -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">Hydra(主机暴力破解)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100 text-left">
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Host</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Type</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Username</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">状态</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($hydra as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm"><?php echo $value['host'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['type'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['username'] ?></td>
                        <td class="px-4 py-3 text-text-muted text-sm"><?php echo date('Y-m-d H:i:s', substr($value['create_time'], 0, 10)) ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($hydra)) { ?>
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($host_id, 'sshScan'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Dirmap(扫后台) -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">Dirmap(扫后台)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100 text-left">
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Code</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Size</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Type</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">URL</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($dirmap as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['code'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['size'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['type'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm truncate max-w-xs"><?php echo $value['url'] ?></td>
                        <td class="px-4 py-3 text-text-muted text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($dirmap)) { ?>
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'dirmapScan'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Nmap列表 -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">Nmap列表</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100 text-left">
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Port</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Host</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Type</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Service</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Is Close</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Create Time</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">OS</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Headers</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Scan Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($host_port as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['port'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm"><?php echo $value['host'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['type'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['service'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['is_close'] ?></td>
                        <td class="px-4 py-3 text-text-muted text-sm"><?php echo $value['create_time'] ?></td>
                        <td class="px-4 py-3 text-text-primary text-sm"><?php echo $value['os'] ?></td>
                        <td class="px-4 py-3 text-text-primary text-sm truncate max-w-xs"><?php echo $value['headers'] ?></td>
                        <td class="px-4 py-3 text-text-muted text-sm"><?php echo $value['scan_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($host_port)) { ?>
                    <tr>
                        <td colspan="10" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'NmapPortScan'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Vulmap信息 -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">Vulmap信息</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100 text-left">
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Host</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Port</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Plugin</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">URL</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Create Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($app_vulmap as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm"><?php echo $value['host'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['port'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['plugin'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm truncate max-w-xs"><?php echo $value['url'] ?></td>
                        <td class="px-4 py-3 text-text-muted text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($app_vulmap)) { ?>
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'vulmapPocTest'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- 主机列表 -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">主机列表</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100 text-left">
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Domain</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Host</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Status</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Country</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">City</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Create Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($host as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm"><?php echo $value['domain'] ?></td>
                        <td class="px-4 py-3 text-text-primary font-mono text-sm"><?php echo $value['host'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['status'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['country'] ?></td>
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['city'] ?></td>
                        <td class="px-4 py-3 text-text-muted text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($host)) { ?>
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'autoAddHost'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- DisMap(CMS指纹识别) -->
    <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
            <h3 class="text-lg font-bold text-text-primary">DisMap(CMS指纹识别)</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100 text-left">
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">Result</th>
                        <th class="px-4 py-3 text-xs font-semibold text-text-secondary uppercase">时间</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($app_dismap as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-4 py-3 text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-4 py-3 text-text-primary text-sm"><?php echo $value['result']; ?></td>
                        <td class="px-4 py-3 text-text-muted text-sm"><?php echo $value['create_time'] ?></td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($app_dismap)) { ?>
                    <tr>
                        <td colspan="3" class="px-4 py-8 text-center text-text-muted"><?php echo getScanStatus($info['id'], 'dismapScan'); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer class="py-6 text-center text-text-muted text-sm border-t border-surface-200 bg-white">
    <p>QingScan 产品仅授权你在遵守<a href="https://baike.baidu.com/item/%E4%B8%AD%E5%8D%8E%E4%BA%BA%E6%B0%91%E5%85%B1%E5%92%8C%E5%9B%BD%E7%BD%91%E7%BB%9C%E5%AE%89%E5%85%A8%E6%B3%95" target="_blank" class="text-primary hover:underline">中华人民共和国网络安全法</a>前提下使用，如果你有二次开发需求,可以微信联系我<code class="bg-surface-100 px-2 py-0.5 rounded text-text-secondary">songboy8888</code></p>
</footer>
</body>
</html>
