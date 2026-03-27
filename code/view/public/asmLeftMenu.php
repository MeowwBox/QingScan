{include file='public/LeftMenuStyle' /}
<?php

// 获取菜单黑名单配置
$menuBlacklist = getMenuBlacklist();

?>
<aside id="sidebar" class="sidebar fixed top-[64px] left-0 w-[260px] h-[calc(100vh-64px)] bg-white border-r border-surface-300 overflow-y-auto overflow-x-hidden p-4 z-40">

    <div class="py-2 px-3 mb-2">
        <span class="menu-title">资产管理</span>
    </div>

    <ul id="leftMenu">
        <!-- 主机资产 -->
        <?php if (!isMenuBlacklisted('主机资产', $menuBlacklist, null)): ?>
        <li>
            <a href="#" class="menu-item">
                <svg class="w-5 h-5 flex-shrink-0 text-text-secondary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                    <line x1="8" y1="21" x2="16" y2="21"/>
                    <line x1="12" y1="17" x2="12" y2="21"/>
                </svg>
                <span class="menu-text">主机资产</span>
                <svg class="menu-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
            <ul class="submenu">
                <?php if (!isMenuBlacklisted('主机资产', $menuBlacklist, '主机概览')): ?><li><a href="/asm/hostassets/overview.html">主机概览</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('主机资产', $menuBlacklist, '全部主机')): ?><li><a href="/asm/hostassets/index.html">全部主机</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('主机资产', $menuBlacklist, '云端主机')): ?><li><a href="/asm/cloud/huoshan.html">云端主机</a></li><?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <!-- 漏洞管理 -->
        <?php if (!isMenuBlacklisted('漏洞管理', $menuBlacklist, null)): ?>
        <li>
            <a href="#" class="menu-item">
                <svg class="w-5 h-5 flex-shrink-0 text-text-secondary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    <path d="M12 8v4"/>
                    <path d="M12 16h.01"/>
                </svg>
                <span class="menu-text">漏洞管理</span>
                <svg class="menu-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
            <ul class="submenu">
                <?php if (!isMenuBlacklisted('漏洞管理', $menuBlacklist, '漏洞汇总')): ?><li><a href="/asm/vulnerability/index.html">漏洞汇总</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('漏洞管理', $menuBlacklist, '主机漏洞')): ?><li><a href="/asm/vulnerability/qingteng.html">主机漏洞</a></li><?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <!-- 工单管理 -->
        <?php if (!isMenuBlacklisted('工单管理', $menuBlacklist, null)): ?>
        <li>
            <a href="#" class="menu-item">
                <svg class="w-5 h-5 flex-shrink-0 text-text-secondary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                </svg>
                <span class="menu-text">工单管理</span>
                <svg class="menu-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
            <ul class="submenu">
                <?php if (!isMenuBlacklisted('工单管理', $menuBlacklist, '工单列表')): ?><li><a href="/asm/workorder/index.html">工单列表</a></li><?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <!-- 虚拟资产 -->
        <?php if (!isMenuBlacklisted('虚拟资产', $menuBlacklist, null)): ?>
        <li>
            <a href="#" class="menu-item">
                <svg class="w-5 h-5 flex-shrink-0 text-text-secondary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="2" y1="12" x2="22" y2="12"/>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                </svg>
                <span class="menu-text">虚拟资产</span>
                <svg class="menu-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
            <ul class="submenu">
                <?php if (!isMenuBlacklisted('虚拟资产', $menuBlacklist, '域名列表')): ?><li><a href="/asm/domain/index.html">域名列表</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('虚拟资产', $menuBlacklist, 'URL列表')): ?><li><a href="/asm/urls/index.html">URL列表</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('虚拟资产', $menuBlacklist, '组件列表')): ?><li><a href="/asm/ip_port/index.html">组件列表</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('虚拟资产', $menuBlacklist, '规则设置')): ?><li><a href="/asm/Discover/keyword_conf.html">规则设置</a></li><?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
    </ul>
</aside>

<script type="text/javascript">
    $("#asm").addClass("nav-active");
</script>
