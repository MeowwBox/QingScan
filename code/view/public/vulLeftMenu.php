{include file='public/LeftMenuStyle' /}
<?php

// 获取菜单黑名单配置
$menuBlacklist = getMenuBlacklist();

?>
<aside id="sidebar" class="sidebar fixed top-[64px] left-0 w-[260px] h-[calc(100vh-64px)] bg-white border-r border-surface-300 overflow-y-auto overflow-x-hidden p-4 z-40">

    <div class="py-2 px-3 mb-2">
        <span class="menu-title">安全情报</span>
    </div>

    <ul id="leftMenu">
        <!-- 安全情报与漏洞管理 -->
        <?php if (!isMenuBlacklisted('安全情报', $menuBlacklist, null)): ?>
        <li>
            <a href="#" class="menu-item">
                <svg class="w-5 h-5 flex-shrink-0 text-text-secondary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                <span class="menu-text">安全情报</span>
                <svg class="menu-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
            <ul class="submenu">
                <?php if (!isMenuBlacklisted('安全情报', $menuBlacklist, '漏洞情报')): ?><li><a href="/vulnerable/index.html">漏洞情报</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('安全情报', $menuBlacklist, '漏洞实例')): ?><li><a href="/vulnerable/pocsuite.html">漏洞实例</a></li><?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <!-- POC管理与检测 -->
        <?php if (!isMenuBlacklisted('漏洞检测', $menuBlacklist, null)): ?>
        <li>
            <a href="#" class="menu-item">
                <svg class="w-5 h-5 flex-shrink-0 text-text-secondary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                <span class="menu-text">漏洞检测</span>
                <svg class="menu-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
            <ul class="submenu">
                <?php if (!isMenuBlacklisted('漏洞检测', $menuBlacklist, 'POC脚本库')): ?><li><a href="/pocs_file/index.html">POC脚本库</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('漏洞检测', $menuBlacklist, '检测任务管理')): ?><li><a href="/vul_target/index.html">检测任务管理</a></li><?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
    </ul>
</aside>

<script type="text/javascript">
    $("#cveuse").addClass("nav-active");
</script>
