<?php
namespace Admin\Controller;
class ExcelController extends CommonController {
    
	//PHPExcel插件使用，导出EXCEL
	
	//PHPExcel插件使用，导出EXCEL
	function index(){
		$mod = M("Stu");
		//指定字段信息
		$fields = array(
				'A'=>array('昵称',8),
				'B'=>array('电话',15),
				'C'=>array('城市',16),
				'D'=>array('开始时间',15),
				'E'=>array('已砍金额',15),
				'F'=>array('最低金额',15),	
				'G'=>array('基础人数',15),
				'H'=>array('最高限额',15),
				'I'=>array('价格区间',15),
				'J'=>array('状态',15),
				'K'=>array('亲友团',15),
				'L'=>array('收藏',15),
		);	
		//指定数据信息
		$qdlist = M('weixinkj')
			->join("left join city on weixinkj.cid=city.Id")
			->field("weixinkj.name as A,weixinkj.phone as B,city.`NAME` as C,weixinkj.starttime as D,weixinkj.kmoney as E,startmoney as F,startnumber as G,weixinkj.endmoney as H,betweens as I,qy as K,starttime,kmoney,issc")
			->order('weixinkj.id desc')
			->select();
		//var_dump(M()->getlastsql());exit;
		//exit;
		foreach ($qdlist as $k=>$v){
			if(strtotime($v['starttime'])+172800<=time() || $v['kmoney']>=5000){
				$qdlist[$k]['J'] = '结束';
			}else{
				$qdlist[$k]['J'] = '进行';
			}
			$qdlist[$k]['A'] = rawurldecode($v['A']);
			if($v['issc'] == 1){
				$qdlist[$k]['L'] = '是';
			}else{
				$qdlist[$k]['L'] = '否';
			}
		unset($qdlist[$k]['starttime']);
		unset($qdlist[$k]['issc']);
		unset($qdlist[$k]['kmoney']);
		}
		//使用函数导出学生信息
		PHPExcel("stuinfo",$fields,$qdlist);
	}
	public function kjexcel(){
		echo 'aa';exit;
		
	}
	
	//导出自定义的excel文件
	public function index2(){
		//指定导出类型
		header("Content-Type:application/vnd.ms-excel"); 
		header("Content-Disposition:attachment;filename=stu.xls");
		
		
		echo "id01\tzhangsan\tman\t20\t\n";
		echo "id01\tzhangsan\tman\t20\t\n";
		echo "id01\tzhangsan\tman\t20\t\n";
		echo "id01\tzhangsan\tman\t20\t\n";
		echo "id01\tzhangsan\tman\t20\t\n";
		echo "id01\tzhangsan\tman\t20\t\n";
		echo "id01\tzhangsan\tman\t20\t\n";
		exit();
	}	
}