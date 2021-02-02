<?php 

echo  'NOW you in the public.';
echo  '<br/>';

// 定義 route
$route = ($_GET['route'])?? "home";
define('CONTROLLER', __DIR__. '/controller/');


include_once(CONTROLLER . 'controller.php');

$classFile = CONTROLLER . $route . 'Controller.php';
$className = $route.'Controller';

if(file_exists($classFile)){ // 導向 controller
    include_once($classFile);

    $page = new $className;
    $page->index();

}else{ // 無該controller 則導首頁


}




// router

// controller
?>