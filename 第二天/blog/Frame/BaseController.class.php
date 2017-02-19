<?php
abstract class BaseController{
    //设置一个存放BaseView对象的属性
    protected $view = null;
    //存放smarty对象的属性
    protected $smarty = null;

    //设置字符集
    public function __construct()
    {
        header('content-type:text/html;charset=utf-8');
        $this->view = new BaseView();
        //将BaseView对象中的smarty赋值给当前类中的smarty
        $this->smarty = $this->view->smarty;
    }

    //页面跳转
    public function jump($msg, $url='?', $time=2){
        echo $msg;
        header("refresh:$time; url=$url");
    }

    //重写smarty的assign方法
    public function assign($key, $value){
        $this->smarty->assign($key, $value);
    }

    //重写display
    public function display($template=null,$cache_id=null,$compile_id=null,$parent=null){
        $this->smarty->display($template,$cache_id,$compile_id,$parent);
    }
}

?>