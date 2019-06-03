<?php
namespace Home\Model;
use Think\Model;

/**
* 网站前台案例模型
* Class CasedecorateModel
* @author lipengqing
* @create date 2015-11-18
*/
class CasedecorateclassModel extends Model
{
	
	/**
	 * 取风格
	 */
	public function gethousestyle()
	{
		
		$cases = M('housestyle')->select();
		return $cases;
	}
	/**
	 * 取居室housetype
	 */
	public function gethousetype()
	{
		
		$cases = M('housetype')->select();
		return $cases;
	}
	
	/**
	 * 取面积case_area
	 */
	public function getcase_area()
	{
		
		$cases = M('case_area')->select();
		foreach ($cases as $k=>$v) {
			$cases[$k]['areaurl'] = $this->returnarea($v['A_ID']);
		}
		return $cases;
	}
	function returnarea($area){
		$arr = array('60pingmi','90pingmi','120pingmi','160pingmi','200pingmi','1000pingmi');
 		return $arr[($area-1)];
	}
	/**
	 * 取局部housefunction
	 */
	public function gethousefunction()
	{
		
		$cases = M('housefunction')->select();
		return $cases;
	}
	/**
	 * 取空间housefunction
	 */
	public function gethousefunctionkj()
	{
		
		$cases = M('housefunction')->where('IsMSite=1')->select();
		return $cases;
	}
}