<?php
namespace Controller;
use Core\Controller;
use Service\backEndAuthService;

class backEndAuthController extends Controller
{
    private $_path = '';

    public function __construct(){
        $this->backEndAuthService = backEndAuthService::getInstance();
    }

    public function index(){
        $this->data['text'] = "渲染最新消息內容文字！";
        // 輸出
        $this->template = $this->_path;
        return $this->render();
    }

    

    public function api($action, $inputData){
        switch ($action) {
            case 'login':
                $data = $this->backEndLogin($inputData);
                break;
            default:
                # code...
                break;
        }


        return $data;
    }

    // 後台登入
    private function backEndLogin($inputData){
        $user = 'Opshell';
        $pass = 'pass';

        $userParams = [
            'uid' => 1,
            'user'=> $user,
            'auth' => 0
        ];

        $JWT = jwtCreat($userParams);
        return $JWT;

        $signKey = 'sjhnRr3yF21ah_E65c9fl';
    }
}
?>