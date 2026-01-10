<style>
    /* 左侧菜单容器 - 浅色背景风格 */
    #leftMenu {
        list-style: none;
        padding: 0;
        margin: 0;
        background-color: #ffffff;
        border-radius: 0;
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
    // 页面加载完成后初始化所有功能
    document.addEventListener('DOMContentLoaded', function() {
        // 初始化显示所有子菜单
        document.querySelectorAll('#leftMenu .submenu').forEach(submenu => {
            if (submenu.classList.contains('show')) {
                submenu.style.maxHeight = submenu.scrollHeight + 'px';
            }
        });
        
        // 根据当前URL自动展开对应子菜单并高亮当前菜单项
        const currentUrl = window.location.pathname;
        const menuItems = document.querySelectorAll('#leftMenu a');
        
        menuItems.forEach(item => {
            // 检查菜单项的href是否与当前URL匹配（忽略参数）
            const itemUrl = item.getAttribute('href');
            if (itemUrl && currentUrl.includes(itemUrl.replace('.html', ''))) {
                // 给当前菜单项添加active类
                item.classList.add('active');
                
                // 展开其父级子菜单
                const submenu = item.closest('.submenu');
                if (submenu) {
                    submenu.classList.add('show');
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    
                    // 更新父菜单项的箭头方向
                    const parentLi = submenu.closest('li');
                    const toggleBtn = parentLi.querySelector('.toggle-btn');
                    if (toggleBtn) {
                        toggleBtn.style.transform = 'translateY(-50%) rotate(90deg)';
                    }
                }
            }
        });
        
        // 折叠/展开菜单功能
        document.querySelectorAll('#leftMenu .toggle-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const parentLi = this.closest('li');
                const submenu = parentLi.querySelector('.submenu');
                
                if (submenu) {
                    // 切换子菜单显示状态
                    submenu.classList.toggle('show');
                    
                    // 更新箭头方向
                    if (submenu.classList.contains('show')) {
                        this.style.transform = 'translateY(-50%) rotate(90deg)';
                        submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    } else {
                        this.style.transform = 'translateY(-50%) rotate(0deg)';
                        submenu.style.maxHeight = '0';
                    }
                }
            });
        });
        
        // 点击菜单项时的处理
        document.querySelectorAll('#leftMenu a').forEach(link => {
            link.addEventListener('click', function(e) {
                const submenu = this.nextElementSibling;
                
                // 如果是有子菜单的父项，则切换子菜单
                if (submenu && submenu.classList.contains('submenu')) {
                    e.preventDefault();
                    
                    // 切换当前菜单项的子菜单
                    submenu.classList.toggle('show');
                    
                    // 更新箭头方向
                    const toggleBtn = this.querySelector('.toggle-btn');
                    if (toggleBtn) {
                        if (submenu.classList.contains('show')) {
                            toggleBtn.style.transform = 'translateY(-50%) rotate(90deg)';
                            submenu.style.maxHeight = submenu.scrollHeight + 'px';
                        } else {
                            toggleBtn.style.transform = 'translateY(-50%) rotate(0deg)';
                            submenu.style.maxHeight = '0';
                        }
                    }
                }
            });
        });
    });
    </script>