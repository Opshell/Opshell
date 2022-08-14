<?php
namespace Controller;
use Core\Controller;
use Service\sysAdminService;
use Service\sysSectionService;

class backEndController extends Controller
{
    private $_path = '';

    public function __construct(){
        $this->sysAdmin = sysAdminService::getInstance();
        $this->sysSection = sysSectionService::getInstance();
    }

    public function index(){
        $this->data['text'] = "渲染最新消息內容文字！";
        // 輸出
        $this->template = $this->_path;
        return $this->render();
    }

    public function api($action, $inputData, $user, $param){
        switch ($action) {
            case 'login': // 後檯登入
                $data = $this->sysAdmin->sysAdminLogin($inputData);
                break;
            case 'sidemenu': // 取得列表
                $data = $this->sysSection->getSideMenu($user['auth']);
                break;
            default:
                # code...
                break;
        }

        return $data;
    }
}
?>