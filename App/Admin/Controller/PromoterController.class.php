<?php
namespace Admin\Controller;
use Think\Controller;
// +----------------------------------------------------------------------
// | * 文件名称：推广员控制器
// +----------------------------------------------------------------------
// | * 开发人员：吕定国
// +----------------------------------------------------------------------
// | * 开发时间：2015年1月28日
// +----------------------------------------------------------------------
// | * 修改时间：2015年1月28日
// +----------------------------------------------------------------------

class PromoterController extends PcommonController {
	private $admin;
	private $citylevel;
	public function __construct(){
		parent::__construct();
		$this->pro = M('tbpromoter');
		$this->citylevel = $_SESSION['scadminuser']['cid'];

		$city = M('city')->select();
		$this->assign('city',$city);
		foreach (getsourcename('',2) as $key => $value) {
           			 $source[] = array('id'=>$key, 'name'=>$value);
       		 }
       		 $this->assign('source',$source);
	}
	public function index(){

		$user = $_SESSION[C('SESSION_USER_KEY')];
		if(isset($user['PromoterTel'])){
			$this->checkLevel(-99999);
			$this->assign('istgy',1);
		}else{
			$this->checkLevel(141);
				
		}

		//列表过滤器，生成查询Map对象.
		$where = '';
		//$map = $this->_search();
		if(method_exists($this, '_filter')) {
			$where = $this->_filter();
		}
		//var_dump($where);exit;
		$model = $this->pro;
		//判断采用自定义的Model类
		if(!empty($model)) {
			$this->_list($model, $where);
		}
		$this->display('index');
	}

	//封装搜素条件,自动调用的方法
	public function _filter(){
		$user = $_SESSION[C('SESSION_USER_KEY')];
		if(isset($user['PromoterTel'])){
			$this->checkLevel(-99999);
			$where['_string'] = '(Id = '.$user['Id'].')';
		}else{
			$this->checkLevel(141);
			
		}
    	if(!empty($_REQUEST['qudao'])){
    		$where['qudao']  = array('like', "%{$_REQUEST['qudao']}%");
    
    	}
    	if(!empty($_REQUEST['utm_term'])){
    		$where['utm_term']  = array('like', "%{$_REQUEST['utm_term']}%");
    
    	}
		//搜索条件有值则做封装
		if(!empty($_REQUEST['keyword'])){
			$where['PromoterName']  = array('like', "%{$_REQUEST['keyword']}%");
		}
		if(!empty($_REQUEST['phone'])){
			$where['PromoterTel']  = array('like', "%{$_REQUEST['phone']}%");
		}
		if(!empty($_REQUEST['CityID'])){
			$where['CityID'] = $_REQUEST['CityID'];
		}

		return $where;
	}
	//设置默认页大小
	public function _pageSize(&$pageSize){
		$pageSize='16';
		return $pageSize;
	}
	function check(){
		$user = $_SESSION[C('SESSION_USER_KEY')];
		if(isset($user['PromoterTel'])){
			$this->checkLevel(-99999);
		}else{
		}
		$id = I('get.id',0);
		$action = I('post.action','');
		$m = M('reservation_construction');
		if($action == 'check'){
			$id = I('post.ID',0);
			$data['Dealstate'] = 1;
			$m->where('ID='.$id)->save($data);
			$this->success('保存成功！');
		}else{
			$info = $m->where('Id='.$id)->select();
			$this->assign('info',$info[0]);
			$this->display("check");
		}
		
	}
	public function pccheck(){
		$user = $_SESSION[C('SESSION_USER_KEY')];
		if(isset($user['PromoterTel'])){
			$this->checkLevel(-99999);
		}else{
		}
		$id = I('get.id',0);
		$action = I('post.action','');
		$m = M('reservation_construction');
		if($action == 'check'){
			$id = I('post.ID',0);
			$data['Dealstate'] = 1;
			$m->where('ID='.$id)->save($data);
			$this->success('保存成功！');
		}else{
			$info = $m->where('Id='.$id)->select();
			$this->assign('info',$info[0]);
			$this->display("pccheck");
		}
		
	}

