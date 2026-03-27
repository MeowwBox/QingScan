/**
 * QingScan 公共UI组件库
 * 使用原生JavaScript编写，兼容jQuery
 * 版本: 1.0.0
 */

(function(global, factory) {
    'use strict';

    if (typeof module === 'object' && typeof module.exports === 'object') {
        module.exports = factory(global);
    } else {
        global.QingScanUI = factory(global);
    }
})(typeof window !== 'undefined' ? window : this, function(window) {
    'use strict';

    // ============================================
    // 私有变量和方法
    // ============================================

    // 配置项
    const config = {
        toastDuration: 3000,
        animationDuration: 300,
        storagePrefix: 'qingscan_'
    };

    // 本地存储封装
    const storage = {
        set: function(key, value) {
            try {
                localStorage.setItem(config.storagePrefix + key, JSON.stringify(value));
            } catch (e) {
                console.warn('localStorage not available');
            }
        },
        get: function(key, defaultValue) {
            try {
                const value = localStorage.getItem(config.storagePrefix + key);
                return value ? JSON.parse(value) : defaultValue;
            } catch (e) {
                return defaultValue;
            }
        },
        remove: function(key) {
            try {
                localStorage.removeItem(config.storagePrefix + key);
            } catch (e) {
                console.warn('localStorage not available');
            }
        }
    };

    // 生成唯一ID
    function generateId() {
        return 'qs_' + Math.random().toString(36).substr(2, 9);
    }

    // 创建DOM元素
    function createElement(tag, className, innerHTML) {
        const el = document.createElement(tag);
        if (className) el.className = className;
        if (innerHTML) el.innerHTML = innerHTML;
        return el;
    }

    // ============================================
    // 1. 侧边栏收起/展开功能
    // ============================================

    let sidebarCollapsed = storage.get('sidebar_collapsed', false);

    /**
     * 切换侧边栏状态
     * @param {boolean} forceCollapse - 可选，强制设置状态
     */
    function toggleSidebar(forceCollapse) {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const icon = document.getElementById('sidebarToggleIcon');

        if (!sidebar) {
            console.warn('Sidebar element not found');
            return;
        }

        // 判断新的折叠状态
        sidebarCollapsed = typeof forceCollapse === 'boolean' ? forceCollapse : !sidebarCollapsed;

        // 切换类名
        if (sidebarCollapsed) {
            sidebar.classList.add('collapsed');
            if (mainContent) mainContent.classList.add('expanded');
        } else {
            sidebar.classList.remove('collapsed');
            if (mainContent) mainContent.classList.remove('expanded');
        }

        // 旋转图标
        if (icon) {
            icon.style.transform = sidebarCollapsed ? 'rotate(90deg)' : 'rotate(0deg)';
        }

        // 保存状态
        storage.set('sidebar_collapsed', sidebarCollapsed);

        // 触发自定义事件
        document.dispatchEvent(new CustomEvent('qingscan:sidebarToggle', {
            detail: { collapsed: sidebarCollapsed }
        }));
    }

    /**
     * 获取侧边栏状态
     * @returns {boolean}
     */
    function isSidebarCollapsed() {
        return sidebarCollapsed;
    }

    /**
     * 初始化侧边栏状态
     */
    function initSidebar() {
        const savedState = storage.get('sidebar_collapsed', false);
        if (savedState) {
            toggleSidebar(true);
        }
    }

    // ============================================
    // 2. 右侧抽屉组件
    // ============================================

    let drawerOpen = false;
    let drawerOnCloseCallback = null;

    /**
     * 打开抽屉
     * @param {string} type - 抽屉类型: 'view', 'add', 'edit' 等
     * @param {object} data - 可选，传递给抽屉的数据
     */
    function openDrawer(type, data) {
        const overlay = document.getElementById('drawerOverlay');
        const panel = document.getElementById('drawerPanel');
        const title = document.getElementById('drawerTitle');
        const formContent = document.getElementById('formContent');
        const viewContent = document.getElementById('viewContent');
        const footer = document.getElementById('drawerFooter');

        if (!overlay || !panel) {
            console.warn('Drawer elements not found');
            return;
        }

        // 存储数据供后续使用
        if (data) {
            panel.dataset.drawerData = JSON.stringify(data);
        }
        panel.dataset.drawerType = type || 'view';

        // 根据类型设置内容
        if (type === 'view') {
            if (title) title.textContent = (data && data.title) || '详情';
            if (formContent) formContent.classList.add('hidden');
            if (viewContent) viewContent.classList.remove('hidden');
            if (footer) footer.classList.add('hidden');
        } else {
            if (title) {
                title.textContent = type === 'add' ? '新增' : (type === 'edit' ? '编辑' : (data && data.title) || '操作');
            }
            if (formContent) formContent.classList.remove('hidden');
            if (viewContent) viewContent.classList.add('hidden');
            if (footer) footer.classList.remove('hidden');
        }

        // 显示抽屉
        overlay.classList.remove('hidden');
        requestAnimationFrame(function() {
            panel.classList.remove('hidden');
        });

        // 禁止背景滚动
        document.body.style.overflow = 'hidden';
        drawerOpen = true;

        // 触发自定义事件
        document.dispatchEvent(new CustomEvent('qingscan:drawerOpen', {
            detail: { type: type, data: data }
        }));
    }

    /**
     * 关闭抽屉
     * @param {boolean} force - 强制关闭（不执行回调）
     */
    function closeDrawer(force) {
        const overlay = document.getElementById('drawerOverlay');
        const panel = document.getElementById('drawerPanel');

        if (!overlay || !panel) return;

        panel.classList.add('hidden');
        setTimeout(function() {
            overlay.classList.add('hidden');
        }, config.animationDuration);

        // 恢复背景滚动
        document.body.style.overflow = '';
        drawerOpen = false;

        // 执行关闭回调
        if (!force && typeof drawerOnCloseCallback === 'function') {
            drawerOnCloseCallback();
            drawerOnCloseCallback = null;
        }

        // 清理数据
        delete panel.dataset.drawerData;
        delete panel.dataset.drawerType;

        // 触发自定义事件
        document.dispatchEvent(new CustomEvent('qingscan:drawerClose'));
    }

    /**
     * 设置抽屉关闭回调
     * @param {function} callback
     */
    function setDrawerCloseCallback(callback) {
        drawerOnCloseCallback = callback;
    }

    /**
     * 获取抽屉数据
     * @returns {object|null}
     */
    function getDrawerData() {
        const panel = document.getElementById('drawerPanel');
        if (panel && panel.dataset.drawerData) {
            try {
                return JSON.parse(panel.dataset.drawerData);
            } catch (e) {
                return null;
            }
        }
        return null;
    }

    /**
     * 获取抽屉类型
     * @returns {string|null}
     */
    function getDrawerType() {
        const panel = document.getElementById('drawerPanel');
        return panel ? panel.dataset.drawerType : null;
    }

    /**
     * 初始化抽屉ESC键关闭
     */
    function initDrawerKeyboard() {
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && drawerOpen) {
                closeDrawer();
            }
        });
    }

    // ============================================
    // 3. 表格交互增强
    // ============================================

    /**
     * 初始化表格全选功能
     * @param {string} tableSelector - 表格选择器
     * @param {string} checkAllSelector - 全选复选框选择器
     * @param {string} rowCheckSelector - 行复选框选择器
     */
    function initTableCheckAll(tableSelector, checkAllSelector, rowCheckSelector) {
        const table = document.querySelector(tableSelector);
        if (!table) return;

        const checkAll = table.querySelector(checkAllSelector || 'thead input[type="checkbox"]');
        const rowChecks = table.querySelectorAll(rowCheckSelector || 'tbody input[type="checkbox"]');

        if (!checkAll) return;

        // 全选/取消全选
        checkAll.addEventListener('change', function() {
            const checked = this.checked;
            rowChecks.forEach(function(checkbox) {
                checkbox.checked = checked;
                // 更新行样式
                const row = checkbox.closest('tr');
                if (row) {
                    row.classList.toggle('bg-primary-light', checked);
                }
            });
            // 触发自定义事件
            table.dispatchEvent(new CustomEvent('qingscan:checkAll', {
                detail: { checked: checked, count: rowChecks.length }
            }));
        });

        // 单个复选框变化
        rowChecks.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const checkedCount = table.querySelectorAll(rowCheckSelector || 'tbody input[type="checkbox"]:checked').length;
                const totalCount = rowChecks.length;

                // 更新全选框状态
                checkAll.checked = checkedCount === totalCount;
                checkAll.indeterminate = checkedCount > 0 && checkedCount < totalCount;

                // 更新行样式
                const row = this.closest('tr');
                if (row) {
                    row.classList.toggle('bg-primary-light', this.checked);
                }

                // 触发自定义事件
                table.dispatchEvent(new CustomEvent('qingscan:rowCheck', {
                    detail: { checkedCount: checkedCount, totalCount: totalCount }
                }));
            });
        });
    }

    /**
     * 获取表格选中行的数据
     * @param {string} tableSelector - 表格选择器
     * @param {string} rowCheckSelector - 行复选框选择器
     * @returns {Array} 选中行的数据ID数组
     */
    function getTableCheckedRows(tableSelector, rowCheckSelector) {
        const table = document.querySelector(tableSelector);
        if (!table) return [];

        const checkedBoxes = table.querySelectorAll((rowCheckSelector || 'tbody input[type="checkbox"]') + ':checked');
        const ids = [];

        checkedBoxes.forEach(function(checkbox) {
            const row = checkbox.closest('tr');
            if (row && row.dataset.id) {
                ids.push(row.dataset.id);
            }
        });

        return ids;
    }

    /**
     * 初始化表格行悬停高亮
     * @param {string} tableSelector - 表格选择器
     */
    function initTableRowHover(tableSelector) {
        const table = document.querySelector(tableSelector);
        if (!table) return;

        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(function(row) {
            row.addEventListener('mouseenter', function() {
                this.classList.add('bg-surface-50');
            });
            row.addEventListener('mouseleave', function() {
                if (!this.querySelector('input[type="checkbox"]:checked')) {
                    this.classList.remove('bg-surface-50');
                }
            });
        });
    }

    /**
     * 批量操作确认
     * @param {string} action - 操作类型
     * @param {string} tableSelector - 表格选择器
     * @param {function} callback - 确认后执行的回调
     */
    function batchOperation(action, tableSelector, callback) {
        const ids = getTableCheckedRows(tableSelector);
        if (ids.length === 0) {
            showToast('请至少选择一项', 'warning');
            return;
        }

        const actionText = {
            'delete': '删除',
            'export': '导出',
            'approve': '审批',
            'reject': '拒绝'
        }[action] || action;

        showConfirm(
            '确认' + actionText,
            '确定要' + actionText + '选中的 ' + ids.length + ' 项记录吗？',
            function() {
                if (typeof callback === 'function') {
                    callback(ids);
                }
            }
        );
    }

    // ============================================
    // 4. 消息提示组件
    // ============================================

    let toastContainer = null;

    /**
     * 显示Toast消息
     * @param {string} message - 消息内容
     * @param {string} type - 类型: 'success', 'error', 'warning', 'info'
     * @param {number} duration - 显示时长(毫秒)，默认3000
     */
    function showToast(message, type, duration) {
        type = type || 'info';
        duration = duration || config.toastDuration;

        // 确保容器存在
        if (!toastContainer) {
            toastContainer = createElement('div', 'qingscan-toast-container');
            toastContainer.style.cssText = 'position:fixed;top:20px;right:20px;z-index:9999;display:flex;flex-direction:column;gap:10px;';
            document.body.appendChild(toastContainer);
        }

        // 创建Toast元素
        const toast = createElement('div', 'qingscan-toast qingscan-toast-' + type);

        // 类型对应的图标和颜色
        const typeConfig = {
            success: {
                icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>',
                bg: 'bg-emerald-50',
                border: 'border-emerald-200',
                text: 'text-emerald-700'
            },
            error: {
                icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>',
                bg: 'bg-red-50',
                border: 'border-red-200',
                text: 'text-red-700'
            },
            warning: {
                icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
                bg: 'bg-amber-50',
                border: 'border-amber-200',
                text: 'text-amber-700'
            },
            info: {
                icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                bg: 'bg-blue-50',
                border: 'border-blue-200',
                text: 'text-blue-700'
            }
        };

        const tc = typeConfig[type] || typeConfig.info;

        toast.style.cssText = 'display:flex;align-items:center;gap:12px;padding:16px 20px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.1);animation:slideIn 0.3s ease;max-width:400px;';
        toast.className = tc.bg + ' ' + tc.border + ' border';

        toast.innerHTML = '<span class="' + tc.text + '">' + tc.icon + '</span>' +
            '<span class="' + tc.text + ' font-medium">' + message + '</span>' +
            '<button class="ml-auto ' + tc.text + ' hover:opacity-70" onclick="this.parentElement.remove()">' +
            '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>' +
            '</button>';

        // 添加动画样式
        if (!document.getElementById('qingscan-toast-style')) {
            const style = createElement('style', '', '@keyframes slideIn{from{opacity:0;transform:translateX(100%)}to{opacity:1;transform:translateX(0)}}@keyframes slideOut{from{opacity:1;transform:translateX(0)}to{opacity:0;transform:translateX(100%)}}');
            style.id = 'qingscan-toast-style';
            document.head.appendChild(style);
        }

        toastContainer.appendChild(toast);

        // 自动移除
        setTimeout(function() {
            toast.style.animation = 'slideOut 0.3s ease forwards';
            setTimeout(function() {
                toast.remove();
            }, 300);
        }, duration);

        // 触发自定义事件
        document.dispatchEvent(new CustomEvent('qingscan:toast', {
            detail: { message: message, type: type }
        }));
    }

    // 快捷方法
    const toast = {
        success: function(message, duration) {
            showToast(message, 'success', duration);
        },
        error: function(message, duration) {
            showToast(message, 'error', duration);
        },
        warning: function(message, duration) {
            showToast(message, 'warning', duration);
        },
        info: function(message, duration) {
            showToast(message, 'info', duration);
        }
    };

    // ============================================
    // 5. 确认对话框
    // ============================================

    /**
     * 显示确认对话框
     * @param {string} title - 标题
     * @param {string} message - 消息内容
     * @param {function} onConfirm - 确认回调
     * @param {function} onCancel - 取消回调（可选）
     */
    function showConfirm(title, message, onConfirm, onCancel) {
        // 创建遮罩层
        const overlay = createElement('div', 'qingscan-confirm-overlay');
        overlay.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:9998;display:flex;align-items:center;justify-content:center;animation:fadeIn 0.2s ease;';

        // 创建对话框
        const dialog = createElement('div', 'qingscan-confirm-dialog');
        dialog.style.cssText = 'background:white;border-radius:16px;padding:24px;max-width:400px;width:90%;box-shadow:0 20px 50px rgba(0,0,0,0.2);animation:scaleIn 0.2s ease;';

        dialog.innerHTML =
            '<div class="text-lg font-bold text-gray-800 mb-2">' + (title || '确认') + '</div>' +
            '<div class="text-gray-600 mb-6">' + (message || '确定要执行此操作吗？') + '</div>' +
            '<div class="flex justify-end gap-3">' +
            '<button class="cancel-btn px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors">取消</button>' +
            '<button class="confirm-btn px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold hover:shadow-lg transition-all">确认</button>' +
            '</div>';

        // 添加动画样式
        if (!document.getElementById('qingscan-confirm-style')) {
            const style = createElement('style', '', '@keyframes scaleIn{from{opacity:0;transform:scale(0.9)}to{opacity:1;transform:scale(1)}}@keyframes fadeIn{from{opacity:0}to{opacity:1}}');
            style.id = 'qingscan-confirm-style';
            document.head.appendChild(style);
        }

        overlay.appendChild(dialog);
        document.body.appendChild(overlay);

        // 禁止背景滚动
        document.body.style.overflow = 'hidden';

        // 关闭函数
        function close() {
            overlay.style.animation = 'fadeIn 0.2s ease reverse';
            setTimeout(function() {
                overlay.remove();
            }, 200);
            document.body.style.overflow = '';
        }

        // 确认按钮
        dialog.querySelector('.confirm-btn').addEventListener('click', function() {
            close();
            if (typeof onConfirm === 'function') {
                onConfirm();
            }
        });

        // 取消按钮
        dialog.querySelector('.cancel-btn').addEventListener('click', function() {
            close();
            if (typeof onCancel === 'function') {
                onCancel();
            }
        });

        // 点击遮罩层关闭
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                close();
                if (typeof onCancel === 'function') {
                    onCancel();
                }
            }
        });

        // ESC键关闭
        function handleEsc(e) {
            if (e.key === 'Escape') {
                close();
                document.removeEventListener('keydown', handleEsc);
                if (typeof onCancel === 'function') {
                    onCancel();
                }
            }
        }
        document.addEventListener('keydown', handleEsc);

        // 触发自定义事件
        document.dispatchEvent(new CustomEvent('qingscan:confirmShow', {
            detail: { title: title, message: message }
        }));
    }

    /**
     * 显示警告确认对话框（红色确认按钮）
     * @param {string} title - 标题
     * @param {string} message - 消息内容
     * @param {function} onConfirm - 确认回调
     */
    function showDangerConfirm(title, message, onConfirm) {
        // 创建遮罩层
        const overlay = createElement('div', 'qingscan-confirm-overlay');
        overlay.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:9998;display:flex;align-items:center;justify-content:center;';

        const dialog = createElement('div', 'qingscan-confirm-dialog');
        dialog.style.cssText = 'background:white;border-radius:16px;padding:24px;max-width:400px;width:90%;box-shadow:0 20px 50px rgba(0,0,0,0.2);';

        dialog.innerHTML =
            '<div class="flex items-center gap-3 mb-4">' +
            '<div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">' +
            '<svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>' +
            '</div>' +
            '<div class="text-lg font-bold text-gray-800">' + (title || '危险操作') + '</div>' +
            '</div>' +
            '<div class="text-gray-600 mb-6 pl-[52px]">' + (message || '此操作不可撤销，确定要继续吗？') + '</div>' +
            '<div class="flex justify-end gap-3">' +
            '<button class="cancel-btn px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors">取消</button>' +
            '<button class="confirm-btn px-5 py-2.5 rounded-xl bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold hover:shadow-lg transition-all">确认删除</button>' +
            '</div>';

        overlay.appendChild(dialog);
        document.body.appendChild(overlay);
        document.body.style.overflow = 'hidden';

        function close() {
            overlay.remove();
            document.body.style.overflow = '';
        }

        dialog.querySelector('.confirm-btn').addEventListener('click', function() {
            close();
            if (typeof onConfirm === 'function') {
                onConfirm();
            }
        });

        dialog.querySelector('.cancel-btn').addEventListener('click', close);
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) close();
        });
    }

    // ============================================
    // 6. 页面加载动画
    // ============================================

    let loadingCount = 0;

    /**
     * 显示加载动画
     * @param {string} message - 可选，加载提示文字
     */
    function showLoading(message) {
        loadingCount++;

        // 检查是否已存在
        let loading = document.getElementById('qingscan-loading');
        if (loading) {
            if (message) {
                const textEl = loading.querySelector('.loading-text');
                if (textEl) textEl.textContent = message;
            }
            return;
        }

        loading = createElement('div', '', 'id="qingscan-loading"');
        loading.style.cssText = 'position:fixed;inset:0;background:rgba(255,255,255,0.9);z-index:9999;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:16px;';

        loading.innerHTML =
            '<div class="loading-spinner" style="width:48px;height:48px;border:4px solid #e2e8f0;border-top-color:#3b82f6;border-radius:50%;animation:spin 1s linear infinite;"></div>' +
            '<div class="loading-text text-gray-600 font-medium">' + (message || '加载中...') + '</div>';

        // 添加动画样式
        if (!document.getElementById('qingscan-loading-style')) {
            const style = createElement('style', '', '@keyframes spin{to{transform:rotate(360deg)}}');
            style.id = 'qingscan-loading-style';
            document.head.appendChild(style);
        }

        document.body.appendChild(loading);
    }

    /**
     * 隐藏加载动画
     */
    function hideLoading() {
        loadingCount = Math.max(0, loadingCount - 1);
        if (loadingCount > 0) return;

        const loading = document.getElementById('qingscan-loading');
        if (loading) {
            loading.style.opacity = '0';
            loading.style.transition = 'opacity 0.3s ease';
            setTimeout(function() {
                loading.remove();
            }, 300);
        }
        loadingCount = 0;
    }

    /**
     * 强制隐藏加载动画
     */
    function forceHideLoading() {
        loadingCount = 0;
        hideLoading();
    }

    // ============================================
    // 7. 自动高度文本框
    // ============================================

    /**
     * 初始化自动高度文本框
     * @param {string|Element} selector - 选择器或元素
     */
    function initAutoResizeTextarea(selector) {
        const elements = typeof selector === 'string'
            ? document.querySelectorAll(selector)
            : [selector];

        elements.forEach(function(textarea) {
            if (!textarea || textarea.tagName !== 'TEXTAREA') return;

            // 设置初始样式
            textarea.style.resize = 'none';
            textarea.style.overflow = 'hidden';

            // 定义调整函数
            function adjustHeight() {
                textarea.style.height = 'auto';
                textarea.style.height = textarea.scrollHeight + 'px';
            }

            // 绑定事件
            textarea.addEventListener('input', adjustHeight);
            textarea.addEventListener('focus', adjustHeight);

            // 初始调整
            adjustHeight();

            // 存储调整函数以便后续调用
            textarea._qingscanAutoResize = adjustHeight;
        });
    }

    /**
     * 更新文本框高度
     * @param {Element} textarea - 文本框元素
     */
    function updateTextareaHeight(textarea) {
        if (textarea && typeof textarea._qingscanAutoResize === 'function') {
            textarea._qingscanAutoResize();
        }
    }

    // ============================================
    // 8. 子菜单切换
    // ============================================

    /**
     * 切换子菜单
     * @param {Element} element - 触发元素
     */
    function toggleSubmenu(element) {
        const arrow = element.querySelector('.menu-arrow');
        const submenu = element.nextElementSibling;

        if (submenu && submenu.classList.contains('submenu')) {
            submenu.classList.toggle('hidden');
            if (arrow) {
                arrow.style.transform = submenu.classList.contains('hidden') ? '' : 'rotate(180deg)';
            }
        }
    }

    /**
     * 初始化所有子菜单
     */
    function initSubmenus() {
        document.querySelectorAll('.menu-group > .menu-item').forEach(function(item) {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                toggleSubmenu(this);
            });
        });
    }

    // ============================================
    // 9. 导航菜单切换
    // ============================================

    /**
     * 初始化导航切换
     */
    function initNavigation() {
        // 顶部导航 - 仅切换激活状态，不阻止默认跳转行为
        document.querySelectorAll('.nav-item').forEach(function(item) {
            item.addEventListener('click', function(e) {
                // 移除所有 nav-item 的激活状态
                document.querySelectorAll('.nav-item').forEach(function(i) {
                    i.classList.remove('active');
                });
                // 为当前点击项添加激活状态
                this.classList.add('active');
                // 注意：不调用 e.preventDefault()，允许链接正常跳转
            });
        });

        // 侧边栏菜单
        document.querySelectorAll('.menu-item').forEach(function(item) {
            if (!item.onclick) {
                item.addEventListener('click', function(e) {
                    // 如果有子菜单，不处理
                    if (this.nextElementSibling && this.nextElementSibling.classList.contains('submenu')) {
                        return;
                    }
                    // 只有当 href 为空或为 # 时才阻止默认行为
                    var href = this.getAttribute('href');
                    if (!href || href === '#' || href === 'javascript:void(0)') {
                        e.preventDefault();
                    }
                    document.querySelectorAll('.menu-item').forEach(function(i) {
                        i.classList.remove('bg-primary-light', 'text-primary', 'font-semibold');
                    });
                    this.classList.add('bg-primary-light', 'text-primary', 'font-semibold');
                });
            }
        });
    }

    // ============================================
    // 10. 工具函数
    // ============================================

    /**
     * 防抖函数
     * @param {function} fn - 要执行的函数
     * @param {number} delay - 延迟时间（毫秒）
     * @returns {function}
     */
    function debounce(fn, delay) {
        let timer = null;
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function() {
                fn.apply(context, args);
            }, delay);
        };
    }

    /**
     * 节流函数
     * @param {function} fn - 要执行的函数
     * @param {number} interval - 间隔时间（毫秒）
     * @returns {function}
     */
    function throttle(fn, interval) {
        let lastTime = 0;
        return function() {
            const context = this;
            const args = arguments;
            const now = Date.now();
            if (now - lastTime >= interval) {
                lastTime = now;
                fn.apply(context, args);
            }
        };
    }

    /**
     * 格式化日期
     * @param {Date|string|number} date - 日期
     * @param {string} format - 格式，默认 'YYYY-MM-DD HH:mm:ss'
     * @returns {string}
     */
    function formatDate(date, format) {
        format = format || 'YYYY-MM-DD HH:mm:ss';
        const d = new Date(date);

        const pad = function(n) {
            return n < 10 ? '0' + n : n;
        };

        return format
            .replace('YYYY', d.getFullYear())
            .replace('MM', pad(d.getMonth() + 1))
            .replace('DD', pad(d.getDate()))
            .replace('HH', pad(d.getHours()))
            .replace('mm', pad(d.getMinutes()))
            .replace('ss', pad(d.getSeconds()));
    }

    /**
     * 复制文本到剪贴板
     * @param {string} text - 要复制的文本
     * @returns {Promise}
     */
    function copyToClipboard(text) {
        return new Promise(function(resolve, reject) {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text).then(resolve).catch(reject);
            } else {
                const textarea = document.createElement('textarea');
                textarea.value = text;
                textarea.style.position = 'fixed';
                textarea.style.opacity = '0';
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    document.execCommand('copy');
                    resolve();
                } catch (e) {
                    reject(e);
                }
                textarea.remove();
            }
        });
    }

    // ============================================
    // 初始化
    // ============================================

    /**
     * 初始化所有组件
     */
    function init() {
        initSidebar();
        initDrawerKeyboard();
        initSubmenus();
        initNavigation();
    }

    // DOM Ready 时自动初始化
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // ============================================
    // 公开API
    // ============================================

    return {
        // 版本
        version: '1.0.0',

        // 侧边栏
        toggleSidebar: toggleSidebar,
        isSidebarCollapsed: isSidebarCollapsed,
        initSidebar: initSidebar,

        // 抽屉
        openDrawer: openDrawer,
        closeDrawer: closeDrawer,
        setDrawerCloseCallback: setDrawerCloseCallback,
        getDrawerData: getDrawerData,
        getDrawerType: getDrawerType,

        // 表格
        initTableCheckAll: initTableCheckAll,
        getTableCheckedRows: getTableCheckedRows,
        initTableRowHover: initTableRowHover,
        batchOperation: batchOperation,

        // 消息提示
        showToast: showToast,
        toast: toast,

        // 确认框
        showConfirm: showConfirm,
        showDangerConfirm: showDangerConfirm,

        // 加载动画
        showLoading: showLoading,
        hideLoading: hideLoading,
        forceHideLoading: forceHideLoading,

        // 文本框
        initAutoResizeTextarea: initAutoResizeTextarea,
        updateTextareaHeight: updateTextareaHeight,

        // 菜单
        toggleSubmenu: toggleSubmenu,
        initSubmenus: initSubmenus,
        initNavigation: initNavigation,

        // 工具函数
        debounce: debounce,
        throttle: throttle,
        formatDate: formatDate,
        copyToClipboard: copyToClipboard,

        // 存储
        storage: storage,

        // 初始化
        init: init
    };
});
