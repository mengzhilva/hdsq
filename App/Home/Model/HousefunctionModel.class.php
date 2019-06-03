<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台空间模型
* Class HousefunctionModel
* @author
* @create date 2015-11-27
*/
class HousefunctionModel extends Model
{
	
	/**
	 * 获取空间（或局部）列表
	 * @param integer $is 1为空间（默认），0为局部
	 * @return array
	 */
	public function getHousefunction($is = 1)
	{
		return $this->where('ismsite=' . $is)->field('id,fontname,font_pinyin')->select();
	}
}