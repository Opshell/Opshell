<?php
use Illuminate\Database\Eloquent\Model as Eloquent; // Eloquent Model (ORM) 使用
use Illuminate\Database\Capsule\Manager as DB; // DB 使用 主要為了執行原生SQL

class Repository extends Eloquent
{
    // Eloquent 設定
    protected $builder = Null;
    protected $table = ''; // 連結的資料表
    protected $primaryKey = 'id'; // 主Key
    public $timestamps = false; // 是否託管更新，"Eloquent的功能 "

    use ClassInstanceTrait {
        ClassInstanceTrait::__construct as private __tConstruct;
    }
    public function __construct(){
        $this->builder = $this;

        $this->__tConstruct();
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
