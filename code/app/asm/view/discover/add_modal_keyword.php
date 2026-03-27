<style>
    /* 抽屉样式 */
    .drawer-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.3);
        z-index: 1050;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease;
    }
    .drawer-overlay.show {
        opacity: 1;
        visibility: visible;
    }
    .drawer-panel {
        position: fixed;
        top: 0;
        right: 0;
        height: 100%;
        width: 480px;
        background: #ffffff;
        box-shadow: -8px 0 30px rgba(0, 0, 0, 0.1);
        z-index: 1051;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .drawer-panel.show {
        transform: translateX(0);
    }
    .drawer-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 24px;
        border-bottom: 1px solid #e2e8f0;
        flex-shrink: 0;
    }
    .drawer-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
    }
    .drawer-close {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        border: none;
        background: transparent;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .drawer-close:hover {
        background: #f1f5f9;
    }
    .drawer-body {
        flex: 1;
        overflow-y: auto;
        padding: 24px;
    }
    .drawer-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding: 20px 24px;
        border-top: 1px solid #e2e8f0;
        background: #f8fafc;
        flex-shrink: 0;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-label-modern {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }
    .form-control-modern {
        width: 100%;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 14px;
        color: #1e293b;
        transition: all 0.2s;
        resize: vertical;
    }
    .form-control-modern:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
        background: #ffffff;
    }
    .form-control-modern::placeholder {
        color: #94a3b8;
    }
    .btn-cancel-modern {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 24px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        background: #f8fafc;
        color: #64748b;
        border: 1px solid #e2e8f0;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-cancel-modern:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }
    .btn-submit-modern {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 24px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: #ffffff;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
    }
    .btn-submit-modern:hover {
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.4);
    }
</style>

<!-- 抽屉 -->
<div class="drawer-overlay" id="keywordDrawerOverlay" onclick="closeKeywordDrawer()"></div>
<div class="drawer-panel" id="keywordDrawerPanel">
    <div class="drawer-header">
        <h3 class="drawer-title">添加关键词</h3>
        <button type="button" class="drawer-close" onclick="closeKeywordDrawer()">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    <form method="post" action="<?php echo url('_add_keyword') ?>">
        <div class="drawer-body">
            <div class="form-group">
                <label class="form-label-modern">数据类型</label>
                <select name="type" class="form-control-modern">
                    <option value="domain">域名</option>
                    <option value="ip">IP</option>
                    <option value="port">端口</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label-modern">关键词</label>
                <input type="text" name="keyword" class="form-control-modern" placeholder="dedecms">
            </div>
        </div>
        <div class="drawer-footer">
            <button type="button" class="btn-cancel-modern" onclick="closeKeywordDrawer()">取消</button>
            <button type="submit" class="btn-submit-modern">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                提交
            </button>
        </div>
    </form>
</div>

<script>
    function openKeywordDrawer() {
        document.getElementById('keywordDrawerOverlay').classList.add('show');
        document.getElementById('keywordDrawerPanel').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeKeywordDrawer() {
        document.getElementById('keywordDrawerOverlay').classList.remove('show');
        document.getElementById('keywordDrawerPanel').classList.remove('show');
        document.body.style.overflow = '';
    }

    // ESC键关闭抽屉
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeKeywordDrawer();
        }
    });
</script>