	public function ztbmcheck(){
		$user = $_SESSION[C('SESSION_USER_KEY')];
		if(isset($user['PromoterTel'])){
			$this->checkLevel(-99999);
		}else{
		}
		$id = I('get.id',0);
		$action = I('post.action','');
		$m = M('reservation_construction');
		if($action == 'check'){
			$id = I('post.ID',0);
			$data['Dealstate'] = 1;
			$m->where('ID='.$id)->save($data);
			$this->success('保存成功！');
		}else{
			$info = $m->where('Id='.$id)->select();
			$this->assign('info',$info[0]);
			$this->display("ztbmcheck");
		}
		
	}

	/**
	 *20160217PC在线查看问题	
	 */
	public function chakan(){
		$user = $_SESSION[C('SESSION_USER_KEY')];
		if(isset($user['PromoterTel'])){
			$this->checkLevel(-99999);
		}else{
		}
		$id = I('get.id',0);
		$m = M('reservation_construction');
		$info = $m->where('Id='.$id)->select();
		// dump($info);
		$this->assign('info',$info[0]);
		$this->display("chakan");
	}

	public function checked(){

		// 此方法权限ID为29
		$this->checkLevel(207);

		// 获取需要审核数据的ID，并从表中获取相应信息
		$id= I('get.id',0);
		$pics = M('reservation_construction')->field('ID,pic,checked')->find($id);
		$this->assign('pics',$pics);
		$this->display("checked");
	}
	public function upcheck() {
		$data['ID']= I('post.id',0);
		$data['checked'] = I('post.checked');
		$pics = M('reservation_construction')->save($data); 
		if($pics) {

			//成功提示
			$this->success(L('更新成功'));
		} else {
			//错误提示
			$this->error(L('更新失败'));
		}
	}
	
	function makeurl(){
		//$this->checkLevel(141);
		$id = I('get.Id',0);
		if($id == 0){
			$id = I('post.id',0);
		}
		$this->assign('id',$id);
		$action = I('post.action','');
		$info = $this->pro->where('id='.$id)->select();
		$cityinfo = M('city')->where('ID ='.$info[0]['CityID'])->find();
		$this->assign('cityinfo',$cityinfo);
		$this->assign('info',$info[0]);
		if($action === 'action'){

			$url = I('post.url',0);
			$id = I('post.id',0);
			$DOMAIN = I('post.DOMAIN',0);
			if(strpos($url,'gonglue') !== false){
				$DOMAIN = 'gonglue';
			}
			if(strpos($url,'zhuangxiuxiaoguotu') !== false){
				$DOMAIN = 'zhuangxiuxiaoguotu';
			}
			if(empty($DOMAIN)){
				$DOMAIN = 'bj';
			}
			if (strpos($url,'utm_term=tuiguangyuan') ){
				$returnurl = $url;
			}else{
				$returnurl = 'http://'.$DOMAIN.'.sc.cc/?utm_term=tuiguangyuan&utm_source='.$id;
				if($url ==='http://'.$DOMAIN.'.sc.cc'){
					$returnurl = $url.'/'.$DOMAIN.'?utm_term=tuiguangyuan&utm_source='.$id;
				}else if(strpos($url,'?') === false){
					$returnurl = $url.'?utm_term=tuiguangyuan&utm_source='.$id;
				}else{
					$returnurl = $url.'&utm_term=tuiguangyuan&utm_source='.$id;
				}
			}
			$this->assign('returnurl',$returnurl);
			$this->assign('mreturnurl','http://m.sc.cc/?utm_term=tuiguangyuan&utm_source='.$id);
			$this->assign('url',$url);
			$this->display("makeurl");
		}else{
			if(empty($cityinfo['DOMAIN'])){
				$cityinfo['DOMAIN'] = 'bj';
			}
			$returnurl = 'http://'.$cityinfo['DOMAIN'].'.sc.cc/?utm_term=tuiguangyuan&utm_source='.$id;
			$this->assign('returnurl',$returnurl);
			$this->assign('mreturnurl','http://m.sc.cc/?utm_term=tuiguangyuan&utm_source='.$id);
			$this->display("makeurl");
		}
	}
	function makeurlmake(){
		$url = I('post.url',0);
		$id = I('post.id',0);
		$DOMAIN = I('post.DOMAIN',0);
		if(empty($DOMAIN)){
			$DOMAIN = 'bj';
		}
		$returnurl = '';
		if($url ==='http://www.sc.cc'){
			$returnurl = $url.'/'.$DOMAIN.'_'.$id;
		}else if($url ==='http://www.sc.cc/'){
			$returnurl = $url.$DOMAIN.'_'.$id;
		}else{
			$city = M('city')->select();
			foreach($city as $k=>$v){
				if (strpos($DOMAIN,'/'.$v['DOMAIN'].'/')){
					$returnrul = str_replace('/'.$v['DOMAIN'].'/', '/'.$v['DOMAIN'].'/'.'_'.$id, $DOMAIN);
				}else if(strpos($DOMAIN,'/'.$v['DOMAIN'])){
					$returnrul = str_replace('/'.$v['DOMAIN'], '/'.$v['DOMAIN'].'_'.$id, $DOMAIN);
				}else {
					$returnurl = '参数错误';
				}
					
			}
		}
		
	}
	
