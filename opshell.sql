-- --------------------------------------------------------
-- 主機:                           127.0.0.1
-- 伺服器版本:                        10.4.10-MariaDB - mariadb.org binary distribution
-- 伺服器作業系統:                      Win64
-- HeidiSQL 版本:                  11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 傾印  資料表 hsintu2020._sys_admin 結構
CREATE TABLE IF NOT EXISTS `_sys_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `login_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '登入帳號',
  `login_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '登入密碼',
  `gpid` int(11) NOT NULL DEFAULT 0 COMMENT '權限群組',
  `real_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '姓名',
  `is_del` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否刪除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='後台登入人員';

-- 正在傾印表格  hsintu2020._sys_admin 的資料：1 rows
/*!40000 ALTER TABLE `_sys_admin` DISABLE KEYS */;
REPLACE INTO `_sys_admin` (`id`, `login_name`, `login_pass`, `gpid`, `real_name`, `is_del`) VALUES
	(1, 'admin', '$2y$10$f0YhI1gY/lmHqOPzYsh1veE3dChPkVl0ySDDZHOs4ahokk2Yv9bgS', 1, '管理員', 0);
/*!40000 ALTER TABLE `_sys_admin` ENABLE KEYS */;

-- 傾印  資料表 hsintu2020._sys_ga 結構
CREATE TABLE IF NOT EXISTS `_sys_ga` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `ga_id` int(11) NOT NULL DEFAULT 0 COMMENT '多國語言共用流水號',
  `note` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '內容',
  `lang` int(11) NOT NULL DEFAULT 1 COMMENT '語系',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Google Analytics';

-- 正在傾印表格  hsintu2020._sys_ga 的資料：1 rows
/*!40000 ALTER TABLE `_sys_ga` DISABLE KEYS */;
REPLACE INTO `_sys_ga` (`id`, `ga_id`, `note`, `lang`) VALUES
	(1, 1, '', 1);
/*!40000 ALTER TABLE `_sys_ga` ENABLE KEYS */;

