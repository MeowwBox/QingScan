{include file='public/head' /}
{include file='public/whiteLeftMenu' /}

<div class="max-w-5xl mx-auto px-4 py-6">
    <!-- 漏洞标题卡片 -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-5 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
            <h1 class="text-xl font-bold text-slate-800">
               <span>
                  <?php echo str_replace('data.tools.semgrep.', "", $info['check_id']); ?>
               </span>
            </h1>
        </div>
    </div>

    <!-- 漏洞基本信息 -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
            <h3 class="text-base font-semibold text-slate-700">基本信息</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                <div class="bg-slate-50 rounded-xl p-4">
                    <span class="text-xs text-slate-400 uppercase tracking-wider">所属文件</span>
                    <div class="mt-2 text-slate-700">
                        <?php
                            $path = preg_replace("/\/data\/codeCheck\/[a-zA-Z0-9]*\//", "", $info['path']);
                            if ($project['is_online'] == 1) {
                                $url = getGitAddr($project['name'], $project['ssh_url'], $info['path'], $info['end_line']);
                            } else {
                                $url = url('get_code',['id'=>$info['id'],'type'=>2]);
                            }
                        ?>
                        <a href="<?php echo $url; ?>" target="_blank" class="text-blue-500 hover:text-blue-600 hover:underline font-mono text-sm">
                            <?php echo $path ?>
                        </a>
                    </div>
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                    <span class="text-xs text-slate-400 uppercase tracking-wider">发现时间</span>
                    <div class="mt-2 text-slate-700"><?php echo $info['create_time'] ?></div>
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                    <span class="text-xs text-slate-400 uppercase tracking-wider">所属项目</span>
                    <div class="mt-2 text-slate-700"><?php echo $info['project_name'] ?></div>
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                    <span class="text-xs text-slate-400 uppercase tracking-wider">审核状态</span>
                    <div class="mt-2">
                        <select class="changCheckStatus bg-white border border-slate-200 rounded-lg px-3 py-2 text-sm focus:border-blue-400 focus:ring-2 focus:ring-blue-100 focus:outline-none w-full"
                                data-id="<?php echo $info['id'] ?>">
                            <option value="0" <?php echo $info['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                            <option value="1" <?php echo $info['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                            <option value="2" <?php echo $info['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                        </select>
                    </div>
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                    <span class="text-xs text-slate-400 uppercase tracking-wider">危险等级</span>
                    <div class="mt-2">
                        <?php
                        $severityClass = '';
                        if ($info['extra_severity'] == 'CRITICAL' || $info['extra_severity'] == 'Critical') $severityClass = 'bg-red-50 text-red-600 border-red-100';
                        elseif ($info['extra_severity'] == 'HIGH' || $info['extra_severity'] == 'High') $severityClass = 'bg-orange-50 text-orange-600 border-orange-100';
                        elseif ($info['extra_severity'] == 'MEDIUM' || $info['extra_severity'] == 'Medium') $severityClass = 'bg-amber-50 text-amber-600 border-amber-100';
                        elseif ($info['extra_severity'] == 'LOW' || $info['extra_severity'] == 'Low') $severityClass = 'bg-sky-50 text-sky-600 border-sky-100';
                        else $severityClass = 'bg-slate-50 text-slate-600 border-slate-100';
                        ?>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-semibold <?php echo $severityClass ?> border">
                            <span class="w-2 h-2 rounded-full bg-current"></span>
                            <?php echo $info['extra_severity'] ?>
                        </span>
                    </div>
                </div>
                <div class="bg-slate-50 rounded-xl p-4">
                    <span class="text-xs text-slate-400 uppercase tracking-wider">缺陷位置</span>
                    <div class="mt-2 text-slate-700">第 <?php echo $info['start_offset'] ?> 行</div>
                </div>
            </div>
        </div>
    </div>

    <!-- 漏洞描述 -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
            <h3 class="text-base font-semibold text-slate-700">漏洞描述</h3>
        </div>
        <div class="p-6">
            <div class="bg-slate-50 rounded-xl p-4 text-slate-600 leading-relaxed">
                <?php echo $info['extra_message'] ?>
            </div>
        </div>
    </div>

    <!-- 错误代码 -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
            <h3 class="text-base font-semibold text-slate-700">错误代码</h3>
        </div>
        <div class="p-6">
            <div class="bg-slate-800 rounded-xl p-4 overflow-x-auto">
                <pre class="text-sm text-slate-300 font-mono whitespace-pre-wrap"><?php echo htmlspecialchars($info['extra_lines']) ?></pre>
            </div>
        </div>
    </div>

    <!-- 操作按钮 -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 flex justify-center gap-3">
            <input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/semgrep') ?>">
            <?php if ($info['check_status'] == 0) { ?>
                <button onclick="to_examine(<?php echo $info['id'] ?>)" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium hover:shadow-lg transition-all">
                    审核
                </button>
            <?php } ?>
            <a href="<?php echo url('code/semgrep_list') ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-medium hover:bg-slate-50 transition-all">
                返回列表页
            </a>
            <a href="<?php echo url('code/semgrep_details', ['id' => $info['upper_id']]) ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-medium hover:bg-slate-50 transition-all">
                上一页
            </a>
            <a href="<?php echo url('code/semgrep_details', ['id' => $info['lower_id']]) ?>" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-medium hover:bg-slate-50 transition-all">
                下一页
            </a>
        </div>
    </div>
</div>
{include file='public/to_examine' /}
{include file='public/footer' /}