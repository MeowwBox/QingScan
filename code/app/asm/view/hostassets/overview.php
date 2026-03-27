{include file='public/head' /}
{include file='public/asmLeftMenu' /}

<style>
    .overview-wrapper {
        padding: 0;
        background: #f8fafc;
    }
    .page-header {
        padding: 24px;
        background: #ffffff;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 24px;
    }
    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        padding: 0 24px;
        margin-bottom: 24px;
    }
    .stat-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04);
        position: relative;
        overflow: hidden;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        opacity: 0.05;
        transform: translate(30%, -30%);
    }
    .stat-card.blue::before { background: #3b82f6; }
    .stat-card.green::before { background: #22c55e; }
    .stat-card.red::before { background: #ef4444; }
    .stat-card.cyan::before { background: #06b6d4; }
    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 16px;
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .stat-icon.blue { background: #eff6ff; color: #3b82f6; }
    .stat-icon.green { background: #f0fdf4; color: #22c55e; }
    .stat-icon.red { background: #fef2f2; color: #ef4444; }
    .stat-icon.cyan { background: #ecfeff; color: #06b6d4; }
    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
    }
    .stat-label {
        font-size: 14px;
        color: #64748b;
    }
    .charts-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        padding: 0 24px 24px;
    }
    .chart-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04);
    }
    .chart-title {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 16px;
    }
</style>

<!-- 页面标题 -->
            <div class="page-header">
                <h3 class="page-title">主机资产概览</h3>
            </div>

            <!-- 统计卡片 -->
            <div class="stats-grid">
                <div class="stat-card blue">
                    <div class="stat-header">
                        <div class="stat-icon blue">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="2" y="3" width="20" height="14" rx="2"/>
                                <path d="M8 21h8M12 17v4"/>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value"><?php echo $stats['total_count'] ?></div>
                    <div class="stat-label">总机器数量</div>
                </div>

                <div class="stat-card green">
                    <div class="stat-header">
                        <div class="stat-icon green">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 8v8M8 12h8"/>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value"><?php echo $stats['new_count'] ?></div>
                    <div class="stat-label">本周新增</div>
                </div>

                <div class="stat-card red">
                    <div class="stat-header">
                        <div class="stat-icon red">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value"><?php echo $stats['vul_count'] ?></div>
                    <div class="stat-label">漏洞数量</div>
                </div>

                <div class="stat-card cyan">
                    <div class="stat-header">
                        <div class="stat-icon cyan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">
                        <?php
                            $hids_installed = 0;
                            foreach ($stats['hids_stats'] as $item) {
                                if ($item['hids_installed'] == 1) {
                                    $hids_installed = $item['count'];
                                    break;
                                }
                            }
                            echo $hids_installed;
                        ?> / <?php echo $stats['total_count'] ?>
                    </div>
                    <div class="stat-label">HIDS已安装</div>
                </div>
            </div>

            <!-- 图表区域 -->
            <div class="charts-grid">
                <!-- 时间维度：最近30天新增趋势 -->
                <div class="chart-card">
                    <h5 class="chart-title">最近30天新增趋势</h5>
                    <canvas id="dailyTrendChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>

                <!-- 类型维度：操作系统类型分布 -->
                <div class="chart-card">
                    <h5 class="chart-title">操作系统类型分布</h5>
                    <canvas id="osTypeChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>

                <!-- 类型维度：主机状态分布 -->
                <div class="chart-card">
                    <h5 class="chart-title">主机状态分布</h5>
                    <canvas id="statusChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>

                <!-- 分布维度：云平台分布 -->
                <div class="chart-card">
                    <h5 class="chart-title">云平台分布</h5>
                    <canvas id="cloudPlatformChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>

                <!-- 分布维度：HIDS安装状态 -->
                <div class="chart-card">
                    <h5 class="chart-title">HIDS安装状态</h5>
                    <canvas id="hidsStatusChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>

                <!-- VPC分布 -->
                <div class="chart-card">
                    <h5 class="chart-title">VPC分布</h5>
                    <canvas id="vpcChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>

                <!-- 云平台HIDS对比 -->
                <div class="chart-card">
                    <h5 class="chart-title">云平台HIDS对比</h5>
                    <canvas id="cloudPlatformHidsChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>

                <!-- CPU核数分布 -->
                <div class="chart-card">
                    <h5 class="chart-title">CPU核数分布</h5>
                    <canvas id="cpuChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>
            </div>
        </div>
    </div>

<!-- 引入Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // 准备数据
    const dailyTrendData = <?php echo json_encode($stats['daily_trend']); ?>;
    const cloudPlatformData = <?php echo json_encode($stats['cloud_platform_stats']); ?>;
    const hidsStatsData = <?php echo json_encode($stats['hids_stats']); ?>;
    const osTypeData = <?php echo json_encode($stats['os_type_stats']); ?>;
    const statusData = <?php echo json_encode($stats['status_stats']); ?>;
    const vpcData = <?php echo json_encode($stats['vpc_stats']); ?>;
    const instanceTypeData = <?php echo json_encode($stats['instance_type_stats']); ?>;
    const cpuData = <?php echo json_encode($stats['cpu_stats']); ?>;
    const cloudPlatformHidsData = <?php echo json_encode($stats['cloud_platform_hids_stats']); ?>;

    // 云平台名称映射
    const platformNames = {
        'huoshan': '火山云',
        'tianyi': '天翼云',
        'idc': '线下IDC',
        'yidong': '移动云',
        'aliyun': '阿里云'
    };

    // 最近30天新增趋势图表
    const dailyTrendCtx = document.getElementById('dailyTrendChart').getContext('2d');
    const dailyTrendChart = new Chart(dailyTrendCtx, {
        type: 'line',
        data: {
            labels: dailyTrendData.map(item => item.date),
            datasets: [{
                label: '新增主机数量',
                data: dailyTrendData.map(item => item.count),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    // 云平台分布图表
    const cloudPlatformCtx = document.getElementById('cloudPlatformChart').getContext('2d');
    const cloudPlatformChart = new Chart(cloudPlatformCtx, {
        type: 'bar',
        data: {
            labels: cloudPlatformData.map(item => platformNames[item.cloud_platform] || item.cloud_platform),
            datasets: [{
                label: '主机数量',
                data: cloudPlatformData.map(item => item.count),
                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                borderColor: '#3b82f6',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    // HIDS安装状态图表
    const hidsStatusCtx = document.getElementById('hidsStatusChart').getContext('2d');
    const hidsStatusChart = new Chart(hidsStatusCtx, {
        type: 'bar',
        data: {
            labels: hidsStatsData.map(item => item.hids_installed ? '已安装' : '未安装'),
            datasets: [{
                label: '主机数量',
                data: hidsStatsData.map(item => item.count),
                backgroundColor: 'rgba(34, 197, 94, 0.8)',
                borderColor: '#22c55e',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    // 操作系统类型分布图表
    const osTypeCtx = document.getElementById('osTypeChart').getContext('2d');
    const osTypeChart = new Chart(osTypeCtx, {
        type: 'bar',
        data: {
            labels: osTypeData.map(item => item.os_type),
            datasets: [{
                label: '主机数量',
                data: osTypeData.map(item => item.count),
                backgroundColor: 'rgba(168, 85, 247, 0.8)',
                borderColor: '#a855f7',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    // 主机状态分布图表
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'bar',
        data: {
            labels: statusData.map(item => item.status),
            datasets: [{
                label: '主机数量',
                data: statusData.map(item => item.count),
                backgroundColor: 'rgba(249, 115, 22, 0.8)',
                borderColor: '#f97316',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    // VPC分布图表
    const vpcCtx = document.getElementById('vpcChart').getContext('2d');
    const vpcChart = new Chart(vpcCtx, {
        type: 'bar',
        data: {
            labels: vpcData.map(item => item.vpc_name),
            datasets: [{
                label: '主机数量',
                data: vpcData.map(item => item.count),
                backgroundColor: 'rgba(20, 184, 166, 0.8)',
                borderColor: '#14b8a6',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    // 云平台HIDS对比图表
    const cloudPlatformHidsCtx = document.getElementById('cloudPlatformHidsChart').getContext('2d');
    const cloudPlatformHidsChart = new Chart(cloudPlatformHidsCtx, {
        type: 'bar',
        data: {
            labels: cloudPlatformHidsData.map(item => platformNames[item.cloud_platform] || item.cloud_platform),
            datasets: [
                {
                    label: '总主机数',
                    data: cloudPlatformHidsData.map(item => item.total),
                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                    borderColor: '#3b82f6',
                    borderWidth: 1,
                    borderRadius: 6
                },
                {
                    label: '已安装HIDS数',
                    data: cloudPlatformHidsData.map(item => item.hids_installed),
                    backgroundColor: 'rgba(34, 197, 94, 0.8)',
                    borderColor: '#22c55e',
                    borderWidth: 1,
                    borderRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    // CPU核数分布图表
    const cpuCtx = document.getElementById('cpuChart').getContext('2d');
    const cpuChart = new Chart(cpuCtx, {
        type: 'bar',
        data: {
            labels: cpuData.map(item => item.cpu + '核'),
            datasets: [{
                label: '主机数量',
                data: cpuData.map(item => item.count),
                backgroundColor: 'rgba(234, 179, 8, 0.8)',
                borderColor: '#eab308',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });
</script>
{include file='public/footer' /}
