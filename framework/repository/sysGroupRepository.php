<?php
namespace Repository;
use Core\Repository;
use Model\SysGroup;

class sysGroupRepository extends Repository
{
    private static $_instance = null;
    public static function getInstance():sysGroupRepository {
        if( self::$_instance === null ){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function construct(){
        // $this->builder = SysGroup::query();
        // $this->creatTableSQL();
    }

    /** 取得後台群組權限
     * @param Int $gid
     * @return stdClass
     */
    public function getGroupAuth($gid){
        return SysGroup::where('id', $gid)
        ->first();
    }

    // 生成資料表
    public function creatTableSQL(){
        /** 管理員群組
         * 權限劃分
         * 0 最高管理員 // 能瀏覽編輯網站所有資訊 EX: 網站工程師
         * 1 高級管理員 // 能瀏覽編輯 除了網站Config外的全部資訊 EX: 上架人員主管
         * 2 一般管理員 // 能瀏覽特定資訊 並有一定的編輯權限 EX: 一般上架人員
         * 3 訪客 // 只能瀏覽非重要的資訊 EX : about news 無任何編輯權限
         */
        $creatSQL = "CREATE TABLE IF NOT EXISTS `_sys_group` (
                `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
                `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '權限群組名稱',
                `authority` tinyint(1) NOT NULL DEFAULT 3 COMMENT '權限等級',
                `is_del` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否可以刪除',
                PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
                COMMENT='後台權限群組';";
        $repInsertSQL = "REPLACE INTO `_sys_group` (`id`, `name`, `authority`, `is_del`) VALUES
	            (1, 'Opshell', 0, 0),
                (2, 'Customer', 1, 0);";
        // $this->creatTable($creatSQL, $repInsertSQL);
    }
}
