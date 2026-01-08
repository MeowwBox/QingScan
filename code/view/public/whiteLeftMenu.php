{include file='public/LeftMenuStyle' /}

<!-- 左侧菜单栏内容 -->
<div class="tuchu" style="padding-right:0;padding-left:0;margin-left:0;">
    <ul id="leftMenu">
        <li>
            <a href="/code/index.html">
                <img src="/icon/repo.svg" class="icon">
                仓库管理
                <img src="/icon/right.svg" class="toggle-btn">
            </a>
        </li>
        <li>
            <a href="#">
                <img src="/icon/code.svg" class="icon">
                代码审计
                <img src="/icon/right.svg" class="toggle-btn">
            </a>
            <ul class="submenu show">
                <li><a href="/code/code_ql/index.html">CodeQL引擎</a></li>
                <li><a href="/code/fortify/index.html">Fortify</a></li>
                <li><a href="/code/semgrep/index.html">SemGrep</a></li>
                <li><a href="/code/murphysec/index.html">成份分析</a></li>
                <li><a href="/code/code_webshell/index.html">WebShell</a></li>
            </ul>
        </li>
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