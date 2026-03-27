<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'QingScan' ?></title>
    <link rel="shortcut icon" href="/static/favicon.svg" type="image/x-icon"/>
    <script src="/static/js/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
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
                        'drawer': '-8px 0 30px rgb(0 0 0 / 0.1)',
                    }
                }
            }
        }
    </script>
    <link href="/static/css/qingscan.css" rel="stylesheet">
    <link href="/static/css/qingscan-light.css" rel="stylesheet">
    <script src="/static/js/qingscan-ui.js"></script>
</head>
<body class="bg-surface-100">

<!-- 顶部导航栏 -->
<header class="fixed top-0 left-0 right-0 h-[64px] bg-white/80 backdrop-blur-xl border-b border-surface-300 z-50 flex items-center px-6 shadow-soft">
    <!-- Logo & 折叠按钮 -->
    <div class="w-[260px] flex items-center gap-3 sidebar-logo-area">
        <button onclick="toggleSidebar()" class="w-10 h-10 rounded-xl bg-surface-100 hover:bg-surface-200 flex items-center justify-center transition-colors">
            <svg id="sidebarToggleIcon" class="w-5 h-5 text-text-secondary transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary to-blue-600 flex items-center justify-center shadow-md">
                <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            <span class="text-xl font-bold bg-gradient-to-r from-primary to-blue-600 bg-clip-text text-transparent">QingScan</span>
        </div>
    </div>

    <!-- 一级菜单 -->
    <nav class="flex-1 flex gap-1">
        <?php
        $rootPath = getcwd();
        $rootPath = rtrim($rootPath,"/public");
        if (file_exists($rootPath.'/view/public/company_head.php')) {
            include realpath($rootPath.'/view/public/company_head.php');
        } else {
            ?>
            <a href="/index/index.html" id="home" class="nav-item px-4 py-2 rounded-lg text-[14px] font-medium transition-all duration-200 text-text-secondary hover:bg-surface-200 hover:text-text-primary">
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
        <?php } ?>
    </nav>

    <!-- 用户区域 -->
    <div class="flex items-center gap-3">
        <button class="relative w-10 h-10 rounded-xl hover:bg-surface-200 flex items-center justify-center transition-colors">
            <svg class="w-5 h-5 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full animate-pulse-dot"></span>
        </button>
        <div class="h-8 w-px bg-surface-300"></div>
        <div class="nav-item relative" id="userDropdown">
            <a href="#" class="flex items-center gap-3 p-1.5 pr-3 rounded-xl hover:bg-surface-200 cursor-pointer transition-colors" onclick="toggleUserMenu(event)">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center text-sm font-semibold text-white shadow-sm">
                    <?php
                    $userName = session('user_name') ?: 'Admin';
                    echo mb_substr($userName, 0, 1, 'UTF-8');
                    ?>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-semibold text-text-primary leading-tight"><?php echo $userName; ?></span>
                    <span class="text-xs text-text-muted leading-tight">管理员</span>
                </div>
                <svg class="w-4 h-4 text-text-muted ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </a>
            <ul id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-card border border-surface-200 py-2 z-50">
                <li>
                    <a class="px-4 py-2.5 text-sm text-text-secondary hover:text-primary hover:bg-surface-100 transition-colors flex items-center gap-2" href="/auth/user_info.html">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        个人资料
                    </a>
                </li>
                <li>
                    <a class="px-4 py-2.5 text-sm text-text-secondary hover:text-primary hover:bg-surface-100 transition-colors flex items-center gap-2" href="/auth/user_password.html">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                        修改密码
                    </a>
                </li>
                <li><hr class="border-surface-200 my-1"></li>
                <li>
                    <a class="px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors flex items-center gap-2" href="/login/logout.html">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        退出登录
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>

<script>
    // 顶部导航激活状态
    (function() {
        const currentPath = window.location.pathname;
        const navMap = {
            '/index/': 'home',
            '/webscan/': 'webscan',
            '/code/': 'codeaudit',
            '/vulnerable/': 'cveuse',
            '/asm/': 'asm',
            '/system/': 'system'
        };

        for (const [path, id] of Object.entries(navMap)) {
            if (currentPath.includes(path)) {
                const navItem = document.getElementById(id);
                if (navItem) navItem.classList.add('active');
                break;
            }
        }
    })();
</script>

<style>
    .nav-item.active {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: #3b82f6;
        font-weight: 600;
    }
</style>

<!-- 主内容区域开始 - 左侧菜单宽度260px，顶部导航高度64px -->
<main id="mainContent" class="main-content ml-[260px] mt-[64px] p-6 min-h-[calc(100vh-64px)] bg-surface-100">
