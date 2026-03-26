{include file='public/LeftMenuStyle' /}
<?php

// 获取菜单黑名单配置
$menuBlacklist = getMenuBlacklist();

?>
<div class="tuchu webscan-sidebar" style="padding-right:0;padding-top:0;padding-bottom:0;padding-left:0;margin:0;border-radius:0;overflow:hidden;">
    <!-- 侧边栏标题 -->
    <div class="sidebar-title">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
            <rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/>
        </svg>
        <span>功能菜单</span>
    </div>
    <ul id="leftMenu">
        <!-- 目标管理 -->
        <?php if (!isMenuBlacklisted('目标管理', $menuBlacklist, null)): ?>
        <li>
            <a href="/webscan/index/index.html">
                <svg class="icon" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3"/><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/>
                </svg>
                目标管理
            </a>
        </li>
        <?php endif; ?>

        <!-- Web扫描工具 -->
        <?php if (!isMenuBlacklisted('Web扫描', $menuBlacklist, null)): ?>
        <li>
            <a href="#">
                <svg class="icon" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                </svg>
                Web扫描
                <svg class="toggle-btn" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
            <ul class="submenu show">
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
            <a href="#">
                <svg class="icon" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                </svg>
                信息收集
                <svg class="toggle-btn" viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
            <ul class="submenu show">
                <?php if (!isMenuBlacklisted('信息收集', $menuBlacklist, 'OneForAll')): ?><li><a href="/webscan/one_for_all/index.html">OneForAll</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('信息收集', $menuBlacklist, 'DirMap')): ?><li><a href="/webscan/dirmap/index.html">DirMap</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('信息收集', $menuBlacklist, 'whatWeb')): ?><li><a href="/webscan/whatweb/index.html">whatWeb</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('信息收集', $menuBlacklist, 'hydra')): ?><li><a href="/webscan/hydra/index.html">hydra</a></li><?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
    </ul>
</div>

<script>
(function () {
        var leftMenu = document.getElementById('leftMenu');
        function adjustHeight() {
            if (leftMenu) {
                leftMenu.style.height = (window.innerHeight - 56) + 'px';
            }
        }
        adjustHeight();
        window.addEventListener('resize', adjustHeight);
    })();
</script>
