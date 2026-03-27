{include file='public/head' /}
{include file='public/whiteLeftMenu' /}

<div class="min-h-screen bg-surface-100 p-6">
    <div class="max-w-5xl mx-auto">
        <!-- 页面标题 -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-text-primary mb-2"><?php echo str_replace('data.tools.semgrep.', "", $info['check_id']); ?></h1>
            <nav class="flex gap-2 text-sm text-text-secondary">
                <a href="<?php echo url('code/index') ?>" class="hover:text-primary transition-colors">代码审计</a>
                <span class="text-text-muted">/</span>
                <a href="<?php echo url('code/semgrep_list') ?>" class="hover:text-primary transition-colors">SemGrep 漏洞列表</a>
                <span class="text-text-muted">/</span>
                <span class="text-text-primary font-medium">漏洞详情</span>
            </nav>
        </div>

        <!-- 基本信息卡片 -->
        <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
                <h3 class="text-lg font-bold text-text-primary">漏洞信息</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-3 gap-6">
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">所属文件</span>
                        <div class="mt-1">
                            <?php
                                $path = preg_replace("/\/data\/codeCheck\/[a-zA-Z0-9]*\//", "", $info['path']);
                                if ($project['is_online'] == 1) {
                                    $url = getGitAddr($project['name'], $project['ssh_url'], $info['path'], $info['end_line']);
                                } else {
                                    $url = url('get_code',['id'=>$info['id'],'type'=>2]);
                                }
                            ?>
                            <a href="<?php echo $url; ?>" target="_blank" class="text-primary hover:underline font-mono text-sm break-all"><?php echo $path ?></a>
                        </div>
                    </div>
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">发现时间</span>
                        <div class="mt-1 font-medium text-text-primary"><?php echo $info['create_time'] ?></div>
                    </div>
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">所属项目</span>
                        <div class="mt-1 font-medium text-text-primary"><?php echo $info['project_name'] ?></div>
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
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">危险等级</span>
                        <div class="mt-1">
                            <?php
                            $levelColors = [
                                'ERROR' => 'bg-red-50 text-red-600 border-red-100',
                                'Critical' => 'bg-red-50 text-red-600 border-red-100',
                                'High' => 'bg-orange-50 text-orange-600 border-orange-100',
                                'Medium' => 'bg-amber-50 text-amber-600 border-amber-100',
                                'Low' => 'bg-blue-50 text-blue-600 border-blue-100'
                            ];
                            $levelColor = $levelColors[$info['extra_severity']] ?? 'bg-surface-50 text-text-secondary border-surface-200';
                            ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold <?php echo $levelColor; ?> border">
                                <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                <?php echo $info['extra_severity'] ?>
                            </span>
                        </div>
                    </div>
                    <div class="bg-surface-50 rounded-xl p-4">
                        <span class="text-xs text-text-muted uppercase tracking-wider">缺陷位置</span>
                        <div class="mt-1 font-medium text-text-primary">第 <?php echo $info['start_offset'] ?> 行</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 漏洞描述卡片 -->
        <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
                <h3 class="text-lg font-bold text-text-primary">漏洞描述</h3>
            </div>
            <div class="p-6">
                <div class="bg-surface-50 rounded-xl p-4 text-sm text-text-secondary leading-relaxed">
                    <?php echo $info['extra_message'] ?>
                </div>
            </div>
        </div>

        <!-- 错误代码卡片 -->
        <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
                <h3 class="text-lg font-bold text-text-primary">错误代码</h3>
            </div>
            <div class="p-6">
                <div class="bg-slate-800 rounded-xl p-4 overflow-x-auto shadow-card">
                    <pre class="text-sm text-text-muted font-mono"><code><?php echo htmlspecialchars($info['extra_lines']) ?></code></pre>
                </div>
            </div>
        </div>

        <!-- 操作按钮 -->
        <div class="bg-white border border-surface-300 rounded-2xl shadow-card p-6">
            <input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/semgrep') ?>">
            {include file='public/to_examine' /}
            <div class="flex justify-center gap-3">
                <?php if ($info['check_status'] == 0) { ?>
                <button onclick="to_examine(<?php echo $info['id'] ?>)"
                        class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-primary to-blue-600 text-white font-semibold hover:shadow-hover transition-all">
                    审核
                </button>
                <?php } ?>
                <a href="<?php echo url('code/semgrep_list') ?>"
                   class="px-5 py-2.5 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 hover:border-primary hover:text-primary transition-all">
                    返回列表页
                </a>
                <a href="<?php echo url('code/semgrep_details', ['id' => $info['upper_id']]) ?>"
                   class="px-5 py-2.5 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 hover:border-primary hover:text-primary transition-all">
                    上一页
                </a>
                <a href="<?php echo url('code/semgrep_details', ['id' => $info['lower_id']]) ?>"
                   class="px-5 py-2.5 rounded-xl border border-surface-400 text-text-primary font-medium hover:bg-surface-100 hover:border-primary hover:text-primary transition-all">
                    下一页
                </a>
            </div>
        </div>
    </div>
</div>

{include file='public/to_examine' /}
{include file='public/footer' /}
