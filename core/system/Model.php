<?php

namespace Core;

use Illuminate\Database\Eloquent\Model as Eloquent; // Eloquent Model (ORM) 使用
use Illuminate\Database\Capsule\Manager as DB; // DB 使用 主要為了執行原生SQL

// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

abstract class Repository extends Eloquent
{
    // Eloquent 設定
    protected $builder = Null;
    protected $table = ''; // 連結的資料表
    protected $primaryKey = 'id'; // 主Key
    public $timestamps = true; // 是否託管更新，"Eloquent的功能 "

    use ClassInstanceTrait {
        ClassInstanceTrait::__construct as private __tConstruct;
    }
    public function __construct()
    {
        $this->builder = $this;
        $this->__tConstruct();
    }
    // 抽象方法 只要繼承Service 就需要有construct;
    abstract public function construct();

    /** 建立builder
     * @param String $table 資料庫名稱
     * @return Eloquent/Builder
     */
    public function getBuilder($table)
    {
        $this->builder->setTable($table);
        return $this->builder;
    }

    public function getList()
    {
        return $this->builder
            ->get()
            ->toArray();
    }
    public function getInfo($id) {
        return $this->builder
            ->find($id)
        ->toArray();
    }

    /** 生成資料表
     * @param String $SQL 
     */
    public function creatTable($creatSQL = "", $repIntoSQL = "") {
        DB::statement($creatSQL);

        if (!empty($repIntoSQL)) {
            DB::insert($repIntoSQL);
        }
    }

    /** 建立資料表 || 更新資料表欄位
     * @param String $tableName // 資料表名稱
     */
    public function creupTable($tableName) {
        // if (!Schema::hasTable($tableName)) {
        // Schema::create($tableName, function (Blueprint $table) {
        //     $table->increments('id');
        // });
        // } else {
        //     Schema::table($tableName, function ($table) {
        //         $table->string('email');
        //     });
        // }
    }
}
