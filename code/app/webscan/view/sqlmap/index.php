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
        ['type' => 'text', 'name' => 'search', 'placeholder' => "搜索关键字"],
        ['type' => 'select', 'name' => 'app_id', 'options' => $projectList, 'frist_option' => '项目列表'],
    ]];
?>
    <!-- 主内容区域 -->
    <div class="p-6 bg-surface-100 min-h-screen font-sans">
        <!-- 页面标题 -->
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold text-text-primary mb-2">SQL注入扫描结果</h1>
                <nav class="flex gap-2 text-sm text-text-secondary">
                    <a href="#" class="hover:text-primary transition-colors">首页</a>
                    <span class="text-text-muted">/</span>
                    <a href="#" class="hover:text-primary transition-colors">Web扫描</a>
                    <span class="text-text-muted">/</span>
                    <span class="text-text-primary font-medium">SQLMap</span>
                </nav>
            </div>
        </div>

        <!-- 搜索区域 -->
        {include file='public/search' /}

        <div class="bg-white border border-surface-300 rounded-2xl overflow-hidden shadow-card">
        <!-- 表头 -->
        <div class="flex justify-between items-center px-5 py-4 border-b border-surface-200 bg-surface-50">
            <div class="flex items-center gap-3">
                <h2 class="text-lg font-bold text-text-primary">SQL注入扫描结果</h2>
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
                        <th class="w-16 px-5 py-4 text-left">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" value="-1" onclick="quanxuan(this)" class="w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20">
                                <span class="text-xs font-semibold text-text-secondary uppercase tracking-wider">全选</span>
                            </label>
                        </th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">ID</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">所属项目</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">漏洞地址</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">漏洞类型</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">Title</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">Payload</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">DBMS</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">Application</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">时间</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-200">
                    <?php foreach ($list as $value) { ?>
                    <tr class="hover:bg-surface-50 transition-colors">
                        <td class="px-5 py-4">
                            <input type="checkbox" class="ids w-4 h-4 rounded border-surface-400 text-primary focus:ring-primary/20 cursor-pointer" name="ids[]" value="<?php echo $value['id'] ?>">
                        </td>
                        <td class="px-5 py-4 font-semibold text-text-primary"><?php echo $value['id'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo isset($projectList[$value['app_id']]) ? $projectList[$value['app_id']] : '' ?></td>
                        <td class="px-5 py-4 text-text-primary max-w-xs truncate" title="<?php echo htmlspecialchars($value['url']) ?>"><?php echo $value['url'] ?></td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold bg-red-50 text-red-600 border border-red-100">
                                <?php echo $value['type'] ?>
                            </span>
                        </td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['title'] ?></td>
                        <td class="px-5 py-4 text-text-secondary font-mono text-xs bg-surface-100 px-2 py-1 rounded max-w-xs truncate"><?php echo $value['payload'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['dbms'] ?></td>
                        <td class="px-5 py-4 text-text-secondary"><?php echo $value['application'] ?></td>
                        <td class="px-5 py-4 text-text-secondary text-sm"><?php echo $value['create_time'] ?></td>
                        <td class="px-5 py-4">
                            <div class="flex gap-1">
                                <a href="<?php echo url('del',['id'=>$value['id']])?>" class="w-9 h-9 rounded-xl bg-surface-100 text-red-500 hover:bg-red-50 transition-colors flex items-center justify-center" title="删除" onclick="return confirm('确定要删除吗？')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- 分页 -->
        <div class="px-5 py-4 border-t border-surface-200 bg-surface-50">
            {include file='public/fenye' /}
        </div>
        </div>
    </div>

    <input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/xray')?>">
    {include file='public/to_examine' /}

{include file='public/footer' /}
