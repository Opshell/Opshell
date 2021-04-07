<?php
namespace Repository;
use Core\Repository;

class newsRepository extends Repository
{
    public function construct()
    {
        $this->table = '_web_news';
        $this->creatTable($this->creatTableSQL());
    }

    public function getList(){
        $cid = !empty($_GET['cid'])? $_GET['cid'] : 0;

        if (!empty($cid)) {
            $this->builder = $this->builder->where('category_id', $cid);
        }

        $list = $this->builder
            ->where('is_show', 1)
            ->orderBy('sort')
            ->get()
        ->toArray();
            
        return $list;
    }



    // 生成資料表
    public function creatTableSQL(){
        $SQL = "CREATE TABLE IF NOT EXISTS `" . $this->table . "` (
                    `id` INT NOT NULL AUTO_INCREMENT ,
                    `unique_id` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '唯一碼' ,
                    `category_id` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '最新消息分類' ,
                    `title` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '名稱' ,
                    `img` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '最新消息列表圖' ,
                    `s_img` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '最新消息列表圖(縮圖)' ,
                    `content` MEDIUMTEXT NOT NULL DEFAULT '' COMMENT '內容' ,
                    `added_time` DATETIME NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '新增時間' ,
                    `update_time` DATETIME NOT NULL DEFAULT '2000-01-01 00:00:00' COMMENT '修改時間' ,
                    `sort` INT(3) NOT NULL DEFAULT 100 COMMENT '排序' ,
                    `lang` INT(3) NOT NULL DEFAULT 100 COMMENT '語言' ,
                    `is_show` INT(1) NOT NULL DEFAULT 1 COMMENT '是否啟用' ,
                PRIMARY KEY (`id`)) ENGINE = MyISAM CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;";
                
        return $SQL;
    }
}
