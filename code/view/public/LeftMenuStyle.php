<style>
    /* ===== 滚动条隐藏 ===== */
    aside.sidebar,
    .sidebar {
        scrollbar-width: none !important;
        -ms-overflow-style: none !important;
    }
    aside.sidebar::-webkit-scrollbar,
    .sidebar::-webkit-scrollbar {
        display: none !important;
    }

    /* ===== 侧边栏收起展开过渡 ===== */
    .sidebar {
        transition: width 0.3s ease, transform 0.3s ease;
    }
    .sidebar.collapsed {
        width: 72px;
    }
    .sidebar.collapsed .menu-text,
    .sidebar.collapsed .menu-badge,
    .sidebar.collapsed .submenu,
    .sidebar.collapsed .menu-arrow,
    .sidebar.collapsed .menu-title {
        opacity: 0;
        visibility: hidden;
    }
    .sidebar.collapsed .menu-item {
        justify-content: center;
        padding-left: 0;
        padding-right: 0;
    }
    .sidebar.collapsed .menu-item svg:first-child {
        margin-right: 0;
    }
    .sidebar:hover .menu-text,
    .sidebar:hover .menu-badge,
    .sidebar:hover .submenu,
    .sidebar:hover .menu-arrow,
    .sidebar:hover .menu-title {
        opacity: 1;
        visibility: visible;
    }
    .sidebar:hover {
        width: 260px;
    }

    .main-content {
        transition: margin-left 0.3s ease;
    }
    .main-content.expanded {
        margin-left: 72px;
    }

    /* ===== 左侧菜单标题 ===== */
    .menu-title {
        display: block;
        font-size: 11px !important;
        font-weight: 700 !important;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #94a3b8;
        transition: opacity 0.2s ease;
    }

    /* ===== 左侧功能栏 ===== */
    #leftMenu {
        list-style: none;
        padding: 0;
        margin: 0;
        background: transparent;
    }

    #leftMenu li {
        margin: 0;
    }

    /* ===== 一级菜单项 ===== */
    #leftMenu > li > a.menu-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        background-color: transparent;
        color: #64748b;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px !important;
        position: relative;
        transition: all 0.2s ease;
        cursor: pointer;
        white-space: nowrap;
        overflow: hidden;
    }

    #leftMenu > li > a.menu-item:hover {
        background-color: #f1f5f9;
        color: #1e293b;
    }

    #leftMenu > li > a.menu-item.active {
        background: #eff6ff;
        color: #3b82f6;
        font-weight: 600;
    }

    /* ===== 图标 ===== */
    #leftMenu > li > a.menu-item svg:first-child {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    #leftMenu > li > a.menu-item:hover svg:first-child {
        color: #1e293b;
    }

    #leftMenu > li > a.menu-item.active svg:first-child {
        color: #3b82f6;
    }

    /* ===== 菜单文字 ===== */
    .menu-text {
        flex: 1;
        white-space: nowrap;
        font-size: 14px !important;
        transition: opacity 0.2s ease;
    }

    /* ===== 徽章 ===== */
    .menu-badge {
        font-size: 11px !important;
        padding: 2px 8px;
        border-radius: 9999px;
        font-weight: 600;
        transition: opacity 0.2s ease;
    }

    /* ===== 展开按钮 ===== */
    .menu-arrow {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .menu-arrow.rotate {
        transform: rotate(180deg);
    }

    /* ===== 二级菜单容器 ===== */
    #leftMenu ul.submenu {
        list-style: none;
        padding: 4px 0 8px;
        margin: 0 0 0 20px;
        border-left: 2px solid #3b82f6;
        overflow: hidden;
    }

    /* ===== 二级菜单项 ===== */
    #leftMenu ul.submenu li a {
        display: block;
        padding: 8px 16px;
        background-color: transparent;
        color: #64748b;
        border-radius: 8px;
        text-decoration: none;
        margin: 2px 8px;
        font-size: 13px !important;
        font-weight: 400;
        transition: all 0.2s ease;
    }

    #leftMenu ul.submenu li a:hover {
        background-color: #f8fafc;
        color: #3b82f6;
    }

    #leftMenu ul.submenu li a.active {
        background: #eff6ff;
        color: #3b82f6;
        font-weight: 500;
    }

    /* ===== 响应式 ===== */
    @media (max-width: 768px) {
        #leftMenu > li > a.menu-item {
            padding: 10px 14px;
            font-size: 13px !important;
        }
        .menu-text {
            font-size: 13px !important;
        }
        #leftMenu ul.submenu li a {
            padding: 8px 12px;
            font-size: 12px !important;
        }
    }
</style>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        // 根据当前URL高亮菜单项
        const currentUrl = window.location.pathname;
        const menuItems = document.querySelectorAll('#leftMenu a');

        menuItems.forEach(item => {
            const itemUrl = item.getAttribute('href');
            if (itemUrl && itemUrl !== '#' && currentUrl.includes(itemUrl.replace('.html', ''))) {
                item.classList.add('active');

                // 展开父级菜单
                const submenu = item.closest('.submenu');
                if (submenu) {
                    const toggleBtn = submenu.previousElementSibling?.querySelector('.menu-arrow');
                    if (toggleBtn) {
                        toggleBtn.classList.add('rotate');
                    }
                }
            }
        });

        // 折叠/展开菜单功能
        document.querySelectorAll('#leftMenu .menu-arrow').forEach(btn => {
            btn.closest('a').addEventListener('click', function(e) {
                if (this.getAttribute('href') === '#') {
                    e.preventDefault();
                    const submenu = this.nextElementSibling;
                    if (submenu && submenu.classList.contains('submenu')) {
                        submenu.style.display = submenu.style.display === 'none' ? '' : 'none';
                        btn.classList.toggle('rotate');
                    }
                }
            });
        });
    });

    // 侧边栏收起展开
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const icon = document.getElementById('sidebarToggleIcon');

        if (sidebar) {
            sidebar.classList.toggle('collapsed');
            if (mainContent) {
                mainContent.classList.toggle('expanded');
            }
            if (icon) {
                icon.style.transform = sidebar.classList.contains('collapsed') ? 'rotate(90deg)' : 'rotate(0deg)';
            }
        }
    }
</script>
