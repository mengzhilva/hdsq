<?php
namespace Home\Model;
use Think\Model;

	/**
	 *公用model
	 *reservation_construction的model
	 *开发人员：李彭青
	 *开发时间：2015.8.13
	 *方法：开启批量验证、字段映射、自动验证、自动完成
	 *
	 */

class ReservationConstructionModel extends Model{
	protected $patchValidate = true;
	protected $_map = array(
		'username' => 'NAME',  //姓名
		'telephone' => 'PHONE',  //手机号
		'type' => 'TYPE',  //报名类型
	);
	protected $_validate = array(
		array('PHONE', '/^1[3|4|5|8|7][0-9]\d{8}$/', '手机号不合法'),
		array('NAME', 'require', '用户名必填'),
		// array('area', '/^([0-9]{0,3})$/', '面积为1-3位数字'),
		// array('PromoterId', 'number', '推广员ID必须是一个数字'),
		// array('TYPE', 'number', '报名类型必须是一个数字'),
	);

	protected $_auto = array(
		array('TIME', 'dateTime', 3, 'function'),
		array('addtime', 'dateTime', 3, 'function'),
		array('uid', 'getSessUid', 3, 'function'),
		array('ip', 'get_client_ip', 3, 'function' ),
	);

	/**
	 * 将姓名、电话等信息写入报名表
	 */
	public function addUserInfo($data)
	{
		//对渠道来源的cookie支持
		$utm = cookie('utm');
		if(empty($data['qudao']) && !empty($utm['utm_source']) && $utm['utm_term'] != 'tuiguangyuan'){
			$data['qudao'] = $utm['utm_source'];
		}
		if(empty($data['utm_term']) && !empty($utm['utm_term']) && $utm['utm_term'] != 'tuiguangyuan'){
			$data['utm_term'] = $utm['utm_term'];
		}
		if(!empty($utm['utm_term']) && !empty($utm['utm_source']) && $utm['utm_term'] == 'tuiguangyuan'){
			$tgy = M('tbpromoter')->where('id='.$utm['utm_source'])->find();
			$data['CID'] = $tgy['CityID'];
			$data['PromoterId'] = $utm['utm_source'];
		}
		if ($this->create($data)) {
			if ($this->add()) {
				return true;
			} else {
				return false;
				// return $this->getLastSql();
			}
		} else {
			return false;
			// return $this->getError();
		}

	}

}