	public function edit(){

		$user = $_SESSION[C('SESSION_USER_KEY')];
		if(isset($user['PromoterTel'])){
			$this->checkLevel(-99999);
		}else{
			$this->checkLevel(141);
		}
		$id = I('get.Id',0);
		//var_dump($id);
		$info = $this->pro->where('id='.$id)->select();
		//$city = M('city')->where('ID in ('.$info[0]['cid'].')')->select();
		//var_dump($city);
		$this->assign('info',$info[0]);
		$this->display("edit");
	}
	public function update(){
		$user = $_SESSION[C('SESSION_USER_KEY')];
		if(isset($user['PromoterTel'])){
			$this->checkLevel(-99999);
		}else{
		$this->checkLevel(141);
		}
		$id = I('post.Id',0);
		
		$pass = I('post.userpass',0);
		if(!empty($pass)){
			$data['userpass'] = md5($pass);
		}
		$data['PromoterName'] = I('post.PromoterName',0);
		$data['PromoterTel'] = I('post.PromoterTel',0);
		$data['PromoterQQ'] = I('post.PromoterQQ',0);
		$data['PromoterMsn'] = I('post.PromoterMsn',0);
		$data['PromoterMail'] = I('post.PromoterMail',0);
		$data['CityID'] = I('post.CityID',0);
		$data['leyuid'] = I('post.leyuid',0);
		$data['allowPromote'] = I('post.allowPromote',0);
		$this->pro->where('Id='.$id)->save($data);

		$this->success('保存成功！');
	}
	public function add(){
		$this->checkLevel(141);
		$this->display("add");
	}
	public function insert(){
		$this->checkLevel(141);
		$username = I('post.PromoterTel',0);
		$check = $this->pro->where("PromoterTel='".$username."'")->select();
		if(!empty($check)){
			$this->error('电话号码重复！');
		}else{
			$pass = I('post.userpass',0);
			$data['userpass'] = md5($pass);
			$data['PromoterName'] = I('post.PromoterName',0);;
			$data['PromoterTel'] = $username;
			$data['PromoterQQ'] = I('post.PromoterQQ',0);
			$data['PromoterMsn'] = I('post.PromoterMsn',0);
			$data['PromoterMail'] = I('post.PromoterMail',0);
			$data['CityID'] = I('post.CityID',0);
			$data['leyuid'] = I('post.leyuid',0);
			$data['allowPromote'] = I('post.allowPromote',0);
			$this->pro->add($data); // 根据条件更新记录
		}
		$this->success('保存成功！');
	}
	public function del(){

		$this->checkLevel(141);
		$id = $_REQUEST['ids'];
		$model = $this->pro;
		if (isset($id) && is_string($id)) {
			//批量删除
			$condition = array('Id' => array('in', $id));
			if (false !== $model->where($condition)->delete()) {
				$this->success(L('删除成功'));
			} else {
				$this->error(L('删除失败'));
			}
		} else if (is_array($id)){
			//批量删除
			$condition = array('Id'=> array('in', explode(',', $id)));
			if (false !== $model->where($condition)->delete()) {
				$this->success(L('删除成功'));
			} else {
				$this->error(L('删除失败'));
			}
		}else {
			$this->error('非法操作');
		}
	}
	public function bm(){
		$source_id=I('source',-1);
		$this ->source_id=$source_id;
		$user = $_SESSION[C('SESSION_USER_KEY')];
		$this->assign('user',$user);
		if(isset($user['PromoterTel'])){
			$this->checkLevel(-99999);
		}else{
			$this->checkLevel(142);
		}
		$bmlxall = getbmlxall();
		// dump($bmlxall);
		//列表过滤器，生成查询Map对象.

		$map = $this->_search('reservation_construction');
		
		if(method_exists($this, '_filterbm')) {
			$where = $this->_filterbm();
		}
		// dump($where);
		$model = M('reservation_construction');
		//判断采用自定义的Model类
		if(!empty($model)) {
			$this->_bmlist($model, $where);
			  //echo  $model->getLastSql();
		}
		if(!isset($_REQUEST['Typeid'])){
			$_REQUEST['Typeid'] = -1;
		}
		// dump($_REQUEST['Typeid']);exit;
		
		$source = getsource();		
		 array_unshift($source, "全部");
		 
		$this->assign('source',$source);
		// dump(getsource());
		$this->assign('Typeid',$_REQUEST['Typeid']);
		$this->assign('bmlxall',$bmlxall);
		$this->display("bm");
		
	}

