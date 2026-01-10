{include file='public/LeftMenuStyle' /}
<?php

// 获取菜单黑名单配置
$menuBlacklist = getMenuBlacklist();

?>
<div class="tuchu" style="padding-right:0;padding-left:0;margin-left:0;">
    <ul id="leftMenu">
        <!-- 云资产管理 -->
        <?php if (!isMenuBlacklisted('主机资产', $menuBlacklist, null)): ?>
        <li>
            <a href="#">
                <img src="/icon/asm.svg" class="icon">
                主机资产
                <img src="/icon/right.svg" class="toggle-btn">
            </a>
            <ul class="submenu">
                <?php if (!isMenuBlacklisted('主机资产', $menuBlacklist, '全部主机')): ?><li><a href="/asm/hostassets/index.html">全部主机</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('主机资产', $menuBlacklist, '云端主机')): ?><li><a href="/asm/cloud/huoshan.html">云端主机</a></li><?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        
        <!-- 漏洞管理 -->
        <?php if (!isMenuBlacklisted('漏洞管理', $menuBlacklist, null)): ?>
        <li>
            <a href="#">
                <img src="/icon/cve.svg" class="icon">
                漏洞管理
                <img src="/icon/right.svg" class="toggle-btn">
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
            <a href="#">
                <img src="/icon/tools.svg" class="icon">
                工单管理
                <img src="/icon/right.svg" class="toggle-btn">
            </a>
            <ul class="submenu">
                <?php if (!isMenuBlacklisted('工单管理', $menuBlacklist, '工单列表')): ?><li><a href="/asm/workorder/index.html">工单列表</a></li><?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <!-- 资产管理核心功能 -->
        <?php if (!isMenuBlacklisted('虚拟资产', $menuBlacklist, null)): ?>
        <li>
            <a href="#">
                <img src="/icon/webscan.svg" class="icon">
                虚拟资产
                <img src="/icon/right.svg" class="toggle-btn">
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
</div>

<script type="text/javascript">
    // 获取当前屏幕高度
    var screenHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

    // 设置要修改高度的DIV的ID，这里假设该DIV的ID为"myDiv"
    var div = document.getElementById("leftMenu");
    screenHeight -= 56;
    // 设置DIV的高度为当前屏幕高度
    div.style.height = screenHeight + "px";
</script>
<script type="text/javascript">
    $("#asm").addClass("nav-active");
</script>