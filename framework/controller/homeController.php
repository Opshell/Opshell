<?php
class homeController extends Controller
{
    private $_tplPath = 'home';
    private $newsService = null;

    public function __construct(){
        $this->newsService = new newsService;
    }

    public function index(){
        $this->data['text'] = "渲染內容文字";

        print_r($this->newsService->getList());exit;

        $this->data['newsList'] = $this->newsService->getList();



        // 組件載入
        $this->components = array(
            'header'
        );

        // 輸出
        $this->template = $this->_tplPath;
        return $this->render();
    }
}
?>