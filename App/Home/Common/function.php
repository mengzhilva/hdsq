<?php


// 将当前时间戳格式化,如 '2015-08-14 14:30:06'
function dateTime() {
        return date('Y-m-d H:i:s', time());
}

//首页攻略省略号
function addslh($data) {
        $str = iconv("UTF-8", "GB2312//IGNORE", $data);
        if (mb_strlen($str, 'gb2312') > 35) {
                $str = mb_substr($str, 0, 35, 'gb2312') . '......';
                return iconv("GB2312//IGNORE", "UTF-8", $str);
        } else {
                return $data;
        }
}
function sp_testwrite($d)
{
	$tfile = "_test.txt";
	$fp    = @fopen($d . "/" . $tfile, "w");
	if (!$fp) {
		return false;
	}
	fclose($fp);
	$rs = @unlink($d . "/" . $tfile);
	if ($rs) {
		return true;
	}
	return false;
}

function sp_dir_create($path, $mode = 0777)
{
	if (is_dir($path))
		return true;
	$ftp_enable = 0;
	$path       = sp_dir_path($path);
	$temp       = explode('/', $path);
	$cur_dir    = '';
	$max        = count($temp) - 1;
	for ($i = 0; $i < $max; $i++) {
		$cur_dir .= $temp[$i] . '/';
		if (@is_dir($cur_dir))
			continue;
		@mkdir($cur_dir, 0777, true);
		@chmod($cur_dir, 0777);
	}
	return is_dir($path);
}

function sp_dir_path($path)
{
	$path = str_replace('\\', '/', $path);
	if (substr($path, -1) != '/')
		$path = $path . '/';
	return $path;
}

function sp_execute_sql($db, $sql)
{
	$sql = trim($sql);
	preg_match('/CREATE TABLE .+ `([^ ]*)`/', $sql, $matches);
	if ($matches) {
		$table_name = $matches[1];
		$msg        = "创建数据表{$table_name}";
		try {
			$db->query($sql);
			return [
			'error'   => 0,
			'message' => $msg . ' 成功！'
					];
		} catch (\Exception $e) {
			return [
			'error'     => 1,
			'message'   => $msg . ' 失败！',
			'exception' => $e->getTraceAsString()
			];
		}

	} else {
		try {
			$db->query($sql);
			return [
			'error'   => 0,
			'message' => 'SQL执行成功!'
					];
		} catch (\Exception $e) {
			return [
			'error'     => 1,
			'message'   => 'SQL执行失败！',
			'exception' => $e->getTraceAsString()
			];
		}
	}
}

/**
 * 显示提示信息
 * @param  string $msg 提示信息
 */
function sp_show_msg($msg, $class = '')
{
	echo "<script type=\"text/javascript\">showmsg(\"{$msg}\", \"{$class}\")</script>";
	flush();
	ob_flush();
}

function sp_update_site_configs($db, $table_prefix)
{
$sitename        = I("post.sitename");
    $email           = I("post.manager_email");
    $siteurl         = I("post.siteurl");
    $seo_keywords    = I("post.sitekeywords");
    $seo_description = I("post.siteinfo");
    $site_options    = <<<helllo
    {
            		"site_name":"$sitename",
            		"site_host":"$siteurl",
            		"site_root":"",
            		"site_icp":"",
            		"site_admin_email":"$email",
            		"site_tongji":"",
            		"site_copyright":"",
            		"site_seo_title":"$sitename",
            		"site_seo_keywords":"$seo_keywords",
            		"site_seo_description":"$seo_description"
        }
helllo;
    $sql             = "INSERT INTO `{$table_prefix}options` (option_value,option_name) VALUES ('$site_options','site_options')";
    $db->execute($sql);
    sp_show_msg("网站信息配置成功!");
}

function sp_create_admin_account($db, $table_prefix, $authcode)
{
    $username    = I("post.manager");
    $password    = sp_password(I("post.manager_pwd"), $authcode);
    $email       = I("post.manager_email");
    $create_date = date("Y-m-d h:i:s");
    $ip          = get_client_ip(0, true);
    $sql         = <<<hello
    INSERT INTO `{$table_prefix}users`
    (id,user_login,user_pass,user_nicename,user_email,user_url,create_time,user_activation_key,user_status,last_login_ip,last_login_time) VALUES
    ('1', '{$username}', '{$password}', 'admin', '{$email}', '', '{$create_date}', '', '1', '{$ip}','{$create_date}');;
hello;
    $db->execute($sql);
sp_show_msg("管理员账号创建成功!");
}


