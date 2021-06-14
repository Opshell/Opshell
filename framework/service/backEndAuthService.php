<?php
namespace Service;
use Core\Service;
use Repository\backEndAuthRepository;

class backEndAuthService extends Service
{
    public function construct(){
        $this->Repository = backEndAuthRepository::getInstance();
    }

    public function index(){}
}
