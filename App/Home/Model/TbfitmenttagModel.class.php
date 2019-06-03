<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台装修指南热点标签模型
* Class TbfitmenttagModel
* @author lipengqing
* @create date 2015-11-19
*/
class TbfitmenttagModel extends Model
{
	
	/**
	 * 获取装修指南标签
	 * @return array
	 */
	public function getTag($limit = 15)
	{
		return $this->where('status=1')->field('id,tag')->limit($limit)->select();
	}
}

