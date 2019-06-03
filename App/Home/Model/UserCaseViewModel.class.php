<?php

namespace Home\Model;
use Think\Model\ViewModel;
class UserCaseViewModel extends ViewModel {

	public $viewFields = array(
			'usercollect'=>array('id','cid','uid','_type'=>'LEFT'),
			 'casedecorate'=>array('*','_on'=>'casedecorate.id=usercollect.cid'),
	   );
}