-- 傾印  資料表 hsintu2020._sys_group 結構
CREATE TABLE IF NOT EXISTS `_sys_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '權限群組名稱',
  `is_del` int(11) NOT NULL DEFAULT 0 COMMENT '是否刪除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='後台權限群組';

-- 正在傾印表格  hsintu2020._sys_group 的資料：1 rows
/*!40000 ALTER TABLE `_sys_group` DISABLE KEYS */;
REPLACE INTO `_sys_group` (`id`, `name`, `is_del`) VALUES
	(1, '超級管理員', 0);
/*!40000 ALTER TABLE `_sys_group` ENABLE KEYS */;

-- 傾印  資料表 hsintu2020._sys_group_perm 結構
CREATE TABLE IF NOT EXISTS `_sys_group_perm` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `admin_id` int(11) NOT NULL DEFAULT 0 COMMENT '後台人員流水號',
  `group_id` int(11) NOT NULL DEFAULT 0 COMMENT '權限群組流水號',
  `perm_id` int(11) NOT NULL DEFAULT 0 COMMENT '權限節點流水號',
  `s_tag` tinyint(4) NOT NULL DEFAULT 0 COMMENT '檢視權限',
  `a_tag` tinyint(4) NOT NULL DEFAULT 0 COMMENT '新增權限',
  `e_tag` tinyint(4) NOT NULL DEFAULT 0 COMMENT '修改權限',
  `d_tag` tinyint(4) NOT NULL DEFAULT 0 COMMENT '刪除權限',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='後台權限群組內容';

-- 正在傾印表格  hsintu2020._sys_group_perm 的資料：50 rows
/*!40000 ALTER TABLE `_sys_group_perm` DISABLE KEYS */;
REPLACE INTO `_sys_group_perm` (`id`, `admin_id`, `group_id`, `perm_id`, `s_tag`, `a_tag`, `e_tag`, `d_tag`) VALUES
	(1, 0, 1, 1, 0, 0, 0, 0),
	(2, 0, 1, 2, 0, 1, 1, 1),
	(3, 0, 1, 3, 0, 1, 1, 1),
	(4, 0, 1, 4, 0, 1, 1, 1),
	(5, 0, 1, 5, 0, 1, 1, 1),
	(6, 0, 1, 6, 0, 0, 0, 0),
	(7, 0, 1, 7, 0, 1, 1, 1),
	(8, 0, 1, 8, 0, 1, 1, 1),
	(9, 0, 1, 9, 0, 1, 1, 1),
	(10, 0, 1, 10, 0, 1, 1, 1),
	(11, 0, 1, 11, 0, 1, 1, 1),
	(12, 0, 1, 12, 0, 1, 1, 1),
	(13, 0, 1, 13, 0, 1, 1, 1),
	(14, 0, 1, 14, 0, 1, 1, 1),
	(15, 0, 1, 15, 0, 1, 1, 1),
	(16, 0, 1, 16, 0, 1, 1, 1),
	(17, 0, 1, 17, 0, 1, 1, 1),
	(18, 0, 1, 18, 0, 1, 1, 1),
	(19, 0, 1, 19, 0, 1, 1, 1),
	(20, 0, 1, 20, 0, 1, 1, 1),
	(21, 0, 1, 21, 0, 1, 1, 1),
	(22, 0, 1, 22, 0, 1, 1, 1),
	(23, 0, 1, 23, 0, 1, 1, 1),
	(24, 0, 1, 24, 0, 1, 1, 1),
	(25, 0, 1, 25, 0, 1, 1, 1),
	(26, 0, 1, 26, 0, 1, 1, 1),
	(27, 0, 1, 27, 0, 1, 1, 1),
	(28, 0, 1, 10, 0, 1, 1, 1),
	(29, 0, 1, 11, 0, 1, 1, 1),
	(30, 0, 1, 12, 0, 1, 1, 1),
	(31, 0, 1, 13, 0, 1, 1, 1),
	(32, 0, 1, 14, 0, 1, 1, 1),
	(33, 0, 1, 15, 0, 1, 1, 1),
	(34, 0, 1, 16, 0, 1, 1, 1),
	(35, 0, 1, 17, 0, 1, 1, 1),
	(36, 0, 1, 18, 0, 1, 1, 1),
	(37, 0, 1, 19, 0, 1, 1, 1),
	(38, 0, 1, 20, 0, 1, 1, 1),
	(39, 0, 1, 21, 0, 1, 1, 1),
	(40, 0, 1, 22, 0, 1, 1, 1),
	(41, 0, 1, 23, 0, 1, 1, 1),
	(42, 0, 1, 24, 0, 1, 1, 1),
	(43, 0, 1, 25, 0, 1, 1, 1),
	(44, 0, 1, 26, 0, 1, 1, 1),
	(45, 0, 1, 27, 0, 1, 1, 1),
	(46, 0, 1, 28, 0, 1, 1, 1),
	(47, 0, 1, 29, 0, 1, 1, 1),
	(48, 0, 1, 30, 0, 1, 1, 1),
	(49, 0, 1, 31, 0, 1, 1, 1),
	(50, 0, 1, 32, 0, 1, 1, 1);
/*!40000 ALTER TABLE `_sys_group_perm` ENABLE KEYS */;

-- 傾印  資料表 hsintu2020._sys_section 結構
CREATE TABLE IF NOT EXISTS `_sys_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '節點名稱',
  `table_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '檢查資料表名稱',
  `field_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '檢查欄位名稱',
  `field_value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '檢查欄位值',
  `parent_id` int(11) NOT NULL DEFAULT 0 COMMENT '上層節點流水號',
  `link` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '節點連結',
  `sort` int(11) NOT NULL DEFAULT 100 COMMENT '排序',
  `hide_sub` tinyint(4) NOT NULL DEFAULT 1 COMMENT '當節點為資料夾時是否自動關閉',
  `Slist` int(11) NOT NULL DEFAULT 1 COMMENT '是否提供列表權限',
  `Sadd` int(11) NOT NULL DEFAULT 1 COMMENT '是否提供新增權限',
  `Sedit` int(11) NOT NULL DEFAULT 1 COMMENT '是否提供修改權限',
  `Sdelete` int(11) NOT NULL DEFAULT 1 COMMENT '是否提供刪除權限',
  `control` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否提供控制',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '節點狀態',
  `data_count` int(11) NOT NULL DEFAULT 0 COMMENT '資料筆數',
  `show_data_count` int(11) NOT NULL DEFAULT 0 COMMENT '是否顯示資料筆數',
  `node_table` int(11) NOT NULL DEFAULT 0 COMMENT '節點來源資料表',
  `node_id` int(11) NOT NULL DEFAULT 0 COMMENT '節點來源資料流水號',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='後台節點';

-- 正在傾印表格  hsintu2020._sys_section 的資料：25 rows
/*!40000 ALTER TABLE `_sys_section` DISABLE KEYS */;
REPLACE INTO `_sys_section` (`id`, `name`, `table_name`, `field_name`, `field_value`, `parent_id`, `link`, `sort`, `hide_sub`, `Slist`, `Sadd`, `Sedit`, `Sdelete`, `control`, `status`, `data_count`, `show_data_count`, `node_table`, `node_id`) VALUES
	(1, '管理權限', '', '', '', 0, '', 9900, 1, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0),
	(2, '群组管理', '_sys_group', '', '', 1, 'index.php?type=system&do=group', 9910, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(3, '帳號管理', '_sys_admin', '', '', 1, 'index.php?type=system&do=user', 9920, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(4, '權限管理', '_sys_group_perm', '', '', 1, 'index.php?type=system&do=group_permission', 9930, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(5, '功能表單管理', '_sys_section', '', '', 1, 'index.php?type=system&do=treefunction.list', 9999, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(6, 'SEO管理', '', '', '', 1, '', 9940, 1, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0),
	(7, 'SEO管理', '_sys_seo', '', '', 6, 'index.php?type=system&do=list&cn=seo', 1000, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(8, 'Google Analytics', '_sys_ga', '', '', 6, 'index.php?type=system&do=info&cn=ga&id=1', 2000, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(9, '網站地圖', '_sys_sitemap', '', '', 6, 'index.php?type=system&do=info&cn=sitemap&id=1', 3000, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(10, 'BANNER管理', '', '', '', 0, '', 1000, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(11, 'BANNER管理(繁體中文)', 'banner_tw', '', '', 10, 'index.php?type=web&do=list&cn=banner_tw', 1000, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(12, 'BANNER管理(英文)', 'banner_en', '', '', 10, 'index.php?type=web&do=list&cn=banner_en', 2000, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(14, '公司簡介', '_web_about', '', '', 0, 'index.php?type=web&do=list&cn=about', 3000, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(15, '產品資訊', '', '', '', 0, '', 4000, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(16, '產品分類', '_web_product_category', '', '', 15, 'index.php?type=web&do=list&cn=product_category', 1000, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(17, '產品', '_web_product', '', '', 15, 'index.php?type=web&do=list&cn=product', 2000, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(19, '聯絡我們', '', '', '', 0, '', 6000, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(20, '聯絡我們-信箱管理', '_web_contact_email', '', '', 19, 'index.php?type=web&do=list&cn=contact_email', 1000, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(21, '聯絡我們', '_web_contact', '', '', 19, 'index.php?type=web&do=list&cn=contact', 2000, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(22, '網站資料', '_web_web_setting', 'id', '1', 0, 'index.php?type=web&do=info&cn=web_setting&id=1', 500, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(23, '最新消息', '_web_news', '', '', 24, 'index.php?type=web&do=list&cn=news', 200, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(24, '最新消息管理', '', '', '', 0, '', 3500, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(25, '最新消息分類', '_web_news_category', '', '', 24, 'index.php?type=web&do=list&cn=news_category', 100, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(26, '檔案下載', '_web_support', '', '', 0, 'index.php?type=web&do=list&cn=support', 4500, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
	(32, 'BANNER管理(日文)', 'banner_jp', '', '', 10, 'index.php?type=web&do=list&cn=banner_jp', 3000, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0);
/*!40000 ALTER TABLE `_sys_section` ENABLE KEYS */;

-- 傾印  資料表 hsintu2020._sys_seo 結構
CREATE TABLE IF NOT EXISTS `_sys_seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `seo_id` int(11) NOT NULL DEFAULT 0 COMMENT '多國語言共用流水號',
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '頁面名稱',
  `action_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '頁面名稱',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '標題',
  `keywords` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '關鍵字',
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '描述',
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分享圖示',
  `sort` int(11) NOT NULL DEFAULT 100 COMMENT '排序',
  `lang` int(11) NOT NULL DEFAULT 1 COMMENT '語系',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='SEO管理';

-- 正在傾印表格  hsintu2020._sys_seo 的資料：14 rows
/*!40000 ALTER TABLE `_sys_seo` DISABLE KEYS */;
REPLACE INTO `_sys_seo` (`id`, `seo_id`, `action`, `action_name`, `title`, `keywords`, `description`, `og_image`, `sort`, `lang`) VALUES
	(1, 1, '', '全站預設', '達盈科技工業股份有限公司', '', '', '', 100, 1),
	(2, 1, '', '全站預設', 'DARING TECHNOLOGY INDUSTRY CO., LTD.', '', '', '', 100, 3),
	(3, 3, 'index', '首頁', '達盈科技工業股份有限公司', '', '', '', 200, 1),
	(4, 3, 'index', '首頁', 'DARING TECHNOLOGY INDUSTRY CO., LTD.', '', '', '', 200, 3),
	(5, 5, 'about', '公司簡介', '達盈科技工業股份有限公司', '', '', '', 300, 1),
	(6, 5, 'about', '公司簡介', 'DARING TECHNOLOGY INDUSTRY CO., LTD.', '', '', '', 300, 3),
	(7, 7, 'pro_list', '產品資訊', '達盈科技工業股份有限公司', '', '', '', 400, 1),
	(8, 7, 'pro_list', '產品資訊', 'DARING TECHNOLOGY INDUSTRY CO., LTD.', '', '', '', 400, 3),
	(9, 9, 'prod', '產品資訊內頁', '達盈科技工業股份有限公司', '', '', '', 500, 1),
	(10, 9, 'prod', '產品資訊內頁', 'DARING TECHNOLOGY INDUSTRY CO., LTD.', '', '', '', 500, 3),
	(11, 11, 'application', '附加功能', '達盈科技工業股份有限公司', '', '', '', 600, 1),
	(12, 11, 'application', '附加功能', 'DARING TECHNOLOGY INDUSTRY CO., LTD.', '', '', '', 600, 3),
	(13, 13, 'contact', '聯絡我們', '達盈科技工業股份有限公司', '', '', '', 700, 1),
	(14, 13, 'contact', '聯絡我們', 'DARING TECHNOLOGY INDUSTRY CO., LTD.', '', '', '', 700, 3);
/*!40000 ALTER TABLE `_sys_seo` ENABLE KEYS */;

-- 傾印  資料表 hsintu2020._sys_session 結構
CREATE TABLE IF NOT EXISTS `_sys_session` (
  `session_key` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_expiry` int(11) DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`session_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 正在傾印表格  hsintu2020._sys_session 的資料：~1 rows (近似值)
/*!40000 ALTER TABLE `_sys_session` DISABLE KEYS */;
REPLACE INTO `_sys_session` (`session_key`, `session_data`, `session_expiry`, `ip`) VALUES
	('pokf4pu4oj1mafe4tov2j0pm5s', 'csrf|s:44:"XOygc+4qJidxr64M1/2YyFQkBNVmL2Hx0hCuvZ5hfL4=";lang|s:1:"1";', 1622774777, '127.0.0.1');
/*!40000 ALTER TABLE `_sys_session` ENABLE KEYS */;

-- 傾印  資料表 hsintu2020._sys_sitemap 結構
CREATE TABLE IF NOT EXISTS `_sys_sitemap` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `note` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '內容',
  `last_modified_date` date NOT NULL DEFAULT '1000-01-01' COMMENT '日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='網站地圖';

-- 正在傾印表格  hsintu2020._sys_sitemap 的資料：0 rows
/*!40000 ALTER TABLE `_sys_sitemap` DISABLE KEYS */;
/*!40000 ALTER TABLE `_sys_sitemap` ENABLE KEYS */;


-- 傾印  資料表 hsintu2020._web_banner 結構
CREATE TABLE IF NOT EXISTS `_web_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `title` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '圖片說明',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '網址',
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '開啟方式',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '圖片',
  `img_s` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '圖片(縮圖)',
  `img_source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '圖片(原圖)',
  `sort` int(11) NOT NULL DEFAULT 100 COMMENT '排序',
  `is_show` int(11) NOT NULL DEFAULT 1 COMMENT '是否啟用',
  `lang` int(11) NOT NULL DEFAULT 1 COMMENT '語系',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='跑馬燈圖片管理';

-- 正在傾印表格  hsintu2020._web_banner 的資料：3 rows
/*!40000 ALTER TABLE `_web_banner` DISABLE KEYS */;
REPLACE INTO `_web_banner` (`id`, `title`, `url`, `target`, `img`, `img_s`, `img_source`, `sort`, `is_show`, `lang`) VALUES
	(1, '第一張', '', '_self', 'upload/banner/img/20210505144410GoY.png', 'upload/banner/img_s/20210505144410GoY.png', 'upload/banner/img_source/20210505144410GoY.png', 100, 1, 1),
	(2, '第二張', 'https://www.iware.com.tw', '_self', 'upload/banner/img/20210505153213RxL.png', 'upload/banner/img_s/20210505153213RxL.png', 'upload/banner/img_source/20210505153213RxL.png', 200, 1, 1),
	(4, '英文', '', '_self', 'upload/banner/img/20210505145904Dxx.png', 'upload/banner/img_s/20210505145904Dxx.png', 'upload/banner/img_source/20210505145904Dxx.png', 100, 1, 3);
/*!40000 ALTER TABLE `_web_banner` ENABLE KEYS */;

-- 傾印  資料表 hsintu2020._web_contact 結構
CREATE TABLE IF NOT EXISTS `_web_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '姓名',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '電話',
  `email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '電子信箱',
  `message` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '詢問內容',
  `add_time` datetime NOT NULL COMMENT '留言時間',
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '備註',
  `is_deal` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否已處理',
  `deal_time` datetime NOT NULL COMMENT '處理時間',
  `source_lang` int(11) NOT NULL DEFAULT 1 COMMENT '來源語系',
  `ip` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '留言IP',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='聯絡我們';

-- 正在傾印表格  hsintu2020._web_contact 的資料：1 rows
/*!40000 ALTER TABLE `_web_contact` DISABLE KEYS */;
REPLACE INTO `_web_contact` (`id`, `name`, `phone`, `email`, `message`, `add_time`, `remark`, `is_deal`, `deal_time`, `source_lang`, `ip`) VALUES
	(4, 'bb', 'jkl', 'bear@iware.com.tw', '123\n456\n789', '2021-05-10 16:12:13', '', 0, '0000-00-00 00:00:00', 1, '127.0.0.1');
/*!40000 ALTER TABLE `_web_contact` ENABLE KEYS */;

-- 傾印  資料表 hsintu2020._web_contact_email 結構
CREATE TABLE IF NOT EXISTS `_web_contact_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'email',
  `lang` int(11) NOT NULL DEFAULT 1 COMMENT '語言',
  `is_show` int(11) NOT NULL DEFAULT 1 COMMENT '是否啟用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='聯絡我們-信箱管理';

