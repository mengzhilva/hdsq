<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "">

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" /> 

<script type="text/javascript" src="/Public/js/jquery.min.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
body {
	 font-family: 宋体;
	font-size: 12px;
	margin:0px;
	background-color:#ffffff;
	color:#666666;
}
li{ list-style:none; line-height:24px; }
.demo1 li{ display:block; margin:0px; list-style:none;font-size:12px;   }
.demo1 li a:link,.demo1 li a:visited {text-decoration:none; font-size:12px; }
.demo1 li a:hover,.demo1 li a:active {text-decoration:none; font-size:12px; }
</style>



<div id=demo style="overflow:hidden;height:<?php echo ($height); ?>px;width:160px;font-size: 12px;">
<div id="demo1"></div>
<div id=demo2></div>
</div>
   <script>
   $(function(){
   getdata();
function getdata(){
	var url = "<?php echo C('scurl')['HD_INDEX'];?>ajaxgetnew/";
	var id = "<?php echo ($id); ?>";
	$.post(url,
		{id:id},
		function(txt){
				//alert(txt);
				$("#demo1").html('');
				$("#demo1").html(txt);
				$("#demo2").html('');
				$("#demo2").html(txt);
			}
		
		);
}

var speed=50;
var colee2=document.getElementById("demo2");
var colee1=document.getElementById("demo1");
var colee=document.getElementById("demo");
colee2.innerHTML=colee1.innerHTML; //克隆colee1为colee2
function Marquee1(){
//当滚动至colee1与colee2交界时
if(colee2.offsetTop-colee.scrollTop<=0){
 colee.scrollTop-=colee1.offsetHeight; //colee跳到最顶端
 }else{
 colee.scrollTop++
}
}
var MyMar1=setInterval(Marquee1,speed)//设置定时器
//鼠标移上时清除定时器达到滚动停止的目的
colee.onmouseover=function() {clearInterval(MyMar1)}
//鼠标移开时重设定时器
colee.onmouseout=function(){MyMar1=setInterval(Marquee1,speed)}

   });
   

   </script>