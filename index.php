<?php
// echo "Hello world!<br/><br/>";
// echo $_SERVER['REQUEST_URI'] . '<br><br>';
// var_dump(xdebug_info('mode'));

// 核心啟動
require_once(dirname(__FILE__) . '/core/startup.php');

// 前後台路由導向
$defPATH = 'public'; // 預設導向(前台)
$indexFile = 'router.php';

$appPATH = [ // 其他可探索資料夾
    'webadmin' => 'index.html', // 後台
    'api' => 'router.php' // api
];

$route = [];
foreach ($appPATH as $dir => $entrance) {
    $dirPart = '/'.$dir.'/';
    // 開放探索 && 入口檔案存在
    if (stristr($_SERVER['REQUEST_URI'], $dirPart) && is_file(ROOT_PATH .$dirPart.$entrance)) {
        $route = [
            'path' => str_replace($dirPart, '/', $_SERVER['REQUEST_URI']),
            'file' => $dir . '/' . $entrance
            // 'file' => $v . '/index.php'
        ];
        break;
    }
}

// 存取錯誤資料夾則導向預設前台
if (empty($route)) {
    $route = [
        'path' => $_SERVER['REQUEST_URI'],
        'file' => $defPATH . '/'. $indexFile
    ];
}

if (stristr($route['path'], '?', true)) {
    $route['path'] = stristr($route['path'], '?', true);
}

// 如果有路由=>計算路徑
if ($route['path'] != '/') {
    $path = [];
    $tmp = explode('/', $route['path']);
    foreach ($tmp as $v) {
        if (empty($v)) { continue; }
        $path[] = trim($v);
    }

    if ($path) {
        $_GET['route'] = implode('/', $path);
    }
}

require_once(ROOT_PATH .'/'. $route['file']);

function include_path($Path){
    $BasePath = dirname(dirname(__FILE__));
    $PathSplit = explode('/', $Path);
    return implode(DIRECTORY_SEPARATOR, array_merge(array($BasePath), $PathSplit));
}
