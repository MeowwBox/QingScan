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
        font-size: 20px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }
    .info-item {
        background: #f8fafc;
        border-radius: 12px;
        padding: 16px;
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
    .level-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }
    .level-critical .level-dot { background: #dc2626; }
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
    /* 分隔线 */
    .divider {
        height: 1px;
        background: #f1f5f9;
        margin: 20px 0;
    }
</style>

<div class="flex flex-wrap" style="margin: 0;">
    <div class="w-full px-4" style="padding: 20px;">
        <!-- 漏洞标题 -->
        <div class="page-card">
            <div class="card-header" style="text-align: center;">
                <h2 class="page-title">
                    <?php echo $info['Category']; ?>
                </h2>
            </div>
        </div>

        <!-- 基本信息 -->
        <div class="page-card">
            <div class="card-header">
                <h3 class="card-title">基本信息</h3>
            </div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">漏洞类型</div>
                        <div class="info-value"><?php echo htmlentities($info['Category']); ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">发现时间</div>
                        <div class="info-value"><?php echo $info['create_time']; ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">审核状态</div>
                        <div class="info-value">
                            <select class="status-select changCheckStatus" data-id="<?php echo $info['id'] ?>">
                                <option value="0" <?php echo $info['check_status'] == 0 ? 'selected' : ''; ?> >未审核</option>
                                <option value="1" <?php echo $info['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞</option>
                                <option value="2" <?php echo $info['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞</option>
                            </select>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">危险等级</div>
                        <div class="info-value">
                            <?php
                            $levelMap = ['Critical' => 'critical', 'High' => 'high', 'Medium' => 'medium', 'Low' => 'low'];
                            $levelClass = $levelMap[$info['Friority']] ?? 'low';
                            ?>
                            <span class="level-badge level-<?php echo $levelClass ?>">
                                <span class="level-dot"></span>
                                <?php echo $info['Friority'] ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 污染来源 -->
        <?php
        $Source = $info['Source'];
        $isSourceArray = is_array($Source) && !empty($Source);
        ?>
        <div class="page-card">
            <div class="card-header">
                <h3 class="card-title">污染来源</h3>
            </div>
            <div class="card-body">
                <?php if ($isSourceArray) { ?>
                    <div class="info-grid" style="margin-bottom: 16px;">
                        <div class="info-item">
                            <div class="info-label">参数来源</div>
                            <div class="info-value" title="<?php echo $Source['FilePath'] ?? '' ?>">
                                <?php echo basename($Source['FilePath'] ?? '') ?>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">行号</div>
                            <div class="info-value"><?php echo $Source['LineStart'] ?? '' ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">目标函数</div>
                            <div class="info-value">
                                <?php echo $Source['TargetFunction'] ?? '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="code-block">
                        <pre style="margin: 0; color: #e2e8f0;"><?php echo htmlspecialchars($Source['Snippet'] ?? '') ?></pre>
                    </div>
                <?php } else { ?>
                    <div class="code-block">
                        <pre style="margin: 0; color: #e2e8f0;"><?php echo htmlspecialchars($Source ?? '') ?></pre>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- 触发点信息 -->
        <?php
        $Primary = $info['Primary'] ?? [];
        $isPrimaryArray = is_array($Primary) && !empty($Primary);
        ?>
        <div class="page-card">
            <div class="card-header">
                <h3 class="card-title">触发点信息</h3>
            </div>
            <div class="card-body">
                <?php if ($isPrimaryArray) { ?>
                    <div class="info-grid" style="margin-bottom: 16px;">
                        <div class="info-item">
                            <div class="info-label">执行点</div>
                            <div class="info-value"><?php echo $Primary['FilePath'] ?? '' ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">行号</div>
                            <div class="info-value"><?php echo $Primary['LineStart'] ?? '' ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">目标函数</div>
                            <div class="info-value">
                                <?php echo $Primary['TargetFunction'] ?? '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="code-block">
                        <pre style="margin: 0; color: #e2e8f0;"><?php echo htmlspecialchars($Primary['Snippet'] ?? '') ?></pre>
                    </div>
                <?php } else { ?>
                    <div class="code-block">
                        <pre style="margin: 0; color: #e2e8f0;"><?php echo htmlspecialchars($Primary ?? '') ?></pre>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- 操作按钮 -->
        <div class="page-card">
            <div class="card-body" style="text-align: center;">
                <input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/fortify') ?>">
                {include file='public/to_examine' /}
                <?php if ($info['check_status'] == 0) { ?>
                    <a href="javascript:;" class="btn-action btn-primary" onclick="to_examine(<?php echo $info['id'] ?>)">审核</a>
                <?php } ?>
                <a href="<?php echo url('fortify/index') ?>" class="btn-action">返回列表页</a>
                <a href="<?php echo url('fortify/details', ['id' => $info['upper_id']]) ?>" class="btn-action">上一页</a>
                <a href="<?php echo url('fortify/details', ['id' => $info['lower_id']]) ?>" class="btn-action">下一页</a>
            </div>
        </div>
    </div>
</div>

{include file='public/to_examine' /}
{include file='public/footer' /}
