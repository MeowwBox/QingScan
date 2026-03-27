{include file='public/head' /}
{include file='public/blackLeftMenu' /}

<!-- 卡片容器 -->
<div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card">
    <!-- 卡片头部 -->
    <div class="flex items-center justify-between px-6 py-5 border-b border-surface-200">
        <div>
            <h3 class="text-xl font-bold text-text-primary">SQL注入漏洞详情</h3>
            <p class="text-sm text-text-muted mt-1">Web Vulnerabilities</p>
        </div>
        <div class="flex items-center gap-2">
            <input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/xray')?>">
            {include file='public/to_examine' /}
            <?php if($info['check_status'] == 0){?>
            <button onclick="to_examine(<?php echo $info['id']?>)" class="px-4 py-2 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-primary-light hover:border-primary hover:text-primary transition-all">
                审核
            </button>
            <?php }?>
            <a href="<?php echo url('sqlmap/index') ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 transition-all">
                返回列表页
            </a>
            <a href="<?php echo url('sqlmap/details', ['id' => $info['upper_id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 transition-all">
                上一页
            </a>
            <a href="<?php echo url('sqlmap/details', ['id' => $info['lower_id']]) ?>" class="px-4 py-2 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 transition-all">
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
                <span class="text-xs text-text-muted uppercase tracking-wider">插件名称</span>
                <div class="mt-1 font-medium text-text-primary"><?php echo $info['plugin'] ?></div>
            </div>
            <div class="bg-surface-100 rounded-xl p-4">
                <span class="text-xs text-text-muted uppercase tracking-wider">创建时间</span>
                <div class="mt-1 font-medium text-text-primary"><?php echo date('Y-m-d H:i:s', substr($info['create_time'], 0, 10)) ?></div>
            </div>
            <div class="bg-surface-100 rounded-xl p-4">
                <span class="text-xs text-text-muted uppercase tracking-wider">审核状态</span>
                <div class="mt-1">
                    <select class="changCheckStatus bg-surface-100 border border-surface-300 rounded-lg px-3 py-1.5 text-sm focus:border-primary focus:outline-none" data-id="<?php echo $info['id'] ?>">
                        <option value="0" <?php echo $info['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                        <option value="1" <?php echo $info['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                        <option value="2" <?php echo $info['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- 目标URL -->
        <div class="bg-surface-100 rounded-xl p-4 mb-6">
            <span class="text-xs text-text-muted uppercase tracking-wider">目标地址</span>
            <div class="mt-2">
                <a href="<?php echo $info['detail']['addr'] ?>" target="_blank" class="text-primary hover:underline font-mono text-sm break-all">
                    <?php echo $info['detail']['addr'] ?>
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
