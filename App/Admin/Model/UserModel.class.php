<?php
//自定义用户信息Model类
namespace Admin\Model;
use Think\Model;

class UserModel extends Model{
    
    //自动验证
    protected $_validate = array(
         array('username','/^\w{8,16}$/','账号必须是合法的8-16位字符！'),
         array('userpass','/^.{6,}$/','密码必须是6位及以上字符！'),
         array('username','','帐号信息已经存在！',0,'unique',1), // 在新增的时候验证username字段是否唯一     
    );
    
    //自动完成（填充）
    protected $_auto = array(
        array('userpass','md5',3,'function') , 
        array('addtime','time',1,'function'),
        array('state','0'),  
    ); 
    
}