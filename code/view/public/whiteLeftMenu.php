{include file='public/LeftMenuStyle' /}
<?php

// 获取菜单黑名单配置
$menuBlacklist = getMenuBlacklist();

?>
<aside id="sidebar" class="sidebar fixed top-[64px] left-0 w-[260px] h-[calc(100vh-64px)] bg-white border-r border-surface-300 overflow-y-auto overflow-x-hidden p-4 z-40">

    <div class="py-2 px-3 mb-2">
        <span class="menu-title">代码审计</span>
    </div>

    <ul id="leftMenu">
        <!-- 代码仓库管理 -->
        <?php if (!isMenuBlacklisted('代码仓库', $menuBlacklist, null)): ?>
        <li>
            <a href="/code/index.html" class="menu-item">
                <svg class="w-5 h-5 flex-shrink-0 text-text-secondary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                </svg>
                <span class="menu-text">代码仓库</span>
                <span class="menu-badge ml-auto bg-primary text-white text-[11px] px-2 py-0.5 rounded-full font-medium">12</span>
            </a>
        </li>
        <?php endif; ?>

        <!-- 代码审计工具 -->
        <?php if (!isMenuBlacklisted('代码审计', $menuBlacklist, null)): ?>
        <li>
            <a href="#" class="menu-item">
                <svg class="w-5 h-5 flex-shrink-0 text-text-secondary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                </svg>
                <span class="menu-text">审计工具</span>
                <svg class="menu-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
            <ul class="submenu">
                <?php if (!isMenuBlacklisted('代码审计', $menuBlacklist, 'CodeQL引擎')): ?><li><a href="/code/codeql/index.html">CodeQL引擎</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('代码审计', $menuBlacklist, 'Fortify')): ?><li><a href="/code/fortify/index.html">Fortify</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('代码审计', $menuBlacklist, 'SemGrep')): ?><li><a href="/code/semgrep/index.html">SemGrep</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('代码审计', $menuBlacklist, 'MobSF扫描')): ?><li><a href="/code/mobsfscan/index.html">MobSF扫描</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('代码审计', $menuBlacklist, 'Webshell检测')): ?><li><a href="/code/code_webshell/index.html">Webshell检测</a></li><?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
    </ul>
</aside>

<script type="text/javascript">
    $("#codeaudit").addClass("nav-active");
</script>
