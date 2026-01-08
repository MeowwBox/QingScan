{include file='public/LeftMenuStyle' /}
<div class="tuchu" style="padding-right:0;padding-left:0;margin-left:0;">
    <ul id="leftMenu">
        <!-- 安全情报与漏洞管理 -->
        <li>
            <a href="#">
                <img src="/icon/cve.svg" class="icon">
                安全情报
                <img src="/icon/right.svg" class="toggle-btn">
            </a>
            <ul class="submenu show">
                <li><a href="/vulnerable/index.html">漏洞情报</a></li>
                <li><a href="/vulnerable/pocsuite.html">漏洞实例</a></li>
            </ul>
        </li>
        
        <!-- POC管理与检测 -->
        <li>
            <a href="#">
                <img src="/icon/scan.svg" class="icon">
                漏洞检测
                <img src="/icon/right.svg" class="toggle-btn">
            </a>
            <ul class="submenu show">
                <li><a href="/pocs_file/index.html">POC脚本库</a></li>
                <li><a href="/vul_target/index.html">检测任务管理</a></li>
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
    $("#cveuse").addClass("nav-active");
</script>