<?php
namespace Service;
use Core\Service;
use Repository\backEndRepository;

class backEndService extends Service
{
    public function construct(){
        $this->Repository = backEndRepository::getInstance();
    }

    public function index(){}

    /** 後台登入
     * @param String $user
     * @param String $pass
     * @return Object { 
     *  status => Boolean
     *  message => String
     *  data => jwt String
     * }
     */
    public function backEndLogin($inputData){
        // 資料檢查
        $user = ($inputData['username']) ?? "";
        $pass = ($inputData['password']) ?? "";

        if (!empty($user) && !empty($pass)) {
            $user = $this->Repository->getBackEndUser($user); // 取得該用戶
            if($user){
                $pass = crypt($pass, $user->salt); // 加鹽驗算
                if($pass == $user->pass){
                    $this->result = [
                        'status' => true,
                        'message' => 'Sign in suceesfully',
                        'data' => jwtCreat([
                            'user' => $user->user,
                            'name' => $user->name,
                            'auth' => $this->Repository->getGroupAuth($user->group_id)->authority
                        ]),
                        'redirect' => ''
                    ];
                }else{
                    $this->result['message'] = 'Wrong password.';
                }
            }else{
                $this->result['message'] = 'User does not exist.';
            }
        }

        return (object)$this->result;
    }

    /** 取得後台側邊Menu
     * @param Int $auth
     * @param Int $pid
     */
    public function getSideMenu($auth = 3, $pid = 0){
        // 取最外層
        $this->result['status'] = true;
        $this->result['message'] = 'Getting success.';
        $this->result['data'] = $this->Repository->getSideMenu($auth, $pid)
        ->map(function($e) use($auth){
            $child = $this->getSideMenuRecursive($auth, $e->id);

            if(!empty($child)){
                $e->child = $child;
            }

            return $e;
        })->toArray();

        return (object)$this->result;
    }

    /** Menu 遞迴
     * @param Int $auth
     * @param Int $pid
     * @return Array $child
     */
    public function getSideMenuRecursive($auth = 3, $pid = 0){
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