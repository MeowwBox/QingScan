{include file='public/head' /}
<div class="container-fluid" style="padding-left: 0;">
    <div class="row">
        <div class="col-md-1 " style="padding-right: 0;" >
            {include file='public/asmLeftMenu' /}
        </div>
        <div class="col-md-11 " style="padding:0;">
    
    <!-- 页面标题 -->
    <div class="row tuchu mb-3">
        <div class="col-md-12">
            <h3>主机资产概览</h3>
        </div>
    </div>
    
    <!-- 统计卡片 -->
    <div class="row tuchu mb-3" style="padding: 0px;background-color: #eeeeee;margin: 0px;">
        <div class="col-md-3 ">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">总机器数量</h5>
                            <h3 class="card-text"><?php echo $stats['total_count'] ?></h3>
                        </div>
                        <div class="text-primary">
                            <i class="bi bi-server" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3  ">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">本周新增</h5>
                            <h3 class="card-text"><?php echo $stats['new_count'] ?></h3>
                        </div>
                        <div class="text-success">
                            <i class="bi bi-plus-circle" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">漏洞数量</h5>
                            <h3 class="card-text"><?php echo $stats['vul_count'] ?></h3>
                        </div>
                        <div class="text-danger">
                            <i class="bi bi-exclamation-triangle" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">HIDS已安装</h5>
                            <h3 class="card-text">
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
                            </h3>
                        </div>
                        <div class="text-info">
                            <i class="bi bi-shield-check" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 图表区域 -->
    <div class="row tuchu mb-3" style="margin:0px;padding:0px;background-color: #eeeeee;">
        <!-- 时间维度：最近30天新增趋势 -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">最近30天新增趋势</h5>
                    <canvas id="dailyTrendChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>
            </div>
        </div>
        <!-- 类型维度：操作系统类型分布 -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">操作系统类型分布</h5>
                    <canvas id="osTypeChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>
            </div>
        </div>
        <!-- 类型维度：主机状态分布 -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">主机状态分布</h5>
                    <canvas id="statusChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>
            </div>
        </div>
        <!-- 分布维度：云平台分布 -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">云平台分布</h5>
                    <canvas id="cloudPlatformChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>
            </div>
        </div>
        
        <!-- 分布维度：HIDS安装状态 -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">HIDS安装状态</h5>
                    <canvas id="hidsStatusChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>
            </div>
        </div>
        
        <!-- VPC分布 -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">VPC分布</h5>
                    <canvas id="vpcChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>
            </div>
        </div>
        
        <!-- 实例类型分布 -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">实例类型分布</h5>
                    <canvas id="instanceTypeChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>
            </div>
        </div>
        
        <!-- CPU核数分布 -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CPU核数分布</h5>
                    <canvas id="cpuChart" style="height: 200px !important; max-width: 100% !important;"></canvas>
                </div>
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
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
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
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
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
                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
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
                backgroundColor: 'rgba(153, 102, 255, 0.8)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
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
                backgroundColor: 'rgba(255, 159, 64, 0.8)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
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
                backgroundColor: 'rgba(75, 192, 192, 0.8)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // 实例类型分布图表
    const instanceTypeCtx = document.getElementById('instanceTypeChart').getContext('2d');
    const instanceTypeChart = new Chart(instanceTypeCtx, {
        type: 'bar',
        data: {
            labels: instanceTypeData.map(item => item.instance_type),
            datasets: [{
                label: '主机数量',
                data: instanceTypeData.map(item => item.count),
                backgroundColor: 'rgba(153, 102, 255, 0.8)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
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
                backgroundColor: 'rgba(255, 205, 86, 0.8)',
                borderColor: 'rgba(255, 205, 86, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
        </div>
    </div>
</div>
{include file='public/footer' /}