<?php
//单例、工厂类，用来实例化自定义的模型类
class FactoryModel{
    //存储自定义模型类的对象的成员属性
    private static $obj = null;
    //0， 0.0 '', null, array() '0'

    /*
     * className : 要实例化的模型类的名字
     */
    public static function getInstance($clasName){
        if(!isset(self::$obj)){
            self::$obj[$clasName] = new $clasName();
        }
        return self::$obj[$clasName];
    }
}
?>