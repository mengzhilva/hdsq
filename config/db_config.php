<?php
date_default_timezone_set('PRC');
error_reporting(0);
class cls_mysql
{
	var $dblink = NULL;
	var $settings = array();
	var $error_msgs = array();
	function __construct($dbhost, $dbuser, $dbpw, $dbname = '')
	{
		$this->connect($dbhost, $dbuser, $dbpw, $dbname);
	}
	function connect($dbhost, $dbuser, $dbpw, $dbname = '')
	{
		$this->dblink = @mysql_connect($dbhost, $dbuser, $dbpw, true);
		if (!$this->dblink)
		{
			$this->errlog("连接数据库服务器($dbhost)失败！");
			return false;
		}
			$this->settings = array(
			'dbhost'   => $dbhost,
			'dbuser'   => $dbuser,
			'dbpw'     => $dbpw,
			'dbname'   => $dbname
		);
		mysql_query("SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary", $this->dblink);
		mysql_query("SET sql_mode=''", $this->dblink);
		if ($dbname)
		{
			if (mysql_select_db($dbname, $this->dblink) === false)
			{
				$this->errlog("打开数据库($dbname)失败！");
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;
		}
	}
	//关闭数据库连接
	function close()
	{
		return mysql_close($this->dblink);
	}
	//执行sql语句
	function query($sql)
	{
		if (!($query = mysql_query($sql, $this->dblink)))
		{
			$this->errlog("查询失败！$sql");
			return false;
		}
		return $query;
	}
	function affected_rows() {
		return mysql_affected_rows($this->dblink);
	}
	function getone($sql) {
		$sql = trim($sql . ' LIMIT 1');
		$rslt = $this->query($sql);
		if ($rslt !== false)
		{
			$row = mysql_fetch_row($rslt);
			if ($row !== false)
			{
				return $row[0];
			}
			else
			{
				return '';
			}
		}
		else
		{
			return false;
		}
	}
	function getall($sql)
	{
		$rslt = $this->query($sql);
		if ($rslt !== false)
		{
			return $rslt;
		}
		else
		{
			return false;
		}
	}
	function getrow($sql)
	{
		$sql = trim($sql . ' LIMIT 1');
		$res = $this->query($sql);
		if ($res !== false)
		{
			return mysql_fetch_assoc($res);
		}
		else
		{
			return false;
		}
	}
	function errlog($err)
	{
		echo $err;
		array_push($this->error_msgs, $err);
	}
}
$GLOBALS['db'] = new cls_mysql('www.sc.cc', 'root', '1a2b3c4d5e@**)).com0512', 'scc');
//当新的一天到来时，更新设计师轮换图
//require("updates.php");
//desiger_ad_update();
//当前城市
// $nowcityid = $_GET["nowcityid"];
// if($nowcityid.""=="")
// {
// 	$nowcityid = $_COOKIE["nowcityid"];	
// }
// if($nowcityid.""=="")
// {
// 	$nowcityid = 1;
// }
// if($nowcityid.""!="")
// {
// 	setcookie("nowcityid", $nowcityid, time()+36000,"/","");
// }
?>