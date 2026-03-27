<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QingScan - 一站式安全扫描平台</title>
    <link rel="shortcut icon" href="/static/favicon.svg" type="image/x-icon"/>
    <script src="/static/js/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript" src="/static/js/echarts.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        'primary-hover': '#2563eb',
                        'primary-light': '#eff6ff',
                        surface: {
                            50: '#ffffff',
                            100: '#f8fafc',
                            200: '#f1f5f9',
                            300: '#e2e8f0',
                            400: '#cbd5e1',
                        },
                        text: {
                            primary: '#1e293b',
                            secondary: '#64748b',
                            muted: '#94a3b8',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 1px 3px 0 rgb(0 0 0 / 0.05), 0 1px 2px -1px rgb(0 0 0 / 0.05)',
                        'card': '0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04)',
                        'hover': '0 4px 12px -2px rgb(0 0 0 / 0.1)',
                    }
                }
            }
        }
    </script>
    <link href="/static/css/qingscan.css" rel="stylesheet">
    <link href="/static/css/qingscan-light.css" rel="stylesheet">
    <style>
        /* 页面容器 - 全宽无左侧菜单 */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        /* 顶部导航栏 */
        .top-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Dashboard容器 */
        .dashboard-container {
            padding: 24px;
            max-width: 1600px;
            margin: 0 auto;
        }

        /* 欢迎区域 */
        .welcome-section {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 40px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
            color: white;
        }
        .welcome-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        .welcome-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: 10%;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }
        .welcome-title {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }
        .welcome-subtitle {
            font-size: 16px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }
        .welcome-stats {
            display: flex;
            gap: 60px;
            margin-top: 32px;
            position: relative;
            z-index: 1;
        }
        .welcome-stat-item {
            text-align: center;
        }
        .welcome-stat-value {
            font-size: 42px;
            font-weight: 700;
        }
        .welcome-stat-label {
            font-size: 14px;
            opacity: 0.8;
        }

        /* 统计卡片网格 */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.15);
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }
        .stat-card.blue::before { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
        .stat-card.green::before { background: linear-gradient(90deg, #10b981, #34d399); }
        .stat-card.purple::before { background: linear-gradient(90deg, #8b5cf6, #a78bfa); }
        .stat-card.orange::before { background: linear-gradient(90deg, #f59e0b, #fbbf24); }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }
        .stat-icon.blue { background: #eff6ff; color: #3b82f6; }
        .stat-icon.green { background: #ecfdf5; color: #10b981; }
        .stat-icon.purple { background: #f5f3ff; color: #8b5cf6; }
        .stat-icon.orange { background: #fffbeb; color: #f59e0b; }

        .stat-value {
            font-size: 36px;
            font-weight: 700;
            color: #1e293b;
            line-height: 1;
            margin-bottom: 4px;
        }
        .stat-label {
            font-size: 15px;
            color: #64748b;
            font-weight: 500;
        }
        .stat-trend {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 13px;
            margin-top: 10px;
            color: #10b981;
        }

        /* 图表区域 */
        .charts-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }
        .chart-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .chart-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
        }
        .chart-btn {
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 13px;
            border: 1px solid #e2e8f0;
            background: white;
            color: #64748b;
            cursor: pointer;
            transition: all 0.2s;
            margin-left: 8px;
        }
        .chart-btn:hover, .chart-btn.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        /* 快捷入口 */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 16px;
        }
        .quick-action-item {
            background: white;
            border-radius: 16px;
            padding: 24px 16px;
            text-align: center;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            display: block;
        }
        .quick-action-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        .quick-action-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 24px;
        }
        .quick-action-label {
            font-size: 14px;
            color: #475569;
            font-weight: 600;
        }

        /* 列表区域 */
        .list-section {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .list-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .list-item {
            display: flex;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #f1f5f9;
            text-decoration: none;
            transition: background 0.2s;
        }
        .list-item:last-child {
            border-bottom: none;
        }
        .list-item:hover {
            background: #f8fafc;
            margin: 0 -12px;
            padding-left: 12px;
            padding-right: 12px;
            border-radius: 10px;
        }
        .list-item-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 14px;
            background: #f1f5f9;
            color: #64748b;
        }
        .list-item-content {
            flex: 1;
        }
        .list-item-title {
            font-size: 15px;
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 2px;
        }
        .list-item-desc {
            font-size: 12px;
            color: #94a3b8;
        }
        .list-item-value {
            font-size: 16px;
            font-weight: 700;
            color: #3b82f6;
        }

        /* 导航激活状态 */
        .nav-item.active {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            color: #3b82f6;
            font-weight: 600;
        }

        /* 响应式 */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .quick-actions { grid-template-columns: repeat(4, 1fr); }
            .charts-section { grid-template-columns: 1fr; }
            .list-section { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .quick-actions { grid-template-columns: repeat(3, 1fr); }
            .welcome-stats { flex-wrap: wrap; gap: 20px; }
            .welcome-title { font-size: 28px; }
        }

        /* 动画 */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
        }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
    </style>
</head>
<body>
    <!-- 顶部导航栏 -->
    <header class="fixed top-0 left-0 right-0 h-[64px] top-nav z-50 flex items-center px-6 shadow-soft">
        <!-- Logo -->
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-primary to-blue-600 flex items-center justify-center shadow-md">
                <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            <span class="text-xl font-bold bg-gradient-to-r from-primary to-blue-600 bg-clip-text text-transparent">QingScan</span>
        </div>

        <!-- 一级菜单 -->
        <nav class="flex-1 flex gap-1 ml-8">
            <a href="/index/index.html" id="home" class="nav-item active px-4 py-2 rounded-lg text-[14px] font-medium transition-all duration-200 text-text-secondary hover:bg-surface-200 hover:text-text-primary">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    主页
                </span>
            </a>
            <a href="/webscan/index.html" id="webscan" class="nav-item px-4 py-2 rounded-lg text-[14px] font-medium transition-all duration-200 text-text-secondary hover:bg-surface-200 hover:text-text-primary">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                    </svg>
                    网站扫描
                </span>
            </a>
            <a href="/code/index.html" id="codeaudit" class="nav-item px-4 py-2 rounded-lg text-[14px] font-medium transition-all duration-200 text-text-secondary hover:bg-surface-200 hover:text-text-primary">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                    代码审计
                </span>
            </a>
            <a href="/vulnerable/index.html" id="cveuse" class="nav-item px-4 py-2 rounded-lg text-[14px] font-medium transition-all duration-200 text-text-secondary hover:bg-surface-200 hover:text-text-primary">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    安全情报
                </span>
            </a>
            <a href="/asm/hostassets/index.html" id="asm" class="nav-item px-4 py-2 rounded-lg text-[14px] font-medium transition-all duration-200 text-text-secondary hover:bg-surface-200 hover:text-text-primary">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    资产管理
                </span>
            </a>
            <a href="/system/task_scan/index.html" id="system" class="nav-item px-4 py-2 rounded-lg text-[14px] font-medium transition-all duration-200 text-text-secondary hover:bg-surface-200 hover:text-text-primary">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    系统管理
                </span>
            </a>
        </nav>

        <!-- 用户区域 -->
        <div class="flex items-center gap-3">
            <a href="/auth/user_info.html" class="flex items-center gap-3 p-1.5 pr-4 rounded-xl hover:bg-surface-200 cursor-pointer transition-colors">
                <img class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 object-cover shadow-sm" src="/static/images/user-face.jpg" alt="用户头像">
                <span class="text-sm font-medium text-text-secondary">个人中心</span>
            </a>
            <a href="/login/logout.html" class="px-4 py-2 rounded-xl text-sm font-medium text-red-500 hover:bg-red-50 transition-colors">
                退出
            </a>
        </div>
    </header>

    <!-- 主内容区域 -->
    <main class="pt-[64px] min-h-screen">
        <div class="dashboard-container">
            <!-- 欢迎区域 -->
            <div class="welcome-section animate-fade-in">
                <div class="welcome-title">欢迎使用 QingScan</div>
                <div class="welcome-subtitle">一站式安全扫描平台 · 资产探测 · 漏洞扫描 · 代码审计</div>
                <div class="welcome-stats">
                    <?php
                    $totalScans = 0;
                    $totalVulns = 0;
                    $totalAssets = 0;
                    foreach ($data as $category) {
                        $totalAssets += $category['value'];
                        foreach ($category['subInfo'] as $item) {
                            $totalScans += $item['value'];
                        }
                    }
                    ?>
                    <div class="welcome-stat-item">
                        <div class="welcome-stat-value"><?php echo number_format($totalAssets) ?></div>
                        <div class="welcome-stat-label">资产总数</div>
                    </div>
                    <div class="welcome-stat-item">
                        <div class="welcome-stat-value"><?php echo number_format($totalScans) ?></div>
                        <div class="welcome-stat-label">扫描记录</div>
                    </div>
                    <div class="welcome-stat-item">
                        <div class="welcome-stat-value">4</div>
                        <div class="welcome-stat-label">扫描模块</div>
                    </div>
                </div>
            </div>

            <!-- 统计卡片 -->
            <div class="stats-grid">
                <?php
                $colors = ['blue', 'green', 'purple', 'orange'];
                $icons = [
                    '<svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>',
                    '<svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>',
                    '<svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>',
                    '<svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>'
                ];
                ?>
                <?php foreach ($data as $index => $category): ?>
                <div class="stat-card <?php echo $colors[$index] ?> animate-fade-in delay-<?php echo $index + 1 ?>">
                    <div class="stat-icon <?php echo $colors[$index] ?>">
                        <?php echo $icons[$index] ?>
                    </div>
                    <div class="stat-value"><?php echo number_format($category['value']) ?></div>
                    <div class="stat-label"><?php echo $category['name'] ?></div>
                    <div class="stat-trend">
                        <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                        <?php echo count($category['subInfo']) ?> 个子项
                    </div>
                </div>
                <?php endforeach ?>
            </div>

            <!-- 快捷入口 -->
            <div class="chart-card animate-fade-in" style="margin-bottom: 24px;">
                <div class="chart-header">
                    <div class="chart-title">快捷入口</div>
                </div>
                <div class="quick-actions">
                    <a href="<?php echo url('webscan/index/index') ?>" class="quick-action-item">
                        <div class="quick-action-icon" style="background: #eff6ff; color: #3b82f6;">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <div class="quick-action-label">新增扫描</div>
                    </a>
                    <a href="<?php echo url('asm/domain/index') ?>" class="quick-action-item">
                        <div class="quick-action-icon" style="background: #ecfdf5; color: #10b981;">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg>
                        </div>
                        <div class="quick-action-label">域名管理</div>
                    </a>
                    <a href="<?php echo url('asm/hostassets/index') ?>" class="quick-action-item">
                        <div class="quick-action-icon" style="background: #f5f3ff; color: #8b5cf6;">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2"/></svg>
                        </div>
                        <div class="quick-action-label">主机资产</div>
                    </a>
                    <a href="<?php echo url('code/index/index') ?>" class="quick-action-item">
                        <div class="quick-action-icon" style="background: #fffbeb; color: #f59e0b;">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                        </div>
                        <div class="quick-action-label">代码审计</div>
                    </a>
                    <a href="<?php echo url('xray/index') ?>" class="quick-action-item">
                        <div class="quick-action-icon" style="background: #fef2f2; color: #ef4444;">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div class="quick-action-label">XRay漏洞</div>
                    </a>
                    <a href="<?php echo url('pocs_file/index') ?>" class="quick-action-item">
                        <div class="quick-action-icon" style="background: #f0fdf4; color: #22c55e;">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div class="quick-action-label">POC脚本</div>
                    </a>
                </div>
            </div>

            <!-- 图表区域 -->
            <div class="charts-section">
                <div class="chart-card animate-fade-in">
                    <div class="chart-header">
                        <div class="chart-title">扫描数据概览</div>
                        <div>
                            <button class="chart-btn active" onclick="switchChart('bar')">柱状图</button>
                            <button class="chart-btn" onclick="switchChart('pie')">饼图</button>
                        </div>
                    </div>
                    <div id="mainChart" style="height: 350px;"></div>
                </div>
                <div class="chart-card animate-fade-in">
                    <div class="chart-header">
                        <div class="chart-title">分类统计</div>
                    </div>
                    <div id="pieChart" style="height: 350px;"></div>
                </div>
            </div>

            <!-- 详细列表 -->
            <div class="list-section">
                <?php foreach ($data as $category): ?>
                <div class="list-card animate-fade-in">
                    <div class="chart-header">
                        <div class="chart-title"><?php echo $category['name'] ?></div>
                        <span style="font-size: 14px; color: #64748b;">共 <?php echo $category['value'] ?> 项</span>
                    </div>
                    <?php foreach ($category['subInfo'] as $item): ?>
                    <a href="<?php echo $item['href'] ?>" class="list-item">
                        <div class="list-item-icon">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div class="list-item-content">
                            <div class="list-item-title"><?php echo $item['name'] ?></div>
                            <div class="list-item-desc">点击查看详情</div>
                        </div>
                        <div class="list-item-value"><?php echo number_format($item['value']) ?></div>
                    </a>
                    <?php endforeach ?>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </main>

<script>
// 主图表数据
var chartData = <?php echo json_encode($data) ?>;
var categories = chartData.map(item => item.name);
var values = chartData.map(item => item.value);

// 初始化主图表
var mainChart = echarts.init(document.getElementById('mainChart'));
var pieChart = echarts.init(document.getElementById('pieChart'));

// 柱状图配置
var barOption = {
    tooltip: {
        trigger: 'axis',
        axisPointer: { type: 'shadow' }
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    xAxis: {
        type: 'category',
        data: categories,
        axisLine: { lineStyle: { color: '#e2e8f0' } },
        axisLabel: { color: '#64748b' }
    },
    yAxis: {
        type: 'value',
        axisLine: { show: false },
        axisLabel: { color: '#64748b' },
        splitLine: { lineStyle: { color: '#f1f5f9' } }
    },
    series: [{
        data: values,
        type: 'bar',
        barWidth: '50%',
        itemStyle: {
            borderRadius: [8, 8, 0, 0],
            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                { offset: 0, color: '#3b82f6' },
                { offset: 1, color: '#60a5fa' }
            ])
        }
    }]
};

// 饼图配置
var pieOption = {
    tooltip: {
        trigger: 'item',
        formatter: '{b}: {c} ({d}%)'
    },
    legend: {
        bottom: '5%',
        left: 'center',
        textStyle: { color: '#64748b' }
    },
    series: [{
        type: 'pie',
        radius: ['40%', '70%'],
        avoidLabelOverlap: false,
        itemStyle: {
            borderRadius: 10,
            borderColor: '#fff',
            borderWidth: 2
        },
        label: {
            show: false,
            position: 'center'
        },
        emphasis: {
            label: {
                show: true,
                fontSize: '18',
                fontWeight: 'bold'
            }
        },
        labelLine: { show: false },
        data: chartData.map((item, index) => ({
            value: item.value,
            name: item.name
        })),
        color: ['#3b82f6', '#10b981', '#8b5cf6', '#f59e0b']
    }]
};

mainChart.setOption(barOption);
pieChart.setOption(pieOption);

// 切换图表类型
function switchChart(type) {
    document.querySelectorAll('.chart-btn').forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    if (type === 'bar') {
        mainChart.setOption(barOption, true);
    } else {
        var pieDataOption = {
            tooltip: { trigger: 'item', formatter: '{b}: {c} ({d}%)' },
            series: [{
                type: 'pie',
                radius: ['30%', '60%'],
                data: chartData.map(item => ({ value: item.value, name: item.name })),
                itemStyle: { borderRadius: 8, borderColor: '#fff', borderWidth: 2 },
                color: ['#3b82f6', '#10b981', '#8b5cf6', '#f59e0b']
            }]
        };
        mainChart.setOption(pieDataOption, true);
    }
}

// 窗口大小改变时重绘图表
window.addEventListener('resize', function() {
    mainChart.resize();
    pieChart.resize();
});

// 版本更新提示
$.ajax({
    type: "get",
    url: "<?php echo url('index/upgradeTips')?>",
    dataType: "json",
    success: function (res) {
        if (res.code == 1) {
            if (confirm(res.msg)) {
                window.location.href = "<?php echo url('config/system_update')?>"
            }
        }
    }
});
</script>
</body>
</html>
