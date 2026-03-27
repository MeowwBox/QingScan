<?php
/**
 * 统一表格组件
 *
 * 使用示例：
 * $tableArr = [
 *     'title' => '域名列表',
 *     'count' => count($list),
 *     'checkbox' => true,
 *     'columns' => [
 *         ['field' => 'id', 'title' => 'ID', 'width' => 'w-20'],
 *         ['field' => 'domain', 'title' => '域名'],
 *         ['field' => 'status', 'title' => '状态'],
 *         ['field' => 'create_time', 'title' => '创建时间'],
 *     ],
 * ];
 */

$title = $tableArr['title'] ?? '';
$count = $tableArr['count'] ?? null;
$checkbox = $tableArr['checkbox'] ?? false;
$columns = $tableArr['columns'] ?? [];
$toolbarRight = $tableArr['toolbarRight'] ?? ''; // 工具栏右侧内容
?>
<style>
    /* 表格容器 */
    .table-container {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
    }

    /* 表格工具栏 */
    .table-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 20px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }
    .table-toolbar-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .table-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
    }
    .table-badge {
        background: #3b82f6;
        color: #ffffff;
        font-size: 12px;
        font-weight: 600;
        padding: 2px 10px;
        border-radius: 20px;
    }
    .table-toolbar-right {
        display: flex;
        gap: 8px;
    }

    /* 表格样式 */
    .table-wrapper {
        overflow-x: auto;
    }
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    .data-table thead {
        background: #f8fafc;
    }
    .data-table th {
        padding: 14px 20px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e2e8f0;
    }
    .data-table td {
        padding: 14px 20px;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
        font-size: 14px;
    }
    .data-table tbody tr:hover {
        background: #f8fafc;
    }
    .data-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Checkbox样式 */
    .table-checkbox {
        width: 18px;
        height: 18px;
        border-radius: 4px;
        border: 1px solid #cbd5e1;
        cursor: pointer;
        accent-color: #3b82f6;
    }

    /* 操作按钮 */
    .table-actions {
        display: flex;
        gap: 6px;
    }
    .table-action-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }
    .table-action-btn.view {
        background: #f1f5f9;
        color: #3b82f6;
    }
    .table-action-btn.view:hover {
        background: #eff6ff;
    }
    .table-action-btn.edit {
        background: #f1f5f9;
        color: #f59e0b;
    }
    .table-action-btn.edit:hover {
        background: #fffbeb;
    }
    .table-action-btn.delete {
        background: #f1f5f9;
        color: #ef4444;
    }
    .table-action-btn.delete:hover {
        background: #fef2f2;
    }

    /* 空数据提示 */
    .table-empty {
        padding: 48px 20px;
        text-align: center;
        color: #94a3b8;
    }
    .table-empty-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 12px;
        color: #cbd5e1;
    }
    .table-empty-text {
        font-size: 14px;
    }

    /* 分页区域 */
    .table-footer {
        padding: 12px 20px;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* 标签样式 */
    .table-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }
    .table-tag.blue {
        background: #eff6ff;
        color: #3b82f6;
        border: 1px solid #bfdbfe;
    }
    .table-tag.green {
        background: #ecfdf5;
        color: #10b981;
        border: 1px solid #a7f3d0;
    }
    .table-tag.red {
        background: #fef2f2;
        color: #ef4444;
        border: 1px solid #fecaca;
    }
    .table-tag.amber {
        background: #fffbeb;
        color: #f59e0b;
        border: 1px solid #fde68a;
    }
</style>

<div class="table-container">
    <!-- 工具栏 -->
    <div class="table-toolbar">
        <div class="table-toolbar-left">
            <?php if ($title): ?>
            <span class="table-title"><?php echo $title ?></span>
            <?php endif; ?>
            <?php if ($count !== null): ?>
            <span class="table-badge"><?php echo $count ?></span>
            <?php endif; ?>
        </div>
        <?php if ($toolbarRight): ?>
        <div class="table-toolbar-right">
            <?php echo $toolbarRight ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- 表格内容 - 由调用方填充 -->
