<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台套餐概述模型
* Class PackageCityConfigModel
* @author lipengqing
* @create date 2015-11-18
*/
class PackageCityConfigModel extends Model
{
	
	/**
	 * 获取所需城市的指定套餐数据
	 * @param string $packagename  套餐名称
	 * @param integer $cityid   城市ID
	 * @return array   返回所需数据
	 */
	public function getPackage($packagename = '', $cityid = 0)
	{
		if (!empty($packagename) && !empty($cityid)) {
			// 套餐的ID
			$pid = M('Package')->where('NAME like \'%' . $packagename . '%\'')->getField('id');
			// 返回套餐概述信息
			return $this->where('pid=' . $pid . ' AND cid=' . $cityid)->field('id,image,image2,image3,url')->find();
		}
	}
}