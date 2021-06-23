<?php


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

/** JWT Token 生成
 * @param Array $params 參數
 * @return Srting
 */
function jwtCreat($params){
    global $config;

    // JWT 三要件生成
    $header = base64_encode(json_encode($config['jwtHeader']));
    $payload = [
        "iat" => time(),
        "exp" => time() + 7200, //token過期時間(2hr)
    ];
    $payload = array_merge($params, $payload); // 合併參數(後蓋前，可用來更新憑證)
    ksort($payload); // 因為合併陣列  排序一下
    $payload = base64_encode(json_encode($payload)); 
    
    // 簽章生成
    $Signature = base64_encode(hash_hmac("sha256", $header . $payload, $config['jwtKeys'], TRUE));

    // JWT = header.payload.Signature
    return $header.".". $payload.".". $Signature;
}

/** JWT Token 驗證
 * @param String $token jwt_Token
 * @return Srting
 */
function jwtVerify($token){
    global $config;
    $token = str_replace("Bearer ", "", $token);

    $JWT = explode(".", $token);
    $verification = false;
    if(count($JWT) == 3){
        // 驗證是否過期
        $payload = json_decode(base64_decode($JWT[1]));
        if($payload->exp > time()){
            // 驗證 JWT 是否竄改
            $Signature = base64_encode(hash_hmac("sha256", $JWT[0] . $JWT[1], $config['jwtKeys'], TRUE));

            if($Signature == $JWT[2]){
                $verification = [
                    'auth' => true,
                    'payload' => (array)$payload
                ];
            }
        };
    } 

    return $verification;
}

/** 獲取 HTTP header */
if (!function_exists('getallheaders')) {
    function getallheaders() {
        $headers = array();
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}

/** 隨機生成N碼亂數
 * @param Int $length = 12 // 碼數
 * @param String $characters = 0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ // 可使用字元
 * @return String
 */
function randomStr($length = 12, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-+/*.^&|[]<>(){}@#%?!'){
    if (!is_int($length) || $length < 0) {
        return false;
    }
    $characters_length = strlen($characters) - 1;
    $string = '';

    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[mt_rand(0, $characters_length)];
    }
    return $string;
}