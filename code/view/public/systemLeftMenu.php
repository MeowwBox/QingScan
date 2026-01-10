{include file='public/LeftMenuStyle' /}
<?php

// 获取菜单黑名单配置
$menuBlacklist = getMenuBlacklist();

?>
<div class="tuchu" style="padding-right:0;padding-left:0;margin-left:0;">
    <ul id="leftMenu">
        <!-- 系统管理核心功能 -->
        <?php if (!isMenuBlacklisted('系统管理', $menuBlacklist, null)): ?>
        <li>
            <a href="#">
                <img src="/icon/setting.svg" class="icon">
                系统管理
                <img src="/icon/right.svg" class="toggle-btn">
            </a>
            <ul class="submenu show">
                <?php if (!isMenuBlacklisted('系统管理', $menuBlacklist, '系统配置')): ?><li><a href="/config/index.html">系统配置</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('系统管理', $menuBlacklist, '任务队列')): ?><li><a href="/system/task_scan/index.html">任务队列</a></li><?php endif; ?>
                <?php if (!isMenuBlacklisted('系统管理', $menuBlacklist, '系统日志')): ?><li><a href="/system/user_log/index.html">系统日志</a></li><?php endif; ?>
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
    $("#system").addClass("nav-active");
</script>