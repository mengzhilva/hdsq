<?php
namespace Admin\Model;
use Think\Model;

/**
* 
*/
class StandardModel extends Model
{
	protected $_auto = array(
		array('addtime', 'getDatetime', self::MODEL_INSERT, 'function'),
	);

}