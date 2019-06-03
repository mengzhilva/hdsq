<?php
namespace Admin\Model;
use Think\Model;

/**
* 装修计算模型
* @author lipengqing
* @create date 2015-11-11
*/
class JisuanModel extends Model
{
	
	protected $_auto = array(
		array('addtime','getDatetime',self::MODEL_INSERT,'function'),
		array('updatetime','getDatetime',self::MODEL_UPDATE,'function'),
	);
}