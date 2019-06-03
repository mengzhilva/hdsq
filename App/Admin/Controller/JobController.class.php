<?php
namespace Admin\Controller;
use Think\Controller;
// +----------------------------------------------------------------------
// | * 文件名称：招聘管理控制器
// +----------------------------------------------------------------------
// | * 开发人员：吕定国
// +----------------------------------------------------------------------
// | * 开发时间：2014年12月19日
// +----------------------------------------------------------------------
// | * 修改时间：2015年1月12日
// +----------------------------------------------------------------------

class JobController extends CommonController {
	private $job;
	private $citylevel;
	public function __construct(){
		parent::__construct();
		$this->job = M('Tbjob');
		$this->citylevel = $_SESSION['scadminuser']['cid'];

		$city = M('city')->where('id in ('.$this->citylevel.')')->select();
		$this->assign('city',$city);
	}
	
	public function index(){

		$this->checkLevel(78);
		
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
		$where['CityID'] = array('in',$this->citylevel);
		//搜索条件有值则做封装
		if(!empty($_REQUEST['keyword'])){
			$where['Title']  = array('like', "%{$_REQUEST['keyword']}%");
				
		}
		if(!empty($_REQUEST['CityID'])){
			$where['CityID'] = array('like', "%{$_REQUEST['CityID']}%");
		}

		return $where;
	}
	//设置默认页大小
	public function _pageSize(&$pageSize){
		$pageSize='16';
		return $pageSize;
	}
	
	public function edit(){
		$this->checkLevel(79);

		$id = I('get.id',0);
		//var_dump($id);
		$info = $this->job->where('id='.$id)->select();
		$tbjobtype = M('tbjobtype')->select();
		$this->assign('tbjobtype',$tbjobtype);
		$tbjobclass = M('tbjobclass')->select();
		$this->assign('tbjobclass',$tbjobclass);
		$this->assign('info',$info[0]);
		$this->display("edit");
	}
	public function update(){
		$this->checkLevel(79);
		
		$id = I('post.id',0);

    	$data['Title'] = I('post.Title',0);
    	// $data['JobTypeId'] = I('post.JobType',0);
    	$type = M('tbjobtype')->where('ClassID='.I('post.JobType',0))->select();
    	$data['JobType'] = $type[0]['ClassName'];
    	$data['TeamName'] = I('post.TeamName',0);
    	$data['ClassID'] = I('post.ClassID',0);
    	$class = M('tbjobclass')->where('ClassID='.$data['ClassID'])->select();
    	$data['ClassName'] = $class[0]['ClassName'];
    	$data['JobNum'] = I('post.JobNum',0);
    	$data['CityID'] = I('post.CityID',0);
    	$city = M('city')->where('ID='.$data['CityID'])->select();
    	$data['CityName'] = $city[0]['NAME'];
    	$data['JobNote'] = I('post.JobNote',0);
    	$data['JobRequire'] = I('post.JobRequire',0);
    	$data['JobEmail'] = I('post.JobEmail',0);
    	$data['AddTime'] = I('post.AddTime',0);
    	$data['EndTime'] = I('post.EndTime',0);
    	$data['JobEmail'] = I('post.JobEmail',0);
		$this->job->where('id='.$id)->save($data);

		$this->success('保存成功！');
	}
    public function add(){
		$this->checkLevel(80);

		$info = $this->job->where('id='.$id)->select();
		$tbjobtype = M('tbjobtype')->select();
		$this->assign('tbjobtype',$tbjobtype);
		$tbjobclass = M('tbjobclass')->select();
		$this->assign('tbjobclass',$tbjobclass);
    	$this->display("add");
    }
    public function insert(){
		$this->checkLevel(80);
	
    	$data['Title'] = I('post.Title');
    	// $data['JobTypeId'] = I('post.JobType',0);
    	$type = M('tbjobtype')->where('ClassID='.I('post.JobType'))->select();
    	$data['JobType'] = $type[0]['ClassName'];
    	$data['TeamName'] = I('post.TeamName');
    	$data['ClassID'] = I('post.ClassID');
    	$class = M('tbjobclass')->where('ClassID='.$data['ClassID'])->select();
    	$data['ClassName'] = $class[0]['ClassName'];
    	$data['JobNum'] = I('post.JobNum');
    	$data['CityID'] = I('post.CityID');
    	$city = M('city')->where('ID='.$data['CityID'])->select();
    	$data['CityName'] = $city[0]['NAME'];
    	$data['JobNote'] = I('post.JobNote');
    	$data['JobRequire'] = I('post.JobRequire');
    	$data['JobEmail'] = I('post.JobEmail');
    	$data['AddTime'] = I('post.AddTime','0000-00-00');
    	$data['EndTime'] = I('post.EndTime','0000-00-00');
    	$data['JobEmail'] = I('post.JobEmail');
            $m = M('Tbjob');
            $res = $m->add($data);

    	if($res){

                $this->success('保存成功！');
        }

    	
    }
    public function del(){
		$this->checkLevel(82);

    	$id = $_REQUEST['ids'];
    	$model = $this->job;
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

    public function check(){
		$this->checkLevel(131);

		$id = I('get.id',0);
		//var_dump($id);
		$info = $this->job->where('id='.$id)->select();
    	$this->assign('vo',$info[0]);
    	$this->display("check");
    }
    public function audit(){
        $this->checkLevel(131);
        (!$_REQUEST['ids'] || !$_GET['type']) && $this->error(L('缺少必要的参数！'));
        $id   = explode(',',$_REQUEST['ids']);
        $type = $_GET['type'] == 'y' ? 1 : -1;
        $news = M('Tbjob');
        $data['Status']  = $type;
        foreach($id AS $k => $v){
            $where['id'] = $v;
            $news->where($where)->save($data);
        }
        $this->success(L('更新成功'));
    }
    function updatecheck(){
    	$this->checkLevel(131);
    
    	$id = I('post.id',0);
    	$data['Status'] = I('post.Status','');
    	$data['StatusInfo'] = I('post.StatusInfo',0);
    	//var_dump($data);exit;
    	$this->job->where('id='.$id)->save($data); // 根据条件更新记录
    	 
    	$this->success('保存成功！');
    }
}