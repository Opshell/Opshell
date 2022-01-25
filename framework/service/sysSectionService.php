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
}
