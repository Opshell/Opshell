<?php 

echo  'NOW you in the public.';
echo  '<br/>';

// 定義 route
$route = ($_GET['route'])?? "home";
define('DIR_CONTROLLER', __DIR__. '/controller/'); // 控制器
define('DIR_TEMPLATE', __DIR__. '/template/'); //樣板

$classFile = DIR_CONTROLLER . $route . 'Controller.php';
$className = $route.'Controller';

// router
if(file_exists($classFile)){ // 導向 controller
    include_once($classFile);

    $page = new $className;
    $Response->setOutput($page->index());
}

// Output
$Response->output();
?>