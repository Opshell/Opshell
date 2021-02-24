<?php
use Illuminate\Database\Eloquent\Model as Eloquent; // Eloquent Model (ORM) 使用

class Repository extends Eloquent
{
    protected $builder = Null;
    protected $table = '';
    protected $wheres = [];
    protected $orders = [];
    
    public function __construct(){
        $this->builder = Repository::table($this->table);
        $this->setWhere($this->wheres);
        $this->setOrder($this->orders);

    }

    public function setWhere($wheres = []){
        foreach ($wheres as $k => $v) {
            $v['relation'] = empty($v['relation']) ? '=' : $v['relation'];
            $this->builder->where($v['key'], $v['relation'], $v['value']);
        }
    }

    public function setOrder($orders = []){
        foreach ($orders as $k => $v) {
            $this->builder->orderBy($v['key'], $v['value']);
        }
    }
    
    public function getList(){
        $builder = $this->builder->get();
        
        return $builder;
    }

    public function getInfo($id){
        $builder = $this->builder->find($id);

        return $builder;
    }
}
