<?php
header("Content-type:text/html;charset=utf-8");
//框架的入口文件
// ini_set('session.cookie_path', '/');
// ini_set('session.cookie_domain','.sitrue.cc');//跨域访问Session
//开启调试模式：
define("APP_DEBUG",true);

//指定当前项目的应用目录名
define("APP_PATH","./App/");
//判断是否301跳转了
//require("redirect.php");
//导入Thinkphp框架
require("./ThinkPHP/ThinkPHP.php");



