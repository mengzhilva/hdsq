<?php
namespace Home\Model;
use Think\Model;
class CaseImgModel extends Model {

	function get_case_image($cid = 0){
		$info = M('case_image')->where('cid='.$cid)->select();
		return $info;
	}
}