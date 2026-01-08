<?php
// 直接从app.php文件中提取UC_AUTH_KEY值
$app_config_content = file_get_contents(__DIR__ . '/config/app.php');
preg_match("/'UC_AUTH_KEY'\s*=>\s*'(.*?)'/", $app_config_content, $matches);
$uc_auth_key = $matches[1] ?? 'lyj0p2wtexiax32ijn23pantnyzdayu32hui3dlayuan1325zh3oonlg2xin7';

// 定义ucenter_md5函数（直接复制过来避免依赖）
function ucenter_md5($str, $key = 'lyj0p2wtexiax32ijn23pantnyzdayu32hui3dlayuan1325zh3oonlg2xin7')
{
    return '' === $str ? '' : md5(md5(sha1($str) . $key) . '###xt');
}

// 设置管理员信息
$username = 'admin';
$password = 'admin'; // 默认密码，可以修改
$nickname = '管理员';

// 生成加密密码
$encrypted_password = ucenter_md5($password . $username, $uc_auth_key);

// 输出结果
echo "生成的管理员密码信息：\n";
echo "用户名：{$username}\n";
echo "明文密码：{$password}\n";
echo "加密密码：{$encrypted_password}\n";
echo "\n";
echo "可以使用以下SQL语句插入管理员用户：\n";
echo "INSERT INTO `user` (`id`, `username`, `nickname`, `password`, `email`, `auth_group_id`, `status`, `created_at`, `update_time`, `last_login_ip`, `last_login_time`, `is_delete`, `url`) VALUES\n";
echo "(1, '{$username}', '{$nickname}', '{$encrypted_password}', 'admin@admin.com', 1, 1, " . time() . ", " . time() . ", '127.0.0.1', 0, 0, '/index/index');";