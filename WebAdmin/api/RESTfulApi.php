<?php 
    // use Controller\newsController;
    // use Service\newsService;
    // use Repository\newsRepository;
    // use Controller\newsController;
    
    // 核心啟動
    require_once(dirname(dirname(dirname(__FILE__))) . '/core/startup.php');

    $route = ($_GET['route'])?? ""; // class
    $action = ($_GET['action'])?? ""; // 動作
    $id = ($_GET['id'])?? "";

    // $newsController = new newsController();

    $result = [
        'status' => 'Error',
        'message' => 'Incomplete parameters !',
        'data' => [],
        'redirect' => '/',
    ];
    
    if (!empty($route) && !empty($action)) {
        $className = 'Controller\\' .$route . 'Controller';
        $result['data'] = $className;
        $result['message'] = 'Class is not exists.';

        if (class_exists($className)) {
            $class = new $className();

            switch ($action) {
                case 'list':
                    $result = $class->api();

                    // $result['message'] = $data->message;
                    // $result['redirect'] = $data->redirect;

                    // if(!$data->error){ // 如果沒有錯誤
                    //     $result['status'] = 'Success';
                    //     $result['data'] = $data->result;
                    // }else{
                    //     $result['status'] = 'Error';
                    //     $result['data'] = [];
                    // }
                    break;
                default:
                    $result['data'] = $action;
                    $result['message'] = 'Method is not exists.';
            }
        }
    }

    if(gettype($result) == "String"){
        echo $result;
    }else{
        echo json_encode($result);
    };
    exit;
?>