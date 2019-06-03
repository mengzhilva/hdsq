<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台案例模型
* Class CasedecorateModel
* @author lipengqing
* @create date 2015-11-18
*/
class CasedecorateModel extends Model
{
	
	/**
	 * 获取所需城市的指定案例数据
	 * @param integer $cityid   城市ID
	 * @return array   返回所需数据
	 */
	public function getCases($cityid = 0,$limit = 8,$start = 0)
	{
		$limits = $limit;
		if(!empty($start) && !empty($limit)){
			$limits = $start.','.$limit;
		}

		$cases = $this->where('inindex=1 AND IS3D=0 AND status=1 AND cityid=' . $cityid)->field('id,did,name,image,typeid,sid,area,cid,cottage')->order('updatetime desc')->limit($limits)->select();
		//echo M()->getLastSql();
		foreach ($cases as &$v) {
			// 设计师
			$v['style'] = M('housestyle')->where('ID=' . $v['sid'])->find();
			$v['housetype'] = M('housetype')->where('ID=' . $v['typeid'])->find();
			$v['areaurl'] = $this->returnarea($v['area']);
			$v['community'] = M('community')->where('ID=' . $v['cid'])->field('NAME,ID')->find();
			// $v['designer'] = M('Designer')->where('id=' . $v['did'])->field('id,cid,lid,name,phote,reservations,hid,office,status')->find();
			$v['casetotal'] = $this->where('status=1 AND did=' . $v['did'])->count();
			$designer = M('Designer')->where('id=' . $v['did'])->field('id,cid,lid,name,phote,reservations,hid,office,status')->find();
			if($designer['office']==-1){
				$designer['name']='实创设计师';
				$designer['phote']='/Public/touxiang.jpg';
				$designer['phote_url']='javascript:void(0);';	
				$designer['target']='';	
			}else{
				$designer['phote_url']=C('scurl')['DESIGNER_INDEX'].$designer['id'].'.html';
				$designer['target']='target="_blank"';	
			}
			$v['designer']=$designer;
			$v['casetotal'] = $this->where('status=1 AND did=' . $v['did'])->count();
		}

		return $cases;
	}
	function returnarea($area){
 		if($area<=60){
 			return '60pingmi';
 		}else if($area>60 && $area<=90){
 			return '90pingmi';
 		}else if($area>90 && $area<=120){
 			return '120pingmi';
 		}else if($area>120 && $area<=160){
 			return '160pingmi';
 		}else if($area>160 && $area<=200){
 			return '200pingmi';
 		}else{
 			return '10000pingmi';
 		}
	}
	/**
	 * 获取所需城市的指定案例数据
	 * @param integer $cityid   城市ID
	 * @return array   返回所需数据
	 */
	public function getCasesindex($cityid = 0,$limit = 0,$start = 0)
	{
		$limits = $limit;
		if(!empty($start) && !empty($limit)){
			$limits = $start.','.$limit;
		}
		$cases = $this->where('inindex=1 AND status=1 AND cityid=' . $cityid)->field('id,did,name,image,cottage')->order('updatetime desc')->limit($limits)->select();
	

		return $cases;
	}
	public function getCasesinfo($id = 0)
	{
		$cases = $this->where('id=' . $id)->field('id,sid,did,area,typeid,name,image,cottage,hits')->find();
	

		return $cases;
	}
        /**
         * 方法功能:获取指定小区的案例
         * 开发时间：16-6-3 下午5:00
         */
        public function getCommunity_Cases($cityid,$cid,$num=4){
                $where['cityID'] = $cityid;
                $where['CID'] = $cid;
                $where['status'] = 1;
                $where['status'] = 1;
                $where['IS3D'] = 0;
                $cases = $this->where($where)->field('ID,SID,DID,AREA,TYPEID,NAME,IMAGE')->order('UPDATETIME DESC')->limit($num)->select();
                foreach ($cases as &$v) {
                        $v['case_img'] = M('case_image')->where('CID='.$v['ID'])->field('IMAGE')->limit(3)->order('ID DESC')->select();
                        $v['designer'] = M('designer')->where('ID='.$v['DID'])->field('NAME,PHOTE')->find();
                        $v['areaurl'] = $this->returnarea($v['AREA']);
                        $v['style'] = M('housestyle')->where('ID=' . $v['SID'])->getField('FONTNAME');
                        $v['housetype'] = M('housetype')->where('ID=' . $v['TYPEID'])->getField('FONTNAME');
                }
                return $cases;
        }
}