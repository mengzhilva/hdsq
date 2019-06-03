<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台友情链接模型
* Class LinksModel
* @author lipengqing
* @create date 2015-11-27
*/
class LinksModel extends Model
{
	
	/**
	 * 获取友情链接列表
         * $pindaoid 频道ID
         * 下面的参数一一对应数据库字段
         * $dtstyleid 单图风格ID（没有的情况下可以不写此参数）
         * $dtkongid 单图空间ID（没有的情况下可以不写此参数）
         * $dtjubuid 单图局部ID（没有的情况下可以不写此参数）
         * $tucestyleid 图册风格ID（没有的情况下可以不写此参数）
         * $baojiaid 报价ID（没有的情况下可以不写此参数）
         * $lixiangzhuangid 理想装ID（没有的情况下可以不写此参数）
         * $gonglueid 攻略ID（没有的情况下可以不写此参数）
	 */
	public function getLinks($cid = 0, $pindaoid = 0,$canshu=0)
	{
		$where['is_delete'] = 0;
		$where['is_show'] = 1;
		$where['is_pic'] = 1;

		if(!empty($cid) && $pindaoid != 4  && $pindaoid != 11 && $pindaoid!=12){
			$where['cid'] = $cid;
		}
		if(!empty($pindaoid)){
			$where['pindaoid'] = $pindaoid;
		}
                if(!empty($canshu)){
                        $where['canshu'] = $canshu;
                }
		return $this->where($where)->field('link_id,link_name,url')->order('addtime desc')->select();
	}

        /**
	 * 获取热点标签
	 */
	public function getRedian($cid = 0, $pindaoid = 0)
	{
		$where['is_delete'] = 0;
		$where['is_show'] = 1;
		$where['is_pic'] = 3;
		if(!empty($cid) && ($pindaoid != 4 && $pindaoid != 3)){
			$where['cid'] = $cid;
		}
		if(!empty($pindaoid)){
			$where['pindaoid'] = $pindaoid;
		}
		return $this->where($where)->field('link_id,link_name,url')->order('addtime desc')->select();
	}
}
