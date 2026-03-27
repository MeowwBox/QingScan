<!-- 工具列表抽屉 -->
<div id="toolsDrawerOverlay" class="fixed inset-0 bg-black/30 z-50 opacity-0 invisible transition-opacity duration-300" onclick="closeToolsDrawer()"></div>
<div id="toolsDrawerPanel" class="fixed top-0 right-0 h-full w-[520px] bg-white shadow-[-8px_0_30px_rgba(0,0,0,0.1)] z-50 flex flex-col transform translate-x-full transition-transform duration-300">
    <!-- 抽屉头部 -->
    <div class="flex items-center justify-between px-6 py-5 border-b border-slate-200">
        <h3 class="text-lg font-bold text-slate-800">工具列表</h3>
        <button type="button" onclick="closeToolsDrawer()" class="w-9 h-9 rounded-xl hover:bg-slate-100 flex items-center justify-center transition-colors">
            <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- 抽屉内容 -->
    <form method="post" action="<?= url("process_safe/edit_tools") ?>" class="flex-1 flex flex-col">
        <div class="flex-1 overflow-y-auto px-6 py-5">
            <input type="hidden" name="type" id="tools_type" value="1">
            <input type="hidden" name="project_id" id="tools_project_id" value="0">
            <div class="mb-5">
                <label class="block text-sm font-medium text-slate-700 mb-2">项目名称</label>
                <div id="tools_name" class="text-blue-600 font-semibold text-lg"></div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-3">需要调用的工具</label>
                <div class="grid grid-cols-2 gap-3">
                    <?php
                    foreach ($tools_list as $k=>$v) {
                    ?>
                    <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 hover:border-blue-300 hover:bg-blue-50 cursor-pointer transition-all">
                        <input type="checkbox" name="tools[]" class="tools-checkbox w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500" value="<?php echo $k;?>">
                        <span class="text-sm text-slate-700"><?php echo $v;?></span>
                    </label>
                    <?php }?>
                </div>
            </div>
        </div>

        <!-- 抽屉底部 -->
        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
            <button type="submit" class="w-full px-5 py-3 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold hover:shadow-lg transition-all">
                提交
            </button>
        </div>
    </form>
</div>

<script>
    function tools(id, name, type) {
        document.getElementById('tools_project_id').value = id;
        document.getElementById('tools_type').value = type;
        document.getElementById('tools_name').innerHTML = name;

        $.ajax({
            type: "get",
            url: "<?php echo url('process_safe/tools')?>",
            data: {project_id: id, type: type},
            dataType: "json",
            success: function (res) {
                document.querySelectorAll('.tools-checkbox').forEach(function(item) {
                    var value = item.value;
                    var label = item.closest('label');
                    if (res.data && res.data.includes(value)) {
                        item.checked = true;
                        label.classList.add('border-blue-500', 'bg-blue-50');
                    } else {
                        item.checked = false;
                        label.classList.remove('border-blue-500', 'bg-blue-50');
                    }
                });
                openToolsDrawer();
            }
        });
    }

    function openToolsDrawer() {
        var overlay = document.getElementById('toolsDrawerOverlay');
        var panel = document.getElementById('toolsDrawerPanel');

        overlay.classList.remove('opacity-0', 'invisible');
        overlay.classList.add('opacity-100', 'visible');
        panel.classList.remove('translate-x-full');
        panel.classList.add('translate-x-0');
        document.body.style.overflow = 'hidden';
    }

    function closeToolsDrawer() {
        var overlay = document.getElementById('toolsDrawerOverlay');
        var panel = document.getElementById('toolsDrawerPanel');

        panel.classList.remove('translate-x-0');
        panel.classList.add('translate-x-full');
        setTimeout(function() {
            overlay.classList.remove('opacity-100', 'visible');
            overlay.classList.add('opacity-0', 'invisible');
        }, 300);
        document.body.style.overflow = '';
    }

    // 添加复选框状态变化时的视觉反馈
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('tools-checkbox')) {
            var label = e.target.closest('label');
            if (e.target.checked) {
                label.classList.add('border-blue-500', 'bg-blue-50');
            } else {
                label.classList.remove('border-blue-500', 'bg-blue-50');
            }
        }
    });

    // ESC键关闭抽屉
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeToolsDrawer();
        }
    });
</script>
