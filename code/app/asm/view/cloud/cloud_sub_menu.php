<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?php echo (app('request')->action() === 'huoshan') ? 'active' : ''; ?>" href="{:URL('huoshan')}" id="huoshan_tab">火山云</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo (app('request')->action() === 'aliyun') ? 'active' : ''; ?>" href="{:URL('aliyun')}" id="aliyun_tab">阿里云</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo (app('request')->action() === 'yidong') ? 'active' : ''; ?>" href="{:URL('yidong')}" id="yidong_tab">移动云</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo (app('request')->action() === 'tianyi') ? 'active' : ''; ?>" href="{:URL('tianyi')}" id="tianyi_tab">天翼云</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo (app('request')->action() === 'baidu') ? 'active' : ''; ?>" href="{:URL('baidu')}" id="baidu_tab">百度云</a>
    </li>
</ul>