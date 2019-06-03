<?php
namespace Admin\Controller;
use Think\Controller;
// +----------------------------------------------------------------------
// | * 文件名称：站点管理控制器
// +----------------------------------------------------------------------
// | * 开发人员：吕定国
// +----------------------------------------------------------------------
// | * 开发时间：2014年12月19日
// +----------------------------------------------------------------------
// | * 修改时间：2015年1月12日
// +----------------------------------------------------------------------

class WebsetController extends CommonController {
	private $city;
	private $citylevel;
	public function __construct(){
		parent::__construct();
		$this->city = M('Webset');
		$this->citylevel = $_SESSION['scadminuser']['cid'];

		$city = M('city')->where('id in ('.$this->citylevel.')')->select();
		$this->assign('city',$city);
	}
	
	public function index(){
		
		$this->checkLevel(58);
		//列表过滤器，生成查询Map对象.
		$where = '';
		//$map = $this->_search();
		if(method_exists($this, '_filter')) {
			$where = $this->_filter();
		}
		$model = $this->city;
		//判断采用自定义的Model类
		if(!empty($model)) {
			$this->_list($model, $where);
		}
		$info = $this->city->where('id=1')->select();
		$this->assign('info',$info[0]);
		$this->display('index');
	}

	//封装搜素条件,自动调用的方法
	public function _filter(){
		//搜索条件有值则做封装
		if(!empty($_REQUEST['keyword'])){
			$where['NAME']  = array('like', "%{$_REQUEST['keyword']}%");
				
		}

		return $where;
	}
	//设置默认页大小
	public function _pageSize(&$pageSize){
		$pageSize='16';
		return $pageSize;
	}
	
	public function edit(){
		$this->checkLevel(60);

		$id = I('get.id',0);
		//var_dump($id);
		$info = $this->city->where('id='.$id)->select();
		$this->assign('info',$info[0]);
		$this->display("edit");
	}
	/**
	 * 更新数据之前，对数据进行处理
	 */
	public function _before_update()
	{
		// 删除已经更换掉的图片
		if (!empty($_POST['isdel']) && ($_POST['mapimg'] != $_POST['isdel'])) {
			@unlink('.' . $_POST['isdel']);
		}
		unset($_POST['isdel']);
	}

	public function update(){
		//$this->checkLevel(60);
		$name = I('post.name',0);
		$id = 1;
		$check = $this->city->select();
	    	$data['NAME'] = I('post.name',0);
	    	$data['phone'] = I('post.phone',0);
	    	$data['DOMAIN'] = I('post.DOMAIN',0);
	    	$data['SEONAME'] = I('post.SEONAME',0);
	    	$data['SEOKEYWORD'] = I('post.SEOKEYWORD',0);
	    	$data['SEODESCRIPTION'] = I('post.SEODESCRIPTION',0);
	    	$data['headerlogo'] = I('post.headerlogo',0);
	    	$data['beian'] = I('post.beian',0);
		//var_dump($data);
		if(!empty($check)){
			$city = $this->city->where('ID='.$id)->save($data);
		//var_dump($city);
		}else{
	    	// $data['swfurl'] = I('post.IMAGE',0);
			$city = $this->city->add($data);
	
		}
			$this->success('保存成功！');
	}
    public function add(){
		$this->checkLevel(59);
    	$this->display("add");
    }
    public function insert(){
		$this->checkLevel(59);

		$name = I('post.name',0);
		$check = $this->city->where("NAME='".$name."'")->select();
		if(!empty($check)){
			$this->error('站点名称重复！');
		}else{
	    	$data['NAME'] = I('post.name',0);
	    	$data['DOMAIN'] = I('post.DOMAIN',0);
	    	$data['STATE'] = I('post.STATE',0);
	    	$data['PTYPE'] = I('post.PTYPE',0);
	    	$data['TELEPHONE'] = I('post.TELEPHONE','');
	    	$data['PHONE'] = I('post.PHONE','');
	    	$data['LEYUCID'] = I('post.LEYUCID',0);
	    	$data['LEYUFID'] = I('post.LEYUFID',0);
	    	$data['LEYUGID'] = I('post.LEYUGID',0);
	    	$data['SEONAME'] = I('post.SEONAME',0);
	    	$data['address'] = I('post.address',0);
	    	$data['SEOKEYWORD'] = I('post.SEOKEYWORD',0);
	    	$data['SEODESCRIPTION'] = I('post.SEODESCRIPTION',0);
	    	// $data['swfurl'] = I('post.IMAGE',0);
	    	$data['mapimg'] = I('post.mapimg','','strip_tags');
	    	$data['up'] = I('post.up', 0, 'intval');
	    	$this->city->add($data); // 根据条件更新记录
	    	$this->success('保存成功！');
		}
    }
    public function del(){
		$this->checkLevel(61);

    	$id = $_REQUEST['ids'];
    	$model = $this->city;
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