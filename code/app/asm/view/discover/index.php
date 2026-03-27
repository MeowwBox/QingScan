{include file='public/head' /}
{include file='public/asmLeftMenu' /}
<style>
    .page-header {
        margin-bottom: 24px;
    }
    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }
    .breadcrumb-nav {
        display: flex;
        gap: 8px;
        font-size: 14px;
        color: #64748b;
    }
    .breadcrumb-nav a {
        color: #64748b;
        text-decoration: none;
        transition: color 0.2s;
    }
    .breadcrumb-nav a:hover {
        color: #3b82f6;
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
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-primary:hover {
        box-shadow: 0 4px 12px -2px rgb(0 0 0 / 0.1);
        transform: translateY(-1px);
    }
    .btn-outline {
        background: transparent;
        color: #64748b;
        border: 1px solid #cbd5e1;
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 500;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-outline:hover {
        background: #f8fafc;
        border-color: #3b82f6;
        color: #3b82f6;
    }
    .btn-danger {
        background: transparent;
        color: #ef4444;
        border: 1px solid #fecaca;
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 500;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }
    .btn-danger:hover {
        background: #fef2f2;
        border-color: #ef4444;
    }
    .sub-menu {
        display: flex;
        gap: 8px;
        margin-bottom: 20px;
        padding: 4px;
        background: #f1f5f9;
        border-radius: 12px;
        width: fit-content;
    }
    .sub-menu a {
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        color: #64748b;
        text-decoration: none;
        transition: all 0.2s;
    }
    .sub-menu a:hover {
        color: #1e293b;
    }
    .sub-menu a.active {
        background: #ffffff;
        color: #3b82f6;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.05);
    }
</style>
    <?php
    $searchArr = [
        'action' => $_SERVER['REQUEST_URI'],
        'method' => 'get',
        'inputs' => [
            ['type' => 'text', 'name' => 'keyword', 'value' => $keyword, 'placeholder' => "dedecms"],
        ], 'btnArr' => [

        ]
    ];
    ?>
    {include file='public/search' /}

    <!-- 页面标题 -->
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-2xl font-bold text-text-primary mb-2">资产发现</h1>
            <nav class="flex gap-2 text-sm text-text-secondary">
                <a href="#" class="hover:text-primary transition-colors">首页</a>
                <span class="text-text-muted">/</span>
                <a href="#" class="hover:text-primary transition-colors">资产管理</a>
                <span class="text-text-muted">/</span>
                <span class="text-text-primary font-medium">资产发现</span>
            </nav>
        </div>
    </div>

    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card">
        {include file='discover/sub_menu' /}

        <?php
        $tableArr = [
            'title' => '',
            'count' => null,
            'checkbox' => false,
            'columns' => [
                ['title' => 'ID'],
                ['title' => '标题'],
                ['title' => 'IP'],
                ['title' => 'Host'],
                ['title' => '端口'],
                ['title' => '产品类型'],
                ['title' => '创建时间'],
                ['title' => '操作'],
            ],
            'noPagination' => true,
        ];
        ?>
        {include file='public/table_start' /}

        <?php foreach ($list as $value) { ?>
            <tr class="hover:bg-surface-50 transition-colors">
                <td class="px-5 py-4"><span class="badge badge-blue">#<?php echo $value['id'] ?></span></td>
                <td class="px-5 py-4"><?php echo substr($value['title'], 0, 27) ?></td>
                <td class="px-5 py-4"><?php echo $value['ip'] ?></td>
                <td class="px-5 py-4"><?php echo $value['host'] ?></td>
                <td class="px-5 py-4"><?php echo $value['port'] ?></td>
                <td class="px-5 py-4"><?php echo $value['product_category'] ?></td>
                <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
                <td class="px-5 py-4">
                    <div class="flex gap-2">
                        <button onclick="showDiscoverDetail(<?php echo $value['id'] ?>)" class="btn-outline">详情</button>
                        <a href="{:URL('_del',['id'=>$value['id']])}" class="btn-danger">删除</a>
                    </div>
                </td>
            </tr>
        <?php } ?>

        {include file='public/table_end' /}
        {include file='public/fenye' /}
    </div>
<script>
    $("#scan_result").addClass("active");

    function showDiscoverDetail(id) {
        openDrawer('view', '资产详情', 520);
        setDrawerContent('<div class="flex items-center justify-center py-12"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div></div>');

        fetch('<?php echo url("detail"); ?>?id=' + id)
            .then(response => response.json())
            .then(res => {
                if (res.code === 1 && res.data) {
                    const data = res.data;
                    const html = `
                        <div class="space-y-6">
                            <div class="bg-surface-50 rounded-xl p-4">
                                <h4 class="text-sm font-semibold text-text-muted mb-3">基本信息</h4>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-text-muted">标题</span>
                                        <span class="font-medium text-right max-w-[280px]">${data.title || '-'}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-text-muted">IP</span>
                                        <span class="font-medium">${data.ip || '-'}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-text-muted">Host</span>
                                        <span class="font-medium text-primary">${data.host || '-'}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-surface-50 rounded-xl p-4">
                                <h4 class="text-sm font-semibold text-text-muted mb-3">服务信息</h4>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-text-muted">端口</span>
                                        <span class="font-medium">${data.port || '-'}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-text-muted">产品类型</span>
                                        <span class="font-medium">${data.product_category || '-'}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-surface-50 rounded-xl p-4">
                                <h4 class="text-sm font-semibold text-text-muted mb-3">时间信息</h4>
                                <div class="flex justify-between">
                                    <span class="text-text-muted">创建时间</span>
                                    <span class="text-text-secondary">${data.create_time || '-'}</span>
                                </div>
                            </div>
                        </div>
                    `;
                    setDrawerContent(html);
                } else {
                    setDrawerContent('<div class="text-center py-12 text-red-500">' + (res.msg || '加载失败') + '</div>');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                setDrawerContent('<div class="text-center py-12 text-red-500">加载失败，请稍后重试</div>');
            });
    }
</script>
{include file='public/drawer' /}
{include file='public/footer' /}
