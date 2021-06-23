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
     * @param Array $user
     */
    public function getSideMenu($auth = 3){
        // 取最外層
        $this->result['status'] = true;
        $this->result['message'] = 'Getting success.';
        $this->result['data'] = $this->Repository->getSideMenu($auth, 0)
        ->map(function($e) use($auth){
            $child = $this->Repository->getSideMenu($auth, $e->id);
            $e->child = (!$child->isEmpty())? $child->toArray() : [];

            return $e;
        })->toArray();

        return (object)$this->result;
    }
}