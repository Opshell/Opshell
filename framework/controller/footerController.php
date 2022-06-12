<?php
namespace Controller;
use Core\Controller;

class footerController extends Controller
{
    private $_tplPath = 'footer';

    public function __construct(){}

    public function index(){
        $this->data['text'] = "渲染頁尾文字";

        // 輸出
        $this->template = $this->_tplPath;
        return $this->render();
    }
}
