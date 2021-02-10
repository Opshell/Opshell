<?php
class homeController extends Controller
{
    private $_tplPath = 'home';

    public function __construct(){

    }

    public function index(){
        $this->data['text'] = "渲染內容文字";

        $this->components = array(
            'header'
        );

        // 輸出
        $this->template = $this->_tplPath;
        return $this->render();
    }
}
?>