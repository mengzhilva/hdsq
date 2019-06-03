<?php return array(
    //PDO连接方式
    'DB_TYPE'   => 'pdo', // 数据库类型
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => 'root', // 密码
    'DB_PREFIX' => '', // 数据库表前缀 
     'DB_DSN'    => 'mysql:host=localhost;dbname=hdsqs',
    //设置模块访问列表
    'MODULE_ALLOW_LIST'    =>  array('Home','Admin'),
    'DEFAULT_MODULE'       =>  'Home',
    'URL_MODEL'             =>  1, 
);