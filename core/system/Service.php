<?php
namespace Core;

abstract class Service
{
    protected $Repository = null;
    protected $result = [
        'status' => false,
        'message' => 'Incomplete parameters.',
        'redirect' => '',
        'data' => []
    ];

    use ClassInstanceTrait{
        ClassInstanceTrait::__construct as private __tConstruct;
    }
    public function __construct(){
        $this->__tConstruct();
    }

    // 抽象方法 只要繼承Service 就需要有getInstance && construct;
    abstract public static function getInstance();
    abstract public function construct();

    // 取得列表資料
    public function getList($cid, $curPage, $pageSize, $select, $lang){
        $list = $this->Repository->getList($cid , $curPage, $pageSize, $select, $lang);

        return $list;
    }

    // 取得明細資料
    public function getInfo($id){
        $rtn = $this->Repository->getInfo($id);

        return (is_null($rtn)) ? null : $rtn;
    }
}
