<?php
namespace Admin\Model;
use Think\Model;

/**
* 后台幻灯片模型
* Class ActivityModel
* @author lipengqing
* @create date 2015-11-24
*/
class ActivityModel extends Model
{
	
	/**
	 * 获取非审核通过（待审核、审核未通过）的幻灯片数量
	 * @param string $cityid 以‘,’分隔的城市ID字符串
	 * @return integer 数字 
	 */
	public function getActivityTotal($cityid)
	{
		return $this->where('cid in (' . $cityid . ') AND status =0')->count();
	}
}
