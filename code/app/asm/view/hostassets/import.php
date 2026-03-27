{include file='public/head' /}
{include file='public/asmLeftMenu' /}
<style>
    .detail-wrapper {
        padding: 24px;
        background: #f8fafc;
        min-height: calc(100vh - 64px);
    }
    .form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 32px;
        max-width: 600px;
        margin: 0 auto;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
    }
    .form-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid #e2e8f0;
    }
    .alert-info {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        color: #1e40af;
        padding: 20px 24px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .alert-info svg {
        flex-shrink: 0;
    }
</style>
<div class="form-card">
    <h1 class="form-title">导入主机资产</h1>
    <div class="alert-info">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 16v-4M12 8h.01"/>
        </svg>
        <p style="margin: 0; font-size: 14px;">功能开发中，敬请期待！</p>
    </div>
</div>
{include file='public/footer' /}
