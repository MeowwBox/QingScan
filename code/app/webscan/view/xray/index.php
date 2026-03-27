{include file='public/head' /}
{include file='public/blackLeftMenu' /}

<?php
$dengjiArr = ['Low', 'Medium', 'High', 'Critical'];
?>
<?php
$searchArr = [
    'action' => $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'placeholder' => '搜索关键字', 'label' => '关键字'],
        ['type' => 'select', 'name' => 'Category', 'options' => $CategoryList, 'frist_option' => '全部类别', 'label' => '类别'],
        ['type' => 'select', 'name' => 'app_id', 'options' => $projectList, 'frist_option' => '全部项目', 'label' => '所属项目'],
        ['type' => 'select', 'name' => 'check_status', 'options' => $check_status_list, 'frist_option' => '全部状态', 'frist_option_value' => -1, 'label' => '审计状态'],
    ],
    'btnArr' => []
]; ?>

    <!-- 主内容区域 -->
    <div class="p-6 bg-surface-100 min-h-screen font-sans">

        <!-- 页面标题 -->
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold text-text-primary mb-2">XRAY漏洞列表</h1>
                <nav class="flex gap-2 text-sm text-text-secondary">
                    <a href="<?php echo url('index/index') ?>" class="hover:text-primary transition-colors">首页</a>
                    <span class="text-text-muted">/</span>
                    <a href="#" class="hover:text-primary transition-colors">Web扫描</a>
                    <span class="text-text-muted">/</span>
                    <span class="text-text-primary font-medium">XRAY漏洞列表</span>
                </nav>
            </div>
        </div>

        <!-- 搜索区域 -->
        <div class="bg-white border border-surface-300 rounded-2xl p-5 mb-6 shadow-card">
            {include file='public/search' /}
        </div>

        <!-- 表格区域 -->
    <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card">
        <!-- 表头 -->
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <div class="flex items-center gap-3">
                <h2 class="text-lg font-bold text-text-primary">XRAY漏洞列表</h2>
                <span class="bg-primary text-white text-xs px-2.5 py-1 rounded-full font-medium"><?php echo count($list) ?></span>
            </div>
            <div class="flex gap-2">
                {include file='public/batch_del' /}
            </div>
        </div>

        <!-- 表格 -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-surface-100">
                        <th class="w-16 px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" value="-1" onclick="quanxuan(this)" class="w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20 cursor-pointer">
                                全选
                            </label>
                        </th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">所属项目</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">漏洞类型</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">URL地址</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">创建时间</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">状态</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider w-[150px]">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($list as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" class="ids w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20 cursor-pointer" name="ids[]" value="<?php echo $value['id'] ?>">
                            </label>
                        </td>
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo isset($projectList[$value['app_id']]) ? $projectList[$value['app_id']] : '' ?></td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-50 text-red-600 border border-red-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                <?php echo $value['plugin'] ?? '' ?>
                            </span>
                        </td>
                        <?php $targetInfo = json_decode($value['target'] ?? '', true); ?>
                        <td class="px-5 py-4 text-text-secondary text-sm truncate max-w-[300px]" title="<?php echo $targetInfo['url'] ?? '' ?>"><?php echo $targetInfo['url'] ?? '' ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo !empty($value['create_time']) ? date('Y-m-d H:i:s', (int)substr($value['create_time'], 0, 10)) : '' ?></td>
                        <td class="px-5 py-4">
                            <select class="changCheckStatus bg-surface-100 border border-surface-300 rounded-xl px-3 py-2 text-sm text-text-primary focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none transition-all" data-id="<?php echo $value['id'] ?>">
                                <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?> class="text-text-secondary">未审核</option>
                                <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?> class="text-emerald-600">有效漏洞</option>
                                <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?> class="text-red-600">无效漏洞</option>
                            </select>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex gap-1">
                                <a href="<?php echo url('xray/details', ['id' => $value['id']]) ?>" class="w-9 h-9 rounded-xl bg-surface-100 text-primary hover:bg-primary-light transition-colors flex items-center justify-center" title="查看漏洞">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="<?php echo url('xray/del', ['id' => $value['id']]) ?>" class="w-9 h-9 rounded-xl bg-surface-100 text-red-500 hover:bg-red-50 transition-colors flex items-center justify-center" title="删除">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if (empty($list)) { ?>
                    <tr>
                        <td colspan="8" class="px-5 py-12 text-center text-text-muted">暂无漏洞数据</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- 分页 -->
        <div class="px-5 py-4 border-t border-surface-200 bg-surface-50 flex justify-between items-center">
            {include file='public/fenye' /}
        </div>
        </div>
    </div>

    <input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/xray') ?>">
    {include file='public/to_examine' /}

{include file='public/footer' /}
