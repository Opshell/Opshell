<?php
class Controller{
    protected $langs;
    protected $template;
    protected $error;
    protected $ajax = false;
    protected $children = array();
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
     * 
     */
    protected function render(){ 
        // 
        // foreach ($this->children as $child) {
        //     $this->data[basename($child)] = $this->load->control($child);
        // }

        $file = DIR_TEMPLATE . $this->template . '.php';
        if (is_file($file)) {
            // $this->data['langs'] = $this->langs;

            extract($this->data);

            ob_start();
            require($file);

            $this->output = ob_get_contents();

            ob_end_clean();

            return $this->output;
        } else {
            trigger_error('Error: 無法載入樣板 ' . $file . '!');
            exit();
        }
    }
}
?>