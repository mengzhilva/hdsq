<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台设计师模型
* Class DesignerModel
* @author lipengqing
* @create date 2015-11-27
*/
class DesignerModel extends Model
{
	
	/**
	 * 获取设计师
	 * @param integer $cityid 城市ID
	 * @return array
	 */
	public function getDesigner($cityid = 1)
	{
		$where['STATUS'] = 1;
		$where['INDEX'] = 1;
		$where['CID'] = $cityid;
		return $this->where($where)->field('id,name')->order('updatetime desc')->select();
	}
}
