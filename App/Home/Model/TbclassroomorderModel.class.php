<?php
namespace Home\Model;
use Think\Model;

/**
* 活动报名模型
* Class TbclassroomorderModel
*/
class TbclassroomorderModel extends Model
{
	
	/**
	 * 字段验证
	 */
	protected $_validate = array(
		array('CityID','number', '城市ID必须是一个数字！'),
		array('CityName','require', '城市名必填！'),
		array('ClassRoomID','number', '活动ID必须是一个数字！'),
		array('ClassRoomName', 'require', '活动名称必填！'),
		array('UserName', 'require', '报名人姓名必填！'),
		array('TelePhone', 'require', '报名人电话必填！'),
		array('PromoterId', 'number', '推广员ID必须是一个数字'),
		array('UserIp', 'ipcheck', '频繁报名,请10秒后再操作',1,'function'),
	);

	/**
	 * 自动完成
	 */
	protected $_auto = array(
		array('UpdateTime', 'dateTime', self::MODEL_BOTH, 'function'),
		array('UserIp', 'get_client_ip', self::MODEL_BOTH, 'function'),
	);

	/**
	 * 活动报名表单数据写入
	 */
	public function adduser($data)
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
			$data['CityID'] = $tgy['CityID'];
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


	/**
	 * 获取当前活动报名人和电话
	 */
	public function getBmInfo($hdid)
	{
		return $this->where('classroomid=' . $hdid)->field('username,telephone')->select();
	}
}