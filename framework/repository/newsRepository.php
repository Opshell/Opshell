<?php
class newsRepository extends Repository
{
    public function __construct() {
        $this->table = '_web_news';
    }
}
