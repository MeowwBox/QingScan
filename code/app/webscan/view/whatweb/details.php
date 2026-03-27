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
<main class="p-6 min-h-screen">
    <!-- 页面标题 -->
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 mb-2">漏洞详情</h1>
            <nav class="flex gap-2 text-sm text-slate-500">
                <a href="/" class="hover:text-blue-500 transition-colors">首页</a>
                <span class="text-slate-300">/</span>
                <a href="<?php echo url('xray/index') ?>" class="hover:text-blue-500 transition-colors">WhatWeb</a>
                <span class="text-slate-300">/</span>
                <span class="text-slate-700 font-medium">详情</span>
            </nav>
        </div>
        <div class="flex gap-2">
            <?php if($info['check_status'] == 0){?>
            <a href="javascript:;" class="px-4 py-2.5 rounded-xl bg-blue-500 text-white font-medium hover:bg-blue-600 transition-colors" onclick="to_examine(<?php echo $info['id']?>)">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    审核
                </span>
            </a>
            <?php }?>
            <a href="<?php echo url('xray/index') ?>" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-medium hover:bg-slate-50 transition-colors">返回列表</a>
            <a href="<?php echo url('xray/details', ['id' => $info['upper_id']]) ?>" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-medium hover:bg-slate-50 transition-colors">上一页</a>
            <a href="<?php echo url('xray/details', ['id' => $info['lower_id']]) ?>" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-600 font-medium hover:bg-slate-50 transition-colors">下一页</a>
        </div>
    </div>

    <input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/xray')?>">

    <!-- 主卡片 -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <!-- 卡片头部 -->
        <div class="flex justify-between items-center px-6 py-5 border-b border-slate-100 bg-slate-50">
            <div class="flex items-center gap-3">
                <h2 class="text-xl font-bold text-slate-800">Web Vulnerabilities</h2>
                <span class="bg-red-100 text-red-600 text-xs px-2.5 py-1 rounded-full font-medium">漏洞</span>
            </div>
            {include file='public/to_examine' /}
        </div>

        <!-- 详情内容 -->
        <div class="p-6">
            <!-- 基本信息表格 -->
            <div class="bg-slate-50 rounded-xl border border-slate-200 overflow-hidden mb-6">
                <table class="w-full">
                    <tbody class="divide-y divide-slate-200">
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-slate-500 bg-slate-100 w-40">ID</td>
                            <td class="px-5 py-4 text-slate-700"><?php echo $info['id'] ?></td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-slate-500 bg-slate-100">Target</td>
                            <td class="px-5 py-4">
                                <a href="<?php echo $info['detail']['addr'] ?>" target="_blank" class="text-blue-500 hover:text-blue-600 hover:underline font-mono text-sm">
                                    <?php echo $info['detail']['addr'] ?>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-slate-500 bg-slate-100">Plugin / VulnType</td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium bg-amber-50 text-amber-600 border border-amber-100">
                                    <?php echo $info['plugin'] ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-slate-500 bg-slate-100">CreateTime</td>
                            <td class="px-5 py-4 text-slate-600"><?php echo date('Y-m-d H:i:s', substr($info['create_time'], 0, 10)) ?></td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-slate-500 bg-slate-100">审核状态</td>
                            <td class="px-5 py-4">
                                <select class="changCheckStatus bg-slate-100 border border-slate-300 rounded-xl px-4 py-2 text-slate-700 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-all" data-id="<?php echo $info['id'] ?>">
                                    <option value="0" <?php echo $info['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                                    <option value="1" <?php echo $info['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                                    <option value="2" <?php echo $info['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- 详细信息卡片 -->
            <div class="bg-slate-50 rounded-xl border border-slate-200 overflow-hidden">
                <table class="w-full">
                    <tbody class="divide-y divide-slate-200">
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-slate-500 bg-slate-100 w-40">URL</td>
                            <td class="px-5 py-4">
                                <a href="<?php echo $info['detail']['addr'] ?>" target="_blank" class="text-blue-500 hover:text-blue-600 hover:underline font-mono text-sm">
                                    <?php echo $info['detail']['addr'] ?>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-slate-500 bg-slate-100">Request</td>
                            <td class="px-5 py-4">
                                <pre class="max-h-96 overflow-auto"><?php echo trim($info['detail']['snapshot'][0][0]) ?></pre>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-5 py-4 text-sm font-semibold text-slate-500 bg-slate-100">Response</td>
                            <td class="px-5 py-4">
                                <pre class="max-h-96 overflow-auto"><?php echo trim($info['detail']['snapshot'][0][0]) ?></pre>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

{include file='public/to_examine' /}
{include file='public/footer' /}
