<?php 
echo "Hello world!<br/><br/>";

// 核心啟動
require_once(dirname(__FILE__) . '/core/startup.php');

// 前後台路由導向
$defPATH = 'public'; // 預設導向(前台)
$appPATH = array('WebAdmin'); // 後台或更多其他可探索資料夾

$route = array();
foreach ($appPATH as $v) {
    $dir = '/' . $v . '/';
    if (stristr($_SERVER['REQUEST_URI'], $dir) && is_file(ROOT_PATH . $v . '/index.php')) {
        $route = array(
            'path' => str_replace($dir, '/', $_SERVER['REQUEST_URI']),
            'file' => $v . '/index.php'
        );
        break;
    }
}

// 存取錯誤資料夾則導向預設前台
if (empty($route)) {
    $route = array(
        'path' => $_SERVER['REQUEST_URI'],
        'file' => $defPATH . '/index.php'
    );
}

if (stristr($route['path'], '?', true)) {
    $route['path'] = stristr($route['path'], '?', true);
}

// 如果有路由=>計算路徑
if ($route['path'] != '/') {
    $path = array();
    $tmp = explode('/', $route['path']);
    foreach ($tmp as $v) {
        if (empty($v)) { continue; }
        $path[] = trim($v);
    }

    if ($path) {
        $_GET['route'] = implode('/', $path);
    }
}


// 導向
require_once(ROOT_PATH .'/'. $route['file']);


function include_path($Path){
    $BasePath = dirname(dirname(__FILE__));
    $PathSplit = explode('/', $Path);
    return implode(DIRECTORY_SEPARATOR, array_merge(array($BasePath), $PathSplit));
}