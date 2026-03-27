<div class="bg-white border-b border-surface-300 px-4 py-3">
    <div class="flex gap-2">
        <a href="{:URL('huoshan')}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all <?php echo (app('request')->action() === 'huoshan') ? 'bg-primary-light text-primary' : 'text-text-secondary hover:bg-surface-100'; ?>">火山云</a>
        <a href="{:URL('aliyun')}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all <?php echo (app('request')->action() === 'aliyun') ? 'bg-primary-light text-primary' : 'text-text-secondary hover:bg-surface-100'; ?>">阿里云</a>
        <a href="{:URL('yidong')}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all <?php echo (app('request')->action() === 'yidong') ? 'bg-primary-light text-primary' : 'text-text-secondary hover:bg-surface-100'; ?>">移动云</a>
        <a href="{:URL('tianyi')}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all <?php echo (app('request')->action() === 'tianyi') ? 'bg-primary-light text-primary' : 'text-text-secondary hover:bg-surface-100'; ?>">天翼云</a>
        <a href="{:URL('baidu')}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all <?php echo (app('request')->action() === 'baidu') ? 'bg-primary-light text-primary' : 'text-text-secondary hover:bg-surface-100'; ?>">百度云</a>
    </div>
</div>
