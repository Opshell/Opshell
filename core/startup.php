<?php
/** 整個網站的環境檢查=>全域變數設定=>網站基本設定
 * const VERSION 0.1
 */

// 設定常數
const TIMEDAY = 86400;

date_default_timezone_set("Asia/Taipei"); // 設定時區

// SSL 檢查
if (!empty($_SERVER['HTTPS'])) {
    if (
        $_SERVER['HTTPS'] == 'on' ||
        $_SERVER['HTTPS'] == '1' ||
        (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)
    ) {
        $_SERVER['HTTPS'] = true;
    } else {
        $_SERVER['HTTPS'] = false;
    }
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $_SERVER['HTTPS'] = true;
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
    $_SERVER['HTTPS'] = true;
} else {
    $_SERVER['HTTPS'] = false;
}

// CLI 識別
if (empty($_SERVER['REQUEST_URI'])) {
    define('IS_CLI', true);
} else {
    define('IS_CLI', false);
}

$host = $_SERVER['SERVER_NAME'];

// HTTP
define('HTTP_BASE', '//' . $host . '/'); 
define('HTTP_UPLOAD', HTTP_BASE . 'upload/'); // 上傳檔案
// URL
define('DOMAIN_URL', (($_SERVER['HTTPS']) ? 'https' : 'http') . ':' . HTTP_BASE);

// path
define('ROOT_PATH', dirname(dirname(__FILE__)));
define('CORE_PATH', ROOT_PATH . '/core');

//start session
if (empty(session_id())) session_start();

//clear cache
define('CACHEPREFIX', function_exists('opcache_reset') ? 'opcache_' : (function_exists('accelerator_reset') ? 'accelerator_' : ''));
if (function_exists(CACHEPREFIX . 'reset')) {
    call_user_func(CACHEPREFIX . 'reset');
}