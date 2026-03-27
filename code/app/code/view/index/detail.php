<?php

$str = file_get_contents("/mnt/d/permeate.xml");

$obj = simplexml_load_string($str, "SimpleXMLElement", LIBXML_NOCDATA);
$test = json_decode(json_encode($obj), true);

$countList = $test['ReportSection'][0]['SubSection'][1]['IssueListing']['Chart']['GroupingSection'];

$list = $test['ReportSection'][2]['SubSection']['IssueListing']['Chart']['GroupingSection'];
foreach ($list as $key => $value) {
    foreach ($value['Issue'] as $k => $val) {
        if (strpos($val['Source']['FileName'], '.php') === false) {
            unset($value['Issue'][$k]);
        }
    }

    if (empty($value['Issue'])) {
        unset($list[$key]);
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fortify 漏洞详情</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.bootcdn.net/ajax/libs/echarts/5.1.1/echarts.min.js"></script>
    <style>
        * { scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent; }
        *::-webkit-scrollbar { width: 6px; height: 6px; }
        *::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        *::-webkit-scrollbar-track { background: transparent; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
        }

        .page-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 20px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
        }

        .breadcrumb {
            display: flex;
            gap: 8px;
            font-size: 14px;
            color: #64748b;
            margin-top: 4px;
        }

        .breadcrumb a {
            color: #3b82f6;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            background: #f8fafc;
            color: #475569;
            border: 1px solid #e2e8f0;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            background: #f1f5f9;
            border-color: #3b82f6;
            color: #3b82f6;
        }

        .container-main {
            max-width: 1400px;
            margin: 0 auto;
            padding: 24px;
        }

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
        }

        .card-body {
            padding: 20px;
        }

        /* 图表区域 */
        .chart-container {
            display: flex;
            gap: 24px;
            margin-bottom: 24px;
        }

        .chart-card {
            flex: 1;
        }

        #main {
            width: 100%;
            height: 400px;
        }

        /* Tab 样式 */
        .tabs-container {
            margin-bottom: 16px;
        }

        .nav-tabs {
            display: flex;
            gap: 4px;
            background: #f8fafc;
            padding: 6px;
            border-radius: 12px;
            overflow-x: auto;
            flex-wrap: wrap;
        }

        .nav-link {
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: #64748b;
            background: transparent;
            border: none;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            color: #1e293b;
            background: #f1f5f9;
        }

        .nav-link.active {
            background: white;
            color: #3b82f6;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* 表格样式 */
        .table-modern {
            width: 100%;
            border-collapse: collapse;
        }

        .table-modern thead tr {
            background: #f8fafc;
        }

        .table-modern th {
            padding: 14px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e2e8f0;
        }

        .table-modern td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
        }

        .table-modern tbody tr:hover {
            background: #f8fafc;
        }

        /* 代码块样式 */
        .code-block {
            background: #1e293b;
            border-radius: 10px;
            padding: 14px 16px;
            overflow-x: auto;
        }

        .code-block code {
            color: #e2e8f0;
            font-family: 'Monaco', 'Consolas', monospace;
            font-size: 13px;
            line-height: 1.6;
        }

        /* 漏洞等级徽章 */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-critical {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .badge-high {
            background: #fff7ed;
            color: #ea580c;
            border: 1px solid #fed7aa;
        }

        .badge-medium {
            background: #fefce8;
            color: #ca8a04;
            border: 1px solid #fef08a;
        }

        .badge-low {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        /* Tab 内容 */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* 文件路径样式 */
        .file-path {
            font-family: monospace;
            font-size: 13px;
            color: #64748b;
            background: #f8fafc;
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
        }

        /* 信息网格 */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .info-item {
            background: #f8fafc;
            border-radius: 12px;
            padding: 16px;
        }

        .info-item label {
            font-size: 11px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .info-item .value {
            margin-top: 4px;
            font-weight: 600;
            color: #1e293b;
        }
    </style>
</head>
<body>
    <!-- 页面头部 -->
    <header class="page-header">
        <div>
            <h1 class="page-title">Fortify 漏洞详情</h1>
            <nav class="breadcrumb">
                <a href="#">首页</a>
                <span>/</span>
                <a href="#">代码审计</a>
                <span>/</span>
                <span>漏洞详情</span>
            </nav>
        </div>
        <a href="javascript:history.back();" class="btn-back">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"></path>
            </svg>
            返回
        </a>
    </header>

    <main class="container-main">
        <!-- 统计图表 -->
        <div class="chart-container">
            <div class="card chart-card">
                <div class="card-header">
                    <h3 class="card-title">漏洞分布统计</h3>
                </div>
                <div class="card-body">
                    <div id="main"></div>
                </div>
            </div>
        </div>

        <!-- 漏洞类型标签页 -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">漏洞列表</h3>
            </div>
            <div class="card-body">
                <div class="tabs-container">
                    <ul class="nav-tabs" id="myTab" role="tablist">
                        <?php $first = true; foreach ($list as $value) { ?>
                            <li>
                                <button class="nav-link <?php echo $first ? 'active' : '' ?>"
                                        id="<?php echo md5($value['groupTitle']) ?>-tab"
                                        data-tab="<?php echo md5($value['groupTitle']) ?>"
                                        onclick="switchTab('<?php echo md5($value['groupTitle']) ?>')">
                                    <?php echo $value['groupTitle'] ?>
                                </button>
                            </li>
                        <?php $first = false; } ?>
                    </ul>
                </div>

                <?php $first = true; foreach ($list as $value) { ?>
                    <div class="tab-content <?php echo $first ? 'active' : '' ?>"
                         id="<?php echo md5($value['groupTitle']) ?>"
                         role="tabpanel">
                        <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 16px; color: #1e293b;">
                            <?php echo $value['groupTitle'] ?>
                        </h4>
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>漏洞等级</th>
                                    <th>文件名</th>
                                    <th>行号</th>
                                    <th>代码段</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($value['Issue'] as $val) {
                                    if (strpos($val['Source']['FileName'], '.php') !== false) {
                                        // 根据等级设置样式
                                        $badgeClass = 'badge-low';
                                        if ($val['Friority'] == 'Critical') $badgeClass = 'badge-critical';
                                        elseif ($val['Friority'] == 'High') $badgeClass = 'badge-high';
                                        elseif ($val['Friority'] == 'Medium') $badgeClass = 'badge-medium';
                                ?>
                                    <tr>
                                        <td>
                                            <span class="badge <?php echo $badgeClass ?>">
                                                <span style="width: 6px; height: 6px; border-radius: 50%; background: currentColor;"></span>
                                                <?php echo $val['Friority'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="file-path" title="<?php echo $val['Source']['FilePath'] ?>">
                                                <?php echo $val['Primary']['FileName'] ?>
                                            </span>
                                        </td>
                                        <td title="<?php echo $val['Abstract'] ?>" style="font-weight: 600;">
                                            <?php echo $val['Source']['LineStart'] ?>
                                        </td>
                                        <td>
                                            <div class="code-block">
                                                <code title="<?php echo htmlspecialchars($val['Primary']['Snippet']) ?>">
                                                    <?php echo htmlspecialchars($val['Source']['Snippet']) ?>
                                                </code>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                <?php $first = false; } ?>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        // 初始化 echarts 图表
        var myChart = echarts.init(document.getElementById('main'));
        var option = {
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b}: {c} ({d}%)'
            },
            legend: {
                orient: 'vertical',
                right: '5%',
                top: 'center',
                textStyle: {
                    color: '#64748b',
                    fontSize: 13
                }
            },
            series: [
                {
                    name: '漏洞等级',
                    type: 'pie',
                    selectedMode: 'single',
                    radius: [0, '35%'],
                    center: ['35%', '50%'],
                    label: {
                        position: 'inner',
                        fontSize: 13,
                        color: '#fff',
                        fontWeight: 500
                    },
                    labelLine: {
                        show: false
                    },
                    data: [
                        <?php foreach ($countList as $value) {
                            echo "{value: {$value['@attributes']['count']}, name: '{$value['groupTitle']}'},";
                        } ?>
                    ],
                    itemStyle: {
                        borderColor: '#fff',
                        borderWidth: 2
                    }
                },
                {
                    name: '漏洞类型',
                    type: 'pie',
                    radius: ['45%', '70%'],
                    center: ['35%', '50%'],
                    labelLine: {
                        length: 20,
                        length2: 15
                    },
                    label: {
                        formatter: '{b}: {c}',
                        color: '#64748b',
                        fontSize: 12
                    },
                    data: [
                        <?php foreach ($list as $value) {
                            $num = count($value['Issue']);
                            echo "{value: {$num}, name: '{$value['groupTitle']}'},";
                        } ?>
                    ],
                    itemStyle: {
                        borderColor: '#fff',
                        borderWidth: 2
                    }
                }
            ],
            color: ['#3b82f6', '#22c55e', '#f59e0b', '#ef4444', '#8b5cf6', '#06b6d4', '#ec4899', '#6366f1']
        };
        myChart.setOption(option);

        // 响应式调整
        window.addEventListener('resize', function() {
            myChart.resize();
        });

        // Tab 切换功能
        function switchTab(tabId) {
            // 移除所有 active 类
            document.querySelectorAll('.nav-link').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });

            // 添加 active 类
            document.querySelector('[data-tab="' + tabId + '"]').classList.add('active');
            document.getElementById(tabId).classList.add('active');
        }
    </script>
</body>
</html>