	/**
	 *专题报名管理
	 * 20160218
	 */
	public function ztbm(){
		$user = $_SESSION[C('SESSION_USER_KEY')];
		$this->assign('user',$user);
		if(isset($user['PromoterTel'])){
			$this->checkLevel(-99999);
		}else{
			$this->checkLevel(142);
		}
		$bmlxall = getbmlxall();
		// dump($bmlxall);
		//列表过滤器，生成查询Map对象.

		$map = $this->_search('reservation_construction');
		if(method_exists($this, '_filterztbm')) {
			$wherezt = $this->_filterztbm();
			// dump($wherezt);
		}
		// dump($where);
		$model = M('reservation_construction');
		//判断采用自定义的Model类
		if(!empty($model)) {
			$this->_list($model, $wherezt);
			//  echo  $model->getLastSql();
		}
		if(!isset($_REQUEST['Typeid'])){
			$_REQUEST['Typeid'] = -1;
		}
		// dump($_REQUEST['Typeid']);exit;
		$this->assign('Typeid',$_REQUEST['Typeid']);
		$this->assign('bmlxall',$bmlxall);
		$this->display("ztbm");
	}

	public function _filterztbm(){

		if(!empty($_REQUEST['Dealstate'])){
			$where['Dealstate'] = $_REQUEST['Dealstate'];
		}
		$where['CID'] = array('in',$this->citylevel);
		$where['TYPE'] = array('in','17,19,26');
		    	//搜索条件有值则做封装
		    	if(!empty($_REQUEST['keyword'])){
		    		$where['remark']  = array('like', "%{$_REQUEST['keyword']}%");
		    
		    	}
		           if(!empty($_REQUEST['Ism']) && $_REQUEST['Ism']==1){
				$where['Ism'] = 1;
		            }elseif($_REQUEST['Ism']==NULL){
		                    $where['Ism'] = array('in','0,1');
		           }else{
		                    $where['Ism'] = 0;
		            }
		  	
		  	
			if($_REQUEST['Dealstate'] !=''){
				$where['Dealstate'] = $_REQUEST['Dealstate'];
			}
			if(!empty($_REQUEST['cityID'])){
				$where['CID'] = $_REQUEST['cityID'];
			}

		            if(!empty($_REQUEST['starttime']) && !empty($_REQUEST['endtime'])){
		                        $where['addtime'] = array(array('egt',$_REQUEST['starttime']),array('elt',$_REQUEST['endtime']));
		            }else if(!empty($_REQUEST['starttime']) && empty($_REQUEST['endtime'])){
		                    $where['addtime'] = array('egt',$_REQUEST['starttime']);
		             }else if(empty($_REQUEST['starttime']) && !empty($_REQUEST['endtime'])){
		                $where['addtime'] = array('elt',$_REQUEST['endtime']);
		             }    
	    
		return $where;
	}

	//专题报名管理，提示未处理消息
	public function ztbmmessages(){
		$model = M('reservation_construction');
		$where['TYPE'] = array('in',17,19);
		$where['Dealstate'] = 0;//未处理
		$count = $model->where($where)->count();
		echo $count;
	}

