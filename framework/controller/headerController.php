<?php
namespace Controller;
use Core\Controller;

class headerController extends Controller
{
    private $_tplPath = 'header';

    public function __construct(){

    }

    public function index(){
        $this->data['text'] = "渲染頁首文字";

        // 輸出
        $this->template = $this->_tplPath;
        return $this->render();
    }
}
