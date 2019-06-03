<?php
namespace Home\Model;
use Think\Model\ViewModel;
class CaseImgViewModel extends ViewModel {

	public $viewFields = array(
			'case_image'=>array('CID','_type'=>'LEFT'),
			 'casedecorate'=>array('ID'=>'CCID','HID'=>'PHID', '_on'=>'case_image.CID=casedecorate.ID'),
	   );
	function get_case_image($cid = 0){
		$info = M('case_image')->where('cid='.$cid)->select();
		return $info;
	}
}