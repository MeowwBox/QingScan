</main><!-- 结束 main-content -->

<script>
    function quanxuan(obj) {
        var child = $('.table').find('.ids');
        child.each(function (index, item) {
            if (obj.checked) {
                item.checked = true
            } else {
                item.checked = false
            }
        })
    }

    // Function to get current page path
    function getCurrentPagePath() {
        var url = window.location.href;
        var path = url.match(/\/\/[^\/]*(\/[^?#]*)/);
        if (path && path.length > 1) {
            return path[1].replace(/\.html.*$/, '');
        }
        return '';
    }

    // Function to add 'active' class to A links containing the path
    function addActiveClassToLinks(path) {
        $('#leftMenu a').each(function () {
            if ($(this).attr('href').indexOf(path) !== -1) {
                $(this).addClass('active');
            }
        });
    }

    $(document).ready(function () {
        // 获取所有具有 auto-height-textarea 类的 textarea 元素
        var textareas = document.getElementsByClassName("auto-height-textarea");

        // 为每个 textarea 添加 input 事件监听器
        Array.from(textareas).forEach(function (textarea) {
            textarea.addEventListener("input", function () {
                // 自动调整高度
                this.style.height = "auto";
                this.style.height = this.scrollHeight + "px";
            });

            // 页面加载完毕后，首次触发 input 事件，以便调整初始高度
            textarea.dispatchEvent(new Event("input"));
        });

    });


    // Call the functions
    var currentPagePath = getCurrentPagePath();
    addActiveClassToLinks(currentPagePath);

    // 侧边栏收起展开状态管理
    let sidebarCollapsed = false;
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const icon = document.getElementById('sidebarToggleIcon');

        if (!sidebar || !mainContent) return;

        sidebarCollapsed = !sidebarCollapsed;

        if (sidebarCollapsed) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
            if (icon) icon.style.transform = 'rotate(90deg)';
            // 保存状态到 localStorage
            localStorage.setItem('sidebarCollapsed', 'true');
        } else {
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('expanded');
            if (icon) icon.style.transform = 'rotate(0deg)';
            localStorage.setItem('sidebarCollapsed', 'false');
        }
    }

    // 页面加载时恢复侧边栏状态
    (function() {
        const savedState = localStorage.getItem('sidebarCollapsed');
        if (savedState === 'true') {
            sidebarCollapsed = true;
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const icon = document.getElementById('sidebarToggleIcon');
            if (sidebar) sidebar.classList.add('collapsed');
            if (mainContent) mainContent.classList.add('expanded');
            if (icon) icon.style.transform = 'rotate(90deg)';
        }
    })();

    // 抽屉组件初始化
    const QingScanDrawer = {
        open: function(type, options = {}) {
            const overlay = document.getElementById('drawerOverlay');
            const panel = document.getElementById('drawerPanel');
            const title = document.getElementById('drawerTitle');

            if (!overlay || !panel) {
                console.warn('Drawer elements not found');
                return;
            }

            // 设置标题
            if (title && options.title) {
                title.textContent = options.title;
            }

            // 显示抽屉
            overlay.classList.remove('hidden');
            setTimeout(() => {
                panel.classList.remove('hidden');
            }, 10);

            // 禁止背景滚动
            document.body.style.overflow = 'hidden';

            // 触发自定义事件
            document.dispatchEvent(new CustomEvent('drawer:opened', { detail: { type, options } }));
        },

        close: function() {
            const overlay = document.getElementById('drawerOverlay');
            const panel = document.getElementById('drawerPanel');

            if (!overlay || !panel) return;

            panel.classList.add('hidden');
            setTimeout(() => {
                overlay.classList.add('hidden');
            }, 300);

            // 恢复背景滚动
            document.body.style.overflow = '';

            // 触发自定义事件
            document.dispatchEvent(new CustomEvent('drawer:closed'));
        }
    };

    // 全局快捷函数
    function openDrawer(type, options) {
        QingScanDrawer.open(type, options);
    }

    function closeDrawer() {
        QingScanDrawer.close();
    }

    // ESC键关闭抽屉
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDrawer();
        }
    });

    // 导航栏激活状态处理
    (function() {
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-item[href]').forEach(item => {
            const href = item.getAttribute('href');
            if (href && currentPath.includes(href.replace('.html', ''))) {
                item.classList.add('active');
            }
        });
    })();

    // 用户下拉菜单切换
    function toggleUserMenu(event) {
        event.preventDefault();
        event.stopPropagation();
        const menu = document.getElementById('userMenu');
        if (menu) {
            menu.classList.toggle('hidden');
        }
    }

    // 点击外部关闭用户菜单
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('userMenu');
        const dropdown = document.getElementById('userDropdown');
        if (menu && dropdown && !dropdown.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });

</script>
</body>
</html>
