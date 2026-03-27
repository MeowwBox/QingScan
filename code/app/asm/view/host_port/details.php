{include file='public/head' /}
{include file='public/asmLeftMenu' /}
<style>
    .detail-wrapper {
        padding: 24px;
        background: #f8fafc;
        min-height: calc(100vh - 64px);
    }
    .detail-header {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 32px;
        margin-bottom: 24px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04);
    }
    .detail-title {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 16px;
        text-align: center;
    }
    .detail-nav {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }
    .btn-outline {
        background: transparent;
        color: #64748b;
        border: 1px solid #cbd5e1;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 500;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-outline:hover {
        background: #f8fafc;
        border-color: #3b82f6;
        color: #3b82f6;
    }
    .info-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04);
    }
    .info-card h3 {
        font-size: 16px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    .info-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .info-item dt {
        color: #94a3b8;
        font-size: 14px;
        font-weight: 500;
    }
    .info-item dd {
        color: #1e293b;
        font-size: 14px;
        font-weight: 500;
    }
    .content-section {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04);
    }
    .content-section h3 {
        font-size: 16px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 16px;
    }
    .content-body {
        background: #f8fafc;
        border-radius: 12px;
        padding: 20px;
        color: #475569;
        font-size: 14px;
        line-height: 1.8;
        word-wrap: break-word;
    }
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-blue {
        background: #eff6ff;
        color: #3b82f6;
        border: 1px solid #bfdbfe;
    }
</style>
<div class="detail-wrapper">
    <div class="max-w-7xl mx-auto px-4">
        <div class="detail-header">
            <h1 class="detail-title">
                <span><?php echo $info['host'];?></span>
            </h1>
            <div class="detail-nav">
                <a href="<?php echo url('host_port/index') ?>" class="btn-outline">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    返回列表页
                </a>
                <a href="<?php echo url('host_port/details', ['id' => $info['upper_id']]) ?>" class="btn-outline">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 19l-7-7 7-7"/>
                    </svg>
                    上一页
                </a>
                <a href="<?php echo url('host_port/details', ['id' => $info['lower_id']]) ?>" class="btn-outline">
                    下一页
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="info-card">
            <h3>基本信息</h3>
            <div class="info-grid">
                <div class="info-item">
                    <dt>端口类型：</dt>
                    <dd><?php echo $info['type']?></dd>
                </div>
                <div class="info-item">
                    <dt>端口号：</dt>
                    <dd><span class="badge badge-blue"><?php echo $info['port']?></span></dd>
                </div>
                <div class="info-item">
                    <dt>服务名称：</dt>
                    <dd><?php echo $info['service']?></dd>
                </div>
            </div>
        </div>

        <div class="content-section">
            <h3>Headers</h3>
            <div class="content-body">
                <?php echo $info['headers']?>
            </div>
        </div>

        <div class="content-section">
            <h3>HTML</h3>
            <div class="content-body">
                <?php echo $info['html']?>
            </div>
        </div>
    </div>
</div>
{include file='public/footer' /}
