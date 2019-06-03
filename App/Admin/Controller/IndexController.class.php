<?php
namespace Admin\Controller;

class IndexController extends CommonController {
	public function __construct(){
		parent::__construct();
		$this->citylevel = $_SESSION['scadminuser']['cid'];
		$webset = D('webset')->where('id=1')->find();

		$this->assign('webset',$webset);
	}
	public function index(){
		//计算新闻管理未审核Statusdescription
		
		//推广员活动报名，未审核
   
		$user = $_SESSION[C('SESSION_USER_KEY')];
		if(isset($user['PromoterTel'])){
			// $this->checkLevel(-99999);
			$bmwhere['_string'] = 'TelePhone!=15110000000 and PromoterId = '.$user['Id'];
		}else{
			$bmwhere['_string'] = 'TelePhone!=15110000000 and PromoterId > 0 and CityID in ('.$this->citylevel.')';
		}
	


		$this->display("index");
	}

}