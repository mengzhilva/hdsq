<?php
//过滤HTML代码
function replacehtml($html)
{
	return preg_replace("/<\/?[^>]+>/","",$html);
}
//日期操作函数
function dateadd($part, $n, $date)
{
	switch($part)
	{
		case "y": $val = date("Y-m-d H:i:s", strtotime($date ." +$n year")); break;
		case "m": $val = date("Y-m-d H:i:s", strtotime($date ." +$n month")); break;
		case "w": $val = date("Y-m-d H:i:s", strtotime($date ." +$n week")); break;
		case "d": $val = date("Y-m-d H:i:s", strtotime($date ." +$n day")); break;
		case "h": $val = date("Y-m-d H:i:s", strtotime($date ." +$n hour")); break;
		case "n": $val = date("Y-m-d H:i:s", strtotime($date ." +$n minute")); break;
		case "s": $val = date("Y-m-d H:i:s", strtotime($date ." +$n second")); break;
	}
	return $val;
}
//格式化HTML
function htmlencode($fString)
{
	if($fString!="")
	{
		$fString = str_replace( '>', '&gt;',$fString);
		$fString = str_replace( '<', '&lt;',$fString);
		$fString = str_replace( chr(32), '&nbsp;',$fString);
		$fString = str_replace( chr(13), ' ',$fString);
		$fString = str_replace( chr(10) & chr(10), '<br>',$fString);
		$fString = str_replace( chr(10), '<BR>',$fString);
	}
	return $fString;
}
//格式化时间
function formattime($timsstr,$t="")
{
	if($t.""=="")
	{
		return date("Y-m-d", $timsstr);
	}
	else
	{
		return date("Y-m-d H:i:s", $timsstr);
	}
}
//截取字符串
function funleft($allstr,$len)
{
	return mb_substr($allstr,0,$len,'utf-8');	
}
//安全化字符串
// function formathtml($str)
// {
// 	return 	str_replace("’","'",$str);
// }
//输出脚本
function writescript($str)
{
	return "<script>$str</script>";	
}
//读取webservice
function webservice()
{
	$ws = "http://oa.sitrust.cn:8001/ToMobile.asmx?wsdl";//webservice服务的地址
	$client = new SoapClient ($ws);
	
	/*echo ("SOAP服务器提供的开放函数:");
	echo ('<pre>');
	var_dump ( $client->__getFunctions () );//获取服务器上提供的方法
	echo ('</pre>');
	echo ("SOAP服务器提供的Type:");
	echo ('<pre>');
	var_dump ( $client->__getTypes () );//获取服务器上数据类型
	echo ('</pre>');
	echo ("执行GetGUIDNode的结果:");*/	
	return $client;
}
//读取webservice
function webserviceqgc()
{
	$ws = "http://oa.sitrust.cn:8001/scweb.asmx?wsdl";//webservice服务的地址
	$client = new SoapClient ($ws);
	
	/*echo ("SOAP服务器提供的开放函数:");
	echo ('<pre>');
	var_dump ( $client->__getFunctions () );//获取服务器上提供的方法
	echo ('</pre>');
	echo ("SOAP服务器提供的Type:");
	echo ('<pre>');
	var_dump ( $client->__getTypes () );//获取服务器上数据类型
	echo ('</pre>');
	echo ("执行GetGUIDNode的结果:");*/	
	return $client;
}
//读取绑定的默认合号
function getdefaultconnumber($f_uid)
{
	return $GLOBALS["db"]->getone("select connumber from process_manage where uid=$f_uid and isdefault=1");
}
//是否有绑定的合同号
function ishaveconnumber($f_connumber)
{
	if($f_connumber.""=="")
	{
		return wscript("alert('您还没有绑定合同号！');history.back();");
	}
	else
	{
		return "";	
	}
}
//读取时间差
function datediff($date1,$date2)
{
	$temp=strtotime($date2)-strtotime($date1);
	$date=floor($temp/86400);
	return $date;
}
//读取城市名称
// function getcityname($id)
// {
// 	if($id==""||$id=="0")
// 	{
// 		echo "全国";
// 	}
// 	else
// 	{
// 		return $GLOBALS["db"]->getone("select name from city where id=$id");
// 	}
// }
//读取城市分类名称
// function getcityareaname($id)
// {
// 	if($id==""||$id=="0")
// 	{
// 		echo "全部";
// 	}
// 	else
// 	{
// 		return $GLOBALS["db"]->getone("select name from cityarea where id=$id");
// 	}
// }
//读取设计师级别
// function getdesignerlevel($id)
// {
// 	return $GLOBALS["db"]->getone("select name from designerlevel where id=$id");
// }
// //设计师星级文字
// function getdesignerstar($star)
// {
// 	$starstr = "";
// 	for($si=0;$si<$star;$si++)
// 	{
// 		$starstr = $starstr."★";
// 	}
// 	return $starstr;
// }
//读取复选框
// function reqs($str)
// {
// 	$arrayss = $_REQUEST[$str];
// 	$sizess = count($arrayss);
// 	$catess="";
// 	for($iss=0; $iss<$sizess; $iss++)
// 	{
// 		if($iss==$sizess-1)
// 		{
// 			$catess = $catess.$arrayss[$iss];
// 		}
// 		else
// 		{
// 			$catess = $catess.$arrayss[$iss].",";
// 		}	
// 	}
// 	return $catess;
// }
//获取城市URL
function getdomain($id)
{
	return $GLOBALS["db"]->getone("select DOMAIN from city where ID=$id");
}
//获取实际图片URL,兼容各版本URL
function gettrueurl($PHOTE)
{
	if(strpos($PHOTE,"UploadFile")==""&&strpos($PHOTE,"web_manage")=="")
	{
		$PHOTE = "/file/img/$PHOTE";
	}
	if(strpos($PHOTE,"web_manage")=="")
	{
		$PHOTE = "http://www.sc.cc$PHOTE";
	}	
	return $PHOTE;
}
//是否重点小区&&其它是否类的内容
function isimportent($strs)
{
	if($strs==0)
	{
		return "否";	
	}	
	else
	{
		return "是";	
	}
}
//小区好邻居 N年装修
function ucasezhuangxiu($num,$mode=true){
    $char = array('零','一','二','三','四','五','六','七','八','九');
    //$char = array('零','壹','贰','叁','肆','伍','陆','柒','捌','玖);
    $dw = array('','十','百','千','','万','亿','兆');
    //$dw = array('','拾','佰','仟','','萬','億','兆');
    $dec = '点';  //$dec = '點';
    $retval = '';
    if($mode){
        preg_match_all('/^0*(\d*)\.?(\d*)/',$num, $ar);
    }else{
        preg_match_all('/(\d*)\.?(\d*)/',$num, $ar);
    }
    if($ar[2][0] != ''){
        $retval = $dec . ch_num($ar[2][0],false); //如果有小数，先递归处理小数
    }
    if($ar[1][0] != ''){
        $str = strrev($ar[1][0]);
        for($i=0;$i<strlen($str);$i++) {
            $out[$i] = $char[$str[$i]];
            if($mode){
                $out[$i] .= $str[$i] != '0'? $dw[$i%4] : '';
                if($str[$i]+$str[$i-1] == 0){
                    $out[$i] = '';
                }
                if($i%4 == 0){
                    $out[$i] .= $dw[4+floor($i/4)];
                }
            }
        }
        $retval = join('',array_reverse($out)) . $retval;
    }
    return str_replace("一十","十",$retval);
}
//绑定合同地址
$BindUrl = "/bj/vip/bdht.html";
$keyx5 = 'scx5';
?>