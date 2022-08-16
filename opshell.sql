-- --------------------------------------------------------
-- 主機:                           127.0.0.1
-- 伺服器版本:                        8.0.27 - MySQL Community Server - GPL
-- 伺服器作業系統:                      Win64
-- HeidiSQL 版本:                  11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- 傾印  資料表 opshell._sys_admin 結構
CREATE TABLE IF NOT EXISTS `_sys_admin` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `group_id` int NOT NULL DEFAULT '0' COMMENT '權限群組',
  `user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登入帳號',
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登入密碼',
  `salt` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '鹽',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '帳號名稱',
  `is_del` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否可以刪除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='後台登入人員';

-- 正在傾印表格  opshell._sys_admin 的資料：1 rows
/*!40000 ALTER TABLE `_sys_admin` DISABLE KEYS */;
REPLACE INTO `_sys_admin` (`id`, `group_id`, `user`, `pass`, `salt`, `name`, `is_del`) VALUES
	(1, 1, 'Opshell', 'O0qkxEYN8p.yY', 'O0Mu3E[a()A<', 'Opshell', 0);
/*!40000 ALTER TABLE `_sys_admin` ENABLE KEYS */;

-- 傾印  資料表 opshell._sys_config 結構
CREATE TABLE IF NOT EXISTS `_sys_config` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'config' COMMENT '設定群組',
  `config` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '設定',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名稱',
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '數值',
  `lang` tinyint(1) NOT NULL DEFAULT '1' COMMENT '語言',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='網站設定';

-- 正在傾印表格  opshell._sys_config 的資料：7 rows
/*!40000 ALTER TABLE `_sys_config` DISABLE KEYS */;
REPLACE INTO `_sys_config` (`id`, `group`, `config`, `title`, `value`, `lang`) VALUES
	(1, 'config', 'comp_name', '網站名稱', 'Opshell', 1),
	(2, 'config', 'comp_email', '網站E-Mail', 'phenomx9990@gmail,com', 1),
	(3, 'seo', 'title', '標題', 'Opshell', 1),
	(4, 'seo', 'keywords', '關鍵字', '', 1),
	(5, 'seo', 'description', '簡述', '', 1),
	(6, 'seo', 'og_image', '分享圖片', '', 1),
	(7, 'config', 'ga_id', 'GA_ID', '', 1);
/*!40000 ALTER TABLE `_sys_config` ENABLE KEYS */;

-- 傾印  資料表 opshell._sys_group 結構
CREATE TABLE IF NOT EXISTS `_sys_group` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '權限群組名稱',
  `authority` tinyint(1) NOT NULL DEFAULT '3' COMMENT '權限等級',
  `is_del` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否可以刪除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='後台權限群組';

-- 正在傾印表格  opshell._sys_group 的資料：2 rows
/*!40000 ALTER TABLE `_sys_group` DISABLE KEYS */;
REPLACE INTO `_sys_group` (`id`, `name`, `authority`, `is_del`) VALUES
	(1, 'Opshell', 0, 0),
	(2, 'Customer', 1, 0);
/*!40000 ALTER TABLE `_sys_group` ENABLE KEYS */;

-- 傾印  資料表 opshell._sys_section 結構
CREATE TABLE IF NOT EXISTS `_sys_section` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `parent_id` int NOT NULL DEFAULT '0' COMMENT '上層節點流水號',
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '節點名稱',
  `table_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '檢查資料表名稱',
  `field_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '檢查欄位名稱',
  `field_value` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '檢查欄位值',
  `auth_view` tinyint(1) NOT NULL DEFAULT '1' COMMENT '檢視權限',
  `auth_crud` tinyint(1) NOT NULL DEFAULT '1' COMMENT '控制權限',
  `hide_sub` tinyint NOT NULL DEFAULT '1' COMMENT '當節點為資料夾時是否自動關閉',
  `link` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '節點連結',
  `sort` int NOT NULL DEFAULT '100' COMMENT '排序',
  `status` int NOT NULL DEFAULT '1' COMMENT '節點狀態',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='功能表單';

-- 正在傾印表格  opshell._sys_section 的資料：8 rows
/*!40000 ALTER TABLE `_sys_section` DISABLE KEYS */;
REPLACE INTO `_sys_section` (`id`, `parent_id`, `icon`, `title`, `table_name`, `field_name`, `field_value`, `auth_view`, `auth_crud`, `hide_sub`, `link`, `sort`, `status`) VALUES
	(1, 0, 'folder', '後台管理', '', '', '', 0, 0, 1, '', 9999, 1),
	(2, 1, 'fingerprint', '權限群組', '_sys_group', '', '', 0, 0, 1, '/group', 1, 1),
	(3, 1, 'user', '後台帳號', '_sys_admin', '', '', 0, 0, 1, '/admin', 2, 1),
	(4, 1, 'folder', '網站設定', '', '', '', 0, 0, 1, '', 3, 1),
	(5, 1, 'layers', '功能表單', '_sys_section', '', '', 0, 0, 1, '/sectionList', 4, 1),
	(6, 0, 'notebook', '文章', '_web_article', '', '', 1, 1, 1, '/articleList', 1000, 1),
	(7, 0, 'square', '圖標總覽', '_sys_icon', '', '', 1, 1, 1, '/iconList', 9000, 1),
	(8, 4, 'chart-network', 'SEO 管理', '', '', '', 0, 0, 1, '/seo', 100, 1),
	(9, 4, 'settings', '基本設定', '_sys_config', '', '', 1, 1, 1, '/setting', 100, 1);
/*!40000 ALTER TABLE `_sys_section` ENABLE KEYS */;

-- 傾印  資料表 opshell._web_article 結構
CREATE TABLE IF NOT EXISTS `_web_article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unique_id` int NOT NULL DEFAULT '0' COMMENT '多語系用',
  `category_id` int NOT NULL DEFAULT '0' COMMENT '分類ID',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '標題',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '內容',
  `img` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '主圖',
  `img_s` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '縮圖',
  `sort` int NOT NULL DEFAULT '1' COMMENT '排序',
  `lang` int NOT NULL DEFAULT '1' COMMENT '語系',
  `enable` int NOT NULL DEFAULT '1' COMMENT '是否啟用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='文章';

-- 正在傾印表格  opshell._web_article 的資料：2 rows
/*!40000 ALTER TABLE `_web_article` DISABLE KEYS */;
REPLACE INTO `_web_article` (`id`, `unique_id`, `category_id`, `title`, `content`, `img`, `img_s`, `sort`, `lang`, `enable`) VALUES
	(1, 1, 0, '測試', '為啥content不能為空字串?', '', '', 1, 1, 1),
	(2, 2, 0, '還是測試', '已經習慣用description了  要改成content好麻煩...', '', '', 1, 1, 1);
/*!40000 ALTER TABLE `_web_article` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
