<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台站点城市模型
* Class CityModel
* @author lipengqing
* @create date 2015-11-27
*/
class CityModel extends Model
{
	
	/**
	 * 获取站点城市列表
	 */
	public function getCity()
	{
		return $this->field('id,name,domain')->select();
	}
}
