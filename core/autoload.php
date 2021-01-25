<?php
//自動加載類
function my__autoload($class_name){
    $file = '';

    if (substr($class_name, -7) == 'Service') {
        $file = ROOT_PATH . 'core/services/' . $class_name . '.class.php';
    } else if (substr($class_name, -10) == 'Repository') {
        $file = ROOT_PATH . 'core/repositories/' . $class_name . '.class.php';
    } else if (substr($class_name, -5) == 'Model') {
        $file = ROOT_PATH . 'core/models/' . $class_name . '.class.php';
    }

    if ($file == '' || !file_exists($file)) {
        $file = ROOT_PATH . 'core/table/' . $class_name . '.class.php';
        if (!file_exists($file)) {
            $file = ROOT_PATH . 'core/class/' . $class_name . '.class.php';
            if (!file_exists($file)) {
                $file = ROOT_PATH . 'core/class/' . $class_name . '/' . $class_name . '.class.php';
            }
        }
    }
    if (is_file($file)) {
        include_once($file);
    }
}

spl_autoload_register('my__autoload');