	/**
	 * 推广员报名管理
	 * 20150304
	 */
	public function promotebm(){
		$user = $_SESSION[C('SESSION_USER_KEY')];
		if(isset($user['PromoterTel'])){
			$this->checkLevel(-99999);
		}else{
			$this->checkLevel(171);
		}

		// $this->checkLevel(142);
		$bmlxall = getbmlxall();
		//列表过滤器，生成查询Map对象.
		$where = '';
		// $map['PromoterId']  = array('GT',0);
		//$map = $this->_search();
		if(method_exists($this, '_filter')) {
			$where = $this->_filterpromoterbm();
		}
		//var_dump($where);exit;
		$model = M('reservation_construction');
		//判断采用自定义的Model类
		if(!empty($model)) {
			$this->_list($model, $where);
		}
		if(!isset($_REQUEST['Typeid'])){
			$_REQUEST['Typeid'] = -1;
		}
		$this->assign('Typeid',$_REQUEST['Typeid']);

		$this->assign('bmlxall',$bmlxall);
		$this->display("promotebm");
		
	}
	/*
	20150522微信退款
	 */
	public function wxrefund(){
		$this->checkLevel(194);
		//判断采用自定义的Model类
		 if(method_exists($this, '_filter')) {
			$where = $this->_filterwx();
		}
		$model = M('wxrefund');
		//判断采用自定义的Model类
		if(!empty($model)) {
			$this->_list($model, $where);
		}
		$this->display('wxrefund');
	}
	public function _filterwx(){
		if(!empty($_REQUEST['cid'])){
			$where['cid'] = $_REQUEST['cid'];
		}
		switch ($_REQUEST['status']) {
			case '0':
				$where['status'] = 0;
				break;
			case '1':
				$where['status'] = 1;
				break;
			case '-1':
				$where['status'] = -1;
				break;

		}
		return $where;
	}
	//微信退款处理状态
	public function wxeditcheck(){
		$id = I('get.id',0);
		$this->assign('id',$id);
		$this->display('wxcheck');
	}
	public function wxcheck(){
		$id = I('post.id',0);
		$data['status'] = I('post.status',0);
		$data['handlingtime'] = date('Y-m-d H:i:s');
		M('wxrefund')->where('id='.$id)->save($data);
		$this->success('保存成功！');
	}
	/*
	20150309公众号在线报修
	 */
	public function onlinerepair(){
		$this->checkLevel(173);
		$model = M('reservation_construction');

		 if(method_exists($this, '_filterpair')) {
			$where = $this->_filterpair();
		}
		//判断采用自定义的Model类
		if(!empty($model)) {
			$this->_list($model, $where);
		}

		$this->display('onlinerepair');
	}

	public function _filterpair(){
		if(!empty($_REQUEST['Dealstate']) || $_REQUEST['Dealstate'] ==0){
			$where['Dealstate'] = $_REQUEST['Dealstate'];
		}
                if($where['Dealstate']==null){
                        unset($where['Dealstate']);
                }
		$where['CID'] = array('in',$this->citylevel);
		$where['TYPE'] =13;
		return $where;
	}

	/**
	 * 2016-01-11PC以线报修
	 */
	public function pconlinerepair(){
		$this->checkLevel(222);
		$model = M('reservation_construction');

		 if(method_exists($this, '_filterpairpc')) {
			$where = $this->_filterpairpc();
		}

		//判断采用自定义的Model类
		if(!empty($model)) {
			$this->_list($model, $where);
		}

		$this->display('pconlinerepair');
	}

	public function _filterpairpc(){
		if(!empty($_REQUEST['Dealstate'])){
			$where['Dealstate'] = $_REQUEST['Dealstate'];
		}
		$where['CID'] = array('in',$this->citylevel);
		$where['TYPE'] =23;
		return $where;
	}
	
	//在线报修，提示未处理消息
	public function newmessages(){
		$model = M('reservation_construction');
		$where['TYPE'] =13;
		$where['Dealstate'] = 0;//未处理
                $where['CID'] = array('in',$this->citylevel);//新添加当前城市限制
		$count = $model->where($where)->count();
		echo $count;
	}

