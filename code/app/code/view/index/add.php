{include file='public/head' /}
{include file='public/whiteLeftMenu' /}
<style>
    .form-page-container {
        max-width: 640px;
        margin: 40px auto;
        padding: 0 20px;
    }
    .form-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }
    .form-card-header {
        padding: 24px 32px;
        border-bottom: 1px solid #e2e8f0;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }
    .form-card-header h1 {
        font-size: 20px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }
    .form-card-body {
        padding: 32px;
    }
    .form-group {
        margin-bottom: 24px;
    }
    .form-group:last-of-type {
        margin-bottom: 0;
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
    .form-select-modern {
        width: 100%;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 14px;
        color: #1e293b;
        transition: all 0.2s;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 20px;
        padding-right: 44px;
    }
    .form-select-modern:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
        background-color: #ffffff;
    }
    .btn-submit-modern {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 32px;
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
        transform: translateY(-1px);
    }
    .btn-back-modern {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 32px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        background: #f8fafc;
        color: #64748b;
        border: 1px solid #e2e8f0;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }
    .btn-back-modern:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        color: #1e293b;
    }
    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid #e2e8f0;
    }
</style>
<div class="form-page-container">
    <div class="form-card">
        <div class="form-card-header">
            <h1>添加扫描任务</h1>
        </div>
        <div class="form-card-body">
            <form method="post" action="/index.php?s=host/_add">
                <div class="form-group">
                    <label class="form-label-modern">所属应用</label>
                    <select name="app_id" class="form-select-modern">
                        <option value="1">111</option>
                        <option value="2">222</option>
                        <option value="3">333</option>
                        <option value="4">444</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label-modern">URL地址</label>
                    <input type="url" name="url" class="form-control-modern" placeholder="请输入URL地址">
                </div>

                <div class="form-group">
                    <label class="form-label-modern">启用爬虫</label>
                    <select name="is_crawl" class="form-select-modern">
                        <option value="1">启用</option>
                        <option value="0">不启用</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label-modern">自定义Header</label>
                    <textarea class="form-control-modern" name="custom_header" rows="3" placeholder="填写header消息"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label-modern">自定义Cookie</label>
                    <textarea class="form-control-modern" name="custom_cookie" rows="3" placeholder="自定义cookie"></textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-submit-modern">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        提交
                    </button>
                    <a href="/index.php?s=host/index" class="btn-back-modern">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        返回
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
{include file='public/footer' /}
