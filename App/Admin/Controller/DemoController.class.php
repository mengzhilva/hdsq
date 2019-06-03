<?php
namespace Admin\Controller;

//测试控制器
class DemoController extends CommonController{
	
	//执行文件上传方法
	public function doUp(){
		//dump($_FILES);
		 $upload = new \Think\Upload();// 实例化上传类
		 $upload->maxSize =3145728 ;// 设置附件上传大小 
		 $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		 $upload->rootPath  = './Public/Uploads/'; // 设置附件上传目录
		 $upload->autoSub = false; //关闭自动生成子目录
		 
		 // 上传文件 
		 $info = $upload->upload();
		 if(!$info){
			// 上传错误提示错误信息
			$this->error($upload->getError());
		 }else{
			// 上传成功
			$this->success('上传成功！'.$info['pic']['savename']);
			
		 }
	}
	
	//编辑器的图片上传
	public function doUpload(){
		 $type = I('post.type');
		 $upload = new \Think\Upload();// 实例化上传类
		 $upload->maxSize =10145728 ;// 设置附件上传大小 
		 $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		 $upload->rootPath  = './Public/Uploads/'; // 设置附件上传目录
		 $upload->autoSub = false; //关闭自动生成子目录
		 
		 // 上传文件 
		 $info = $upload->upload();
		 //准备响应信息
		 $res=array("err"=>"","msg"=>"");
		 $res['state']=0;
		 if(!$info){
			// 上传错误提示错误信息
			$res['err']="上传失败：原因:".$upload->getError();
		 }else{
			foreach($info as $upfile){
				// 上传成功
				$res['msg']=__ROOT__."/Public/Uploads/".$upfile['savename'];
				$res['state']=200;
				$res['type'] = $type;
			}
		 }
		 $this->ajaxReturn($res);
	}
	//上传flash
	public function doflash(){
		 $upload = new \Think\Upload();// 实例化上传类
		 $upload->maxSize =10145728 ;// 设置附件上传大小 
		 $upload->exts = array('swf');// 设置附件上传类型
		 $upload->rootPath  = './Public/Uploads/flash/'; // 设置附件上传目录
		 $upload->autoSub = false; //关闭自动生成子目录
		 // 上传文件
		 $info = $upload->upload();
		 //准备响应信息
		 $res=array("err"=>"","msg"=>"");
		 $res['state']=0;
		 if(!$info){
			// 上传错误提示错误信息
			$res['err']="上传失败：原因:".$upload->getError();
		 }else{
			foreach($info as $upfile){
				// 上传成功
				$res['msg']=__ROOT__."/Public/Uploads/flash/".$upfile['savename'];
				$res['state']=200;
			}
		 }
		 $this->ajaxReturn($res);
	}


	/**
	 * 加载图片上传页面
	 */
	public function upindex()
	{
		$width = I('get.width', 0, 'intval');
		$height= I('get.height', 0, 'intval');
		$note = I('get.note', '', 'strip_tags');
		$note = iconv('gb2312', 'utf-8', $note);
		$type = I('get.type','');
		if (empty($width) && empty($height)) {
			// echo '<h1>请先选择' . $note . '位置！<h1>';
			echo '<script>$.pdialog.closeCurrent();alertMsg.info("请先选择' . $note . '位置！");</script>';

		} else {
			$this->assign('width', $width);
			$this->assign('height', $height);
			$this->assign('type', $type);
			$this->display('upindex');
		}


	}

	/**
	 * 图片上传之前，检查图片宽度和高度是否符合要求
	 */
	public function _before_upimg()
	{
		$res = ['state' => 300, 'err' => ''];
		if (!empty($_FILES['pic']['tmp_name'])) {
			$width = I('post.width', 0, 'intval');
			$height = I('post.height', 0, 'intval');
			if ((getimagesize($_FILES['pic']['tmp_name'])['0'] != $width) || (getimagesize($_FILES['pic']['tmp_name'])['1'] != $height)) {
				$res['err'] = '上传的图片尺寸不符合要求！';
				$this->ajaxReturn($res);
			}
		} else {

			$res['err'] = '请选择要上传的图片！';
			$this->ajaxReturn($res);
		}
		
	}

	/**
	 * 执行图片上传（ajax返回）
	 * @param string $type 标识，返回数据时用于区分图片
	 * @author
	 */
	public function upimg()
	{
		$this->doUpload();
	}
}