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
}