-- 正在傾印表格  hsintu2020._web_contact_email 的資料：1 rows
/*!40000 ALTER TABLE `_web_contact_email` DISABLE KEYS */;
REPLACE INTO `_web_contact_email` (`id`, `email`, `lang`, `is_show`) VALUES
	(1, 'yuwei@iware.com.tw', 1, 1);
/*!40000 ALTER TABLE `_web_contact_email` ENABLE KEYS */;



-- 傾印  資料表 hsintu2020._web_about 結構
CREATE TABLE IF NOT EXISTS `_web_about` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `about_id` int(11) NOT NULL DEFAULT 0 COMMENT '多國語言共用流水號',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '標題',
  `note` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '說明',
  `seo_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '網頁標題',
  `seo_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '網頁關鍵字',
  `seo_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '網頁描述',
  `custom_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '自訂網址',
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '分享圖示',
  `sort` int(11) NOT NULL DEFAULT 100 COMMENT '排序',
  `is_show` int(11) NOT NULL DEFAULT 1 COMMENT '是否啟用',
  `lang` int(11) NOT NULL DEFAULT 1 COMMENT '語系',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='公司簡介';



-- 傾印  資料表 hsintu2020._web_patent 結構
CREATE TABLE IF NOT EXISTS `_web_patent` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `title` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '圖片說明',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '網址',
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '開啟方式',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '圖片',
  `img_s` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '圖片(縮圖)',
  `img_source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '圖片(原圖)',
  `sort` int(11) NOT NULL DEFAULT 100 COMMENT '排序',
  `is_show` int(11) NOT NULL DEFAULT 1 COMMENT '是否啟用',
  `lang` int(11) NOT NULL DEFAULT 1 COMMENT '語系',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='專利管理';



-- 傾印  資料表 hsintu2020._web_news_category 結構
CREATE TABLE IF NOT EXISTS `_web_news_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `news_category_id` int(11) NOT NULL DEFAULT 0 COMMENT '多國語言共用流水號',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '標題',
  `sort` int(11) NOT NULL DEFAULT 100 COMMENT '排序',
  `is_show` int(11) NOT NULL DEFAULT 1 COMMENT '是否啟用',
  `lang` int(11) NOT NULL DEFAULT 1 COMMENT '語系',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='最新消息分類';

