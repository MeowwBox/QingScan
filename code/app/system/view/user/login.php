<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=env('website')?> 登录</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        'primary-hover': '#2563eb',
                        'primary-light': '#eff6ff',
                        surface: {
                            50: '#ffffff',
                            100: '#f8fafc',
                            200: '#f1f5f9',
                            300: '#e2e8f0',
                            400: '#cbd5e1',
                        },
                        text: {
                            primary: '#1e293b',
                            secondary: '#64748b',
                            muted: '#94a3b8',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
                    },
                    boxShadow: {
                        'card': '0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04)',
                        'hover': '0 4px 12px -2px rgb(0 0 0 / 0.1)',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.3s ease-out forwards; }

        /* Custom checkbox */
        .custom-checkbox {
            appearance: none;
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #cbd5e1;
            border-radius: 5px;
            background-color: #f8fafc;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }
        .custom-checkbox:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }
        .custom-checkbox:checked::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 2px;
            width: 5px;
            height: 9px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .custom-checkbox:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-100 via-blue-50 to-slate-200 min-h-screen flex items-center justify-center font-sans">
    <!-- Background Pattern -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-200/30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-300/20 rounded-full blur-3xl"></div>
    </div>

    <!-- Login Card -->
    <div class="relative w-full max-w-md mx-4 opacity-0 animate-fadeIn">
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-card border border-surface-300 p-8 md:p-10">
            <!-- Logo Area -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-primary to-blue-600 shadow-lg mb-4">
                    <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-primary to-blue-600 bg-clip-text text-transparent mb-2">QingScan</h1>
                <p class="text-text-secondary text-sm">安全扫描管理平台</p>
            </div>

            <!-- Login Form -->
            <form action="<?php echo url('login/doLogin') ?>" method="POST" class="space-y-5">
                <!-- Username -->
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-2">用户名</label>
                    <input type="text" name="username"
                        class="w-full bg-surface-100 border border-surface-300 rounded-xl px-4 py-3 text-text-primary placeholder-text-muted focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none transition-all"
                        placeholder="请输入用户名" required autofocus>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-text-primary mb-2">密码</label>
                    <input type="password" name="password"
                        class="w-full bg-surface-100 border border-surface-300 rounded-xl px-4 py-3 text-text-primary placeholder-text-muted focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none transition-all"
                        placeholder="请输入密码" required>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember_password" value="1" class="custom-checkbox">
                        <span class="text-sm text-text-secondary select-none">记住我</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-primary to-blue-600 text-white font-semibold hover:shadow-hover hover:from-primary-hover hover:to-blue-700 transition-all duration-200 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    登录
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-6 pt-6 border-t border-surface-200 text-center">
                <p class="text-sm text-text-muted">
                    &copy; <?=date('Y')?> QingScan. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
