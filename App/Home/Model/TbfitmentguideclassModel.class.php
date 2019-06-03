<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台装修指南热点标签模型
* Class TbfitmenttagModel
* @author lipengqing
* @create date 2015-11-19
*/
class TbfitmentguideclassModel extends Model
{
	
	/**
	 * 获取装修指南分类
	 * @return array
	 */
	public function getbyparentclass($classid = 0,$limit = 8)
	{
		if(!empty($classid)){
			return $this->where('ParentID='.$classid)->field('ClassID,Description,Title,Keywords,ClassName')->limit($limit)->select();
		}
	}
}

