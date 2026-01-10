{include file='public/LeftMenuStyle' /}
<?php

// 获取菜单黑名单配置
$menuBlacklist = getMenuBlacklist();

?>
<div class="tuchu" style="padding-right:0;padding-left:0;margin-left:0;">
    <ul id="leftMenu">
        <!-- 目标管理 -->
        <?php if (!isMenuBlacklisted('目标管理', $menuBlacklist, null)): ?>
        <li>
            <a href="/webscan/index/index.html">
                <img src="/icon/home.svg" class="icon">
                目标管理
                <img src="/icon/right.svg" class="toggle-btn">
            </a>
        </li>
        <?php endif; ?>
        
        <!-- Web扫描工具 -->
        <?php if (!isMenuBlacklisted('Web扫描', $menuBlacklist, null)): ?>
        <li>
            <a href="#">
                <img src="/icon/tools.svg" class="icon">
                Web扫描
                <img src="/icon/right.svg" class="toggle-btn">
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
                <img src="/icon/tools.svg" class="icon">
                信息收集
                <img src="/icon/right.svg" class="toggle-btn">
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
    $("#webscan").addClass("nav-active");
</script>