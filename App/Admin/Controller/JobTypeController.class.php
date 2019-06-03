<?php
namespace Admin\Controller;
use Think\Controller;
// +----------------------------------------------------------------------
// | * 文件名称：招聘职位分类管理控制器
// +----------------------------------------------------------------------
// | * 开发人员：吕定国
// +----------------------------------------------------------------------
// | * 开发时间：2014年12月19日
// +----------------------------------------------------------------------
// | * 修改时间：2015年1月12日
// +----------------------------------------------------------------------

class JobTypeController extends CommonController {
	private $job;
	public function __construct(){
		parent::__construct();
		$this->job = M('tbjobtype');
	}
	
	public function index(){
		$this->checkLevel(81);
		
		
		//$area = $this->city->query("select a.NAME as areaname,b.name as cityname,a.id as aid,b.id as cid from city a left join city b on a.CID=b.id");


		//列表过滤器，生成查询Map对象.
		$where = '';
		//$map = $this->_search();
		if(method_exists($this, '_filter')) {
			$where = $this->_filter();
		}
		//var_dump($where);exit;
		$model = $this->job;
		//判断采用自定义的Model类
		if(!empty($model)) {
			$this->_list($model, $where);
		}
		$this->display('index');
	}

	//封装搜素条件,自动调用的方法
	public function _filter(){
		//搜索条件有值则做封装
		if(!empty($_REQUEST['keyword'])){
			$where['ClassName']  = array('like', "%{$_REQUEST['keyword']}%");
				
		}

		return $where;
	}
	//设置默认页大小
	public function _pageSize(&$pageSize){
		$pageSize='16';
		return $pageSize;
	}
	
	public function edit(){
		$this->checkLevel(81);

		$id = I('get.id',0);
		//var_dump($id);
		$info = $this->job->where('ClassID='.$id)->select();
		$this->assign('info',$info[0]);
		$this->display("edit");
	}
	public function update(){
		$this->checkLevel(81);
		$id = I('post.id',0);

		$data['ClassName'] = I('post.ClassName',0);
		$data['ClassNote'] = I('post.ClassNote',0);
		$this->job->where('ClassID='.$id)->save($data);
		
		$datas['JobType'] = I('post.ClassName',0);
		M('Tbjob')->where('JobTypeId='.$id)->save($datas);

		$this->success('保存成功！');
	}
    public function add(){
		$this->checkLevel(81);
    	$this->display("add");
    }
    public function insert(){
		$this->checkLevel(81);
 
    	$data['ClassName'] = I('post.ClassName',0);
    	$data['ClassNote'] = I('post.ClassNote',0);
    	$this->job->add($data);
    	$this->success('保存成功！');
    }
    public function del(){

    	$id = $_REQUEST['ids'];
    	$model = $this->job;
    	if (isset($id) && is_string($id)) {
    		//批量删除
    		$condition = array('ClassID' => array('in', $id));
    		if (false !== $model->where($condition)->delete()) {
    			$this->success(L('删除成功'));
    		} else {
    			$this->error(L('删除失败'));
    		}
    	} else if (is_array($id)){
    		//批量删除
    		$condition = array('ClassID'=> array('in', explode(',', $id)));
    		if (false !== $model->where($condition)->delete()) {
    			$this->success(L('删除成功'));
    		} else {
    			$this->error(L('删除失败'));
    		}
    	}else {
    		$this->error('非法操作');
    	}
    	
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