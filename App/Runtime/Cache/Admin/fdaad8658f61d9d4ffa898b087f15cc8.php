<?php if (!defined('THINK_PATH')) exit();?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Public/css/hd.css" rel="stylesheet" type="text/css" />

<link href="/Public/css/hddisplaynew.css" rel="stylesheet" type="text/css" />

<title>编辑活动页面</title>
<script language=javascript src="/Public/js/jquery.min.js"></script>
<script language=javascript src="/Public/js/jquery_dx.js"></script>
<script type="text/javascript">
	$(window).scroll( function() { 
				scCjBar.style.top = (document.body.scrollTop+window.screen.height-138) +"px";
	 } );
</script>
</head>
<style>*{margin:0px;}
body{overflow-x:hidden;} 
.root{ position:relative;}
.img{z-index:-1; position:absolute;}
*{font-size:12px;}
.close{font-size:12px;}
#chajianbox li .button button{
	font-size:12px;
}
</style>

<body>
<script type="text/javascript">
//拖动和放大缩小插件
var dragresize = new DragResize('dragresize',
		{ minWidth: 20, minHeight: 20, minLeft: 0, minTop: 20, maxLeft: 20000, maxTop: 20000 });

dragresize.isElement = function(elm)
{
if (elm.className && elm.className.indexOf('drsElement') > -1) return true;
};
dragresize.isHandle = function(elm)
{
if (elm.className && elm.className.indexOf('drsMoveHandle') > -1) return true;
};
dragresize.ondragfocus = function() { };
dragresize.ondragstart = function(isResize) { };
dragresize.ondragmove = function(isResize) { };
dragresize.ondragend = function(isResize) { };
dragresize.ondragblur = function() { };
dragresize.apply(document);
</script>

<div class="root" id="root" style="left: 0;width:<?php echo ($list['width']); ?>;height:<?php echo ($list['height']); ?>;">

<?php if(is_array($chajians)): $i = 0; $__LIST__ = $chajians;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="drsElement" style="left: <?php echo ($vo['lefts']); ?>; top: <?php echo ($vo['tops']); ?> ; width: <?php echo ($vo['width']); ?>; height:<?php echo ($vo['height']); ?>;background: green; text-align: center;filter:alpha(opacity=50); -moz-opacity:0.5;-khtml-opacity: 0.5; opacity: 0.5;" var="<?php echo ($vo['chajianID']); ?>"  rhcid="<?php echo ($vo['rhcid']); ?>">
		<div class="close" onclick="$(this).parent().remove();">删除</div>
		<!--<div class="zuobiao" ></div>  -->
		<div class="drsMoveHandle"><?php echo ($vo['name']); echo ($vo['rhcid']); ?></div>
		<?php echo ($vo['htmlnr']); ?>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>
	<script type="text/javascript">
		var	imgWidth = "<?php echo ($list['width']); ?>";
		root.style.left = "-" + ((imgWidth - window.screen.width) / 2) + "px";
		
		//alert();
	</script>
	
	<div class="img" id="img" style="background:url(<?php echo ($list['background']); ?>) no-repeat;background-size: 100% 100%;-moz-background-size:100% 100%;width:<?php echo ($list['width']); ?>;height:<?php echo ($list['height']); ?>;"></div>

</div>
<div class="scCjBar" id="scCjBar">

<div id="chajianxy" style="float:left;">隐藏</div>
<div id="chajianbox" style="height:30px;">

	<li>
		<?php if(is_array($chajian)): $i = 0; $__LIST__ = $chajian;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="button">
				<div class="buttonContent">
					<button class="add"  onclick="addhtml(<?php echo ($vo['id']); ?>);">增加<?php echo ($vo['name']); ?></button>
				</div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
	</li>
	<button id="tijiao" onclick="tijiao()">提交</button>
</div>
</div>
</body>
<script type="text/javascript">
//alert(width);
//alert(swidth);
//alert(w);
//im.class('img');
//im.css('left',w+'px');;
//im.css('min-widht',swidth+'px');
function tijiao(){
	var str = '';
	var n = 0;
	$(".drsElement").each(function(){
		var rhcid = 0;
		if($(this).attr('rhcid')){
			rhcid = $(this).attr('rhcid');
		}
		if(n == 0){
			str += $(this).css('left')+','+$(this).css('top')+','+$(this).css('width')+','+$(this).css('height')+','+$(this).attr('var')+','+rhcid;
			}else{
			str += "-"+$(this).css('left')+','+$(this).css('top')+','+$(this).css('width')+','+$(this).css('height')+','+$(this).attr('var')+','+rhcid;
			}
		n++;
		});
		//alert(str);
    var urls = "/Admin/Hd/displayedit/";
    id="<?php echo ($id); ?>";
	$.post( urls,
		{
			str:str,id:id
		},
		function(txt){
			//var h = '<div id="zh'+num+'" class="bmkh  drsElement" var="'+i+'" ><div class="close" onclick="$(zh'+num+').remove();">关闭</div></div>';
			alert(txt);
			//location.href="<?php echo $_SESSION["rurl"]?>";
			window.close();
			//$("#zh"+num).append(txt);//在父节点里加html
		}
	);
}
function addhtml(i){
	//alert(num);(document.body.offsetHeight - 170) / 2 + document.body.scrollTop;
	var top = document.body.scrollTop;
	//alert(top);
	if(i!=0){
	    var urls = "/Admin/Hd/get_chajian/";
		$.post( urls,
			{
				id:i,top:top
				
			},
			function(txt){
				//var h = '<div id="zh'+num+'" class="bmkh  drsElement" var="'+i+'" ><div class="close" onclick="$(zh'+num+').remove();">关闭</div></div>';
				$("#root").append(txt);//增加父节点
				//$("#zh"+num).append(txt);//在父节点里加html
			}
		);
	}
	//num++;
}

$("#chajianxy").click(function(){
	var val = $("#chajianbox").css("display");

	if(val == 'block'){
		$("#chajianbox").css("display",'none');
		$("#chajianxy").html('显示');
		}else{
			$("#chajianbox").css("display",'block');
			$("#chajianxy").html('隐藏');

		}
	
});


</script>
</html>