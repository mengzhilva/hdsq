<?php 
namespace Admin\Model;
use Think\Model;
class HdModel extends Model {
	protected $tableName = 'tbClassRoom';
	protected $tablePrefix = '';
	

	/**
	 * 获取非审核通过（待审核、审核未通过）的活动数
	 * @param string 以‘,’分隔的城市ID字符串
	 * @return integer 数字
	 */
	public function getHdTotal($cityid)
	{
		return $this->where('cityid in (' . $cityid . ') AND status = 0')->count();
	}
}

