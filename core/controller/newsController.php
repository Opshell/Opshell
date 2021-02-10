<?php
class newsController extends Controller
{
    private $_path = 'news';

    public function __construct(){

    }

    public function index(){
        $this->data['text'] = "渲染最新消息內容文字！";



        // 輸出
        $this->template = $this->_path;
        return $this->render();
    }
}
?>