-- 傾印  資料表 hsintu2020._web_news 結構
CREATE TABLE IF NOT EXISTS `_web_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `category_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '分類ID',
  `news_id` int(11) NOT NULL DEFAULT 0 COMMENT '多國語言共用流水號',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '標題',
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '地點',
  `period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '時間',
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '內容',
  `sort` int(11) NOT NULL DEFAULT 100 COMMENT '排序',
  `is_show` int(11) NOT NULL DEFAULT 1 COMMENT '是否啟用',
  `lang` int(11) NOT NULL DEFAULT 1 COMMENT '語系',
  `created_at` datetime DEFAULT '2000-01-01 00:00:00' COMMENT '新增時間',
  `seo_title` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '網頁標題',
  `seo_keywords` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '網頁關鍵字',
  `seo_description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '網頁描述',
  `custom_url` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '自訂網址',
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分享圖示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='最新消息';



-- 傾印  資料表 hsintu2020._web_product_category 結構
CREATE TABLE IF NOT EXISTS `_web_product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `product_category_id` int(11) NOT NULL DEFAULT 0 COMMENT '多國語言共用流水號',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '標題',
  `sort` int(11) NOT NULL DEFAULT 100 COMMENT '排序',
  `is_show` int(11) NOT NULL DEFAULT 1 COMMENT '是否啟用',
  `lang` int(11) NOT NULL DEFAULT 1 COMMENT '語系',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='設備分類';

-- 傾印  資料表 hsintu2020._web_product 結構
CREATE TABLE IF NOT EXISTS `_web_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `category_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '分類ID',
  `product_id` int(11) NOT NULL DEFAULT 0 COMMENT '多國語言共用流水號',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '標題',
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '地點',
  `period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '時間',
  `description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '內容',
  `sort` int(11) NOT NULL DEFAULT 100 COMMENT '排序',
  `is_show` int(11) NOT NULL DEFAULT 1 COMMENT '是否啟用',
  `lang` int(11) NOT NULL DEFAULT 1 COMMENT '語系',
  `created_at` datetime DEFAULT '2000-01-01 00:00:00' COMMENT '新增時間',
  `seo_title` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '網頁標題',
  `seo_keywords` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '網頁關鍵字',
  `seo_description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '網頁描述',
  `custom_url` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '自訂網址',
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分享圖示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='設備';





