<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台户型模型
* Class HousetypeModel
* @author lipengqing
* @create date 2015-11-27
*/
class HousetypeModel extends Model
{
	
	/**
	 * 获取户型列表
	 */
	public function getHousetype()
	{
		return $this->field('id,name,font_pinyin')->select();
	}
}

