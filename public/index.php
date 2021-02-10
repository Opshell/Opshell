<?php 

echo  'NOW you in the public.';
echo  '<br/>';

// 定義 route
$route = ($_GET['route'])?? "home";
define('DIR_TEMPLATE', __DIR__. '/template/'); //樣板

$classFile = CONTROLLER_PATH . $route . 'Controller.php';
$className = $route.'Controller';

// router
if(file_exists($classFile)){ // 導向 controller
    // include_once($classFile);

    $page = new $className;
    $Response->setOutput($page->index());
}

// Output
$Response->output();
?>