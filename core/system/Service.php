<?php
class Service
{
    protected $Repository = null;

    use ClassInstanceTrait{
        ClassInstanceTrait::__construct as private __tConstruct;
    }
    public function __construct(){
        $this->__tConstruct();
    }

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
