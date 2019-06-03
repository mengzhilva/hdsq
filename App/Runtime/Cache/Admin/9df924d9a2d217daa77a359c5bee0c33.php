<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>管理工作平台_活动神器</title>

<link href="/Public/dwz/themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="/Public/dwz/themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
<!--<link href="/Public/dwz/themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>-->
<link href="/Public/dwz/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
<!--[if IE]>
<link href="/Public/dwz/themes/css/ieHack.css" rel="stylesheet" type="text/css" media="screen"/>
<![endif]-->

<script src="/Public/dwz/js/speedup.js" type="text/javascript"></script>
<script src="/Public/dwz/js/jquery-1.7.1.js" type="text/javascript"></script>
<script src="/Public/dwz/js/jquery.cookie.js" type="text/javascript"></script>
<script src="/Public/dwz/js/jquery.validate.js" type="text/javascript"></script>
<script src="/Public/dwz/js/jquery.bgiframe.js" type="text/javascript"></script>

<script src="/Public/dwz/xheditor/xheditor-1.1.12-zh-cn.min.js" type="text/javascript"></script>
<script src="/Public/dwz/uploadify/scripts/swfobject.js" type="text/javascript"></script>
<script src="/Public/dwz/uploadify/scripts/jquery.uploadify.v2.1.0.js" type="text/javascript"></script>
<!-- 添加时间插件2016 5-6 -->
<script language="javascript" type="text/javascript" src="/Public/dwz/date/WdatePicker.js"></script>


<script src="/Public/dwz/js/dwz.min.js" type="text/javascript"></script>
<script src="/Public/dwz/js/dwz.regional.zh.js" type="text/javascript"></script>

<script type="text/javascript">
$(function(){
	DWZ.init("/Public/dwz/dwz.frag.xml", {
		//loginUrl:"login_dialog.html", loginTitle:"登录",    // 弹出登录对话框
		loginUrl:"/Public/login",    // 跳到登录页面
		statusCode:{ ok:200, error:300, timeout:301}, //【可选】
		pageInfo:{ pageNum:"pageNum", numPerPage:"numPerPage", orderField:"_order", orderDirection:"_sort"}, //【可选】
		debug:false,    // 调试模式 【true|false】
		callback:function(){
			initEnv();
			$("#themeList").theme({ themeBase:"/Public/dwz/themes"}); // themeBase 相对于index页面的主题base路径
		}
	});
});

</script>
<style>
.fileQueue {
	width: 400px;
	height: 200px;
	overflow: auto;
	border: 1px solid #E5E5E5;
	margin-bottom: 10px;
}

.uploadifyQueueItem {
	font: 11px Verdana, Geneva, sans-serif;
	border: 2px solid #E5E5E5;
	background-color: #F5F5F5;
	margin-top: 5px;
	padding: 10px;
	width: 350px;
}
.uploadifyError {
	border: 2px solid #FBCBBC !important;
	background-color: #FDE5DD !important;
}
.uploadifyQueueItem .cancel {
	float: right;
}
.uploadifyProgress {
	background-color: #FFFFFF;
	border-top: 1px solid #808080;
	border-left: 1px solid #808080;
	border-right: 1px solid #C5C5C5;
	border-bottom: 1px solid #C5C5C5;
	margin-top: 10px;
	width: 100%;
}
.uploadifyProgressBar {
	background-color: #0099FF;
	width: 1px;
	height: 3px;
}
</style>

</head>