/**
* 写入配置文件
 * @param  array $config 配置信息
*/
function sp_create_config($config, $authcode)
    {
    if (is_array($config)) {
    	//读取配置内容
    	$conf = file_get_contents(MODULE_PATH . 'Data/config.php');

    	//替换配置项
        foreach ($config as $key => $value) {
        $conf = str_replace("#{$key}#", $value, $conf);
        }

        $conf = str_replace('#AUTHCODE#', $authcode, $conf);
        $conf = str_replace('#COOKIE_PREFIX#', sp_random_string(6) . "_", $conf);

        //写入应用配置文件
        if (file_put_contents('data/conf/db.php', $conf)) {
        sp_show_msg('配置文件写入成功');
    	} else {
	sp_show_msg('配置文件写入失败！', 'error');
    	}
    	return '';

    	}
    	}


    	/**
    	 * 切分SQL文件成多个可以单独执行的sql语句
    	 * @param $file sql文件路径
    	 * @param $tablePre 表前缀
    	 * @param string $charset 字符集
    	 * @param string $defaultTablePre 默认表前缀
    	 * @param string $defaultCharset 默认字符集
    	 * @return array
    	 */
    	function cmf_split_sql($file, $tablePre, $charset = 'utf8mb4', $defaultTablePre = 'cmf_', $defaultCharset = 'utf8mb4')
    	{
    		if (file_exists($file)) {
    			//读取SQL文件
    			$sql = file_get_contents($file);
    			$sql = str_replace("\r", "\n", $sql);
    			$sql = str_replace("BEGIN;\n", '', $sql);//兼容 navicat 导出的 insert 语句
    			$sql = str_replace("COMMIT;\n", '', $sql);//兼容 navicat 导出的 insert 语句
    			$sql = str_replace($defaultCharset, $charset, $sql);
    			$sql = trim($sql);
    			//替换表前缀
    			$sql  = str_replace(" `{$defaultTablePre}", " `{$tablePre}", $sql);
    			$sqls = explode(";\n", $sql);
    			return $sqls;
    		}
    	
    		return [];
    	}

    	/**
    	 * 判断 cmf 核心是否安装
    	 * @return bool
    	 */
    	function cmf_is_installed()
    	{
    		static $cmfIsInstalled;
    		if (empty($cmfIsInstalled)) {
    			$cmfIsInstalled = file_exists(CMF_ROOT . 'data/install.lock');
    		}
    		return $cmfIsInstalled;
    	}
function sp_create_db_config($config)
{
		if (is_array($config)) {
		//读取配置内容
		//$conf = file_get_contents(APP_PATH . 'Common/Conf/config.php');
		$conf = "<?php return array(
    //PDO连接方式
    'DB_TYPE'   => 'pdo', // 数据库类型
    'DB_USER'   => '".$config['username']."', // 用户名
    'DB_PWD'    => '".$config['password']."', // 密码
    'DB_PREFIX' => '', // 数据库表前缀 
     'DB_DSN'    => 'mysql:host=".$config['hostname'].";dbname=".$config['dbname']."',
    //设置模块访问列表
    'MODULE_ALLOW_LIST'    =>  array('Home','Admin'),
    'DEFAULT_MODULE'       =>  'Home',
    'URL_MODEL'             =>  1, 
);";
        	//替换配置项
        	//foreach ($config as $key => $value) {
        		//	$conf = str_replace("#{$key}#", $value, $conf);
       // }


		file_put_contents(APP_PATH . 'Common/Conf/config.php', $conf);
        return true;

        	}
        }
/**
 * 随机字符串生成
 * @param int $len 生成的字符串长度
 * @return string
 */
function cmf_random_string($len = 6)
{
    $chars    = [
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
        "3", "4", "5", "6", "7", "8", "9"
    ];
    $charsLen = count($chars) - 1;
    shuffle($chars);    // 将数组打乱
    $output = "";
    for ($i = 0; $i < $len; $i++) {
        $output .= $chars[mt_rand(0, $charsLen)];
    }
    return $output;
}