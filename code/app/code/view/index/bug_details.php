{include file='public/head' /}
{include file='public/whiteLeftMenu' /}

<div class="min-h-screen bg-surface-100 p-6">
    <div class="max-w-5xl mx-auto">
        <!-- 页面标题 -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-text-primary mb-2"><?php echo $info['Category']; ?></h1>
            <nav class="flex gap-2 text-sm text-text-secondary">
                <a href="<?php echo url('code/index') ?>" class="hover:text-primary transition-colors">代码审计</a>
                <span class="text-text-muted">/</span>
                <a href="<?php echo url('code/bug_list') ?>" class="hover:text-primary transition-colors">漏洞列表</a>
                <span class="text-text-muted">/</span>
                <span class="text-text-primary font-medium">漏洞详情</span>
            </nav>
        </div>

        <!-- 基本信息卡片 -->
        <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
                <h3 class="text-lg font-bold text-text-primary">基本信息</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-3 gap-6">
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">漏洞类型</span>
                        <div class="mt-1 font-medium text-text-primary"><?php echo htmlentities($info['Category']); ?></div>
                    </div>
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">发现时间</span>
                        <div class="mt-1 font-medium text-text-primary"><?php echo $info['create_time']; ?></div>
                    </div>
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">所属项目</span>
                        <div class="mt-1 font-medium text-text-primary"><?php echo htmlentities($projectArr[$info['code_id']]['name']); ?></div>
                    </div>
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">危险等级</span>
                        <div class="mt-1">
                            <?php
                            $levelColors = [
                                'Critical' => 'bg-red-50 text-red-600 border-red-100',
                                'High' => 'bg-orange-50 text-orange-600 border-orange-100',
                                'Medium' => 'bg-amber-50 text-amber-600 border-amber-100',
                                'Low' => 'bg-blue-50 text-blue-600 border-blue-100'
                            ];
                            $levelColor = $levelColors[$info['Friority']] ?? 'bg-surface-50 text-text-secondary border-surface-200';
                            ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold <?php echo $levelColor; ?> border">
                                <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                <?php echo $info['Friority'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">审核状态</span>
                        <div class="mt-1">
                            <select class="changCheckStatus bg-surface-100 border border-surface-300 rounded-lg px-3 py-1.5 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none"
                                    data-id="<?php echo $info['id'] ?>">
                                <option value="0" <?php echo $info['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                                <option value="1" <?php echo $info['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                                <option value="2" <?php echo $info['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $Source = $info['Source'];
        if (!empty($Source)) { ?>
        <!-- 污染来源卡片 -->
        <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
                <h3 class="text-lg font-bold text-text-primary">污染来源</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-3 gap-6 mb-6">
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">参数来源</span>
                        <div class="mt-1 font-mono text-sm text-text-primary break-all"><?php echo $Source['FilePath'] ?></div>
                    </div>
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">行号</span>
                        <div class="mt-1 font-mono text-sm text-text-primary"><?php echo $Source['LineStart'] ?></div>
                    </div>
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">目标函数</span>
                        <div class="mt-1 font-mono text-sm text-text-primary"><?php echo isset($Source['TargetFunction'])?$Source['TargetFunction']:'' ?></div>
                    </div>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-text-primary mb-3">漏洞代码</h4>
                    <div class="bg-slate-800 rounded-xl p-4 overflow-x-auto">
                        <pre class="text-sm text-text-muted font-mono"><code><?php echo htmlspecialchars(syntax_highlight($Source['Snippet'])) ?></code></pre>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php
        $Primary = $info['Primary'];
        ?>
        <!-- 触发点信息卡片 -->
        <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
                <h3 class="text-lg font-bold text-text-primary">触发点信息</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-3 gap-6 mb-6">
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">执行点</span>
                        <div class="mt-1 font-mono text-sm text-text-primary break-all"><?php echo $Primary['FilePath'] ?></div>
                    </div>
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">行号</span>
                        <div class="mt-1 font-mono text-sm text-text-primary"><?php echo $Primary['LineStart'] ?></div>
                    </div>
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">目标函数</span>
                        <div class="mt-1 font-mono text-sm text-text-primary"><?php echo isset($Primary['TargetFunction'])?$Primary['TargetFunction']:'' ?></div>
                    </div>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-text-primary mb-3">漏洞代码</h4>
                    <div class="bg-slate-800 rounded-xl p-4 overflow-x-auto">
                        <pre class="text-sm text-text-muted font-mono"><code><?php echo $Primary['Snippet']; ?></code></pre>
                    </div>
                </div>
            </div>
        </div>

        <!-- 操作按钮 -->
        <div class="bg-white border border-surface-300 rounded-2xl shadow-card p-6">
            <input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/fortify') ?>">
            {include file='public/to_examine' /}
            <div class="flex justify-center gap-3">
                <?php if ($info['check_status'] == 0) { ?>
                <button onclick="to_examine(<?php echo $info['id'] ?>)"
                        class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary to-blue-600 text-white font-semibold hover:shadow-hover transition-all">
                    审核
                </button>
                <?php } ?>
                <a href="<?php echo url('code/bug_list') ?>"
                   class="px-5 py-2.5 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 hover:border-primary hover:text-primary transition-all">
                    返回列表页
                </a>
                <a href="<?php echo url('code/bug_details', ['id' => $info['upper_id']]) ?>"
                   class="px-5 py-2.5 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 hover:border-primary hover:text-primary transition-all">
                    上一页
                </a>
                <a href="<?php echo url('code/bug_details', ['id' => $info['lower_id']]) ?>"
                   class="px-5 py-2.5 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 hover:border-primary hover:text-primary transition-all">
                    下一页
                </a>
            </div>
        </div>
    </div>
</div>

{include file='public/to_examine' /}
{include file='public/footer' /}
