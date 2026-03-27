{include file='public/head' /}
{include file='public/blackLeftMenu' /}
<style>
    pre {
        margin-top: 0;
        margin-bottom: 1em;
        overflow: auto;
        background: #1e293b;
        color: #e2e8f0;
        padding: 1rem;
        border-radius: 0.75rem;
        font-size: 13px;
        line-height: 1.6;
    }
</style>
<!-- 页面标题 -->
<div class="mb-6">
    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-2xl font-bold text-text-primary mb-2">目录扫描详情</h1>
            <nav class="flex gap-2 text-sm text-text-secondary">
                <a href="/" class="hover:text-primary transition-colors">首页</a>
                <span class="text-text-muted">/</span>
                <a href="<?php echo url('dirmap/index') ?>" class="hover:text-primary transition-colors">Dirmap</a>
                <span class="text-text-muted">/</span>
                <span class="text-text-primary font-medium">详情</span>
            </nav>
        </div>
        <div class="flex items-center gap-2">
            <input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/xray')?>">
            {include file='public/to_examine' /}
            <?php if($info['check_status'] == 0){?>
            <button onclick="to_examine(<?php echo $info['id']?>)" class="px-4 py-2 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-primary-light hover:border-primary hover:text-primary transition-all">
                审核
            </button>
            <?php }?>
            <a href="<?php echo url('dirmap/index') ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 transition-all">
                返回列表页
            </a>
            <a href="<?php echo url('dirmap/details', ['id' => $info['upper_id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 transition-all">
                上一页
            </a>
            <a href="<?php echo url('dirmap/details', ['id' => $info['lower_id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 transition-all">
                下一页
            </a>
        </div>
    </div>
</div>

<!-- 主卡片 -->
<div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card">

            <!-- 卡片内容 -->
            <div class="p-6">
                <!-- 信息网格 -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-surface-100 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">ID</span>
                        <div class="mt-1 text-lg font-bold text-text-primary"><?php echo $info['id'] ?></div>
                    </div>
                    <div class="bg-surface-100 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">状态码</span>
                        <div class="mt-1">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-semibold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                <?php echo $info['code'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="bg-surface-100 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">大小</span>
                        <div class="mt-1 font-medium text-text-primary"><?php echo $info['size'] ?></div>
                    </div>
                    <div class="bg-surface-100 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">类型</span>
                        <div class="mt-1">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-medium bg-blue-50 text-blue-600 border border-blue-100">
                                <?php echo $info['type'] ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- URL -->
                <div class="bg-surface-100 rounded-xl p-4 mb-6">
                    <span class="text-xs text-text-muted uppercase tracking-wider">URL地址</span>
                    <div class="mt-2">
                        <a href="<?php echo $info['url'] ?>" target="_blank" class="text-primary hover:underline font-mono text-sm break-all">
                            <?php echo $info['url'] ?>
                        </a>
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

{include file='public/to_examine' /}
{include file='public/footer' /}
