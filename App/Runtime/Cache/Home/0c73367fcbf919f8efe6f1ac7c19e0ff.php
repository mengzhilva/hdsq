<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8" />
<title>hzcms安装</title>
<link rel="stylesheet" href="/Public/install/simpleboot/themes/flat/theme.min.css" />
<link rel="stylesheet" href="/Public/install/css/install.css" />
<link rel="stylesheet" href="/Public/font-awesome/css/font-awesome.min.css" type="text/css">


	<script src="__STATIC__/js/jquery.js"></script>
</head>
<body>
	<div class="wrap">
		<div class="header">
	<h1 class="logo">HDSQ 安装向导</h1>
	<div class="version">1.0</div>
</div>
		<section class="section">
			<div style="padding: 40px 20px;">
				<div class="text-center">
					<a style="font-size: 18px;">恭喜您，安装完成！</a>
					<br>
					<br>
					<div class="alert alert-danger" style="width: 350px;display: inline-block;">
						为了您站点的安全，安装完成后即可将网站app目录下的“install”文件夹删除!
						另请对data/conf/database.php文件做好备份，以防丢失！
					</div>
					<br>
					<a class="btn btn-success" href="/admin">进入后台</a>
				</div>
			</div>
		</section>
	</div>

	<div class="footer">
	&copy; 2017-<?php echo date('Y');?> <a href="http://www.bjhanzhuo.com" target="_blank">hzcms Team</a>
</div>
	<script>
		$(function() {
			return;
			$.ajax({
				type : "POST",
				url : "http://www.hzcms.com/service/installinfo.php",
				data : {
					host : "<?php echo ((isset($host) && ($host !== ""))?($host):''); ?>",
					ip : "<?php echo ((isset($ip) && ($ip !== ""))?($ip):''); ?>"
				},
				dataType : 'json',
				success : function() {
				}
			});
		});
	</script>
</body>
</html>