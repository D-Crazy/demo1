<?php
//连接数据库；写一些个常用的查询方法
class Db{
    private static $ins = null; //用来存储Db对象
    private $pdo; //用来存储pdo对象

    //连接数据库
    private function __construct()
    {
        $this->conn();
    }

    //连接数据库
    private function conn(){
        try{
            $dsn = $GLOBALS['config']['db_type'] . ":host={$GLOBALS['config']['db_host']}; dbname={$GLOBALS['config']['db_name']}; charset=". $GLOBALS['config']['db_charset'];
            $this->pdo = new PDO($dsn, $GLOBALS['config']['db_user'], $GLOBALS['config']['db_pass']);
        }catch (PDOException $e){
            exit($e->getMessage());
        }
    }

    //防止克隆
    private function __clone(){}

    //
    public static function getIns(){
        if(!isset(self::$ins)){
            self::$ins = new self;
        }
        return self::$ins;
    }

    //获取所有行
    public function fetchAll($sql){
        $stmt = $this->pdo->prepare($sql); //调用prepare方法后，得到了PDOStatement对象
        if($stmt->execute()){
            //echo 111;
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            //echo 222;
            return false;
        }
    }

    //添加数据的方法
    public function add($sql){
        if($this->pdo->exec($sql)){
            return $this->pdo->lastInsertId();
        }
        return false;
    }

    //更新数据的方法
    public function update($sql){
        if($this->pdo->exec($sql) !== false){ //因为有些时候，受影响的行数会有0行
            return true;
        }else{
            return false;
        }
    }
}
?>