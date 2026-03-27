{include file='public/head' /}
{include file='public/systemLeftMenu' /}

<?php
$searchArr = [
    'action' => url('user_log/index'),
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'placeholder' => "搜索的内容"],
    ],
    'btnArr' => [
        ['text' => '清空日志',
            'ext' => [
                "href" => url('user_log/clear_all'),
                "class" => "btn-clear-log"
            ]
        ]
    ]];
$tableArr = [
    'title' => '操作日志',
    'count' => count($list),
    'columns' => [
        ['title' => 'ID'],
        ['title' => '用户名'],
        ['title' => '类型'],
        ['title' => '详情'],
        ['title' => 'IP'],
        ['title' => '登录时间'],
    ],
];
?>
{include file='public/search' /}
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn { animation: fadeIn 0.3s ease-out forwards; }
    .page-container { padding: 24px; }
    .btn-clear-log {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 20px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 500;
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
        transition: all 0.2s;
        text-decoration: none;
    }
    .btn-clear-log:hover {
        background: #fee2e2;
        border-color: #fca5a5;
    }
</style>
<div class="page-container">
    <!-- 页面标题 -->
    <div class="flex justify-between items-start mb-6 opacity-0 animate-fadeIn">
        <div>
            <h1 class="text-2xl font-bold text-text-primary mb-2">操作日志</h1>
            <nav class="flex gap-2 text-sm text-text-secondary">
                <a href="/" class="hover:text-primary transition-colors">首页</a>
                <span class="text-text-muted">/</span>
                <a href="#" class="hover:text-primary transition-colors">系统管理</a>
                <span class="text-text-muted">/</span>
                <span class="text-text-primary font-medium">操作日志</span>
            </nav>
        </div>
    </div>

    <?php
    $tableArr = [
        'title' => '操作日志',
        'count' => count($list),
        'columns' => [
            ['title' => 'ID'],
            ['title' => '用户名'],
            ['title' => '类型'],
            ['title' => '详情'],
            ['title' => 'IP'],
            ['title' => '登录时间'],
        ],
    ];
    ?>
    {include file='public/table_start' /}

    <?php foreach ($list as $value) { ?>
        <tr class="hover:bg-surface-50 transition-colors">
            <td class="px-5 py-4"><?php echo $value['id'] ?></td>
            <td class="px-5 py-4"><span class="font-medium text-text-primary"><?php echo $value['username'] ?></span></td>
            <td class="px-5 py-4"><?php echo $value['type'] ?></td>
            <td class="px-5 py-4 text-text-secondary"><?php echo $value['content'] ?></td>
            <td class="px-5 py-4"><code class="bg-surface-100 px-2 py-1 rounded text-sm text-text-secondary"><?php echo $value['ip'] ?></code></td>
            <td class="px-5 py-4 text-text-secondary"><?php echo $value['create_time']; ?></td>
        </tr>
    <?php } ?>

    {include file='public/table_end' /}
</div>

{include file='public/footer' /}
