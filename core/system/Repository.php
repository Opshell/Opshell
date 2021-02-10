<?php
// use Illuminate\Database\Capsule\Manager as DB; // 引用

class Repository
{
    protected $table = '';
    public function __construct(){}

    public function getList(){
        $table = DB::table($this->table)
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
