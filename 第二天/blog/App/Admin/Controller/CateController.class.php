<?php
class CateController extends BaseController {
    //显示所有分类的列表
    public function index(){
        $cate = FactoryModel::getInstance('CateModel');
        //var_dump($cate->getAllCates());
        $this->assign('cate', $cate->getAllCates());
        $this->display('index.html');
    }


    //显示添加分类的界面
    public function add(){
        $this->display('add.html');
    }

    //获取表单提交的数据，进行分类添加
    public function addHandle(){
//        echo '<pre>';
//        print_r($_POST);
//        exit;
        $arr['category_name'] = $_POST['category_name'];
        $arr['parent_id'] = $_POST['parent_id'];
        $cate = FactoryModel::getInstance('CateModel');
        if($id = $cate->insert($arr)){
            //判断是否是顶级类
            if($_POST['sorts'] == 0){
                //顶级类
                $sorts = $id;
            }else{
                //子类
                $sorts = $_POST['sorts'].'-'.$id;
            }

            if($cate->updateSortsById($id, $sorts)){
                $this->jump('添加成功','?p=Admin&c=Cate');
            }else{
                $this->jump('更新sorts失败','?p=Admin&c=Cate&a=add');
            }
        }else{
            $this->jump('添加失败','?p=Admin&c=Cate&a=add');
        }
    }
}
?>