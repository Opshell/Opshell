<?php
namespace Controller;
use Core\Controller;
use Service\newsService;

class newsController extends Controller
{
    private $_path = 'news';

    public function __construct(){
        $this->newsService = newsService::getInstance();
    }

    public function index(){
        $this->data['text'] = "渲染最新消息內容文字！";

        // 輸出
        $this->template = $this->_path;
        return $this->render();
    }

    public function api(){
        $this->data = $this->newsService->getList();

        return $this->json();
    }
}
?>