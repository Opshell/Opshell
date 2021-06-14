<?php
    // echo "You want me give something to you? <br/><br/>";

    // $subject = $_SERVER['REQUEST_URI']; //   "/api1/aaasd/bbb/";
    // $pattern = '/^\/([^\/]{1,})\/([^\/]*)\/([^\/]*)\//';
    // preg_match($pattern, $subject, $matches);

    // use 載入
    include_once(dirname(__FILE__). '/useControllers.php');
    // 核心啟動
    require_once(dirname(dirname(__FILE__)) . '/core/startup.php');

    // RESTful 網址解析
    $PathSplit = explode('/', $_GET['route']);
    $route = ($PathSplit[0]) ?? "";  // class
    $action = ($PathSplit[1]) ?? ""; // 動作
    $id = ($PathSplit[2]) ?? 0;      // id


    // 輸入資料XSS清理
    $post = $_POST;

    // 預設輸出
    $httpStatusCode = 0;
    $result = [
        'status' => 'Error',
        'message' => 'Incomplete parameters !',
        'data' => [],
        'redirect' => '/',
    ];

    // 權限檢查
    $auth = false;
    $httpStatusCode = 401;
    if(true){
        $auth = true;
    }

    // 參數不完全
    $httpStatusCode = 406;
    $result['data'] = $_GET['route'];
    $result['message'] = 'Parameters missing.';

    if (!empty($route) && !empty($action)) {
        $className = 'Controller\\' .$route . 'Controller';

        // Controller 不存在回傳
        $httpStatusCode = 404; 
        $result['data'] = $className;
        $result['message'] = 'Class is not exists.';

        if (class_exists($className)) { // 判斷 Controller是否存在
            $class = new $className();

            // action 不存在
            $httpStatusCode = 405;
            $result['data'] = $action;
            $result['message'] = 'Method is not exists.';

            $data = $class->api($action, $post);
            if(!empty($data)){
                $httpStatusCode = 200;
                $result['status'] = 'Success';
                $result['message'] = 'Get data success.';
                $result['data'] = $data;
            }
        }
    }

    // Output
    $Response->setOutput($result, $httpStatusCode, 'json');
    $Response->output();
    exit;