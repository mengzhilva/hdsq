<?php

define('CMF_ROOT', __DIR__ . '/../');
$web = M('webset')->where('id=1')->find();

$main_domain = $web['DOMAIN'];
$line        = '/';
$http        = "http://";
$sec_domain  = '';
$sec_city_domain = '';
$sc_hd                         = 'hd/';
$scindex                       = 'index/';
$id_sc                         = 'id/';
return array(
//'配置项'=>'配置值'

    
    'URL_MODEL' => 2,
    "SESSION_USER_KEY" => "scuser",
    'URL_ROUTER_ON' => false,
    'URL_ROUTE_RULES' => array(
          ':city^Index-Public-User-Pay$' => 'Home',//^Index-Public-User这串内容的作用是排除Index-Public-User这些关键字，他们都是分组名、模块名或者我们后面定义的路由规则的开头字符串，这样就兼容了正常的URL模式，如果一级目录不是城市，即直接转为正常路由或匹配下面的路由项
          ':city^Index-Public-User-Pay/:c$' => 'Home',
          ':city^Index-Public-User-Pay/:c/:a' => 'Home',//city作为get参数，注意这里排除了控制器名(以及后面定义的路由规则，避免冲突)，如果一级目录不是城市，即直接为正常路由

    ),

		'scurl' => array(
				// 网站域名URL拼接
				'DOMAIN' => $main_domain, //域名
				'SEC_DOMAIN' => $sec_domain, //域名
				'WWW_DOMAIN' => $http . $sec_domain . $main_domain . $line,
				'WWW_SEC_DOMAIN' => $http . 'www.sc.cc',
				'HTTP'=>$http,
        //活动url
        'HD_INDEX' => $http . $sec_city_domain . $main_domain . $line . $sc_hd,
        'HD_INDEX_INDEX' => $http . $sec_city_domain . $main_domain . $line . $sc_hd . $scindex,
        'HD_INDEX_ID' => $http . $sec_city_domain . $main_domain . $line . $sc_hd . $scindex . $id_sc,

				'HOUZHUI' => '.html',
				'GHOUZHUI' => '/',
				),
		
    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__IMG__' => __ROOT__ . '/Public/web/images',
        '__CSS__' => __ROOT__ . '/Public/web/css',
        '__JS__' => __ROOT__ . '/Public/web/js',
        '__SWF__' => __ROOT__ . '/Public/web/swf',
    ),
    /*
      'Vip/confirm' => array(
      'name'=>'',
      'title'=>'',
      'description'=>'',
      'keywords'=>''
      ),
      seo设置
     */
    'SEOWORD' => array(
        'Index/index' => array(
            'name' => '首页',
            'title' => '实创装饰集团-实创装饰688元/㎡整体家装产品，互联网家装领导品牌-整体装修设计,装修攻略,装修案例与效果图,实创装饰集团官网',
            'description' => '实创装饰688元/㎡整体家装，全国28城联动火热抢购。包工包料保十年，整体家装688元/㎡任性装。实创装饰互联网家装领导品牌，提倡互联网家装服务9星标准。做好装修设计，整体家装选实创-实创装饰官网',
            'keywords' => '实创装饰,实创装修设计,实创装修,实创装饰集团,实创,实创整体家装,实创家装集团,实创装修公司,实创688元/㎡,互联网家装服务标准,全国质保,688元/㎡任性装,包工包料保十年,装修案例,装修效果图,装修攻略'
        ),
    ),
);
