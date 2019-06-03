<?php
namespace Admin\Controller;

class TypeController extends CommonController{
    public function index(){
        // $mod = M("Type");
        // $list = $mod->order("concat(path,id)")->select();
        
        // $this->assign("list",$list);
        
       $cityn = M("city")->select();
       // $cityn = M("cityarea")->where("CID=1")->getField('ID,NAME');
       $this->assign("clist",$cityn);
        // $cityname = M("cityarea")->select();
        
        // dump($cityn);
        $this->display("index");
    }
    public function getcity(){
        $cid=$_GET['cid'];
        $cityname = M("cityarea")->where("CID=".$cid)->getField("ID,NAME");
        echo json_encode($cityname);
        // echo $cityname;
    }
    //重写加载添加表单方法
    public function add($pid=0){
        //获取一级类别
        $this->assign("typelist",M("Type")->where("pid={$pid}")->select());
        $this->display("add");
    }
    
    //重写添加
    public function insert(){
        //获取pid信息
        $type = M("Type")->where("id=".$_POST['pid'])->find();
        if($type){
            $_POST['pid']=$type['id'];
            $_POST['path']=$type['path'].$type['id'].","; 
        }else{
            $_POST['pid']=0;
            $_POST['path']="0,";
        }
        parent::insert();
    }
    
    public function del($id=0){
        //查询当前类别下是否拥有子类别
        $list = M("Type")->where("pid=".$id)->select();
        if(count($list)>0){
           $this->error("无法删除拥有子类的类别！");
           return;
        }
        //判断当前类别使用有商品
        
        //执行删除
        parent::del($id);
        //$this->error("拒绝删除！");
    }
}