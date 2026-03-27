<?php
// 左侧垂直导航栏
?>
<nav class="vertical-nav" style="width: 72px; height: 100vh; background: #1e293b; position: fixed; left: 0; top: 0; display: flex; flex-direction: column; align-items: center; padding: 16px 0;">
    <a href="/code/codeql/index.html" class="nav-item <?php echo isset($active) && $active == 'codeql' ? 'active' : ''; ?>" style="display: flex; flex-direction: column; align-items: center; padding: 12px 0; color: #94a3b8; text-decoration: none; width: 100%; transition: all 0.2s;">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="16 18 22 12 16 6"></polyline>
            <polyline points="8 6 2 12 8 18"></polyline>
        </svg>
        <span style="font-size: 10px; margin-top: 4px;">CodeQL</span>
    </a>
    <a href="/code/fortify/index.html" class="nav-item" style="display: flex; flex-direction: column; align-items: center; padding: 12px 0; color: #94a3b8; text-decoration: none; width: 100%; transition: all 0.2s;">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
        </svg>
        <span style="font-size: 10px; margin-top: 4px;">Fortify</span>
    </a>
    <a href="/code/semgrep/index.html" class="nav-item" style="display: flex; flex-direction: column; align-items: center; padding: 12px 0; color: #94a3b8; text-decoration: none; width: 100%; transition: all 0.2s;">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <span style="font-size: 10px; margin-top: 4px;">SemGrep</span>
    </a>
</nav>
<style>
    .nav-item:hover {
        background: rgba(255,255,255,0.1);
        color: #ffffff;
    }
    .nav-item.active {
        background: rgba(59, 130, 246, 0.2);
        color: #3b82f6;
    }
</style>
