<div class="bg-white border-b border-surface-300 px-4 py-3">
    <div class="flex gap-2">
        <a href="{:URL('index')}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all <?php echo (app('request')->action() === 'index') ? 'bg-primary-light text-primary' : 'text-text-secondary hover:bg-surface-100'; ?>">扫描结果</a>
        <a href="{:URL('keyword_conf')}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all <?php echo (app('request')->action() === 'keyword_conf') ? 'bg-primary-light text-primary' : 'text-text-secondary hover:bg-surface-100'; ?>">关键词配置</a>
    </div>
</div>
