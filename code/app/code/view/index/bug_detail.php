{include file='public/head' /}
{include file='public/whiteLeftMenu' /}

<div class="min-h-screen bg-surface-100 p-6">
    <div class="max-w-6xl mx-auto">
        <!-- 页面标题 -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-text-primary mb-2">漏洞详情</h1>
            <nav class="flex gap-2 text-sm text-text-secondary">
                <a href="<?php echo url('code/index') ?>" class="hover:text-primary transition-colors">代码审计</a>
                <span class="text-text-muted">/</span>
                <a href="<?php echo url('code/bug_list') ?>" class="hover:text-primary transition-colors">漏洞列表</a>
                <span class="text-text-muted">/</span>
                <span class="text-text-primary font-medium">漏洞详情</span>
            </nav>
        </div>

        <!-- 主内容区 -->
        <div class="grid grid-cols-3 gap-6">
            <!-- 左侧主要内容 -->
            <div class="col-span-2 space-y-6">
                <!-- 项目信息卡片 -->
                <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden">
                    <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
                        <h3 class="text-lg font-bold text-text-primary">项目信息</h3>
                    </div>
                    <table class="w-full">
                        <tbody class="divide-y divide-surface-200">
                            <tr class="hover:bg-surface-50 transition-colors">
                                <td class="px-6 py-4 w-32 text-sm font-medium text-text-secondary bg-surface-50">项目地址</td>
                                <td class="px-6 py-4 text-sm text-text-primary">
                                    <a href="<?php echo $project['web_url'] ?>" target="_blank" class="text-primary hover:underline"><?php echo $project['web_url'] ?></a>
                                </td>
                            </tr>
                            <tr class="hover:bg-surface-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-text-secondary bg-surface-50">漏洞类型</td>
                                <td class="px-6 py-4 text-sm text-text-primary"><?php echo $base['Category'] ?></td>
                            </tr>
                            <tr class="hover:bg-surface-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-text-secondary bg-surface-50">危害等级</td>
                                <td class="px-6 py-4">
                                    <?php
                                    $levelColors = [
                                        'Critical' => 'bg-red-50 text-red-600 border-red-100',
                                        'High' => 'bg-orange-50 text-orange-600 border-orange-100',
                                        'Medium' => 'bg-amber-50 text-amber-600 border-amber-100',
                                        'Low' => 'bg-blue-50 text-blue-600 border-blue-100'
                                    ];
                                    $levelColor = $levelColors[$base['Folder']] ?? 'bg-slate-50 text-slate-600 border-slate-100';
                                    ?>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold <?php echo $levelColor; ?> border">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                        <?php echo $base['Folder'] ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-surface-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-text-secondary bg-surface-50">项目ID</td>
                                <td class="px-6 py-4 text-sm text-text-primary font-mono"><?php echo $base['code_id'] ?></td>
                            </tr>
                            <tr class="hover:bg-surface-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-text-secondary bg-surface-50">漏洞描述</td>
                                <td class="px-6 py-4 text-sm text-text-secondary leading-relaxed"><?php echo isset($base['Abstract'])?$base['Abstract']:'' ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <?php if (!empty($Source)) { ?>
                <!-- 污染源信息卡片 -->
                <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden">
                    <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
                        <h3 class="text-lg font-bold text-text-primary">污染源信息</h3>
                    </div>
                    <table class="w-full">
                        <tbody class="divide-y divide-surface-200">
                            <tr class="hover:bg-surface-50 transition-colors">
                                <td class="px-6 py-4 w-32 text-sm font-medium text-text-secondary bg-surface-50">参数来源</td>
                                <td class="px-6 py-4 text-sm">
                                    <a title="<?php echo $project['web_url'] ?>/-/blob/master/<?php echo $Source['FilePath'] ?>"
                                       href="<?php echo $project['web_url'] ?>/-/blob/master/<?php echo $Source['FilePath'] ?>"
                                       target="_blank" class="text-primary hover:underline font-mono"><?php echo $Source['FilePath'] ?></a>
                                </td>
                            </tr>
                            <tr class="hover:bg-surface-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-text-secondary bg-surface-50">行号</td>
                                <td class="px-6 py-4 text-sm text-text-primary font-mono"><?php echo isset($Source['LineStart'])?$Source['LineStart']:'' ?></td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-text-secondary bg-surface-50 align-top">漏洞位置</td>
                                <td class="px-6 py-4">
                                    <div class="bg-slate-800 rounded-xl p-4 overflow-x-auto">
                                        <pre class="text-sm text-slate-300 font-mono"><code><?php echo syntax_highlight($Source['Snippet']) ?></code></pre>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-surface-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-text-secondary bg-surface-50">目标函数</td>
                                <td class="px-6 py-4 text-sm text-text-primary font-mono"><?php echo isset($Source['TargetFunction'])?$Source['TargetFunction']:'' ?></td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-text-secondary bg-surface-50">源码内容</td>
                                <td class="px-6 py-4">
                                    <button class="px-4 py-2 rounded-xl border border-surface-400 text-text-primary text-sm font-medium hover:bg-surface-100 hover:border-primary hover:text-primary transition-all" onclick="toggleSourceCode()">
                                        <span id="sourceBtnText">查看源码</span>
                                    </button>
                                    <div id="sourceCode" class="hidden mt-4">
                                        <div class="bg-slate-800 rounded-xl p-4 overflow-x-auto">
                                            <pre class="text-sm text-slate-300 font-mono"><code><?php echo getCode($project['id'], $Source['FilePath']) ?></code></pre>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php } ?>

                <!-- 执行点信息卡片 -->
                <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden">
                    <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
                        <h3 class="text-lg font-bold text-text-primary">执行点信息</h3>
                    </div>
                    <table class="w-full">
                        <tbody class="divide-y divide-surface-200">
                            <tr class="hover:bg-surface-50 transition-colors">
                                <td class="px-6 py-4 w-32 text-sm font-medium text-text-secondary bg-surface-50">触发文件</td>
                                <td class="px-6 py-4 text-sm">
                                    <a title="<?php echo $project['web_url'] ?>/-/blob/master/<?php echo $Primary['FilePath'] ?>"
                                       href="<?php echo $project['web_url'] ?>/-/blob/master/<?php echo $Primary['FilePath'] ?>"
                                       target="_blank" class="text-primary hover:underline font-mono"><?php echo $Primary['FilePath'] ?></a>
                                </td>
                            </tr>
                            <tr class="hover:bg-surface-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-text-secondary bg-surface-50">行号</td>
                                <td class="px-6 py-4 text-sm text-text-primary font-mono"><?php echo $Primary['LineStart'] ?></td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-text-secondary bg-surface-50 align-top">漏洞位置</td>
                                <td class="px-6 py-4">
                                    <div class="bg-slate-800 rounded-xl p-4 overflow-x-auto">
                                        <pre class="text-sm text-slate-300 font-mono"><code><?php echo syntax_highlight($Primary['Snippet']) ?></code></pre>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-surface-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-text-secondary bg-surface-50">目标函数</td>
                                <td class="px-6 py-4 text-sm text-text-primary font-mono"><?php echo isset($Primary['TargetFunction'])?$Primary['TargetFunction']:'' ?></td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-text-secondary bg-surface-50">源码内容</td>
                                <td class="px-6 py-4">
                                    <button class="px-4 py-2 rounded-xl border border-surface-400 text-text-primary text-sm font-medium hover:bg-surface-100 hover:border-primary hover:text-primary transition-all" onclick="togglePrimaryCode()">
                                        <span id="primaryBtnText">查看源码</span>
                                    </button>
                                    <div id="primaryCode" class="hidden mt-4">
                                        <div class="bg-slate-800 rounded-xl p-4 overflow-x-auto">
                                            <pre class="text-sm text-slate-300 font-mono"><code><?php echo getCode($project['id'], $Primary['FilePath']) ?></code></pre>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 右侧操作区 -->
            <div class="space-y-6">
                <!-- 操作按钮卡片 -->
                <div class="bg-white border border-surface-300 rounded-2xl shadow-card p-6">
                    <h3 class="text-lg font-bold text-text-primary mb-4">操作</h3>
                    <div class="space-y-3">
                        <a class="w-full px-4 py-3 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 hover:border-primary hover:text-primary transition-all flex items-center justify-center gap-2"
                           href="/index.php?s=code_check/bug_list&=<?php echo $base['code_id'] ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            返回列表
                        </a>
                        <div class="grid grid-cols-2 gap-3">
                            <a class="px-4 py-3 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 hover:border-primary hover:text-primary transition-all text-center"
                               href="/index.php?s=code_check/bug_detail&id=<?php echo $base['id'] - 1 ?>">上一个</a>
                            <a class="px-4 py-3 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 hover:border-primary hover:text-primary transition-all text-center"
                               href="/index.php?s=code_check/bug_detail&id=<?php echo $base['id'] + 1 ?>">下一个</a>
                        </div>
                    </div>
                </div>

                <!-- 审核状态卡片 -->
                <div class="bg-white border border-surface-300 rounded-2xl shadow-card p-6">
                    <h3 class="text-lg font-bold text-text-primary mb-4">审核信息</h3>
                    <form class="space-y-4" action="<?php echo U('code_check/_bug_comment', ['id' => $base['id']]) ?>">
                        <div>
                            <label class="block text-sm font-medium text-text-primary mb-2">评论</label>
                            <textarea class="w-full bg-surface-100 border border-surface-300 rounded-xl px-4 py-3 text-text-primary placeholder-text-muted focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none transition-all resize-none text-sm"
                                      name="comment" rows="4"><?php echo $base['comment'] ?></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-text-primary mb-2">审核状态</label>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 cursor-pointer p-2 rounded-lg hover:bg-surface-100 transition-colors">
                                    <input type="radio" name="check_status" <?php echo ($base['check_status'] == 0) ? 'checked' : '' ?> value="0"
                                           class="w-4 h-4 text-primary border-surface-400 focus:ring-primary/20">
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg text-xs font-semibold bg-sky-50 text-sky-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                                        未处理
                                    </span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer p-2 rounded-lg hover:bg-surface-100 transition-colors">
                                    <input type="radio" name="check_status" <?php echo ($base['check_status'] == 1) ? 'checked' : '' ?> value="1"
                                           class="w-4 h-4 text-primary border-surface-400 focus:ring-primary/20">
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        有效漏洞
                                    </span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer p-2 rounded-lg hover:bg-surface-100 transition-colors">
                                    <input type="radio" name="check_status" <?php echo ($base['check_status'] == 2) ? 'checked' : '' ?> value="2"
                                           class="w-4 h-4 text-primary border-surface-400 focus:ring-primary/20">
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-lg text-xs font-semibold bg-slate-50 text-slate-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                        无效漏洞
                                    </span>
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="w-full px-4 py-3 rounded-xl bg-gradient-to-r from-primary to-blue-600 text-white font-semibold hover:shadow-hover transition-all">
                            提交审核
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleSourceCode() {
        const code = document.getElementById('sourceCode');
        const text = document.getElementById('sourceBtnText');
        if (code.classList.contains('hidden')) {
            code.classList.remove('hidden');
            text.textContent = '隐藏源码';
        } else {
            code.classList.add('hidden');
            text.textContent = '查看源码';
        }
    }

    function togglePrimaryCode() {
        const code = document.getElementById('primaryCode');
        const text = document.getElementById('primaryBtnText');
        if (code.classList.contains('hidden')) {
            code.classList.remove('hidden');
            text.textContent = '隐藏源码';
        } else {
            code.classList.add('hidden');
            text.textContent = '查看源码';
        }
    }
</script>
{include file='public/footer' /}
