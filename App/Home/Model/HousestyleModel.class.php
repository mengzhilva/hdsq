<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台风格模型
* Class HousestyleModel
* @author
* @create date 2015-11-27
*/
class HousestyleModel extends Model
{
	/**
	 * 获取风格列表
	 */
	public function getHousestyle()
	{
		return $this->field('id,fontname,font_pinyin')->select();
	}

}