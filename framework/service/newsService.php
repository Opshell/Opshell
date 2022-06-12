<?php
namespace Service;
use Core\Service;
use Repository\newsRepository;

class newsService extends Service{
    private static $_instance = null;
    public static function getInstance():newsService {
        if( self::$_instance === null ){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function construct(){
        $this->Repository = newsRepository::getInstance();
    }

    public function index(){}
}
