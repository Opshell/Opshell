<?php
class newsService extends Service
{
    public function __construct(){
        $this->Repository = new newsRepository();
    }
}
