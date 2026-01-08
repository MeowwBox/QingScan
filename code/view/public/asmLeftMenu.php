{include file='public/LeftMenuStyle' /}
<div class="tuchu" style="padding-right:0;padding-left:0;margin-left:0;">
    <ul id="leftMenu">
        <li>
            <a href="#">
                <img src="/icon/asm.svg" class="icon">
                资产管理
                <img src="/icon/right.svg" class="toggle-btn">
            </a>
            <ul class="submenu show">
                <li><a href="/asm/Discover/index.html">自动发现</a></li>
                <li><a href="/asm/domain/index.html">域名</a></li>
                <li><a href="/asm/urls/index.html">URL</a></li>
                <li><a href="/asm/ip_port/index.html">端口</a></li>
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
    $("#asm").addClass("nav-active");
</script>