-- 傾印  資料表 hsintu2020._web_support 結構
CREATE TABLE IF NOT EXISTS `_web_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `support_id` int(11) NOT NULL DEFAULT 0 COMMENT '多國語言共用流水號',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '' COMMENT '標題',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '圖片',
  `img_s` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '圖片(縮圖)',
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '檔案',
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '檔案原始檔名',
  `file_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '檔案大小',
  `file_download_times` int(11) NOT NULL DEFAULT 0 COMMENT '檔案下載次數',
  `sort` int(11) NOT NULL DEFAULT 100 COMMENT '排序',
  `is_show` int(11) NOT NULL DEFAULT 1 COMMENT '是否啟用',
  `lang` int(11) NOT NULL DEFAULT 1 COMMENT '語系',
  `seo_title` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '網頁標題',
  `seo_keywords` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '網頁關鍵字',
  `seo_description` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '網頁描述',
  `custom_url` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '自訂網址',
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '分享圖示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='檔案下載';

-- 正在傾印表格  hsintu2020._web_support 的資料：3 rows
/*!40000 ALTER TABLE `_web_support` DISABLE KEYS */;
REPLACE INTO `_web_support` (`id`, `support_id`, `title`, `img`, `img_s`, `file`, `file_name`, `file_size`, `file_download_times`, `sort`, `is_show`, `lang`, `seo_title`, `seo_keywords`, `seo_description`, `custom_url`, `og_image`) VALUES
	(1, 1, '測試', 'upload/support/img/20210526135056olX.png', 'upload/support/img_s/20210526135056olX.png', 'upload/support/file/20210526134054zeV.png', '20210406151525344GQJ5DLGCJJ.png', '10194', 0, 100, 1, 1, '', '', '', '', ''),
	(2, 1, 'test', 'upload/support/img/20210526135056olX.png', 'upload/support/img_s/20210526135056olX.png', 'upload/support/file/20210526135056NvQ.png', '20210406170412813A8R486VTSD.png', '259623', 0, 100, 1, 3, '', '', '', '', ''),
	(3, 1, 'テスト', 'upload/support/img/20210526135056olX.png', 'upload/support/img_s/20210526135056olX.png', 'upload/support/file/20210526134054fTL.jpg', '20210406151555447C4Q97ESFUX.jpg', '8125', 0, 100, 1, 4, '', '', '', '', '');
