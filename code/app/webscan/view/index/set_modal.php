<!-- 抽屉式弹窗 -->
<div id="setModalOverlay" class="fixed inset-0 bg-black/30 z-50 hidden" onclick="closeSetModal()"></div>
<div id="setModalPanel" class="fixed top-0 right-0 h-full w-[680px] bg-white shadow-[-8px_0_30px_rgba(0,0,0,0.1)] z-50 flex flex-col transform translate-x-full transition-transform duration-300">
    <div class="flex items-center justify-between px-6 py-5 border-b border-slate-200">
        <h3 class="text-lg font-bold text-slate-800">爬虫规则设置</h3>
        <button onclick="closeSetModal()" class="w-9 h-9 rounded-xl hover:bg-slate-100 flex items-center justify-center transition-colors">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <form method="post" action="/index.php?s=app/_add" class="flex-1 overflow-y-auto p-6">
        <div class="space-y-6">
            <!-- 请求头配置 -->
            <div>
                <h4 class="text-base font-semibold text-slate-800 mb-4">请求头配置</h4>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">请求User-Agent配置</label>
                        <input type="text" name="request-config[user-agent]" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all" placeholder="请求user-agent配置" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            请求Header配置
                            <button type="button" class="ml-2 text-blue-500 hover:text-blue-600 add-copy-dom text-xs">+ 添加</button>
                        </label>
                        <div class="copy-dom space-y-2">
                            <div class="flex gap-2">
                                <input type="text" name="request-config[headers][key][]" class="flex-1 bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all text-sm" placeholder="key" required>
                                <input type="text" name="request-config[headers][value][]" class="flex-1 bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all text-sm" placeholder="value" required>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            请求Cookie配置
                            <button type="button" class="ml-2 text-blue-500 hover:text-blue-600 add-copy-dom text-xs">+ 添加</button>
                        </label>
                        <div class="copy-dom space-y-2">
                            <div class="flex gap-2">
                                <input type="text" name="request-config[cookies][key][]" class="flex-1 bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all text-sm" placeholder="key" required>
                                <input type="text" name="request-config[cookies][value][]" class="flex-1 bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all text-sm" placeholder="value" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 爬取URL限制 -->
            <div>
                <h4 class="text-base font-semibold text-slate-800 mb-4">爬取URL限制</h4>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            不允许的文件后缀
                            <button type="button" class="ml-2 text-blue-500 hover:text-blue-600 add-copy-dom text-xs">+ 添加</button>
                        </label>
                        <div class="copy-dom space-y-2">
                            <input type="text" name="restrictions-on-urls[disallowed-suffix][]" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all text-sm" placeholder="不允许的文件后缀">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            不允许的URL关键字
                            <button type="button" class="ml-2 text-blue-500 hover:text-blue-600 add-copy-dom text-xs">+ 添加</button>
                        </label>
                        <div class="copy-dom space-y-2">
                            <input type="text" name="restrictions-on-urls[disallowed-keywords-in-path-and-query][]" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all text-sm" placeholder="不允许的URL关键字">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            不允许的域名
                            <button type="button" class="ml-2 text-blue-500 hover:text-blue-600 add-copy-dom text-xs">+ 添加</button>
                        </label>
                        <div class="copy-dom space-y-2">
                            <input type="text" name="restrictions-on-urls[disallowed-domain][]" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all text-sm" placeholder="不允许的域名">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            不允许的URL（正则）
                            <button type="button" class="ml-2 text-blue-500 hover:text-blue-600 add-copy-dom text-xs">+ 添加</button>
                        </label>
                        <div class="copy-dom space-y-2">
                            <input type="text" name="restrictions-on-urls[disallowed-urls][]" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all text-sm font-mono" placeholder="不允许的URL（正则）">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            允许的URL（正则）
                            <button type="button" class="ml-2 text-blue-500 hover:text-blue-600 add-copy-dom text-xs">+ 添加</button>
                        </label>
                        <div class="copy-dom space-y-2">
                            <input type="text" name="restrictions-on-urls[allowed-urls][]" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all text-sm font-mono" placeholder="允许的URL（正则）">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 请求行为限制 -->
            <div>
                <h4 class="text-base font-semibold text-slate-800 mb-4">请求行为限制</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">最大页面并发 <span class="text-slate-400 font-normal">(不大于10)</span></label>
                        <input type="number" name="restrictions-on-requests[max-concurrent]" max="10" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all text-sm" placeholder="最大页面并发" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">最大页面深度限制</label>
                        <input type="number" name="restrictions-on-requests[max-depth]" max="10" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all text-sm" placeholder="最大页面深度限制" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">最大点击深度限制</label>
                        <input type="number" name="restrictions-on-requests[max-click-depth]" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all text-sm" placeholder="一个页面中最大点击深度限制" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">最多爬取页面数量</label>
                        <input type="number" name="restrictions-on-requests[max-count-of-page]" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all text-sm" placeholder="最多爬取的页面数量限制" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">最大点击/事件触发次数 <span class="text-slate-400 font-normal">(不大于10000)</span></label>
                        <input type="number" name="restrictions-on-requests[max-click-or-event-trigger]" max="10000" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all text-sm" placeholder="单个页面中最大点击或事件触发次数" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">点击间隔 <span class="text-slate-400 font-normal">(毫秒)</span></label>
                        <input type="number" name="restrictions-on-requests[click-or-event-interval]" class="w-full bg-slate-50 border border-slate-300 rounded-xl px-4 py-2.5 text-slate-800 placeholder-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all text-sm" placeholder="点击间隔，单位毫秒" required>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="px-6 py-4 border-t border-slate-200 bg-slate-50 flex justify-end gap-3">
        <button type="button" onclick="closeSetModal()" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-medium hover:bg-white transition-colors">关闭</button>
        <button type="submit" form="setModalForm" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold hover:shadow-lg transition-all">提交</button>
    </div>
</div>

<script>
    function openSetModal() {
        document.getElementById('setModalOverlay').classList.remove('hidden');
        setTimeout(() => {
            document.getElementById('setModalPanel').classList.remove('translate-x-full');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    function closeSetModal() {
        document.getElementById('setModalPanel').classList.add('translate-x-full');
        setTimeout(() => {
            document.getElementById('setModalOverlay').classList.add('hidden');
        }, 300);
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSetModal();
        }
    });

    $(document).on('click', '.add-copy-dom', function() {
        var $parent = $(this).parent().next('.copy-dom');
        var $clone = $parent.find('> div:first-child, > input:first-child').first().clone();
        $clone.val('');
        $parent.append($clone.prop('outerHTML'));
    });
</script>
