<style>
    /* 左侧菜单容器 - 浅色背景风格 */
    #leftMenu {
        list-style: none;
        padding: 0;
        margin: 0;
        background-color: #ffffff;
        border-radius: 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.09);
    }
    
    /* 菜单项间距 */
    #leftMenu li {
        margin: 0;
    }
    
    /* 一级菜单项 */
    #leftMenu > li > a {
        display: flex;
        align-items: center;
        padding: 14px 20px;
        background-color: transparent;
        color: rgba(0, 0, 0, 0.7);
        border-radius: 0;
        text-decoration: none;
        font-weight: 500;
        position: relative;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }
    
    /* 一级菜单项悬停效果 */
    #leftMenu > li > a:hover {
        background-color: rgba(0, 0, 0, 0.02);
        color: rgba(0, 0, 0, 0.9);
        transform: none;
    }
    
    /* 当前活动菜单项 - 与顶部菜单保持一致的选中效果 */
    #leftMenu > li > a.active {
        background-color: #1890ff;
        color: #ffffff;
        font-weight: 500;
        border-left-color: #1890ff;
    }
    
    /* 二级菜单当前活动项 */
    #leftMenu ul.submenu li a.active {
        background-color: rgba(24, 144, 255, 0.1);
        color: #1890ff;
        font-weight: 500;
    }
    
    /* 图标样式 */
    #leftMenu > li > a .icon {
        margin-right: 12px;
        width: 22px;
        height: 22px;
        vertical-align: middle;
        fill: currentColor;
        opacity: 1;
    }
    
    /* 折叠/展开按钮 */
    #leftMenu > li > a .toggle-btn {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        opacity: 0.6;
        fill: rgba(0, 0, 0, 0.6);
    }
    
    /* 当前活动菜单项的折叠/展开按钮 */
    #leftMenu > li > a.active .toggle-btn {
        fill: #ffffff;
        opacity: 0.8;
    }
    
    /* 折叠/展开按钮旋转动画 */
    #leftMenu > li > a .toggle-btn.rotate {
        transform: translateY(-50%) rotate(90deg);
    }
    
    /* 二级菜单容器 */
    #leftMenu ul.submenu {
        list-style: none;
        padding: 0 0 0 12px;
        margin: 0;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease, opacity 0.3s ease;
        opacity: 0;
        background-color: rgba(0, 0, 0, 0.01);
    }
    
    /* 二级菜单展开状态 */
    #leftMenu ul.submenu.show {
        max-height: 500px;
        opacity: 1;
    }
    
    /* 二级菜单项 */
    #leftMenu ul.submenu li a {
        display: block;
        padding: 12px 20px 12px 36px;
        background-color: transparent;
        color: rgba(0, 0, 0, 0.65);
        border-radius: 0;
        text-decoration: none;
        margin: 0;
        font-size: 13px;
        font-weight: 400;
        transition: all 0.3s ease;
        position: relative;
    }
    
    /* 二级菜单项悬停效果 */
    #leftMenu ul.submenu li a:hover {
        background-color: rgba(0, 0, 0, 0.02);
        color: rgba(0, 0, 0, 0.9);
        transform: none;
    }
    
    /* 响应式设计 */
    @media (max-width: 768px) {
        #leftMenu {
            padding: 5px 0;
        }
        
        #leftMenu li {
            margin: 0 5px 3px;
        }
        
        #leftMenu > li > a {
            padding: 10px 12px;
            font-size: 14px;
        }
        
        #leftMenu ul.submenu li a {
            padding: 8px 12px;
            font-size: 13px;
        }
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        // 折叠/展开功能
        $('#leftMenu > li > a').click(function(e) {
            if ($(this).next('ul.submenu').length > 0) {
                e.preventDefault();
                $(this).next('ul.submenu').toggleClass('show');
                $(this).find('.toggle-btn').toggleClass('rotate');
            }
        });
        
        // 设置当前活动菜单
        var currentUrl = window.location.pathname;
        $('#leftMenu a').each(function() {
            var href = $(this).attr('href');
            if (href && currentUrl.includes(href.replace(/^\//, ''))) {
                $(this).addClass('active');
                // 自动展开包含当前活动项的父菜单
                $(this).closest('ul.submenu').addClass('show');
                if ($(this).closest('ul.submenu').length > 0) {
                    $(this).closest('ul.submenu').prev('a').find('.toggle-btn').addClass('rotate');
                }
            }
        });
    });
</script>