{include file='public/head' /}
{include file='public/asmLeftMenu' /}
<style>
    .content-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        overflow: hidden;
    }
    .table-container {
        overflow-x: auto;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table thead {
        background: #f8fafc;
    }
    .table th {
        padding: 16px 20px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e2e8f0;
    }
    .table td {
        padding: 16px 20px;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
        font-size: 14px;
    }
    .table tbody tr:hover {
        background: #f8fafc;
    }
    .table tbody tr:last-child td {
        border-bottom: none;
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
</style>
    <?php
    $searchArr = [
        'action' => $_SERVER['REQUEST_URI'],
        'method' => 'get',
        'inputs' => [
            ['type' => 'text', 'name' => 'domain', 'placeholder' => "baidu.com"],
        ]
    ];
    ?>
    {include file='public/search' /}

    <!-- 页面标题 -->
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-2xl font-bold text-text-primary mb-2">IP端口列表</h1>
            <nav class="flex gap-2 text-sm text-text-secondary">
                <a href="#" class="hover:text-primary transition-colors">首页</a>
                <span class="text-text-muted">/</span>
                <a href="#" class="hover:text-primary transition-colors">资产管理</a>
                <span class="text-text-muted">/</span>
                <span class="text-text-primary font-medium">IP端口列表</span>
            </nav>
        </div>
    </div>

    <?php
$tableArr = [
    'title' => 'IP端口列表',
    'count' => count($list),
    'columns' => [
        ['title' => 'ID'],
        ['title' => 'IP'],
        ['title' => '端口'],
        ['title' => '位置'],
        ['title' => 'ISP'],
        ['title' => '创建时间'],
        ['title' => '操作'],
    ],
];
?>
{include file='public/table_start' /}

<?php foreach ($list as $value) { ?>
<tr class="hover:bg-surface-50 transition-colors">
    <td class="px-5 py-4">
        <span class="badge badge-blue">#<?php echo $value['id'] ?></span>
    </td>
    <td class="px-5 py-4 font-medium text-text-primary"><?php echo $value['ip'] ?></td>
    <td class="px-5 py-4"><?php echo $value['port'] ?></td>
    <td class="px-5 py-4"><?php echo $value['location'] ?></td>
    <td class="px-5 py-4"><?php echo $value['isp'] ?></td>
    <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
    <td class="px-5 py-4">
        <div class="flex gap-2">
            <button onclick="showIpPortDetail(<?php echo $value['id'] ?>)" class="btn-outline">详情</button>
            <a href="#" class="btn-danger">删除</a>
        </div>
    </td>
</tr>
<?php } ?>

{include file='public/table_end' /}
{include file='public/drawer' /}

<script>
function showIpPortDetail(id) {
    openDrawer('view', 'IP端口详情', 520);
    setDrawerContent('<div class="flex items-center justify-center py-12"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div></div>');

    fetch('<?php echo url("detail"); ?>?id=' + id)
        .then(response => response.json())
        .then(res => {
            if (res.code === 1 && res.data) {
                const data = res.data;
                const html = `
                    <div class="space-y-6">
                        <div class="bg-surface-50 rounded-xl p-4">
                            <h4 class="text-sm font-semibold text-text-muted mb-3">网络信息</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-text-muted">IP</span>
                                    <span class="font-medium text-primary">${data.ip || '-'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-text-muted">端口</span>
                                    <span class="font-medium">${data.port || '-'}</span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-surface-50 rounded-xl p-4">
                            <h4 class="text-sm font-semibold text-text-muted mb-3">地理位置</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-text-muted">位置</span>
                                    <span class="font-medium">${data.location || '-'}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-text-muted">ISP</span>
                                    <span class="font-medium">${data.isp || '-'}</span>
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
{include file='public/footer' /}
