<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台装修攻略模型
* Class TbfitmentguideModel
* @author lipengqing
* @create date 2015-11-19
*/
class TbfitmentguideModel extends Model
{
	
	/**
	 * 获取所需的装修攻略数据
	 * @param string $name 文章分类名称
	 * @return array
	 */
	public function getGuide($name = '', $num = 8)
	{
		$classid = M('Tbfitmentguideclass')->where('classname=\'' . $name . '\'')->getField('classid');
		return $this->where('status=1 AND inindex=1 AND ism=0 AND classid=' . $classid)->field('id,title,defaultpicurl,linkurl')->order('updatetime desc')->limit($num)->select();
	}

	/**
	 * 获取关键字搜索数据
	 * @param $string $keyword 关键字
	 * @return array
	 */
	public function search($keyword)
	{
		$where['title'] = array('like',"%{$keyword}%");
		$where['classname'] = array('like',"%{$keyword}%");
		$where['tag'] = array('like',"%{$keyword}%");
		$where['keywordscore'] = array('like',"%{$keyword}%");
		$where['_logic'] = 'or';
		$map['_complex'] = $where;
		$map['Status']  = 1;
		return $this->where($map)->order('updatetime desc')->field('id,title')->order('updatetime desc')->limit(8)->select();
	}

	/**
	 * 热点文章
	 * @return array 
	 */
	public function getHot()
	{
		return $this->where('status=1 AND inindex=1 AND ism=0 AND hot=1')->field('id,title,intro,defaultpicurl')->order('updatetime desc')->limit(2)->select();
	}
	//根据分类取攻略
	public function getbyclass($classid,$limit = 20,$cityid){
		$city = '';
		if(!empty($cityid)){
			$city = 'and CityID='.$cityid;
		}
		$list = M('tbfitmentguide')
			->field('id,Title,DefaultPicUrl,Intro,LinkUrl,UpdateTime')
			->where('ClassID='.$classid.' and Status=1 and inindex=1 '.$city)
			->order('UpdateTime desc')
			->limit($limit)
			->select();
		
		return $list;
		
	}
}

