<?php
//自定义用户信息Model类
namespace Admin\Model;
use Think\Model;

class UsersModel extends Model{
    
    //自动验证
    protected $_validate = array(
         array('username','/^\w{6,16}$/','账号必须是合法的8-16位字符！'),
         array('password','/^.{6,}$/','密码必须是6位及以上字符！'),
         array('reuserpass','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
         array('username','','用户已经存在！',0,'unique',1),// 在新增的时候验证username字段是否唯一     
    ); 
    
    //自动完成（填充）
    protected $_auto = array(
        array('password','md5',3,'function'), 
        array('registerTime','mydate','1','callback'),
    ); 
    protected function mydate(){
        return date("Y-m-d H:i:s");
    }
    
}