	//在线报修，提示未处理消息
	public function pcnewmessages(){
		$model = M('reservation_construction');
		$where['TYPE'] =23;
		$where['Dealstate'] = 0;//未处理
		$count = $model->where($where)->count();
		echo $count;
	}


	public function delbmr(){
	
	
		$user = $_SESSION[C('SESSION_USER_KEY')];
		if(isset($user['PromoterTel'])){
			$this->checkLevel(-99999);
			$pw = ' and Promoterid = '.$user['Id'].'';
		}else{
			$this->checkLevel(142);
			$pw = '';
		}

		$user = $_SESSION[C('SESSION_USER_KEY')];
		$id = I('get.id',0);
		$res1 = $this->pro->query("delete from reservation_construction where id=".$id.$pw);
		$this->success('删除成功！');
	}
	public function delbm(){
	
		$user = $_SESSION[C('SESSION_USER_KEY')];
		if(isset($user['PromoterTel'])){
			$this->checkLevel(-99999);
			$pw = ' and Promoterid = '.$user['Id'].'';
		}else{
			$this->checkLevel(142);
			$pw = '';
		}

		$user = $_SESSION[C('SESSION_USER_KEY')];
		$id = $_REQUEST['ids'];
		$model = M('reservation_construction');
		if (isset($id) && is_string($id)) {
			//批量删除
			$condition = array('id in ('.$id.')'.$pw);
			if (false !== $model->where($condition)->delete()) {
				$this->success(L('删除成功'));
			} else {
				$this->error(L('删除失败'));
			}
		} else if (is_array($id)){
			//批量删除
			$condition = array('id in ('.$id.') '.$pw);
			if (false !== $model->where($condition)->delete()) {
				$this->success(L('删除成功'));
			} else {
				$this->error(L('删除失败'));
			}
		}else {
			$this->error('非法操作');
		}
	}
	//封装搜素条件,自动调用的方法
	public function _filterbm(){
		$user = $_SESSION[C('SESSION_USER_KEY')];
		if(isset($user['PromoterTel'])){
			$this->checkLevel(-99999);
			$where['_string'] = 'PromoterId = '.$user['Id'];
		}else{
			$this->checkLevel(142);
			
		}

		if(!empty($_REQUEST['qudao'])){
			$where['qudao']  = array('like', "%{$_REQUEST['qudao']}%");
		
		}
		if(!empty($_REQUEST['utm_term'])){
			$where['utm_term']  = array('like', "%{$_REQUEST['utm_term']}%");
		
		}
		 if($_REQUEST['Ism'] !=''){
                      		 $where['Ism'] = $_REQUEST['Ism'];
           		 }

		$where['CID'] = array('in',$this->citylevel);
		//搜索条件有值则做封装
		if(!empty($_REQUEST['cityID'])){
			$where['CID'] = array('in',$_REQUEST['cityID']);
		}

		//搜索条件有值则做封装
		// $map['PromoterId'] =array('EXP','IS NULL'); 
		$where['_string'] = '(PromoterId = 0 or PromoterId is NULL)';

		if(($_REQUEST['Typeid'] == '-1') || ($_REQUEST['Typeid'] == NULL) ){

			// $where['TYPE'] = array('neq', '13');
			$where['TYPE'] = array('not in', '13,17,19,23,26');
		} else {
			$where['TYPE'] = $_REQUEST['Typeid'];
		}

		if($_REQUEST['Dealstate']!=''){
			$where['Dealstate'] = $_REQUEST['Dealstate'];
		}
		// dump($_REQUEST['source']);
		if($_REQUEST['source']==-1) $_REQUEST['source']='';
		if($_REQUEST['source'] != ''){
			$where['source'] = $_REQUEST['source'];
		}

		 if(!empty($_REQUEST['starttime']) && !empty($_REQUEST['endtime'])){
                        	$where['addtime'] = array(array('egt',$_REQUEST['starttime']),array('elt',$_REQUEST['endtime']));
           		 }else if(!empty($_REQUEST['starttime']) && empty($_REQUEST['endtime'])){
           		 	$where['addtime'] = array('egt',$_REQUEST['starttime']);
           		 }else if(empty($_REQUEST['starttime']) && !empty($_REQUEST['endtime'])){
           		 	$where['addtime'] = array('elt',$_REQUEST['endtime']);
           		 }
		$map['_complex'] = $where;
		return $map;
	}
	//20150304
	//封装搜素条件,自动调用的方法
	public function _filterpromoterbm(){
		$user = $_SESSION[C('SESSION_USER_KEY')];
		if(isset($user['PromoterTel'])){
			$this->checkLevel(-99999);
			$where['_string'] = 'PromoterId = '.$user['Id'];
		}else{
			$this->checkLevel(142);
	$where['CID'] = array('in',$this->citylevel);
		}
		$where['PromoterId'] = array('GT',0);
		//搜索条件有值则做封装
		if(!empty($_REQUEST['CityID'])){
			$where['CID'] = $_REQUEST['CityID'];
		}

		//搜索条件有值则做封装

		if(($_REQUEST['Typeid'] == '-1') || ($_REQUEST['Typeid'] == NULL) ){

			// $where['TYPE'] = array('neq', '13');
			$where['TYPE'] = array('not in', '13,17,19,23,26');
		} else {
			$where['TYPE'] = $_REQUEST['Typeid'];
		}
		if($_REQUEST['Dealstate']!=''){
			$where['Dealstate'] = $_REQUEST['Dealstate'];
		}
		
		return $where;
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
	public function wxcz(){
		$id = I('get.id',0);
		$url = urlencode('http://bj.sc.cc/wx/wxpromoterbind/id/'.$id);
		$returnurl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6ff0ede1fce6d885&redirect_uri='.$url.'&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
		$this->assign('returnurl',$returnurl);
		$this->assign('id',$id);
		$this->display();
	}
	public function bdwxerwm(){//获取access_token模板
	
			$html = $this->togetc('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx6ff0ede1fce6d885&secret=079026d605e407b449d0433590e91da0 ');
			
			if($html!="")
			{
				$htmls = json_decode($html,true);
				$access_token = $htmls["access_token"];
				//$openid = $htmls["openid"];
			}
	}
	public function gettgerwm(){//推广员公众号二维码生成
		$id = I('get.id',0);
		$imgs = file_get_contents('Public/download/images/wxpromoter/'.$id.'.jpg');
		//var_dump($_SERVER);exit;
		if($imgs){
			header('Location: /Public/download/images/wxpromoter/'.$id.'.jpg');
		}else{
			$html = $this->togetc('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx6ff0ede1fce6d885&secret=079026d605e407b449d0433590e91da0 ');
			
			if($html!="")
			{
				$htmls = json_decode($html,true);
				$access_token = $htmls["access_token"];
				//$openid = $htmls["openid"];
			}
			
			$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$access_token";
			$str = '{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": '.$id.'}}}';
			//var_dump($str);exit;
			$res = $this->postCurl($str,$url);;
			$res = json_decode($res,true);
			$ticket = $res['ticket'];
			$urlimg = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket;
			$img = $this->togetc($urlimg);
			$imgname = $id;
			file_put_contents('Public/download/images/wxpromoter/'.$imgname.'.jpg',$img);
			//var_dump($res);
	
			header('Location: https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket);
		}
	}
	
	public function sendcd(){
		$url = urlencode('http://www.sc.cc/bj/wx/wxtest');
		echo $url;exit;
		$html = $this->togetc('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx6ff0ede1fce6d885&secret=079026d605e407b449d0433590e91da0 ');
		
		if($html!="")
		{
			$htmls = json_decode($html,true);
			$access_token = $htmls["access_token"];
			$openid = $htmls["openid"];
		}
		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
		$str = ' {
	 "button":[
	 {  
		   "name":"菜单",
		   "sub_button":[
		   {    
			   "type":"view",
			   "name":"搜索1",
			   "url":"http://www.sc.cc/bj/wx/wxtest"
			}]
	  }';
		$res = $this->postCurl($str,$url);;
		var_dump($res);
	}
	protected function togetc($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$a = curl_exec($ch);
		return $a;
	}
	/**
	 *  作用：以post方式提交到对应的接口url
	 */
	public function postCurl($str,$url,$second=30)
	{       
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);curl_close($ch);

		return $data;
		
		
	}
	
}