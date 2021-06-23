<?php
namespace Controller;
use Core\Controller;
use Service\backEndService;

class backEndController extends Controller
{
    private $_path = '';

    public function __construct(){
        $this->backEndService = backEndService::getInstance();
    }

    public function index(){
        $this->data['text'] = "渲染最新消息內容文字！";
        // 輸出
        $this->template = $this->_path;
        return $this->render();
    }

    

    public function api($action, $inputData, $user){
        switch ($action) {
            case 'login': // 後檯登入
                $data = $this->backEndService->backEndLogin($inputData);
                break;
            case 'sidemenu': // 取得列表
                $data = $this->backEndService->getSideMenu($user['auth']);
                break;
            default:
                # code...
                break;
        }

        return $data;
    }
}
?>