<?php
namespace Admin\Controller;
use Think\Controller;
// +----------------------------------------------------------------------
// | * 文件名称：管理员控制器
// +----------------------------------------------------------------------
// | * 开发人员：吕定国
// +----------------------------------------------------------------------
// | * 开发时间：2014年12月19日
// +----------------------------------------------------------------------
// | * 修改时间：2015年1月12日
// +----------------------------------------------------------------------

class AdminController extends CommonController {
    private $admin;
    private $citylevel;
    public function __construct(){
        parent::__construct();
        $this->admin = M('Admin');
        $this->citylevel = $_SESSION['scadminuser']['cid'];

        $city = M('city')->select();
        $this->assign('city',$city);
    }
    public function index(){
        
        $this->checkLevel(1);
        //$area = $this->city->query("select a.NAME as areaname,b.name as cityname,a.id as aid,b.id as cid from city a left join city b on a.CID=b.id");

        

        //列表过滤器，生成查询Map对象.
        $where = '';
        //$map = $this->_search();
        if(method_exists($this, '_filter')) {
            $where = $this->_filter();
        }
        //var_dump($where);exit;
        $model = $this->admin;
        //判断采用自定义的Model类
        if(!empty($model)) {
            $this->_list($model, $where);
        }
        $this->display('index');
    }

    //封装搜素条件,自动调用的方法
    public function _filter(){
        $where['_string'] = '(cid in ('.$this->citylevel.') or cid = 0)';
        //搜索条件有值则做封装
        if(!empty($_REQUEST['keyword'])){
            $where['username']  = array('like', "%{$_REQUEST['keyword']}%");
                
        }
        if(!empty($_REQUEST['truename'])){
            $where['truename']  = array('like', "%{$_REQUEST['truename']}%");
                
        }

        return $where;
    }
    //设置默认页大小
    public function _pageSize(&$pageSize){
        $pageSize='16';
        return $pageSize;
    }
    
    public function edit(){

        $this->checkLevel(3);
        $id = I('get.id',0);
        //var_dump($id);
        $info = $this->admin->where('id='.$id)->select();
        $city = M('city')->where('ID in ('.$info[0]['cid'].')')->select();
        //var_dump($city);
        $this->assign('info',$info[0]);
        $this->display("edit");
    }
    public function update(){
        $this->checkLevel(3);
        $id = I('post.id',0);
        
        $pass = I('post.userpass',0);
        if(!empty($pass)){
            $data['userpass'] = md5($pass);
        }
        $data['truename'] = I('post.truename',0);
        $data['content'] = I('post.content',0);
        $data['time'] = date('Y-m-d H:i:s');
        $this->admin->where('id='.$id)->save($data);

        $this->success('保存成功！');
    }
    public function add(){
        $this->checkLevel(2);
        $this->display("add");
    }
    public function insert(){
        $this->checkLevel(2);
        $username = I('post.username',0);
        $check = $this->admin->where("username='".$username."'")->select();
        if(!empty($check)){
            $this->error('用户名重复！');
        }else{
            $data['username'] = $username;
            $pass = I('post.userpass',0);
            $data['userpass'] = md5($pass);
            $data['truename'] = I('post.truename',0);
            $data['content'] = I('post.content',0);
            $data['time'] = date('Y-m-d H:i:s');
            $this->admin->add($data); // 根据条件更新记录
        }
        $this->success('保存成功！');
    }
    public function del(){

        $this->checkLevel(4);
        $id = $_REQUEST['ids'];
        $model = $this->admin;
        if (isset($id) && is_string($id)) {
            //批量删除
            $condition = array('id' => array('in', $id));
            if (false !== $model->where($condition)->delete()) {
                $this->success(L('删除成功'));
            } else {
                $this->error(L('删除失败'));
            }
        } else if (is_array($id)){
            //批量删除
            $condition = array('id'=> array('in', explode(',', $id)));
            if (false !== $model->where($condition)->delete()) {
                $this->success(L('删除成功'));
            } else {
                $this->error(L('删除失败'));
            }
        }else {
            $this->error('非法操作');
        }
    }

    public function qx(){
        $this->checkLevel(5);
    
        $id = I('get.id',0);
        //var_dump($id);
        $info = $this->admin->where('id='.$id)->select();
        $level =M('Admin_level')->query("select min(id) as id,cate from admin_level group by cate order by min(id) asc");
        
        foreach($level as $k=>$v){
            $level[$k]['list'] = M('Admin_level')->where("cate='".$v['cate']."'")->select();
        }
        //var_dump($info);exit;
        $this->assign('info',$info[0]);
        $this->assign('level',$level);
        $this->display("qx");
    }
    public function updateqx(){

        $id = I('post.id',0);
        $cid = reqs("ck_IDc");
        $lid = reqs("ck_IDl");
        //echo "update admin set cid = '$cid',lid = '$lid' where id = $id";
        $date = date('Y-m-d H:i:s');
        $this->admin->query("update admin set cid = '$cid',lid = '$lid',time='$date' where id = $id");
        $this->success('保存成功！');
    }
    //读取复选框
    private  function reqs($str)
    {
        $arrayss = $_REQUEST[$str];
        $sizess = count($arrayss);
        $catess="";
        for($iss=0; $iss<$sizess; $iss++)
        {
            if($iss==$sizess-1)
            {
                $catess = $catess.$arrayss[$iss];
            }
            else
            {
                $catess = $catess.$arrayss[$iss].",";
            }
        }
        return $catess;
    }
}