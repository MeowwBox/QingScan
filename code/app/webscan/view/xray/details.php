{include file='public/head' /}
{include file='public/blackLeftMenu' /}

<!-- 页面标题区 -->
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-2xl font-bold text-text-primary mb-2">漏洞详情</h1>
            <nav class="flex gap-2 text-sm text-text-secondary">
                <a href="<?php echo url('xray/index') ?>" class="hover:text-primary transition-colors">XRAY漏洞列表</a>
                <span class="text-text-muted">/</span>
                <span class="text-text-primary font-medium">漏洞 #<?php echo $info['id'] ?></span>
            </nav>
        </div>
        <div class="flex gap-3">
            <input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/xray')?>">
            {include file='public/to_examine' /}
            <?php if($info['check_status'] == 0){?>
            <button onclick="to_examine(<?php echo $info['id']?>)" class="px-5 py-2.5 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 hover:border-primary hover:text-primary transition-all duration-200">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    审核
                </span>
            </button>
            <?php }?>
            <a href="<?php echo url('xray/index') ?>" class="px-5 py-2.5 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 hover:border-primary hover:text-primary transition-all duration-200">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    返回列表
                </span>
            </a>
            <div class="flex gap-2">
                <a href="<?php echo url('xray/details', ['id' => $info['upper_id']]) ?>" class="px-4 py-2.5 rounded-xl border border-surface-400 text-text-secondary hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">
                    上一页
                </a>
                <a href="<?php echo url('xray/details', ['id' => $info['lower_id']]) ?>" class="px-4 py-2.5 rounded-xl border border-surface-400 text-text-secondary hover:bg-surface-100 hover:text-text-primary hover:border-primary transition-all">
                    下一页
                </a>
            </div>
        </div>
    </div>

    <!-- 漏洞概览卡片 -->
    <div class="bg-white border border-surface-300 rounded-2xl p-6 mb-6 shadow-card">
        <div class="flex items-start justify-between mb-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h2 class="text-xl font-bold text-text-primary"><?php echo $info['plugin'] ?></h2>
                    <?php if ($info['check_status'] == 1) { ?>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        有效漏洞
                    </span>
                    <?php } elseif ($info['check_status'] == 2) { ?>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-50 text-red-600 border border-red-100">
                        <span class="w-2 h-2 rounded-full bg-red-500"></span>
                        无效漏洞
                    </span>
                    <?php } else { ?>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-sky-50 text-sky-600 border border-sky-100">
                        <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                        未审核
                    </span>
                    <?php } ?>
                </div>
                <p class="text-text-muted text-sm font-mono"><?php echo $info['detail']['addr'] ?></p>
            </div>
            <select class="changCheckStatus bg-surface-100 border border-surface-300 rounded-xl px-4 py-2.5 text-sm text-text-primary focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none transition-all" data-id="<?php echo $info['id'] ?>">
                <option value="0" <?php echo $info['check_status'] == 0 ? 'selected' : ''; ?>>未审核</option>
                <option value="1" <?php echo $info['check_status'] == 1 ? 'selected' : ''; ?>>有效漏洞</option>
                <option value="2" <?php echo $info['check_status'] == 2 ? 'selected' : ''; ?>>无效漏洞</option>
            </select>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-surface-100 rounded-xl p-4">
                <span class="text-xs text-text-muted uppercase tracking-wider">漏洞ID</span>
                <div class="mt-1 font-semibold text-text-primary">#<?php echo $info['id'] ?></div>
            </div>
            <div class="bg-surface-100 rounded-xl p-4">
                <span class="text-xs text-text-muted uppercase tracking-wider">发现时间</span>
                <div class="mt-1 font-medium text-text-primary"><?php echo date('Y-m-d H:i:s', substr($info['create_time'], 0, 10)) ?></div>
            </div>
            <div class="bg-surface-100 rounded-xl p-4">
                <span class="text-xs text-text-muted uppercase tracking-wider">漏洞类型</span>
                <div class="mt-1">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-red-50 text-red-600 border border-red-100">
                        <?php echo $info['plugin'] ?>
                    </span>
                </div>
            </div>
            <div class="bg-surface-100 rounded-xl p-4">
                <span class="text-xs text-text-muted uppercase tracking-wider">目标URL</span>
                <div class="mt-1">
                    <a href="<?php echo $info['detail']['addr'] ?>" target="_blank" class="text-primary hover:underline text-sm truncate block max-w-[200px]"><?php echo $info['detail']['addr'] ?></a>
                </div>
            </div>
        </div>
    </div>

    <!-- 详情信息区 -->
    <div class="grid grid-cols-1 gap-6">
        <!-- URL信息 -->
        <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card">
            <div class="px-5 py-4 border-b border-surface-200 bg-surface-50">
                <h3 class="text-lg font-bold text-text-primary flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    URL信息
                </h3>
            </div>
            <div class="p-5">
                <div class="flex items-center gap-3">
                    <span class="text-text-secondary">目标地址:</span>
                    <a href="<?php echo $info['detail']['addr'] ?>" target="_blank" class="text-primary hover:underline font-mono text-sm"><?php echo $info['detail']['addr'] ?></a>
                </div>
            </div>
        </div>

        <!-- 请求信息 -->
        <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card">
            <div class="px-5 py-4 border-b border-surface-200 bg-surface-50">
                <h3 class="text-lg font-bold text-text-primary flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                    </svg>
                    HTTP请求
                </h3>
            </div>
            <div class="p-5">
                <pre class="bg-slate-800 rounded-xl p-4 text-sm text-slate-300 font-mono overflow-x-auto max-h-[400px]"><?php echo trim($info['detail']['snapshot'][0][0]) ?></pre>
            </div>
        </div>

        <!-- 响应信息 -->
        <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card">
            <div class="px-5 py-4 border-b border-surface-200 bg-surface-50">
                <h3 class="text-lg font-bold text-text-primary flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    HTTP响应
                </h3>
            </div>
            <div class="p-5">
                <pre class="bg-slate-800 rounded-xl p-4 text-sm text-slate-300 font-mono overflow-x-auto max-h-[600px]"><?php echo trim($info['detail']['snapshot'][0][0]) ?></pre>
            </div>
        </div>
    </div>

{include file='public/to_examine' /}
{include file='public/footer' /}
