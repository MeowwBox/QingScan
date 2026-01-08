{include file='public/LeftMenuStyle' /}
<div class="tuchu" style="padding-right:0;padding-left:0;margin-left:0;">
    <ul id="leftMenu">
        <!-- 目标管理 -->
        <li>
            <a href="/webscan/index/index.html">
                <img src="/icon/home.svg" class="icon">
                目标管理
                <img src="/icon/right.svg" class="toggle-btn">
            </a>
        </li>
        
        <!-- Web扫描工具 -->
        <li>
            <a href="#">
                <img src="/icon/tools.svg" class="icon">
                Web扫描
                <img src="/icon/right.svg" class="toggle-btn">
            </a>
            <ul class="submenu show">
                <li><a href="/webscan/xray/index.html">Xray</a></li>
                <li><a href="/webscan/bug/awvs.html">AWVS</a></li>
                <li><a href="/webscan/sqlmap/index.html">SqlMap</a></li>
                <li><a href="/webscan/vulmap/index.html">vulmap</a></li>
                <li><a href="/webscan/app_nuclei/index.html">nuclei</a></li>
                <li><a href="/webscan/app_crawlergo/index.html">crawlergo</a></li>
            </ul>
        </li>
        
        <!-- 信息收集工具 -->
        <li>
            <a href="#">
                <img src="/icon/tools.svg" class="icon">
                信息收集
                <img src="/icon/right.svg" class="toggle-btn">
            </a>
            <ul class="submenu show">
                <li><a href="/webscan/one_for_all/index.html">OneForAll</a></li>
                <li><a href="/webscan/dirmap/index.html">DirMap</a></li>
                <li><a href="/webscan/whatweb/index.html">whatWeb</a></li>
                <li><a href="/webscan/hydra/index.html">hydra</a></li>
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
    $("#webscan").addClass("nav-active");
</script>