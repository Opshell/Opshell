<?php
class newsService extends Service
{
    public function construct(){
        $this->Repository = newsRepository::getInstance();
    }
}
