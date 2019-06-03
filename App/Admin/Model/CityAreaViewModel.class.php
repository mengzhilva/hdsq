<?php

namespace Admin\Model;
use Think\Model\ViewModel;
class CityAreaViewModel extends ViewModel {

	public $viewFields = array(
			'cityarea'=>array('ID'=>'aid','NAME'=>'areaname','CID','_type'=>'LEFT'),
			 'city'=>array('NAME'=>'cityname', '_on'=>'cityarea.cid=city.ID'),
	   );
}