/*!40000 ALTER TABLE `_web_support` ENABLE KEYS */;

-- 傾印  資料表 hsintu2020._web_web_setting 結構
CREATE TABLE IF NOT EXISTS `_web_web_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號',
  `web_setting_id` int(11) NOT NULL DEFAULT 0 COMMENT '多國語言共用流水號',
  `company_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司名稱',
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '地址',
  `phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '電話',
  `fax` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '傳真',
  `email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '信箱',
  `lang` int(11) NOT NULL DEFAULT 1 COMMENT '語系',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='網站資料';

-- 正在傾印表格  hsintu2020._web_web_setting 的資料：3 rows
/*!40000 ALTER TABLE `_web_web_setting` DISABLE KEYS */;
REPLACE INTO `_web_web_setting` (`id`, `web_setting_id`, `company_name`, `address`, `phone`, `fax`, `email`, `lang`) VALUES
	(1, 1, '信都電子股份有限公司', '42756 台中市潭子區雅潭路二段292巷11號', '04-2531-4095', '04-2533-5327', 'daring@daring.com.tw', 1),
	(2, 1, 'Xindu Electronics Co., Ltd.', 'No. 11, Lane 292, Section 2, Yatan Road, Tanzi District, Taichung City 42756', '+886-4-2531-4095', '+886-4-2533-5327', 'daring@daring.com.tw', 3),
	(3, 1, 'Xindu Electronics Co., Ltd.', '4276 台中市潭子区八幡路2号線192号線11号', '+886-4-2531-4095', '+886-4-2533-5327', 'daring@daring.com.tw', 4);
/*!40000 ALTER TABLE `_web_web_setting` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
