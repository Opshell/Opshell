<?php
use Illuminate\Database\Eloquent\Model as Eloquent; // Eloquent Model (ORM) 使用
use Illuminate\Database\Capsule\Manager as DB; // DB 使用 主要為了執行原生SQL

class Repository extends Eloquent
{
    // Eloquent 設定
    protected $table = '';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $builder = Null;
    protected $wheres = [];
    protected $orders = [];

    use ClassInstanceTrait {
        ClassInstanceTrait::__construct as private __tConstruct;
    }
    public function __construct(){
        $this->__tConstruct();

        $this->builder = $this;
        $this->setWhere($this->wheres);
        $this->setOrder($this->orders);
    }

    public function setWhere($wheres = []){
        foreach ($wheres as $k => $v) {
            $v['relation'] = empty($v['relation']) ? '=' : $v['relation'];
            $this->builder = $this->builder->where($v['key'], $v['relation'], $v['value']);
        }
    }

    public function setOrder($orders = []){
        foreach ($orders as $k => $v) {
            $this->builder = $this->builder->orderBy($v['key'], $v['value']);
        }
    }
    
    public function getList(){
        return $this->builder
            ->get()
        ->toArray();
    }

    public function getInfo($id){
        return $this->builder
            ->find($id)
        ->toArray();
    }

    // 生成資料表
    public function creatTable($SQL = ""){
        DB::statement($SQL);
    }
}
