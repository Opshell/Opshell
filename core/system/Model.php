<?php 
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $builder = Null;
    protected $table = '';

    public function __construct(){
        $this->builder = Model::table($this->table);
    }

    public function setWhere($wheres = []){
        foreach ($wheres as $k => $v) {
            $v['relation'] = empty($v['relation'])? '=' : $v['relation'];
            $this->builder->where($v['key'], $v['relation'], $v['value']);
        }
    }

    public function getList(){
        $table = Model::table($this->table)
            ->get();


        return $table;

        $SQL = "SELECT * FROM `" . $this->table . "` WHERE `is_show` = 1 ORDER BY `sort` ASC, `id` DESC";
        return $this->webdb->getListClass($SQL, $this->modelName);
    }

    public function getInfo($id)
    {
        $SQL = "SELECT * FROM `" . $this->table . "` WHERE `is_show` = 1 AND `id` = :id";
        $rtn = $this->webdb->getValueClass($SQL, $this->modelName, array('id' => $id));

        return ($rtn === false) ? null : $rtn;
    }
}
?>