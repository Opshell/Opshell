<?php
namespace Controller;
use Core\Controller;
use Service\sysSectionService;
use stdClass;

class sectionController extends Controller
{
    private $_path = 'section';
    private $Service;

    public function __construct(){
        $this->Service = sysSectionService::getInstance();
    }

    public function index(){
        $this->data['text'] = "渲染最新消息內容文字！";

        // 輸出
        $this->template = $this->_path;
        return $this->render();
    }

    public function api($action, $inputData, $user, $param){
        $result = null;

        if($action == 'list') {
            $result = $this->Service->getSectionList($user['auth']);
        //     $getFeild = [
        //         'id', 'title', 'icon',
        //     ];
        //     $result = $this->Service->getList(0, 10, $param[0], $param[1], $getFeild);
        } else if($action == 'info') {
            $result = $this->Service->getInfo($param[0]);
        }

        // return $result->toJson();
        return $result;
    }
}
