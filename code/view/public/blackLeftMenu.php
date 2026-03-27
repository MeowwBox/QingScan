{include file='public/LeftMenuStyle' /}
<?php

// 获取菜单黑名单配置
$menuBlacklist = getMenuBlacklist();

?>
<aside id="sidebar" class="sidebar fixed top-[64px] left-0 w-[260px] h-[calc(100vh-64px)] bg-white border-r border-surface-300 overflow-y-auto overflow-x-hidden p-4 z-40">

    <div class="py-2 px-3 mb-2">
        <span class="menu-title">网站扫描</span>
    </div>

    <ul id="leftMenu">
        <!-- 目标管理 -->
        <?php if (!isMenuBlacklisted('目标管理', $menuBlacklist, null)): ?>
        <li>
            <a href="/webscan/index/index.html" class="menu-item">
                <svg class="w-5 h-5 flex-shrink-0 text-text-secondary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                </svg>
                <span class="menu-text">目标管理</span>
                <span class="menu-badge ml-auto bg-primary text-white text-[11px] px-2 py-0.5 rounded-full font-medium">12</span>
            </a>
        </li>
        <?php endif; ?>

        <!-- Web扫描工具 -->
        <?php if (!isMenuBlacklisted('Web扫描', $menuBlacklist, null)): ?>
        <li>
            <a href="#" class="menu-item">
                <svg class="w-5 h-5 flex-shrink-0 text-text-secondary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                <span class="menu-text">Web扫描</span>
                <svg class="menu-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
            <ul class="submenu">
                <?php if (!isMenuBlacklisted('Web扫描', $menuBlacklist, 'Xray')): ?><li><a href="/webscan/xray/index.html">Xray</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('Web扫描', $menuBlacklist, 'AWVS')): ?><li><a href="/webscan/bug/awvs.html">AWVS</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('Web扫描', $menuBlacklist, 'SqlMap')): ?><li><a href="/webscan/sqlmap/index.html">SqlMap</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('Web扫描', $menuBlacklist, 'vulmap')): ?><li><a href="/webscan/vulmap/index.html">vulmap</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('Web扫描', $menuBlacklist, 'nuclei')): ?><li><a href="/webscan/app_nuclei/index.html">nuclei</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('Web扫描', $menuBlacklist, 'crawlergo')): ?><li><a href="/webscan/app_crawlergo/index.html">crawlergo</a></li><?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <!-- 信息收集工具 -->
        <?php if (!isMenuBlacklisted('信息收集', $menuBlacklist, null)): ?>
        <li>
            <a href="#" class="menu-item">
                <svg class="w-5 h-5 flex-shrink-0 text-text-secondary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
                <span class="menu-text">信息收集</span>
                <svg class="menu-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
            <ul class="submenu">
                <?php if (!isMenuBlacklisted('信息收集', $menuBlacklist, 'OneForAll')): ?><li><a href="/webscan/one_for_all/index.html">OneForAll</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('信息收集', $menuBlacklist, 'DirMap')): ?><li><a href="/webscan/dirmap/index.html">DirMap</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('信息收集', $menuBlacklist, 'whatWeb')): ?><li><a href="/webscan/whatweb/index.html">whatWeb</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('信息收集', $menuBlacklist, 'hydra')): ?><li><a href="/webscan/hydra/index.html">hydra</a></li><?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <!-- POC管理 -->
        <?php if (!isMenuBlacklisted('POC管理', $menuBlacklist, null)): ?>
        <li>
            <a href="/pocs_file/index.html" class="menu-item">
                <svg class="w-5 h-5 flex-shrink-0 text-text-secondary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="menu-text">POC脚本</span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</aside>

<script type="text/javascript">
    $("#webscan").addClass("nav-active");
</script>
