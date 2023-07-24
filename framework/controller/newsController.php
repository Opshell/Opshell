<?php
namespace Controller;
use Core\Controller;
use Service\newsService;

class newsController extends Controller
{
    private $_path = 'news';
    private $Service;

    public function __construct(){
        $this->Service = newsService::getInstance();
    }

    public function index(){
        $this->data['text'] = "渲染最新消息內容文字！";

        // 輸出
        $this->template = $this->_path;
        return $this->render();
    }

    /**
     * @param Array $param = [id, cid]
     */
    public function api($action, $inputData, $user, $param){
        $result = null;

        if($action == 'list') {
            $result = $this->Service->getList(0, 1, 10, '*', 1);
        } else if($action == 'info') {
            $result = $this->Service->getInfo($param[0]);
        }

        return json_encode($result->toArray(), JSON_UNESCAPED_UNICODE);
    }
}
?>