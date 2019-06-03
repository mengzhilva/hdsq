<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台小区模型
* Class CommunityModel
* @author
* @create date 2015-11-27
*/
class CommunityModel extends Model
{
	
	/**
	 * 获取小区
	 * @param integer $cityid 城市ID
	 * @return array
	 */
	public function getCommunty($cityid = 1,$limit = 9)
	{
		$where['CID'] = $cityid;
		$where['STATUS'] = 1;
		$where['IsImportent'] = 1;
		return $this->where($where)->field('id,name')->order('updatetime desc')->limit($limit)->select();
	}
}

