<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>实创装饰</title>
    <link type="text/css" rel="stylesheet" href="/Public/css/hbm.css">
	<script type="text/javascript" src="/Public/js/jquery.min.js"></script>
    <script type="text/javascript">
    $(function(){
        $(".bmSure").click(function(){
        	if('<?php echo ($is1); ?>' == '1'){
        		window.parent.Dialog.getInstance('1').close();
        	}else{
        		window.parent.Dialog.getInstance('0').close();
        	}
        });
    });
    </script>
</head>
<style>
    body{
        background: #fff;
        h2.bmOk{
            text-align: center;
            color: #ff0000;
            font-size: 24px;
            font-family: Microsoft YaHei;
            margin-top:35px;
        } 
        a.bmSure{
            width: 200px;
            height: 36px;
            line-height: 36px;
            background: #ff0000;
            color: #fff;
            font-size: 18px;
            font-family: Microsoft YaHei;
            font-weight: bold;
            display: block;
            margin:0 auto;
            text-align: center;
            margin-top:40px;
        }
    }
</style>
<body>
    <h2 class="bmOk"><?php echo ($msg); ?></h2>
    <a class="bmSure" style="font-size:18px;">确认</a>
</body>
</html>