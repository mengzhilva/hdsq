<?php
namespace Admin\Controller;
use Think\Controller;
// +----------------------------------------------------------------------
// | * 文件名称：城市管理控制器
// +----------------------------------------------------------------------
// | * 开发人员：吕定国
// +----------------------------------------------------------------------
// | * 开发时间：2014年12月19日
// +----------------------------------------------------------------------
// | * 修改时间：2015年1月12日
// +----------------------------------------------------------------------

class CityAreaController extends CommonController {
	private $cityarea;
	private $citylevel;
	public function __construct(){
		parent::__construct();
		$this->cityarea = M('Cityarea');
		$this->citylevel = $_SESSION['scadminuser']['cid'];

		$city = M('city')->where('id in ('.$this->citylevel.')')->select();
		$this->assign('city',$city);
	}

	public function index(){
		
		$this->checkLevel(43);
		//列表过滤器，生成查询Map对象.
		$where = '';
		//$map = $this->_search();
		if(method_exists($this, '_filter')) {
			$where = $this->_filter();
		}
		$model = D('CityAreaView');
		//判断采用自定义的Model类
		if(!empty($model)) {
			$this->_list($model, $where,'cityarea.id');
		}
		$this->display('index');
	}

	//封装搜素条件,自动调用的方法
	public function _filter(){
		$where['CID'] = array('in',$this->citylevel);
		//搜索条件有值则做封装
		if(!empty($_REQUEST['keyword'])){
			$where['cityarea.NAME']  = array('like', "%{$_REQUEST['keyword']}%");
				
		}

		if(!empty($_REQUEST['CityID'])){
			$where['CID'] = $_REQUEST['CityID'];
		}
		return $where;
	}
	//设置默认页大小
	public function _pageSize(&$pageSize){
		$pageSize='16';
		return $pageSize;
	}
	
	public function edit(){

		$this->checkLevel(43);
		$id = I('get.id',0);
		//var_dump($id);
		$info = $this->cityarea->where('id='.$id)->select();
		$this->assign('info',$info[0]);
		$this->display("edit");
	}
	public function update(){
		$this->checkLevel(43);
    	$name = I('post.name',0);
		$id = I('post.id',0);
    	$check = '';//$this->cityarea->where("NAME='".$name."' and id!=".$id)->select();
    	if(!empty($check)){
    		$this->error('区县名称重复！');
    	}else{
			$data['CID'] = I('post.CityID',0);
			$data['NAME'] = I('post.name',0);
			$city = $this->cityarea->where('ID='.$id)->save($data);
	
			$this->success('保存成功！');
    	}
	}
    public function add(){
		$this->checkLevel(43);
    	$this->display("add");
    }
    public function insert(){

    	$name = I('post.name',0);
		$cityid = I('post.CityID',0);
    	$check = $this->cityarea->where("NAME='".$name."' and CityID='".$cityid."'")->select();
    	if(!empty($check)){
    		$this->error('区县名称重复！');
    	}else{
	    	$this->checkLevel(43);
	    	$data['CID'] = I('post.CityID',0);
	    	$data['NAME'] = I('post.name',0);
	    	$this->cityarea->add($data); // 根据条件更新记录
	    	$this->success('保存成功！');
    	}
    }
    public function del(){

    	$this->checkLevel(43);
    	$id = $_REQUEST['ids'];
    	$model = $this->cityarea;
    	if (isset($id) && is_string($id)) {
    		//批量删除
    		$condition = array('id in('.$id.')');
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
}