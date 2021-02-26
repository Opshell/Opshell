<?php
class Controller{
    protected $langs;
    protected $template;
    protected $error;
    protected $ajax = false;
    protected $components = array();
    protected $data = array();
    protected $json = array(
        'error' => false,
        'message' => '',
        'redirect' => '',
        'result' => array()
    );
    public $output;
    public function __construct(){}

    /** 頁面組合輸出
     * @return {$this->output} html component
     * @return trigger_error
     */
    protected function render(){ 
        // 部件載入
        foreach ($this->components as $component) {
            $this->data[basename($component)] = $this->loader($component);
        }

        $tplFile = DIR_TEMPLATE . $this->template . '.php';
        if (is_file($tplFile)) {
            // $this->data['langs'] = $this->langs;

            extract($this->data);

            ob_start();
            require($tplFile);

            $this->output = ob_get_contents();

            ob_end_clean();

            return $this->output;
        } else {
            trigger_error('Error: 無法載入樣板 ' . $file . '!');
            exit();
        }
    }

    /** 其他部件載入
     * @param {$control} string 控制器相對路徑 EX: 'common/header'
     * @return {$component->index()} html component
     * @return trigger_error
     */
    protected function loader($control){
        $classFile = CONTROLLER_PATH . $control . 'Controller.php';
        $className = $control . 'Controller';

        if(file_exists($classFile)) { // 導向 controller
            $component = new $className;

            return $component->index();
        } else {
            trigger_error('Error: 部件不存在"' . $classFile . '"!');
            exit();
        }
    }
}
?>