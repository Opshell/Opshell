<?php
namespace Model;

use Illuminate\Database\Eloquent\Model as Eloquent; // Eloquent Model (ORM) 使用

class News extends Eloquent
{
    protected $table = '_web_news';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $appends = [];
}
