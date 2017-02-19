<?php
abstract class BaseModel{
    protected $db = null;
    public function __construct(){
        //实例化Db对象，得到Db对象
        $this->db = Db::getIns();
    }
}
?>