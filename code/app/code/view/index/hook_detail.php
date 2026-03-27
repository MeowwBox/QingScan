{include file='public/head' /}
{include file='public/whiteLeftMenu' /}

<!-- 页面标题 -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-text-primary mb-2">Hook 详情</h1>
            <nav class="flex gap-2 text-sm text-text-secondary">
                <a href="<?php echo url('code/index') ?>" class="hover:text-primary transition-colors">代码审计</a>
                <span class="text-text-muted">/</span>
                <a href="<?php echo url('code_check/hooks') ?>" class="hover:text-primary transition-colors">Hooks 提交记录</a>
                <span class="text-text-muted">/</span>
                <span class="text-text-primary font-medium">详情</span>
            </nav>
        </div>

        <!-- 详情表格 -->
        <div class="bg-white border border-surface-300 rounded-2xl shadow-card overflow-hidden">
            <div class="px-6 py-4 border-b border-surface-200 bg-surface-50">
                <h3 class="text-lg font-bold text-text-primary">详细信息</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-surface-100">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider w-32">字段</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-text-secondary uppercase tracking-wider">内容</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-200">
                        <?php foreach ($detail as $key => $value) { ?>
                        <tr class="hover:bg-surface-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-medium text-text-secondary bg-surface-50"><?php echo $key ?></td>
                            <td class="px-6 py-4 text-sm text-text-primary">
                                <?php
                                if ($key == 'results') {
                                    foreach ($value as $k => $v) {
                                        echo '<div class="mb-4 p-4 bg-surface-50 rounded-xl">';
                                        dump($v);
                                        echo '</div>';
                                    }
                                } else {
                                    echo '<span class="font-mono">' . htmlspecialchars($value) . '</span>';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

{include file='public/footer' /}
