{include file='public/head' /}
{include file='public/whiteLeftMenu' /}

<style>
    /* Tailwind 风格样式 */
    .page-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        margin-bottom: 20px;
    }
    .card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
    }
    .card-title {
        color: #64748b;
        font-size: 14px;
        font-weight: 600;
        margin: 0 0 4px;
    }
    .card-body {
        padding: 20px 24px;
    }
    .page-title {
        font-size: 18px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }
    .info-item {
        background: #f8fafc;
        border-radius: 12px;
        padding: 14px 16px;
    }
    .info-label {
        font-size: 11px;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        margin-bottom: 4px;
    }
    .info-value {
        color: #1e293b;
        font-weight: 500;
        font-size: 14px;
    }
    /* 漏洞等级标签 */
    .level-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }
    .level-critical {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
    .level-high {
        background: #fff7ed;
        color: #ea580c;
        border: 1px solid #fed7aa;
    }
    .level-medium {
        background: #fffbeb;
        color: #d97706;
        border: 1px solid #fde68a;
    }
    .level-low {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }
    .level-error {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
    .level-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }
    .level-critical .level-dot,
    .level-error .level-dot { background: #dc2626; }
    .level-high .level-dot { background: #ea580c; }
    .level-medium .level-dot { background: #d97706; }
    .level-low .level-dot { background: #2563eb; }
    /* 代码块 */
    .code-block {
        background: #1e293b;
        border-radius: 12px;
        padding: 16px;
        color: #e2e8f0;
        font-family: 'Monaco', 'Menlo', monospace;
        font-size: 13px;
        line-height: 1.6;
        overflow-x: auto;
    }
    /* 状态选择器 */
    .status-select {
        padding: 8px 12px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        font-size: 14px;
        color: #1e293b;
        cursor: pointer;
    }
    .status-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    }
    /* 按钮 */
    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 16px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #1e293b;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
    }
    .btn-action:hover {
        background: #f8fafc;
        border-color: #3b82f6;
        color: #3b82f6;
    }
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: #ffffff;
        border: none;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        color: #ffffff;
    }
    /* 漏洞描述区域 */
    .desc-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 16px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }
    /* 修复建议 */
    .suggestion-box {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        padding: 16px;
    }
    .suggestion-title {
        color: #166534;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
    }
    .suggestion-content {
        color: #166534;
        font-size: 13px;
        line-height: 1.6;
    }
</style>

<div style="padding: 20px;">
    <!-- 漏洞标题 -->
    <div class="page-card">
        <div class="card-header" style="text-align: center;">
            <h3 class="page-title">
                <?php echo str_replace('data.tools.semgrep.', "", $info['check_id']); ?>
            </h3>
        </div>

        <!-- 基本信息 -->
        <div class="card-body">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">所属文件</div>
                    <div class="info-value">
                        <?php
                        $a = $info['project_name'] ?? '';
                        $path = $info['path'] ?? '';
                        $tmpStr = $a ? preg_replace("/\/.*?\/$a/", "", $path) : $path;
                        echo $tmpStr;
                        ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">发现时间</div>
                    <div class="info-value"><?php echo $info['create_time'] ?? '' ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">所属项目</div>
                    <div class="info-value"><?php echo $info['project_name'] ?? '' ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">审核状态</div>
                    <div class="info-value">
                        <select class="status-select changCheckStatus" data-id="<?php echo $info['id'] ?? '' ?>">
                            <option value="0" <?php echo ($info['check_status'] ?? 0) == 0 ? 'selected' : ''; ?> >未审核</option>
                            <option value="1" <?php echo ($info['check_status'] ?? 0) == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                            <option value="2" <?php echo ($info['check_status'] ?? 0) == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                        </select>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">危险等级</div>
                    <div class="info-value">
                        <?php
                        $levelMap = ['ERROR' => 'error', 'Critical' => 'critical', 'High' => 'high', 'Medium' => 'medium', 'Low' => 'low'];
                        $levelClass = $levelMap[$info['extra_severity'] ?? ''] ?? 'low';
                        ?>
                        <span class="level-badge level-<?php echo $levelClass ?>">
                            <span class="level-dot"></span>
                            <?php echo $info['extra_severity'] ?? '' ?>
                        </span>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">缺陷位置</div>
                    <div class="info-value">第<?php echo $info['start_line'] ?? $info['start_offset'] ?? '' ?>行</div>
                </div>
            </div>
        </div>
    </div>

    <!-- 漏洞描述 -->
    <div class="page-card">
        <div class="card-header">
            <h3 class="card-title">漏洞描述</h3>
        </div>
        <div class="card-body">
            <div class="desc-box">
                <?php echo $info['extra_message'] ?? '' ?>
            </div>
        </div>
    </div>

    <!-- 错误代码 -->
    <div class="page-card">
        <div class="card-header">
            <h3 class="card-title">错误代码</h3>
        </div>
        <div class="card-body">
            <?php if (!empty($info['extra_lines'])) { ?>
                <div class="code-block">
                    <pre style="margin: 0; color: #e2e8f0;"><?php echo htmlspecialchars($info['extra_lines']) ?></pre>
                </div>
            <?php } else { ?>
                <div class="desc-box" style="text-align: center; color: #94a3b8;">
                    <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                    <div>暂无代码片段信息</div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- 操作按钮 -->
    <div class="page-card">
        <div class="card-body" style="text-align: center;">
            <input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/semgrep') ?>">
            <?php if ($info['check_status'] == 0) { ?>
                <a href="javascript:;" class="btn-action btn-primary" onclick="to_examine(<?php echo $info['id'] ?>)">审核</a>
            <?php } ?>
            <a href="<?php echo url('semgrep/index') ?>" class="btn-action">返回列表页</a>
            <a href="<?php echo url('semgrep/details', ['id' => $info['upper_id']]) ?>" class="btn-action">上一页</a>
            <a href="<?php echo url('semgrep/details', ['id' => $info['lower_id']]) ?>" class="btn-action">下一页</a>
        </div>
    </div>
</div>

{include file='public/to_examine' /}
{include file='public/footer' /}
