<?php
class CateModel extends BaseModel {
    //写sql语句，查询所有的分类
    public function getAllCates(){
        $sql = "select * from category order by sorts";
        //echo $sql;
        $data = $this->db->fetchAll($sql);

        foreach($data as $key=>$value){
            $data[$key]['lev'] = count(explode('-',$value['sorts']));
        }
//        var_dump($data);
//        exit;
        return $data;
    }

    //添加顶级分类
    public function insert($arr){
        $sql = "insert into category(name,parent_id)values('$arr[category_name]', $arr[parent_id])";
        return $this->db->add($sql); //返回值可能是false或者新的id
    }

    //根据id更新sorts
    public function updateSortsById($id, $sorts){
        $sql = "update category set sorts='$sorts' where id=$id";
        return $this->db->update($sql);
    }
}
?>