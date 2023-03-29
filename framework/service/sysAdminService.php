<?php
namespace Service;
use Core\Service;
use Repository\sysAdminRepository;
use Repository\sysGroupRepository;

class sysAdminService extends Service {
    private static $_instance = null;
    private $sysGroup = null;

    public static function getInstance():sysAdminService {
        if( self::$_instance === null ){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function construct() {
        $this->Repository = sysAdminRepository::getInstance();
        $this->sysGroup = sysGroupRepository::getInstance();
    }

    /** 後台登入
     * @param String $user
     * @param String $pass
     * @return Object {
     *  status => Boolean
     *  message => String
     *  data => jwt String
     * }
     */
    public function sysAdminLogin($inputData) {
        // 資料檢查
        $user = ($inputData['username']) ?? "";
        $pass = ($inputData['password']) ?? "";

        if (!empty($user) && !empty($pass)) {
            $user = $this->Repository->getSysAdmin($user); // 取得該用戶
            if ($user) {
                $pass = crypt($pass, $user->salt); // 加鹽驗算
                if ($pass == $user->pass) {
                    $this->result = [
                        'status' => true,
                        'message' => 'Sign in suceesfully',
                        'data' => jwtCreat([
                            'user' => $user->user,
                            'name' => $user->name,
                            'auth' => $this->sysGroup->getGroupAuth($user->group_id)->authority
                        ]),
                        'redirect' => ''
                    ];
                } else {
                    $this->result['message'] = 'Wrong password.';
                }
            } else {
                $this->result['message'] = 'User does not exist.';
            }
        }

        return (object)$this->result;
    }
}
