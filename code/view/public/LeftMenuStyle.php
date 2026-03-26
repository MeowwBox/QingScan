<style>
    /* ===== 侧栏外壳（webscan 深灰侧栏） ===== */
    .tuchu.webscan-sidebar {
        background: #fafafa !important;
        border-right: 1px solid #e8e8e8;
        box-shadow: 1px 0 0 rgba(0, 0, 0, 0.02);
    }

    /* ===== 侧栏外壳（code 白底侧栏） ===== */
    .tuchu.code-sidebar {
        background: #ffffff !important;
        border-right: 1px solid #ebebeb;
        box-shadow: 1px 0 0 rgba(0, 0, 0, 0.015);
    }

    /* ===== 一级菜单项（code 侧栏专用） ===== */
    .code-sidebar #leftMenu > li > a {
        padding: 10px 10px 10px 12px;
        font-size: 13px;
        white-space: nowrap;
        overflow: hidden;
    }

    .code-sidebar #leftMenu > li > a:hover {
        padding-left: 16px;
    }

    .code-sidebar #leftMenu > li > a.active {
        padding-left: 16px;
    }

    /* 图标在 code 侧栏更紧凑 */
    .code-sidebar #leftMenu > li > a .icon {
        width: 16px;
        height: 16px;
    }

    .code-sidebar #leftMenu > li > a .toggle-btn {
        width: 12px;
        height: 12px;
        flex-shrink: 0;
    }

    /* ===== 二级菜单项（code 侧栏专用） ===== */
    .code-sidebar #leftMenu ul.submenu li a {
        padding: 7px 10px 7px 32px;
        font-size: 12px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .code-sidebar #leftMenu ul.submenu li a::before {
        left: 18px;
    }

    .code-sidebar #leftMenu ul.submenu li a:hover {
        padding-left: 36px;
    }

    .code-sidebar #leftMenu ul.submenu li a.active {
        padding-left: 36px;
    }

    /* 二级容器缩进适配 */
    .code-sidebar #leftMenu ul.submenu {
        margin-left: 12px;
        border-left: 2px solid #f0f0f0;
    }

    /* ===== 侧边栏标题 ===== */
    .sidebar-title {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 14px 18px 10px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #8c8c8c;
        border-bottom: 1px solid #f0f0f0;
        margin-bottom: 4px;
    }
    .sidebar-title svg {
        width: 14px;
        height: 14px;
        stroke: #bfbfbf;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    /* ===== 左侧功能栏 ===== */
    #leftMenu {
        list-style: none;
        padding: 8px 0 12px;
        margin: 0;
        background: transparent;
        height: 100%;
        min-height: calc(100vh - 70px);
        overflow-y: auto;
        overflow-x: hidden;
    }

    #leftMenu::-webkit-scrollbar {
        width: 5px;
    }
    #leftMenu::-webkit-scrollbar-track {
        background: transparent;
    }
    #leftMenu::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.12);
        border-radius: 3px;
    }

    #leftMenu li {
        margin: 0;
    }

    /* ===== 一级菜单项 ===== */
    #leftMenu > li > a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 11px 16px;
        background-color: transparent;
        color: rgba(0, 0, 0, 0.72);
        border-radius: 0;
        text-decoration: none;
        font-weight: 400;
        font-size: 14px;
        position: relative;
        transition: background 0.2s ease, color 0.2s ease, padding-left 0.2s ease;
        border-left: 3px solid transparent;
        cursor: pointer;
        white-space: nowrap;
        overflow: hidden;
    }

    #leftMenu > li > a:hover {
        background-color: rgba(0, 0, 0, 0.04);
        color: rgba(0, 0, 0, 0.88);
        padding-left: 20px;
    }

    #leftMenu > li > a.active {
        background: rgba(24, 144, 255, 0.08);
        color: #096dd9;
        font-weight: 500;
        border-left-color: #1890ff;
        padding-left: 20px;
    }

    /* ===== 图标 ===== */
    #leftMenu > li > a .icon {
        width: 18px;
        height: 18px;
        fill: none;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
        flex-shrink: 0;
        opacity: 0.9;
        transition: opacity 0.2s ease, transform 0.2s ease;
        stroke: rgba(0, 0, 0, 0.45);
    }

    #leftMenu > li > a:hover .icon,
    #leftMenu > li > a.active .icon {
        stroke: currentColor;
        transform: scale(1.04);
    }

    /* ===== 展开/收起按钮 ===== */
    #leftMenu > li > a .toggle-btn {
        margin-left: auto;
        width: 14px;
        height: 14px;
        fill: none;
        stroke: rgba(0, 0, 0, 0.35);
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        flex-shrink: 0;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), stroke 0.2s ease;
    }

    #leftMenu > li > a:hover .toggle-btn,
    #leftMenu > li > a.active .toggle-btn {
        stroke: rgba(0, 0, 0, 0.55);
    }

    #leftMenu > li > a .toggle-btn.rotate {
        transform: rotate(90deg);
    }

    /* ===== 二级菜单容器 ===== */
    #leftMenu ul.submenu {
        list-style: none;
        padding: 4px 0 6px;
        margin: 0;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
        opacity: 0;
        background: rgba(0, 0, 0, 0.02);
        border-left: 2px solid #f0f0f0;
        margin-left: 18px;
    }

    #leftMenu ul.submenu.show {
        max-height: 600px;
        opacity: 1;
    }

    /* ===== 二级菜单项 ===== */
    #leftMenu ul.submenu li a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px 8px 40px;
        background-color: transparent;
        color: rgba(0, 0, 0, 0.55);
        border-radius: 0 4px 4px 0;
        text-decoration: none;
        margin: 0;
        font-size: 13px;
        font-weight: 400;
        transition: background 0.2s ease, color 0.2s ease, padding-left 0.2s ease;
        position: relative;
    }

    #leftMenu ul.submenu li a::before {
        content: '';
        position: absolute;
        left: 26px;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.18);
        transition: background 0.2s ease, transform 0.2s ease;
    }

    #leftMenu ul.submenu li a:hover {
        background-color: rgba(0, 0, 0, 0.03);
        color: rgba(0, 0, 0, 0.85);
        padding-left: 44px;
    }

    #leftMenu ul.submenu li a:hover::before {
        background: rgba(0, 0, 0, 0.35);
        transform: translateY(-50%) scale(1.25);
    }

    #leftMenu ul.submenu li a.active {
        background: rgba(24, 144, 255, 0.1);
        color: #1890ff;
        font-weight: 500;
        padding-left: 44px;
    }

    #leftMenu ul.submenu li a.active::before {
        background: #1890ff;
        transform: translateY(-50%) scale(1.35);
    }

    @media (max-width: 768px) {
        #leftMenu > li > a {
            padding: 10px 14px;
            font-size: 13px;
        }

        #leftMenu ul.submenu li a {
            padding: 8px 12px 8px 36px;
            font-size: 12px;
        }

        #leftMenu ul.submenu li a::before {
            left: 22px;
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
            const itemUrl = item.getAttribute('href');
            if (itemUrl && currentUrl.includes(itemUrl.replace('.html', ''))) {
                item.classList.add('active');

                const submenu = item.closest('.submenu');
                if (submenu) {
                    submenu.classList.add('show');
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';

                    const parentLi = submenu.closest('li');
                    const toggleBtn = parentLi.querySelector('.toggle-btn');
                    if (toggleBtn) {
                        toggleBtn.classList.add('rotate');
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
                    submenu.classList.toggle('show');
                    this.classList.toggle('rotate');
                    submenu.style.maxHeight = submenu.classList.contains('show')
                        ? submenu.scrollHeight + 'px'
                        : '0';
                }
            });
        });

        // 点击菜单项时的处理
        document.querySelectorAll('#leftMenu > li > a').forEach(link => {
            link.addEventListener('click', function(e) {
                const submenu = this.nextElementSibling;

                if (submenu && submenu.classList.contains('submenu')) {
                    e.preventDefault();

                    submenu.classList.toggle('show');
                    const toggleBtn = this.querySelector('.toggle-btn');
                    if (toggleBtn) {
                        toggleBtn.classList.toggle('rotate');
                    }
                    submenu.style.maxHeight = submenu.classList.contains('show')
                        ? submenu.scrollHeight + 'px'
                        : '0';
                }
            });
        });
    });
    </script>