<?php
//获取smarty对象
class BaseView{
    //设置一个存放smarty对象的属性
    public $smarty = null;
    public function __construct()
    {
        include_once  FRAMES_PATH . 'Smarty/Smarty.class.php';
        $this->smarty = new Smarty();

        $this->smarty->setTemplateDir(VIEW_PATH);
        $this->smarty->setCompileDir(APP_PATH . 'Runtime');
    }
}
?>