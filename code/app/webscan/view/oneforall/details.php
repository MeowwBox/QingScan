{include file='public/head' /}
{include file='public/blackLeftMenu' /}

<!-- 页面内容 -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-text-primary">子域名扫描详情</h1>
</div>

<div class="bg-white border border-surface-300 rounded-2xl p-6 shadow-card" style="width: 100%;">
    <!-- 卡片头部 -->
    <div class="flex items-center justify-between px-6 py-5 border-b border-surface-200">
        <div>
            <h3 class="text-xl font-bold text-text-primary">子域名扫描详情</h3>
            <p class="text-sm text-text-muted mt-1">OneForAll Scan Details</p>
        </div>
        <div class="flex items-center gap-2">
            <input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/xray')?>">
            {include file='public/to_examine' /}
            <?php if($info['check_status'] == 0){?>
            <button onclick="to_examine(<?php echo $info['id']?>)" class="px-4 py-2 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-primary-light hover:border-primary hover:text-primary transition-all">
                审核
            </button>
            <?php }?>
            <a href="<?php echo url('one_for_all/index') ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 transition-all">
                返回列表页
            </a>
            <a href="<?php echo url('one_for_all/details', ['id' => $info['upper_id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 transition-all">
                上一页
            </a>
            <a href="<?php echo url('one_for_all/details', ['id' => $info['lower_id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 transition-all">
                下一页
            </a>
        </div>
    </div>

    <!-- 卡片内容 -->
    <div class="p-6">
                <!-- 信息网格 -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-surface-100 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">ID</span>
                        <div class="mt-1 text-lg font-bold text-text-primary"><?php echo $info['id'] ?></div>
                    </div>
                    <div class="bg-surface-100 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">端口</span>
                        <div class="mt-1">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium bg-violet-50 text-violet-600 border border-violet-100">
                                <?php echo $info['port'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="bg-surface-100 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">状态</span>
                        <div class="mt-1">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                <?php echo $info['status'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="bg-surface-100 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">创建时间</span>
                        <div class="mt-1 font-medium text-text-primary"><?php echo $info['create_time'] ?></div>
                    </div>
                </div>

                <!-- 域名信息 -->
                <div class="bg-surface-100 rounded-xl p-4 mb-6">
                    <span class="text-xs text-text-muted uppercase tracking-wider">域名</span>
                    <div class="mt-2">
                        <span class="text-primary font-mono text-lg font-medium"><?php echo $info['subdomain'] ?></span>
                    </div>
                </div>

                <!-- IP信息 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-surface-100 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">IP地址</span>
                        <div class="mt-2 font-mono text-text-primary"><?php echo $info['ip'] ?></div>
                    </div>
                    <div class="bg-surface-100 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">所属项目</span>
                        <div class="mt-2 text-text-primary"><?php echo $info['app_name'] ?></div>
                    </div>
                </div>

                <!-- 请求详情 -->
                <div class="space-y-4">
                    <div>
                        <h5 class="text-sm font-semibold text-text-primary mb-2 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-primary"></span>
                            Request
                        </h5>
                        <div class="bg-slate-800 rounded-xl p-4 overflow-x-auto">
                            <pre class="text-sm text-slate-300 font-mono whitespace-pre-wrap"><?php echo trim($info['detail']['snapshot'][0][0]) ?></pre>
                        </div>
                    </div>

                    <div>
                        <h5 class="text-sm font-semibold text-text-primary mb-2 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Response
                        </h5>
                        <div class="bg-slate-800 rounded-xl p-4 overflow-x-auto" style="max-height: 600px;">
                            <pre class="text-sm text-slate-300 font-mono whitespace-pre-wrap"><?php echo trim($info['detail']['snapshot'][0][0]) ?></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{include file='public/to_examine' /}
{include file='public/footer' /}