<body scroll="no">
	<div id="layout">
		<!-- 页头信息 -->
		<div id="header">
			<div class="headerNav">
				<a class="logo" href="#" style="background:url(<?php echo ($webset["headerlogo"]); ?>) no-repeat">标志</a>
				<ul class="nav">
					<li><a href="">前台首页</a></li>
					<li><a href="#" target="_blank">欢迎您：<?php if($Promoter != ''): echo ($_SESSION['scadminuser']['PromoterName']); else: echo ($_SESSION['scadminuser']['username']); endif; ?></a></li>
					<?php if($Promoter != ''): ?><li><a href="/Admin/Promoter/edit/Id/<?php echo ($Promoter["Id"]); ?>" target="dialog">修改资料</a></li>
					<li><a href="/Admin/Promoterlogin/logout">退出</a></li>
					<?php else: ?>
					<li><a href="/Admin/Public/password" target="dialog">修改密码</a></li>
					<li><a href="/Admin/Public/logout">退出</a></li><?php endif; ?>
				</ul>
				
				<ul class="themeList" id="themeList">
					<li theme="default"><div class="selected">蓝色</div></li>
					<li theme="green"><div>绿色</div></li>
					<li theme="purple"><div>紫色</div></li>
					<li theme="silver"><div>银色</div></li>
					<li theme="azure"><div>天蓝</div></li>
				</ul>
			</div>
		</div>
		<!-- 页头信息 -->
		<?php $level = explode(',', $_SESSION['scadminuser']['lid']); ?>
		<!-- 左侧导航栏开始 -->
		<div id="leftside">
			<div id="sidebar_s">
				<div class="collapse">
					<div class="toggleCollapse"><div></div></div>
				</div>
			</div>
			<div id="sidebar">
				<div class="toggleCollapse"><h2>主菜单</h2><div>收缩</div></div>
				<div class="accordion" fillSpace="sidebar">
					<div class="accordionHeader">
						<h2><span>Folder</span>活动管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/Admin/Hd/index" target="navTab" rel="listhd" title="活动管理">活动管理</a></li>
							<li><a href="/Admin/Hd/chajianlist" target="navTab"  rel="listhdcj" title="活动插件管理">活动插件管理</a></li>
						</ul>
					</div>
					<div class="accordionHeader">
						<h2><span>Folder</span>报名管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li><a href="/Admin/Hdbm" target="navTab" rel="listhdbm" title="活动报名管理">活动报名管理</a></li>
						
						</ul>
					</div>
					<div class="accordionHeader">
						<h2><span>Folder</span>系统管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							<li style="display:none;"><a href="/Admin/Admin/index" target="navTab" rel="listadmin" title="管理员管理">管理员管理</a></li>
							<li><a href="/Admin/Webset" target="navTab" rel="listzd" title="站点管理">站点管理</a></li>
							<li><a href="/Admin/Webmenu/index" target="navTab" rel="listwebmenu" title="活动菜单管理">活动菜单管理</a></li>
							<li style="display:none;"><a href="/Admin/CityArea/index" target="navTab" rel="listcityarea" title="区县管理">区县管理</a></li>
							<li style="display:none;"><a href="/Admin/City/index" target="navTab"  rel="listcity" title="站点管理">城市管理</a></li>
						
						</ul>
					</div>
				<?php if(in_array(49, $level) or in_array(53, $level) or in_array(78, $level) or in_array(81, $level)){ ?>
					<div class="accordionHeader"  style="display:none;">
						<h2><span>Folder</span>关于企业</h2>
					</div>
					<div class="accordionContent"  style="display:none;">
						<ul class="tree treeFolder">
						<?php if(in_array(49, $level)){ ?>
							<li><a href="/Admin/Tbnewsclass/index" target="navTab" rel="listclass" title="新闻分类管理">新闻分类管理</a></li>
						<?php } ?>
						<?php if(in_array(53, $level)){ ?>
							<li><a href="/Admin/Tbnews/index" target="navTab" rel="listnews" title="新闻内容管理">新闻内容管理</a></li>
							<li><a href="/Admin/TbnewsYgfc/index" target="navTab" rel="listnewsyg" title="员工风采管理">员工风采管理</a></li>
						<?php } ?>
						<?php if(in_array(78, $level)){ ?>
							<li><a href="/Admin/Job/index" target="navTab" rel="listjob" title="招聘管理">招聘管理</a></li>
						<?php } ?>
						<?php if(in_array(81, $level)){ ?>
							<li><a href="/Admin/JobClass/index" target="navTab" rel="listjobclass" title="招聘类别管理">招聘类别管理</a></li>
							<li><a href="/Admin/JobType/index" target="navTab" rel="listjobtype" title="招聘职位类别管理">招聘职位类别管理</a></li>
						<?php } ?>
						<?php if(in_array(107,$level)){?>

							<li><a href="/Admin/Links/index" target="navTab" rel="listlinks" title="友情链接">友情链接</a></li>
						<?php }?>
						</ul>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
		<!-- 左侧导航栏结束-->
		
		<div id="container">
			<div id="navTab" class="tabsPage">
				<div class="tabsPageHeader">
					<div class="tabsPageHeaderContent"><!-- 显示左右控制时添加 class="tabsPageHeaderMargin" -->
						<ul class="navTab-tab">
							<li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">我的主页</span></span></a></li>
						</ul>
					</div>
					<div class="tabsLeft">left</div><!-- 禁用只需要添加一个样式 class="tabsLeft tabsLeftDisabled" -->
					<div class="tabsRight">right</div><!-- 禁用只需要添加一个样式 class="tabsRight tabsRightDisabled" -->
					<div class="tabsMore">more</div>
				</div>
				<ul class="tabsMoreList">
					<li><a href="javascript:;">主页</a></li>
				</ul>
				<div class="navTab-panel tabsPageContent layoutBox">
					<div class="page unitBox">
						<!-- <div class="accountInfo">
						<h1>北京实创装饰CMS管理后台 </h1>
						</div> -->
<style type="text/css">
	.panel div{height:40px;line-height:40px;}
	.panel a{font-size: 14px;}
</style>
						<div class="pageFormContent" layoutH="80" >
						<div class="panel" defH="80">
							<h1>未处理消息</h1>
							<div>
								<?php if(in_array(172, $level)){ ?>
								<a href="/Admin/Hdbm" target="navTab" rel="listhdbm" title="活动报名管理" <?php if($hdbmCount){echo "style='color:red'";} ?>>活动报名管理（<?php echo ($hdbmCount); ?>）</a> |
								<?php } ?>

								<?php if( in_array(67, $level)){ ?>
								<a  href="/Admin/Hd/index" target="navTab" rel="listhd" title="活动管理" <?php if($hd){echo "style='color:red'";} ?>>活动管理（<?php echo ($hd); ?>）</a> |
								<?php } ?>
								
							</div>
						</div>
							<!-- <h3>PUBLIC:/Public</h3>  
							<h3>APP:</h3>  
							<h3>URL:/Admin/Index</h3>  
							<h3>URL:__UPLOAD__  <?php echo (C("TMPL_L_DELIM")); echo (C("TMPL_R_DELIM")); ?></h3>   -->
					</div>
				</div>
			</div>
		</div>

	</div>

	<div id="footer">Copyright &copy; 2012 <a href="demo_page2.html" target="dialog">开发团队</a><!-- Tel：--></div>
</div>
</body>
	<script>
	function fileback(json){
		if(json.state == 200){
			$.pdialog.closeCurrent();
			$(".unitBox").each(function(){
				if($(this).css('display') == 'block'){
					$(this).find("#uploadimg").attr('src',json.msg);
					$(this).find("#background").val(json.msg);
					alertMsg.info('上传成功');
				}
				
			});
		}else{
			alertMsg.info(json.err);
		}
	}
	</script>
</html>