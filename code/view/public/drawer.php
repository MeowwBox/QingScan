<!-- QingScan 右侧抽屉模板 -->
<!-- 使用说明：引入此模板后，调用 openDrawer(type, title) 打开抽屉 -->
<!-- type: view(查看详情) | add(新增) | edit(编辑) -->
<!-- 内容区域由调用页面动态填充 -->

<style>
    /* 抽屉基础样式 */
    .drawer-overlay {
        transition: opacity 0.3s ease;
    }
    .drawer-panel {
        transition: transform 0.3s ease;
    }
    .drawer-overlay.hidden {
        opacity: 0;
        pointer-events: none;
    }
    .drawer-panel.hidden {
        transform: translateX(100%);
    }

    /* 抽屉内容区域滚动条 */
    .drawer-content {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 transparent;
    }
    .drawer-content::-webkit-scrollbar {
        width: 6px;
    }
    .drawer-content::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }
    .drawer-content::-webkit-scrollbar-track {
        background: transparent;
    }
</style>

<!-- 右侧抽屉基础结构 -->

<!-- 抽屉遮罩层 -->
<div id="drawerOverlay" class="drawer-overlay hidden fixed inset-0 bg-black/30 z-50" onclick="closeDrawer()"></div>

<!-- 抽屉面板 -->
<div id="drawerPanel" class="drawer-panel hidden fixed top-0 right-0 h-full w-[520px] bg-white shadow-drawer z-50 flex flex-col">

    <!-- 头部：标题 + 关闭按钮 -->
    <div class="flex items-center justify-between px-6 py-5 border-b border-slate-200 shrink-0">
        <h3 id="drawerTitle" class="text-lg font-bold text-slate-800">标题</h3>
        <button onclick="closeDrawer()" class="w-9 h-9 rounded-xl hover:bg-slate-100 flex items-center justify-center transition-colors">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- 内容区域 -->
    <div id="drawerContent" class="drawer-content flex-1 overflow-y-auto p-6">
        <!-- 具体内容由调用页面填充 -->
    </div>

    <!-- 底部：操作按钮 -->
    <div id="drawerFooter" class="px-6 py-4 border-t border-slate-200 bg-slate-50 shrink-0">
        <div class="flex justify-end gap-3">
            <button onclick="closeDrawer()" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-medium hover:bg-slate-100 transition-colors">
                取消
            </button>
            <button id="drawerSaveBtn" onclick="drawerSave()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold hover:shadow-lg transition-all">
                保存
            </button>
        </div>
    </div>
</div>

<script>
    // 抽屉当前模式
    let currentDrawerMode = 'view';

    /**
     * 打开抽屉
     * @param {string} type - 模式: view(查看详情) | add(新增) | edit(编辑)
     * @param {string} title - 抽屉标题 (可选)
     * @param {number} width - 抽屉宽度 (可选，默认520px)
     */
    function openDrawer(type, title, width) {
        const overlay = document.getElementById('drawerOverlay');
        const panel = document.getElementById('drawerPanel');
        const titleEl = document.getElementById('drawerTitle');
        const footer = document.getElementById('drawerFooter');

        // 设置宽度
        if (width) {
            panel.style.width = width + 'px';
        } else {
            panel.style.width = '520px';
        }

        // 设置模式
        currentDrawerMode = type;

        // 根据模式设置标题和显示底部
        switch(type) {
            case 'view':
                titleEl.textContent = title || '查看详情';
                footer.classList.add('hidden');
                break;
            case 'add':
                titleEl.textContent = title || '新增';
                footer.classList.remove('hidden');
                break;
            case 'edit':
                titleEl.textContent = title || '编辑';
                footer.classList.remove('hidden');
                break;
            default:
                titleEl.textContent = title || '详情';
                footer.classList.remove('hidden');
        }

        // 显示遮罩层
        overlay.classList.remove('hidden');

        // 延迟显示面板以实现动画效果
        setTimeout(() => {
            panel.classList.remove('hidden');
        }, 10);

        // 禁止背景滚动
        document.body.style.overflow = 'hidden';
    }

    /**
     * 关闭抽屉
     */
    function closeDrawer() {
        const overlay = document.getElementById('drawerOverlay');
        const panel = document.getElementById('drawerPanel');

        // 先隐藏面板（带动画）
        panel.classList.add('hidden');

        // 延迟隐藏遮罩层
        setTimeout(() => {
            overlay.classList.add('hidden');
        }, 300);

        // 恢复背景滚动
        document.body.style.overflow = '';
    }

    /**
     * 保存按钮点击事件（由调用页面重写实现）
     */
    function drawerSave() {
        // 由调用页面实现具体保存逻辑
        console.log('drawerSave called, mode:', currentDrawerMode);
    }

    /**
     * 获取当前抽屉模式
     * @returns {string} 当前模式
     */
    function getDrawerMode() {
        return currentDrawerMode;
    }

    /**
     * 设置抽屉内容
     * @param {string} html - HTML内容
     */
    function setDrawerContent(html) {
        document.getElementById('drawerContent').innerHTML = html;
    }

    /**
     * 获取抽屉内容容器
     * @returns {HTMLElement} 内容容器元素
     */
    function getDrawerContent() {
        return document.getElementById('drawerContent');
    }

    /**
     * 设置保存按钮文本
     * @param {string} text - 按钮文本
     */
    function setDrawerSaveText(text) {
        document.getElementById('drawerSaveBtn').textContent = text;
    }

    // ESC键关闭抽屉
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDrawer();
        }
    });
</script>
