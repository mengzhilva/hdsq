<?php
//公共公有控制器
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {
    //加载登录页面
    public function login(){
        $this->display();
    }
 
    //执行登录方法
    public function doLogin(){
         
        //根据登录账号获取用户信息
        $user = M("Admin")->where("username='{$_POST['username']}'")->find();
       
        //判断是否获取到用户
        if($user){

            //检测密码：
            if($user['userpass'] == md5($_POST['userpass'])){
                //将登录的用户信息放入到session中
                $_SESSION[C('SESSION_USER_KEY')]=$user;
                    //判断跳转sc.cc/admin 跳转
                    if (substr($_SERVER['SERVER_NAME'], -5) == 'sc.cc') {
                            header('location:http://www.sc.cc/admin/');
                    }else{
                         $this->redirect("Index/index");
                    }
               
        		
               
            }else{
                // $this->assign("errorinfo","登录密码错误！");
                $this->error("密码错误");
                // $this->display("login");
               
            }
        }else{
        	
        	$user = M("tbpromoter")->where("PromoterTel='{$_POST['username']}'")->find();
        	 
        	//判断是否获取到用户
        	// dump($user);
        	if($user){
        		//检测密码：
        		if($user['userpass'] == md5($_POST['userpass'])){
        			//将登录的用户信息放入到session中
        			$user['lid'] = -99999;
        			$user['id'] = 'p'.$user['Id'];
        			$_SESSION[C('SESSION_USER_KEY')]=$user;
        	
        			//$this->redirect("Index/index");
        			//判断跳转sc.cc/admin 跳转
                                    if (substr($_SERVER['SERVER_NAME'], -5) == 'sc.cc') {
                                            header('location:http://www.sc.cc/admin/');
                                    }else{
                                         $this->redirect("Index/index");
                                    }
        			 
        		}else{
        			// $this->assign("errorinfo","登录密码错误！");
        			$this->error("密码错误");
        			// $this->display("login");
        			 
        		}
        	}else{
        		// $this->assign("errorinfo","登录账号不存在或被禁用");
        		$this->error("用户名错误");
        		// $this->display("login");
        	
        	}
        	
        	
            // $this->assign("errorinfo","登录账号不存在或被禁用");
            $this->error("用户名错误");
            // $this->display("login");
            
        }
    }
    
    //执行退出
    public function logout(){
        unset($_SESSION[C('SESSION_USER_KEY')]);
        $this->display("login");
    }
    //重置密码
    public function password(){
        $user=$_SESSION[C('SESSION_USER_KEY')];
        $this->assign('user',$user);
        $this->display('edit');
    }
    //重置密码提交
    public function update(){
        $id = $_POST['id'];
        $admin = M("admin");
        $data['userpass'] = md5($_POST['userpass']);
        $data['time'] = date('Y-m-d H:i:s');
        if($admin->where("id=".$id)->save($data)){
          $this->success("重置成功！");
        }else{
          $this->error("重置失败！");
        }
    }
}