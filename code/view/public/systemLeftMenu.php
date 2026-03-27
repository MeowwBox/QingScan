{include file='public/LeftMenuStyle' /}
<?php

// 获取菜单黑名单配置
$menuBlacklist = getMenuBlacklist();

?>
<aside id="sidebar" class="sidebar fixed top-[64px] left-0 w-[260px] h-[calc(100vh-64px)] bg-white border-r border-surface-300 overflow-y-auto overflow-x-hidden p-4 z-40">

    <div class="py-2 px-3 mb-2">
        <span class="menu-title">系统管理</span>
    </div>

    <ul id="leftMenu">
        <!-- 系统管理核心功能 -->
        <?php if (!isMenuBlacklisted('系统管理', $menuBlacklist, null)): ?>
        <li>
            <a href="#" class="menu-item">
                <svg class="w-5 h-5 flex-shrink-0 text-text-secondary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                </svg>
                <span class="menu-text">系统设置</span>
                <svg class="menu-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
            <ul class="submenu">
                <?php if (!isMenuBlacklisted('系统管理', $menuBlacklist, '系统配置')): ?><li><a href="/config/index.html">系统配置</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('系统管理', $menuBlacklist, '任务队列')): ?><li><a href="/system/task_scan/index.html">任务队列</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('系统管理', $menuBlacklist, '系统日志')): ?><li><a href="/system/user_log/index.html">系统日志</a></li><?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
    </ul>
</aside>

<script type="text/javascript">
    $("#system").addClass("nav-active");
</script>
