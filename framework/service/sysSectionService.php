<?php
namespace Service;
use Core\Service;
use Repository\sysSectionRepository;

class sysSectionService extends Service {
    private static $_instance = null;
    public static function getInstance():sysSectionService {
        if( self::$_instance === null ){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function construct() {
        $this->Repository = sysSectionRepository::getInstance();
    }

    /** 取得後台側邊Menu
     * @param Int $auth
     * @param Int $pid
     */
    public function getSideMenu($auth = 3, $pid = 0) {
        // 取最外層
        $this->result['status'] = true;
        $this->result['message'] = 'Getting success.';
        $this->result['data'] = $this->getSideMenuRecursive($auth, $pid);
            // ->getSideMenu($auth, $pid)
            // ->map(function ($e) use ($auth) {
            //     $child = $this->getSideMenuRecursive($auth, $e->id);

            //     if (!empty($child)) {
            //         $e->child = $child;
            //     }

            //     return $e;
            // })->toArray();

        return (object)$this->result;
    }

    /** Menu 遞迴
     * @param Int $auth
     * @param Int $pid
     * @return Array $child
     */
    public function getSideMenuRecursive($auth = 3, $pid = 0) {
        return $this->Repository->getSideMenu($auth, $pid)
            ->map(function ($e) use ($auth) {
                $child = $this->getSideMenuRecursive($auth, $e->id);

                if (!empty($child)) {
                    $e->child = $child;
                }

                return $e;
            })->toArray();
    }

    /** 取得後台 SectionList
     * @param Int $auth
     */
    public function getSectionList($auth) {
        $this->result['status'] = true;
        $this->result['message'] = 'Getting success.';

        $list = [];
        // 拉出全部的資料
        $temp = $this->Repository->getSectionList($auth);

        // [-] 用遞迴處理$temp的排序到$list裡
        // 依照parent_id ,id 的關係做排序
        // 並將parent_id = 0 的資料放到最上層
        // 層數每增加一次 $level + 1
        function recursive($temp, &$list, $parentId = 0, $level = 0) {
            $stage = str_repeat('=', $level);
            $level++;
            foreach ($temp as $k => $e) {
                if ($e->parent_id == $parentId) {
                    $e->checked = false;
                    $e->level = $level;
                    $e->stage = "{$parentId} {$stage} >";

                    $list[] = $e;
                    unset($temp[$k]);
                    recursive($temp, $list, $e->id, $level);
                }
            }
        }
        recursive($temp, $list);

        $this->result['data'] = $list;

        return (object)$this->result;
    }
}
