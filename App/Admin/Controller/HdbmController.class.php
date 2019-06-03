<?php
namespace Admin\Controller;
use Think\Controller;
// +----------------------------------------------------------------------
// | * 文件名称：活动管理控制器
// +----------------------------------------------------------------------
// | * 开发人员：吕定国
// +----------------------------------------------------------------------
// | * 开发时间：2014年12月19日
// +----------------------------------------------------------------------
// | * 修改时间：2015年1月12日
// +----------------------------------------------------------------------

class HdbmController extends CommonController {
	private $hd;
	private $citylevel;
	public function __construct(){
		parent::__construct();
		$this->hd = M('tbclassroom');
		$this->citylevel = $_SESSION['scadminuser']['cid'];

		$city = M('city')->where('id in ('.$this->citylevel.')')->select();
		$this->assign('city',$city);
        $citylists = M('city')->select();
        $this->assign('citylists',$citylists);

	}
    //活动报名管理
    public function index(){

    	$this->checkLevel(172);
        $user = $_SESSION[C('SESSION_USER_KEY')];
        $this->assign('user',$user);

    	//列表过滤器，生成查询Map对象.
    	$where = '';
    	//$map = $this->_search();
    	
        if(method_exists($this, '_filterbm')) {
    		$where = $this->_filterbm();
    	}
    	//var_dump($where);exit;
    	$model = M('tbclassroomorder');
    	//判断采用自定义的Model类
    	if(!empty($model)) {
    		$this->_bmlist($model, $where);
    	}
        // echo M('tbclassroomorder')->getlastsql();
    	$this->display();
    }
    //活动推广员报名管理
    public function promoterbm(){
        $user = $_SESSION[C('SESSION_USER_KEY')];
        if(isset($user['PromoterTel'])){
            $this->checkLevel(-99999);
            $this->assign('istgy',1);
        }else{
            $this->checkLevel(174);
        }

        //列表过滤器，生成查询Map对象.
        $where = '';
        if(method_exists($this, '_filterbm')) {
            $where = $this->_filterpromotbm();
        }
        //var_dump($where);exit;
        $model = M('tbclassroomorder');
        //判断采用自定义的Model类
        if(!empty($model)) {
            $this->_list($model, $where);
        }
        $this->display('promoterbm');
    }

    function checkbm(){
    	$id = I('get.id',0);
    	$action = I('post.action','');

    	$m = M('tbclassroomorder');
    	if($action == 'check'){
    		$id = I('post.ID',0);
    		$data['Dealstate'] = 1;
    		$m->where('ID='.$id)->save($data);
    		$this->success('保存成功！');
    	}else{
    		$info = $m->where('Id='.$id)->select();
    		$this->assign('info',$info[0]);
    		$this->display("checkbm");
    	}
    
    }
    function checkprombm(){
        $id = I('get.id',0);
        $action = I('post.action','');
      
        $m = M('tbclassroomorder');
        if($action == 'check'){
            $id = I('post.ID',0);
            $data['Dealstate'] = 1;
            $m->where('ID='.$id)->save($data);
            $this->success('保存成功！');
        }else{
            $info = $m->where('Id='.$id)->select();
            $this->assign('info',$info[0]);
            $this->display("checkbm");
        }
    
    }
    //封装搜素条件,自动调用的方法
    public function _filterbm(){
    	$where['_string'] = "TelePhone!='15110000000' and CityID in (".$this->citylevel.") and (PromoterId = 0 or PromoterId = -1)";
    	//搜索条件有值则做封装
    	if(!empty($_REQUEST['keyword'])){
    		$where['ClassRoomName']  = array('like', "%{$_REQUEST['keyword']}%");
    
    	}
            if($_REQUEST['Ism'] !=''){
                        // dump($_REQUEST['Ism']);
                        $ID =  M('tbclassroom')->where('Ism='.$_REQUEST['Ism'])->getField('ID',true);
                        // dump($ID);
                        // echo  M('tbclassroom')->getLastSql();
                       $where['ClassRoomID'] = array('in', implode(',', $ID));
                       // dump($where['ClassRoomID']);
            }

    	if(!empty($_REQUEST['qudao'])){
    		$where['qudao']  = array('like', "%{$_REQUEST['qudao']}%");
    
    	}
    	if(!empty($_REQUEST['utm_term'])){
    		$where['utm_term']  = array('like', "%{$_REQUEST['utm_term']}%");
    
    	}
	if($_REQUEST['Dealstate'] !=''){
		$where['Dealstate'] = array('eq',$_REQUEST['Dealstate']);
	}
	if(!empty($_REQUEST['CityID'])){
		$where['CityID'] = $_REQUEST['CityID'];
	}

            if(!empty($_REQUEST['starttime']) && !empty($_REQUEST['endtime'])){
                        $where['UpdateTime'] = array(array('egt',$_REQUEST['starttime']),array('elt',$_REQUEST['endtime']));
            }else if(!empty($_REQUEST['starttime']) && empty($_REQUEST['endtime'])){
                    $where['UpdateTime'] = array('egt',$_REQUEST['starttime']);
             }else if(empty($_REQUEST['starttime']) && !empty($_REQUEST['endtime'])){
                $where['UpdateTime'] = array('elt',$_REQUEST['endtime']);
             }
    
    	return $where;
    }
    //封装搜素条件,自动调用的方法
    public function _filterpromotbm(){
        $user = $_SESSION[C('SESSION_USER_KEY')];
        // print_r($user['Id']);
        if(isset($user['PromoterTel'])){
            $this->checkLevel(-99999);
            $where['_string'] = 'TelePhone!=15110000000 and PromoterId = '.$user['Id'];
        }else{
            $this->checkLevel(174);
            $where['_string'] = 'TelePhone!=15110000000 and PromoterId > 0 and CityID in ('.$this->citylevel.')';
            
        }
        // $where['PromoterId'] = array('GT',0);
        // $where['_string'] = ' ';
        //搜索条件有值则做封装
        if(!empty($_REQUEST['keyword'])){
            $where['ClassRoomName']  = array('like', "%{$_REQUEST['keyword']}%");

        }
        if(!empty($_REQUEST['qudao'])){
            $where['qudao']  = array('like', "%{$_REQUEST['qudao']}%");

        }

       if($_REQUEST['Dealstate']!=''){
            $where['Dealstate'] = $_REQUEST['Dealstate'];
        }
        if(!empty($_REQUEST['CityID'])){
            $where['CityID'] = $_REQUEST['CityID'];
        }
      
    
        return $where;
    }

    public function delbmr(){
		$this->checkLevel(70);

    	$id = I('get.id',0);
    	$res1 = $this->hd->query("delete from tbClassRoomOrder where id=".$id);
    	if($res1){
    		$this->success('删除成功！');
    	}else{
    		$this->error('删除失败了！');
    	}
    }
}