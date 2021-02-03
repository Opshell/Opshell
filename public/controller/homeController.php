<?php
class homeController extends Controller
{
    private $_path = 'home';

    public function __construct(){

    }

    public function index(){
        $this->data['text'] = "渲染內容文字";



        // 輸出
        $this->template = $this->_path;
        return $this->render();
    }
}
?>