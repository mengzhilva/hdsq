<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台广告模型
* Class ActivityModel
* @author lipengqing
* @create date 2015-11-18
*/
class ActivityModel extends Model 
{
	
	/**
	 * 获取首页banner广告（当前城市）
	 * @param integer $cityid 当前城市的ID
	 * @param integer $id 广告位ID
	 * @return array 当前城市的广告
	 * @author lipengqing
	 */
	public function getBanner($cityid = 1, $id = 0)
	{

		return $this->field('id,image,url')->where('status=1 AND cid=' . $cityid . ' AND pid=' . $id . ' AND startTime<\'' . date('Y-m-d H:i:s',time()) . '\' AND endTime>\'' . date('Y-m-d H:i:s',time()) . '\'')->order('id desc')->select();
	}

}