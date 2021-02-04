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

// Autoload
require_once(ROOT_PATH . '/vendor/autoload.php');
require_once(CORE_PATH . '/config.php'); // 組態載入
require_once(CORE_PATH . '/system/common.php'); // autoload註冊 框架&常用function載入


// 宣告本機或線上模式
if (getip() == "127.0.0.1" || getip() == "unknown") {
    $develop_mode = "Development";
} else {
    $develop_mode = "Production";
}


// DB 初始化
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as DB;

$DB = new DB;
// 創建連結
$DB->addConnection($database[$develop_mode]);
// 設定全域靜態可訪問
$DB->setAsGlobal();
// 啟動Eloquent
$DB->bootEloquent();


// 回應
$Response = new Response();
$Response->addHeader('Content-Type: text/html; charset=UTF-8'); // 預設回傳格式

