<?php
namespace Model;
use Illuminate\Database\Eloquent\Model as Eloquent; // Eloquent Model (ORM) 使用

class BackEnd extends Eloquent
{
    protected $table = '_web_back_end';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $appends = [];
}
