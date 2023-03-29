<?php
namespace Repository;
use Core\Repository;
use Model\SysSection;

class sysSectionRepository extends Repository
{
    private static $_instance = null;
    public static function getInstance():sysSectionRepository {
        if( self::$_instance === null ){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function construct(){
        // $this->builder = SysSection::query();
        // $this->creatTableSQL();
    }

    public function getList($cid = 0, $curPage = 1, $pageSize = 10, $select = [],  $lang = 1){
        if(empty($select)){
            $list = SysSection::get();
        } else {
            $select = implode(', ', $select);
            $list = SysSection::select($select)->get();
        }

        return $list;
    }

    public function getInfo($id = 0, $select = []) {
        if(empty($select)){
            $info = SysSection::with([ 'Parent' ])
                ->where('id', $id)
            ->first();
        } else {
            $info = SysSection::select($select)
                ->with([ 'Parent' ])
                ->where('id', $id)
            ->first();
        }

        return $info;
    }

    /** 取得後台SideMenu
     * @param Int $authLevel
     * @param Int $parent // 階層
     * @return stdClass
     */
    public function getSideMenu($authLevel, $parent){
        return SysSection::select('id', 'parent_id', 'title', 'icon', 'hide_sub', 'link')
            ->where('auth_view', '>=', $authLevel)
            ->where('parent_id', $parent)
            ->orderBy('sort')
            ->orderBy('id', 'desc')
        ->get();
    }

    /** 從parent_id == 0 && $authLevel 權限
     *  開始取得後台section
     *  如果有子節點，則繼續取得子節點並排序在後面
     *  通通在同一階層
     *  @param Int $authLevel
     *  @return stdClass
     */
    public function getSectionList($authLevel){
        return SysSection::select('id', 'parent_id', 'title', 'icon', 'hide_sub', 'link')
            ->where('auth_view', '>=', $authLevel)
            ->orderBy('parent_id')
            ->orderBy('sort')
        ->get();
    }


    // 生成資料表
    public function creatTableSQL(){
        // 後台管理及權限設定
        $creatSQL = "CREATE TABLE IF NOT EXISTS `_sys_section` (
                `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
                `parent_id` int(11) NOT NULL DEFAULT 0 COMMENT '上層節點流水號',
                `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '節點名稱',
                `table_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '檢查資料表名稱',
                `field_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '檢查欄位名稱',
                `field_value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '檢查欄位值',
                `auth_view` tinyint(1) NOT NULL DEFAULT 1 COMMENT '檢視權限',
                `auth_crud` tinyint(1) NOT NULL DEFAULT 1 COMMENT '控制權限',
                `hide_sub` tinyint(4) NOT NULL DEFAULT 1 COMMENT '當節點為資料夾時是否自動關閉',
                `link` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '節點連結',
                `sort` int(11) NOT NULL DEFAULT 100 COMMENT '排序',
                `status` int(11) NOT NULL DEFAULT 1 COMMENT '節點狀態',
                PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
                COMMENT='功能表單';";
        $repInsertSQL = "REPLACE INTO `_sys_section` (`id`, `parent_id`, `title`, `table_name`, `field_name`, `field_value`, `auth_view`, `auth_crud`, `hide_sub`, `link`, `sort`, `status`) VALUES
                (1, 0, '後台管理', '', '', '', 0, 0, 1, '', 9999, 1),
                (2, 1, '權限群組', '_sys_group', '', '', 0, 0, 1, '/api/group/list', 1, 1),
                (3, 1, '後台帳號', '_sys_admin', '', '', 0, 0, 1, '/api/admin/list', 2, 1),
                (4, 1, '網站設定', '_sys_config', '', '', 0, 0, 1, '/api/config/info', 3, 1),
                (5, 1, '功能表單', '_sys_section', '', '', 0, 0, 1, '/api/section/info', 4, 1);";
        // $this->creatTable($creatSQL, $repInsertSQL);
    }
}
