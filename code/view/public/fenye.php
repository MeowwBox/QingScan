<?php if(!empty($page)){?>
<style>
    /* 分页容器样式 */
    .fenye-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 20px;
        border-top: 1px solid #f1f5f9;
        background: #f8fafc;
        border-radius: 0 0 16px 16px;
    }
    /* 分页按钮通用样式 */
    .fenye-wrapper .pagination {
        display: flex;
        gap: 4px;
        list-style: none;
        margin: 0;
        padding: 0;
        flex-wrap: wrap;
        justify-content: flex-end;
        align-items: center;
    }
    .fenye-wrapper ul {
        display: flex;
        gap: 4px;
        list-style: none;
        margin: 0;
        padding: 0;
        flex-wrap: wrap;
        justify-content: center;
    }
    .fenye-wrapper li {
        display: inline-flex;
    }
    .fenye-wrapper li a,
    .fenye-wrapper li span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 14px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #64748b;
    }
    .fenye-wrapper li a:hover {
        background: #f8fafc;
        border-color: #3b82f6;
        color: #3b82f6;
    }
    /* 当前页样式 */
    .fenye-wrapper li.active a,
    .fenye-wrapper li.active span,
    .fenye-wrapper li.current a,
    .fenye-wrapper li.current span,
    .fenye-wrapper .active a,
    .fenye-wrapper .current a {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border-color: #3b82f6;
        color: #ffffff;
        box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
    }
    /* 禁用状态 */
    .fenye-wrapper li.disabled a,
    .fenye-wrapper li.disabled span,
    .fenye-wrapper .disabled a {
        background: #f8fafc;
        border-color: #e2e8f0;
        color: #94a3b8;
        cursor: not-allowed;
    }
    .fenye-wrapper li.disabled a:hover,
    .fenye-wrapper .disabled a:hover {
        background: #f8fafc;
        border-color: #e2e8f0;
        color: #94a3b8;
    }
    /* 分页信息文字 */
    .fenye-wrapper .pagination-info,
    .fenye-wrapper .fenye-info {
        font-size: 14px;
        color: #64748b;
    }
    .fenye-wrapper .pagination-info strong,
    .fenye-wrapper .fenye-info strong {
        color: #1e293b;
        font-weight: 600;
    }
</style>
<div class="fenye-wrapper">
    <div class="fenye-info">
        <?php if(!empty($paginator)): ?>
        显示 <strong><?php echo ($paginator->currentPage() - 1) * $paginator->listRows() + 1 ?>-<?php echo min($paginator->currentPage() * $paginator->listRows(), $paginator->total()) ?></strong> 条，共 <strong><?php echo $paginator->total() ?></strong> 条记录
        <?php else: ?>
        共 <strong><?php echo count($list ?? []) ?></strong> 条记录
        <?php endif; ?>
    </div>
    {$page|raw}
</div>
<?php }?>
