<?php
namespace Core;

trait ClassInstanceTrait {
    private $constructMethodName = 'construct'; // 子體建構子名稱
    protected static $instance = null;

    /** 執行子體建構子
     *  ClassInstance constructor.
     */
    protected function __construct()
    {
        if (method_exists(static::class, $this->constructMethodName)) {
            call_user_func(array(
                $this,
                $this->constructMethodName
            ));
        }
    }

    /** 實例獲取
     * @return static::$instance
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
?>