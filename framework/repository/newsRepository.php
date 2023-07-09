<?php
namespace Repository;
use Core\Repository;
use Model\News;

class newsRepository extends Repository
{
    private static $_instance = null;
    public static function getInstance():newsRepository {
        if( self::$_instance === null ){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function construct() {
        // $this->builder = News::query();
        // $this->creatTable($this->createSQL());
    }

     /** 取得列表
     * @param Int $cid // 分類ID
     * @param Int $curpage // 目前所在頁
     * @param Int $pageSize // limit 尺寸
     * @param Int $lang // 語系
     * @return void
     */
    public function getList($cid = 0, $curPage = 1, $pageSize = 10, $select = [], $lang = 1) {
        // where(function ($query) use($cid){
        //     if(!empty($cid)){
        //         $query->where('category_id', $cid);
        //     }
        // })
        // ->

        return News::where('enable', 1)
            ->orderBy('sort')
            ->orderBy('id', 'DESC')
        // ->paginate($pageSize, ['*'], 'p', $curPage);
        ->get();
        // ->toArray();
    }

    public function getInfo($id, $lang = 1) {
        return News::where('id', $id)
            ->first();
    }

    // 生成資料表
    public function createSQL(){
        $SQL = "CREATE TABLE IF NOT EXISTS `".$this->table."` (
                    `id` INT NOT NULL AUTO_INCREMENT ,
                    `unique_id` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '唯一碼' ,
                    `category_id` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '最新消息分類' ,
                    `title` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '名稱' ,
                    `img` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '最新消息列表圖' ,
                    `s_img` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '最新消息列表圖(縮圖)' ,
                    `content` MEDIUMTEXT COMMENT '內容' ,
                    `added_time` DATETIME NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '新增時間' ,
                    `update_time` DATETIME NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '修改時間' ,
                    `sort` INT(3) NOT NULL DEFAULT 100 COMMENT '排序' ,
                    `lang` INT(3) NOT NULL DEFAULT 100 COMMENT '語言' ,
                    `is_show` INT(1) NOT NULL DEFAULT 1 COMMENT '是否啟用' ,
                PRIMARY KEY (`id`)) ENGINE = MyISAM CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;";
        return $SQL;
    }
}
