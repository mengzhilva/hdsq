<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台活动管理模型
* Class TbclassroomModel
* @author lipengqing
* @create date 2015-11-19
*/
class TbclassroomModel extends Model
{
	
	/**
	 * 获取指定城市的指定活动数据
	 * @param string $name 活动名称
	 * @param integer $cityid 城市ID
	 * @return array
	 */
	public function getHd($name = '', $cityid = 0)
	{
		return $this->where("ism=0 AND endtime>='".date('Y-m-d')."'".' and status=1 AND title LIKE \'%' . $name . '%\' AND cityid=' . $cityid)->field('id,title')->order('id desc')->getField('id');
	}
}

