<?php
class Service
{
    protected static $_instance = null;
    protected $Repository = null;

    public static function getInstance(){
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct(){}

    // 取得列表資料
    public function getList(){
        $list = $this->Repository->getList();

        return $list;
    }

    // 取得明細資料
    public function getInfo($id){
        $rtn = $this->Repository->getInfo($id);

        return (is_null($rtn)) ? null : $rtn;
    }
}
