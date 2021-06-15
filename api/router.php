<?php
    // echo "You want me give something to you? <br/><br/>";

    // $subject = $_SERVER['REQUEST_URI']; //   "/api1/aaasd/bbb/";
    // $pattern = '/^\/([^\/]{1,})\/([^\/]*)\/([^\/]*)\//';
    // preg_match($pattern, $subject, $matches);

    // use 載入
    include_once(dirname(__FILE__). '/useControllers.php');
    // // 核心啟動
    // require_once(dirname(dirname(__FILE__)) . '/core/startup.php');

    // RESTful 網址解析
    $PathSplit = explode('/', $_GET['route']);
    $route = ($PathSplit[0]) ?? "";  // class
    $action = ($PathSplit[1]) ?? ""; // 動作
    $id = ($PathSplit[2]) ?? 0;      // id

    // POST 處理 => axios post 過來會是Request Payload格式 需要另外處理
    $_POST =(empty($_POST) && !empty(json_decode(file_get_contents("php://input"), true)))? json_decode(file_get_contents("php://input"), true) : $_POST;

    // 輸入資料XSS清理 
    $post = $_POST;

    // http header取得
    $headers = getallheaders();


    // 預設輸出
    $httpStatusCode = 401;
    $result = [
        'status' => 'Error',
        'message' => 'Authorization Error!',
        'data' => [],
        'redirect' => '/login',
    ];

    // 權限檢查
    $auth = ($headers['authorization'])?? false;
    if($auth){ 
        $auth = jwtVerify($auth); 
        $newToken = jwtCreat($auth['payload']);
    }

    if($auth || $action == 'login'){
        // 參數不完全
        $httpStatusCode = 400;
        $result['data'] = $_GET['route'];
        $result['message'] = 'Incomplete parameters.';

        if (!empty($route) && !empty($action)) {
            // 如果只是單純驗證
            if($route == 'auth' && $action == 'verify'){
                $httpStatusCode = 200;
                $result['status'] = 'Success';
                $result['data'] = $newToken;
                $result['message'] = 'Verified successfully.';
            }else{
                $className = 'Controller\\' . $route . 'Controller';

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
                    if (!empty($data)) {
                        $httpStatusCode = 200;
                        $result['status'] = 'Success';
                        $result['message'] = 'Get data success.';
                        $result['data'] = $data;
                    }
                }
            }
        }
    }

    // Output
    $Response->setOutput($result, $httpStatusCode, 'json');
    $Response->output();
    exit;