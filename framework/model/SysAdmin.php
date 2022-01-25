<?php
namespace Model;
use Illuminate\Database\Eloquent\Model as Eloquent; // Eloquent Model (ORM) 使用

class SysAdmin extends Eloquent
{
    protected $table = '_sys_admin';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $appends = [];
}
