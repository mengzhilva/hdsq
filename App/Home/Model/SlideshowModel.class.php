<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台幻灯片模型
* Class SlideshowModel
* @author lipengqing
* @create date 2015-11-19
*/
class SlideshowModel extends Model 
{
	/**
	 * 获取首页幻灯片
	 * @param string $name 幻灯片位置名称
	 * @param integer $cityid 城市ID
	 * @param integer $num = 3 数据条数
	 * @return array 返回数组
	 */
	public function getSlide($name, $cityid, $num = 3)
	{
		// 根据位置名称获取ID
		$sid = M('Slideshowclass')->where('name like \'%' . $name . '%\'')->getField('id');
		// 返回数据
		return $this->where('cid=' . $cityid . ' AND status=1 AND sid=' . $sid)->field('id,name,image,url')->order('id desc')->limit($num)->select();
	}

	/**
	 *   首页幻灯片 不限制图片
	 */
	
	public function ungetSlide($name, $cityid)
	{
		// 根据位置名称获取ID
		$sid = M('Slideshowclass')->where('name like \'%' . $name . '%\'')->getField('id');
		// 返回数据
		return $this->where('cid=' . $cityid . ' AND status=1 AND sid=' . $sid)->field('id,name,image,url')->order('id desc')->select();
	}
}


