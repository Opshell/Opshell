<?php
namespace Repository;
use Core\Repository;
use Model\SysAdmin;

class sysAdminRepository extends Repository
{
    private static $_instance = null;
    public static function getInstance():sysAdminRepository {
        if( self::$_instance === null ){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function construct(){
        // $this->builder = SysAdmin::query();
        // $this->creatTableSQL();
    }

    /** 取得後台會員資料
     * @param String $user // 會員帳號
     * @return stdClass userData
     */
    public function getSysAdmin($user){
        return SysAdmin::where('user', $user)
        ->first();
    }

    /** 取得後台群組權限
     * @param Int $gid
     * @return stdClass
     */
    public function getGroupAuth($gid){
        return SysAdmin::where('id', $gid)
        ->first();
    }

    /** 取得後台SideMenu
     * @param Int $authLevel
     * @param Int $parent // 階層
     * @return stdClass
     */
    public function getSideMenu($authLevel, $parent){
        return $this->getBuilder('_sys_section')
            ->select('id', 'parent_id', 'title', 'icon', 'hide_sub', 'link')
            ->where('auth_view', '>=', $authLevel)
            ->where('parent_id', $parent)
            ->orderBy('sort')
            ->orderBy('id', 'desc')
        ->get();
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

        // 管理員
        $creatSQL = "CREATE TABLE IF NOT EXISTS `_sys_admin` (
                `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
                `group_id` int(11) NOT NULL DEFAULT 0 COMMENT '權限群組',
                `user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登入帳號',
                `pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登入密碼',
                `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '帳號名稱',
                `is_del` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否可以刪除',
                PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
                COMMENT='後台登入人員';";
        $repInsertSQL = "REPLACE INTO `_sys_admin` (`id`, `group_id`, `user`, `pass`,  `name`, `is_del`)  VALUES
	            (1, 1,'admin', '$2y$10\$f0YhI1gY/lmHqOPzYsh1veE3dChPkVl0ySDDZHOs4ahokk2Yv9bgS', 'Opshell', 0);";
        // $this->creatTable($creatSQL, $repInsertSQL);

        // 網站設定
        $creatSQL = "CREATE TABLE IF NOT EXISTS `_sys_config` (
                `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
                `group` varchar(255) NOT NULL DEFAULT 'config' COMMENT '設定群組',
                `config` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '設定',
                `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名稱',
                `value` mediumtext COLLATE utf8mb4_unicode_ci COMMENT '數值',
                `lang` tinyint(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 1 COMMENT '語言',
                PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
                COMMENT='網站設定';";
        $repInsertSQL = "REPLACE INTO `_sys_config` (`id`, `group`, `config`, `title`, `value`, `lang`)  VALUES
	            (1, 'config', 'comp_name', '網站名稱', 'Opshell', 1),
	            (2, 'config', 'comp_email', '網站E-Mail', 'phenomx9990@gmail,com', 1),
	            (3, 'seo', 'title', '標題', 'Opshell', 1),
	            (4, 'seo', 'keywords', '關鍵字', '', 1),
	            (5, 'seo', 'description', '簡述', '', 1),
	            (6, 'seo', 'og_image', '分享圖片', '', 1),
	            (7, 'config', 'ga_id', 'GA_ID', '', 1);";
        // $this->creatTable($creatSQL, $repInsertSQL);

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

        // 預設Icon
        $creatSQL = "CREATE TABLE IF NOT EXISTS `_sys_icon` (
                `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
                `icon_name` varchar(255) NOT NULL DEFAULT 'config' COMMENT 'icon名稱',
                PRIMARY KEY (`id`)
                ) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
                COMMENT='網站Icon';";
        // $this->creatTable($creatSQL);
    }
}
