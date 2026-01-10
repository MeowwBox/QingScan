{include file='public/LeftMenuStyle' /}
<?php

// 获取菜单黑名单配置
$menuBlacklist = getMenuBlacklist();

?>
<!-- 左侧菜单栏内容 -->
<div class="tuchu" style="padding-right:0;padding-left:0;margin-left:0;">
    <ul id="leftMenu">
        <!-- 代码仓库管理 -->
        <?php if (!isMenuBlacklisted('代码仓库', $menuBlacklist, null)): ?>
        <li>
            <a href="#">
                <img src="/icon/repo.svg" class="icon">
                代码仓库
                <img src="/icon/right.svg" class="toggle-btn">
            </a>
            <ul class="submenu show">
                <?php if (!isMenuBlacklisted('代码仓库', $menuBlacklist, 'Git仓库')): ?><li><a href="/code/index.html">Git仓库</a></li><?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        
        <!-- 代码审计工具 -->
        <?php if (!isMenuBlacklisted('代码审计', $menuBlacklist, null)): ?>
        <li>
            <a href="#">
                <img src="/icon/code.svg" class="icon">
                代码审计
                <img src="/icon/right.svg" class="toggle-btn">
            </a>
            <ul class="submenu show">
                <?php if (!isMenuBlacklisted('代码审计', $menuBlacklist, 'CodeQL引擎')): ?><li><a href="/code/codeql/index.html">CodeQL引擎</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('代码审计', $menuBlacklist, 'Fortify')): ?><li><a href="/code/fortify/index.html">Fortify</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('代码审计', $menuBlacklist, 'SemGrep')): ?><li><a href="/code/semgrep/index.html">SemGrep</a></li><?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        
        <!-- 代码安全工具 -->
        <?php if (!isMenuBlacklisted('代码安全', $menuBlacklist, null)): ?>
        <li>
            <a href="#">
                <img src="/icon/tools.svg" class="icon">
                代码安全
                <img src="/icon/right.svg" class="toggle-btn">
            </a>
            <ul class="submenu show">
                <?php if (!isMenuBlacklisted('代码安全', $menuBlacklist, '成份分析')): ?><li><a href="/code/sbom/index.html">成份分析</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('代码安全', $menuBlacklist, 'WebShell检测')): ?><li><a href="/code/webshell/index.html">WebShell检测</a></li><?php endif; ?>
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
    $("#codeaudit").addClass("nav-active");
</script>