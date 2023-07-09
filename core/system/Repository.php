<?php
namespace Core;

use Illuminate\Database\Capsule\Manager as DB; // DB 使用主要為了執行原生SQL

abstract class Repository
{
    protected $builder = Null;
    use ClassInstanceTrait {
        ClassInstanceTrait::__construct as private __tConstruct;
    }
    public function __construct() {
        $this->__tConstruct();
    }
    // 抽象方法 只要繼承Service 就需要有getInstance && construct;
    abstract public static function getInstance();
    abstract public function construct();

    /** 取得列表
     * @param Int $cid // 分類ID
     * @param Int $curpage // 目前所在頁
     * @param Int $pageSize // limit 尺寸
     * @param Int $lang // 語系
     * @return void
     */
    public function getList($cid = 0, $curPage = 1, $pageSize = 10, $select = [], $lang = 1) {
        return $this->builder
            ->where(function ($query) use($cid){
                if(!empty($cid)){
                    $query->where('category_id', $cid);
                }
            })
            ->where('enable', 1)
            ->orderBy('sort')
            ->orderBy('id', 'DESC')
            ->paginate($pageSize, ['*'], 'p', $curPage)
        ->toArray();
        //     ->get()
        // ->toArray();
    }

    public function getInfo($id, $lang) {
        if(empty($select)){
            $info = $this->builder
                ->where('id', $id)
            ->first();
        }

        return $info;
    }

    /** 建立builder
     * @param String $table 資料庫名稱
     * @return Eloquent/Builder
     */
    public function getBuilder($table) {
        return DB::setTable($table);
    }

    /** 生成資料表
     * @param String $creatSQL // 生成資料表用的 SQL
     * @param String $repIntoSQL // 生成資料表之後 要注入的資料SQL
     */
    public function creatTable($creatSQL, $repIntoSQL = '') {
        DB::statement($creatSQL);

        if (!empty($repIntoSQL)) {
            DB::insert($repIntoSQL);
        }
    }
}
