<?php 
session_start();
require("db_config.php");
require("functions.php");

 $uid = $_SESSION["uid"];
// if($uid.""=="")
// {
// 	echo writescript("location.href='http://www.sc.cc/".$city_domain."/Account/login';");
// 	exit();
// }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
<?php
$act=$_REQUEST["act"];
//设定默认合同号
if($act=="1")
{
	$id=$_REQUEST["id"];
	if($id!="")
	{
		$GLOBALS["db"]->query("update process_manage set isdefault = 0 where uid=$uid");
		$GLOBALS["db"]->query("update process_manage set isdefault = 1 where id = $id");
	}
	echo writescript("alert('设定默认合同成功！');location.href='$BindUrl';");
}
//绑定手机号和合同号
if($act=="2")
{
	$mobile = $_REQUEST["mobile"];
	$connumber = $_REQUEST["connumber"];
	$client = webservice();
	/*echo ("SOAP服务器提供的开放函数:");
	echo ('<pre>');
	var_dump ( $client->__getFunctions () );//获取服务器上提供的方法
	echo ('</pre>');
	echo ("SOAP服务器提供的Type:");
	echo ('<pre>');
	var_dump ( $client->__getTypes () );//获取服务器上数据类型
	echo ('</pre>');
	echo ("执行GetGUIDNode的结果:");
	echo ("执行GetGUIDNode的结果:");*/
	
	$result=$client->GetUser(array('phone'=>$mobile,'password'=>'e10adc3949ba59abbe56e057f20f883e'));//查询中国郑州的天气，返回的是一个结构体
	$xml = simplexml_load_string($result-> GetUserResult);
	//print_r($xml); //显示结果
	
	$isdefault=0;
	
	if($GLOBALS["db"]->getone("select count(*) from process_manage where uid = $uid")=="0")	
	{
		$isdefault=1;
	}
	//var_dump($xml);exit;
	$succ=0;
	foreach($xml->Customer as $a) 
	{ 
		if($a->PactNumber==$connumber)
		{
			if($GLOBALS["db"]->getone("select count(*) from process_manage where connumber = '".$a->PactNumber."'")=="0")
			{
				$GLOBALS["db"]->query("insert into process_manage (truename,orderId,mobile,connumber,address,uid,isdefault) values ('".$a->Name ."','".$a->Id ."','".$a->CellPhone ."','".$a->PactNumber ."','".$a->Address ."',$uid,$isdefault)");
				$succ=1;				
			}
			else
			{
				$succ=2;	
			}
		}
	} 

	switch ($succ)
	{
		case 0:
		  echo writescript("alert('输入的手机号或合同号不符，没有绑定成功！');history.back();");
		  break;  
		case 1:
		  echo writescript("alert('绑定手机与合同号成功！');location.href='$BindUrl';");
		  break;
		default:
		  echo writescript("alert('您已经绑定过这个手机与合同号了！');history.back();");
	}
}
?>
</body>
</html>
