<?php
namespace Admin\Model;
use Think\Model;

/**
* 
*/
class BudgetModel extends Model
{
	
	protected $_auto = array(
		array('addtime','getDatetime',self::MODEL_INSERT,'function'),
		array('updatetime','getDatetime',2,'function'),
	);
}