<?php
//自動加載類
function my__autoload($class_name){
    $file = '';

    // framework 加載
    if (substr($class_name, -10) == 'Controller') {
        $file = CONTROLLER_PATH . $class_name . '.php';
    } else if (substr($class_name, -7) == 'Service') {
        $file = SERVICE_PATH . $class_name . '.php';
    } else if (substr($class_name, -10) == 'Repository') {
        $file = REPOSITORY_PATH . $class_name . '.php';
    } else if (substr($class_name, -5) == 'Model') {
        $file = MODEL_PATH . $class_name . '.php';
    }

    // 核心加載
    if ($file == '' || !file_exists($file)) {
        $file = ROOT_PATH . '/core/system/' . $class_name . '.php';
        if (!file_exists($file)) {
            $file = ROOT_PATH . '/core/class/' . $class_name . '.class.php';
            if (!file_exists($file)) {
                $file = ROOT_PATH . '/core/class/' . $class_name . '/' . $class_name . '.class.php';
            }
        }
    }

    if (is_file($file)) {
        include_once($file);
    }
}

spl_autoload_register('my__autoload');


// 常用function 宣告
function getip(){
    global $_SERVER;
    if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $onlineip = getenv('HTTP_CLIENT_IP');
    } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $onlineip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $onlineip = getenv('REMOTE_ADDR');
    } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $onlineip = $_SERVER['REMOTE_ADDR'];
    }
    $onlineip = preg_match("/[\d\.]{7,15}/", $onlineip, $onlineipmatches);

    return (count($onlineipmatches) > 0) ? $onlineipmatches[0] : 'unknown';
}

