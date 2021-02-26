<?php
class homeController extends Controller
{
    private $_tplPath = 'home';
    private $newsService = null;

    public function __construct(){
        $this->newsService = newsService::getInstance();
    }


    public function index($outType='render'){
        $this->data['text'] = "渲染內容文字";
        $this->data['newsList'] = $this->newsService->getList();

        // 組件載入
        $this->components = array(
            'header',
            'footer',
        );

        // 輸出
        if($outType == 'render'){ // 頁面輸出
            $this->template = $this->_tplPath;
            return $this->render();
        }else{ // JSON 輸出
            return $this->json();
        }
    }
}
?>