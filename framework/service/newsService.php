<?php
namespace Service;
use Core\Service;
use Repository\newsRepository;

class newsService extends Service
{
    public function construct(){
        $this->Repository = newsRepository::getInstance();
    }

    public function index(){}
}
