<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link href="/Public/m/css/style.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" id="viewportid" content="target-densitydpi=320,width=640,user-scalable=no">
<script>
if (window.innerWidth > 640){
    document.getElementById('viewportid').setAttribute('content', 'target-densitydpi=285,width=640,user-scalable=yes');
}
</script>

<meta name="apple-touch-fullscreen" content="no" />
<meta content="telephone=no" name="format-detection" />
<meta name="apple-mobile-web-app-capable" content="no" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="">
<!--IOS 添加到主屏幕 应用图标-->
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="">
<link rel="apple-touch-icon-precomposed" href="">
<link rel="shortcut icon" href="">
<link href="/Public/m/css/hd.css" rel="stylesheet" type="text/css" />
<?php if($chajiantyle == '1'): ?><link href="/Public/m/css/hddisplay.css" rel="stylesheet" type="text/css" />
<?php else: ?>
<link href="/Public/m/css/hddisplaynew.css" rel="stylesheet" type="text/css" /><?php endif; ?>
<link href="/Public/m/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/Public/m/web/css/style1.css" />
        <link rel="stylesheet" type="text/css" href="/Public/m/web/css/styleZss.css" />
        <link rel="stylesheet" type="text/css" href="/Public/m/web/css/ybj.css" />
        <link rel="stylesheet" type="text/css" href="/Public/m/web/css/hdtop.css" />

<title><?php echo ($list['Title']); ?> — <?php echo ($webset["NAME"]); ?></title>
<meta name="keywords" content="<?php echo ($keywords); ?>" /> 
<meta name="description" content="<?php echo ($list['hdld']); ?>" />
<script type="text/javascript" src="/Public/m/js/zDialog.js"></script>
<script type="text/javascript" src="/Public/public/js/zDialogdzp.js"></script>
<script type="text/javascript" src="/Public/m/js/jquery.min.js"></script>
<script src="/Public/m/web/js/placeholder.min.js"></script>
</head>
<style>*{margin:0px;}
body{overflow-x:hidden;height:{$list['height']+80}px;background:<?php echo ($list['backgroundcolor']); ?>;} 
.root{position: relative; margin-bottom:78px !important;}
.img{z-index:-1; position:absolute;background-size:100% !important;}
.tou{background:#fff;}
.lineKefu{position: absolute!important;}
.hd_con{ width:640px; margin:0 auto; overflow:hidden}



.header, .main, .footer{ width:640px; height:53px; margin: 0 auto; text-align:center;}
h1{ width:; height:61px; font-size:23px; line-height:60px;  font-weight:normal;}
.sizes{font-size:14px;}
.dh_01 {background: #fff;}
.dh_01 a{ display:block; margin: 0 auto; width:175px; text-align:left; height:44px; background:url(../../../../Public/Home/images/index_01.jpg) no-repeat; line-height:44px; padding-left:385px; font-size:20px; color:#ea5408; box-sizing: content-box;}
</style>
<body>
 <script type="text/javascript">
		// 首页导航显示隐藏
		$(function(){
				$(".mNav-icon").bind("click", function(){
						$(".mNav").addClass('mNav-ani-fromTop');
				})
				$(".mNav-close img").bind("click", function(){
						$(".mNav").removeClass('mNav-ani-fromTop');
				})
		})
	</script>
        


        <div class="wapM" style="padding-bottom:0px;height:;">
            <header  style="height:74px;    padding: 22px 3.125%;">
       <h1 class="fl">
                    <a href="#">
                        <img src="<?php echo ($webset["headerlogo"]); ?>" width="170" height="20" alt="<?php echo ($webset["NAME"]); ?>" />
                    </a>
                </h1>
                <div class="city-title fl" style="font-size:26px">
                   活动优惠
                </div>
                <div class="mNav-icon fr"><img src="/Public/m/web/images/mNav_00.png" width="38" height="20" /></div>
                <div class="mNav">
                    <div class="mNav-close"><img src="/Public/m/web/images/mNav_10.png" width="30" height="30" /></div>
                    <ul>
                        <li>
                        <a href="<?php echo ($webset["DOMAIN"]); ?>">
                        <img src="/Public/m/indexnew/images/mNav_01.png" /><span class="sizes">首页</span></a></li>
                    <?php if(is_array($webmenu)): $i = 0; $__LIST__ = $webmenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vo["url"]); ?>">
                        <img src="/Public/m/indexnew/images/mNav_01.png" /><span class="sizes"><?php echo ($vo["name"]); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                        <div class="clear"></div>
                    </ul>
                </div>    
                </header>
                </div>
<div class="hd_con">
<script type="text/javascript">
<!--

//-->
var mobile = /^1[3|4|5|8|7][0-9]\d{8}$/;
function tijiaos(i){		
    if(i!=0){
        var form = $("#form"+i);
        var UserName = $('#form'+i+' input[name="UserName"]').val();
        var TelePhone = $('#form'+i+' input[name="TelePhone"]').val();
        //alert(UserName);
        if(UserName == ''){
            alert('请填写姓名!');
        }else if (TelePhone == ''){
            alert('请填写电话!');
        }else if(!mobile.test(TelePhone)){
			alert('请输入有效的手机号码！');
        }else{
            ga('send', 'event', 'huodong', 'tijiao', 'huodong', 350);
            form.submit();
        }
    }
}
function dzp(cjid){

	var diag = new Dialogdzp();
	diag.Width = 835;
	diag.Height = 900;
	diag.Title = "拼手气";
	diag.URL = "http://<?php echo C('scurl')['SEC_DOMAIN']; echo C('scurl')['DOMAIN'];?>/wxdzp/"+"?cjid="+cjid+"&t=2"+"&city="+"<?php echo ($city); ?>";
	diag.show();
	$("#_DialogDiv_1").show();
}

</script>

    <?php if($list['Isleft'] == '1'): ?><div class="baomingFd" id="baomingFd">
     <p class="bm_num"></p>
    <form action="/<?php echo ($city); ?>/Huod/bm/" method="post" name="formleft" id="formleft" onSubmit="return chkadd();">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:12px;">
  <tbody><tr>
      <td colspan="2">
            <input type="hidden" name="source" value="<?php echo ($source); ?>"/>
            <input type="hidden" name="Ism" value="<?php echo ($Ism); ?>">
            <input type="hidden" name="ClassRoomID" value="<?php echo ($id); ?>">
            <input type="hidden" name="ClassRoomName" value="<?php echo ($list['Title']); ?>">
            <input type="hidden" name="qudao" value="<?php echo ($utm_source); ?>">
            <input type="hidden" value="add" name="action">
            <input type="hidden" value="<?php echo ($Promoterid); ?>" name="Promoterid">
            <input type="hidden" value="<?php echo ($PromoterName); ?>" name="PromoterName">
            <input type="hidden" value="<?php echo ($utm_term); ?>" name="utm_term">
            <input name="CityID" type="hidden" id="CityID" value="<?php echo ($list['CityID']); ?>">
            <input name="CityName" type="hidden" id="CityName" value="<?php echo ($list['CityID']); ?>">
            <input name="renshu" type="hidden" id="renshu" value="1">
      </td>
  </tr>
  <tr>
    <td height="38" align="right" width="40px">姓名:&nbsp;</td>
    <td height="38"><input name="UserName" id="UserName" type="text" class="input i1"></td>
   </tr>
   <tr>
    <td height="38" align="right" width="40px">性别:&nbsp;</td>
    <td height="38"><input type="radio" name="Sex" checked="checked" value="先生">&nbsp;男&nbsp;<input type="radio" name="Sex" value="女士">&nbsp;女</td>
  </tr>
  <tr>
    <td height="38" align="right" width="40px">电话:&nbsp;</td>
   <td height="38"><input type="text"  class="input i2" id="TelePhone" name="TelePhone" size="5" maxlength="11" ></td> 
     <!-- <td height="38" align="right">楼盘:&nbsp;</td>
         <td height="38"><input  name="LpName" type="text" class="input"  size="5" /></td> -->
  </tr>
  <tr>
    <!-- <td height="38" align="right">面积:&nbsp;</td>
        <td height="38"><input  name="LpName" type="text" class="input i1"  size="1" /></td> -->
    <td height="40" colspan="2" align="right"><a href="javascript:baoming();"><img src="/Public/m/images/button.jpg" border="0" class="baoming" id="a4"></a></td>
  </tr>
</tbody></table>
    </form>

</div>

<?php if($Promoterid == '99999999999999'): ?><!--微信-->
<link rel="stylesheet" type="text/css" href="/css/wx.css">
<!--弹出层-->
    <div class="tcc" id="tc">
    手机请在下方输入：139********<br/>
    座机请在下方输入：0105156****<br/>
    输入您号码并点击回电，我们的专职客服将提供专业咨询，同时提供 <b>免费量房服务</b>。本次通话完全免费。
    </div>
<!--弹出层结束-->
    <div class="gb" id="Float_Show" ><a title=查看官方微信 
onclick="javascript:$('#wx').animate({width: 'show', opacity: 'show'}, 'normal',function(){ $('#wx').show();});$('#Float_Show').fadeOut()" 
href="javascript:void(0);"><img src="/images/leyu_2_v.png" width="27" height="135" /></a></div>



<div class="wx" id="wx" >

    <div class="gb_but"><a title=关闭官方微信 
onclick="javascript:$('#wx').animate({width: 'hide', opacity: 'hide'}, 'normal',function(){ $('#wx').hide();});$('#Float_Show').fadeIn(800);"
href="javascript:void(0);"><img src="/images/wx_01.jpg" width="141" height="30" /></a></div>

    
    <form action="/Huod/bm/" method="post" name="wxform" >
        <input type="text" name="TelePhone" id="TelePhone" size="5" maxlength="11" class="tel" value="请输入您的电话号码"   onfocus="if(document.getElementById('tc').style.display='none'){document.getElementById('tc').style.display='block'};if(value=='请输入您的电话号码'){value=''}" onBlur="if(document.getElementById('tc').style.display='block'){document.getElementById('tc').style.display='none'};if(value==''){value='请输入您的电话号码'}" />
            
            <input type="hidden" name="ClassRoomID" value="<?php echo ($id); ?>">
            <input type="hidden" name="ClassRoomName" value="<?php echo ($list['Title']); ?>">
            <input type="hidden" name="qudao" value="<?php echo ($utm_source); ?>">
            <input type="hidden" value="add" name="action">
            <input type="hidden" value="<?php echo ($Promoterid); ?>" name="Promoterid">
            <input type="hidden" value="<?php echo ($PromoterName); ?>" name="PromoterName">
            <input type="hidden" value="<?php echo ($utm_term); ?>" name="utm_term">
            <input name="CityID" type="hidden" id="CityID" value="<?php echo ($list['CityID']); ?>">
            <input name="CityName" type="hidden" id="CityName" value="<?php echo ($list['CityID']); ?>">
            <input name="renshu" type="hidden" id="renshu" value="1">
            <input type="hidden" name="UserName" value="微信报名" />
            <input type="hidden" name="Sex" value="先生" />
            <input class="baoming" id="aa" type="image" src="/images/but.jpg" name="btn" onClick="if(document.wxform.elements['TelePhone'].value=='请输入您的电话号码' || document.wxform.elements['TelePhone'].value==''){alert('请输入您的电话号码');return false;}" />
    </form>
</div>
<!--微信结束--><?php endif; endif; ?>        
                <div class="clear"></div>
<div class="root" id="root" style="left: 0;width:<?php echo ($list['width']); ?>;height:<?php echo ($list['height']+80); ?>; margin: 0 auto">



    <?php if(is_array($chajians)): $i = 0; $__LIST__ = $chajians;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['chajianID'] == 11): ?><div style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
                
	<style>
	/*css document*/
@charset "utf-8";

html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video, input { margin: 0; padding: 0; border: 0; vertical-align: baseline; }
article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section { display: block; }
body{ font-family: "Microsoft YaHei", Arial, Helvetica, sans-serif; font-size:12px; color:#666666; line-height:1; }
ol, ul { list-style: none; }
blockquote, q { quotes: none; }
blockquote:before, blockquote:after, q:before, q:after { content: ''; content: none; }
table { border-collapse: collapse; border-spacing: 0; }
input, textarea { outline: 0; resize: none; }
a { text-decoration:none; color:#666666; }
a:hover { text-decoration:none; color:#ea5404; }
abbr[title] { border-bottom:1px dotted; }
article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary { display: block; }
a img { border: none; }
.clear { clear:both; }
input, select { -webkit-appearance: none; -moz-appearance: none; -ms-appearance: none; -o-appearance: none; appearance: none; font-family: "Microsoft YaHei", Arial, Helvetica, sans-serif; }
.fl { float:left; } .fr { float:right; }
.border-radius { border-radius:3px; }
/*.hide { display: none !important; }*/
/************************************************************ M站三种报名框 style ************************************************************/
	* { box-sizing:border-box; } .none { display:none; }
	.mContain { width:100%; min-width:320px; max-width:640px; margin:0 auto; }
	
	
	.hBaoming, .sBaoming { padding:20px; }
	/* hBaoming */
	.hInput1 { width:418px; height:80px; border:1px solid #cccccc; line-height:80px; background-color:#ffffff; padding:0 10px; font-size:24px; margin-bottom:10px; }
	.hInput2 { width:418px; height:80px; border:1px solid #cccccc; line-height:80px; background-color:#ffffff; padding:0 10px; font-size:24px; }
	.hButton, .hButton img { width:162px; height:170px; }
	
	/* sBaoming */
	.sInput3 { width:600px; height:80px; border:1px solid #cccccc; line-height:80px; background-color:#ffffff; padding:0 10px; font-size:24px; margin-bottom:20px; }
	.sButton, .sButton img { display:block; width:600px; height:80px; }
	
	
	
	


	</style>

		<div class="mContain">
			<div class="hBaoming">
				<form action="/Huod/bm/" method="post" name="form<?php echo ($i); ?>" id="form<?php echo ($i); ?>">
					<input type="hidden" name="ClassRoomID" value="<?php echo ($id); ?>">
					<input type="hidden" name="ClassRoomName" value="<?php echo ($list['Title']); ?>">
					<input type="hidden" name="qudao" value="<?php echo ($utm_source); ?>">
					<input type="hidden" value="add" name="action">
					<input type="hidden" value="<?php echo ($Promoterid); ?>" name="Promoterid">
					<input type="hidden" value="<?php echo ($PromoterName); ?>" name="PromoterName">
					<input type="hidden" value="<?php echo ($utm_term); ?>" name="utm_term">
					<input name="CityID" type="hidden" id="CityID" value="<?php echo ($list['CityID']); ?>">
					<input name="CityName" type="hidden" id="CityName" value="<?php echo ($list['CityID']); ?>">
					<input name="renshu" type="hidden" id="renshu" value="1">

					<a href="javascript:tijiaos(<?php echo ($i); ?>);" class="hButton fr">
					<?php if(empty($vo['image'])): ?><img src="http://www.sc.cc/Public/images/Home/h_button.png" /></a>
					<?php else: ?>
						<img src="http://www.sc.cc/<?php echo ($vo['image']); ?>" /></a><?php endif; ?>
					<input name="UserName" type="text" placeholder="请输入您的姓名" class="hInput1 fl" >
					<input name="TelePhone" type="text" placeholder="请输入您的电话" maxlength="11" class="hInput2 fl" >
				</form>
				<div class="clear"></div>
			</div>
		</div>

                </div><?php endif; ?>

            <?php if($vo['chajianID'] == 12): ?><div style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
                
<style>
/*css document*/
@charset "utf-8";

html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video, input { margin: 0; padding: 0; border: 0; vertical-align: baseline; }
article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section { display: block; }
body{ font-family: "Microsoft YaHei", Arial, Helvetica, sans-serif; font-size:12px; color:#666666; line-height:1; }
ol, ul { list-style: none; }
blockquote, q { quotes: none; }
blockquote:before, blockquote:after, q:before, q:after { content: ''; content: none; }
table { border-collapse: collapse; border-spacing: 0; }
input, textarea { outline: 0; resize: none; }
a { text-decoration:none; color:#666666; }
a:hover { text-decoration:none; color:#ea5404; }
abbr[title] { border-bottom:1px dotted; }
article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary { display: block; }
a img { border: none; }
.clear { clear:both; }
input, select { -webkit-appearance: none; -moz-appearance: none; -ms-appearance: none; -o-appearance: none; appearance: none; font-family: "Microsoft YaHei", Arial, Helvetica, sans-serif; }
.fl { float:left; } .fr { float:right; }
.border-radius { border-radius:3px; }
/*.hide { display: none !important; }*/
/************************************************************ M站三种报名框 style ************************************************************/
  * { box-sizing:border-box; } .none { display:none; }
  .mContain { width:100%; min-width:320px; max-width:640px; margin:0 auto; }
  
  
  .hBaoming, .sBaoming { padding:20px; }
  /* hBaoming */
  .hInput1 { width:418px; height:80px; border:1px solid #cccccc; line-height:80px; background-color:#ffffff; padding:0 10px; font-size:24px; margin-bottom:10px; }
  .hInput2 { width:418px; height:80px; border:1px solid #cccccc; line-height:80px; background-color:#ffffff; padding:0 10px; font-size:24px; }
  .hButton, .hButton img { width:162px; height:170px; }
  
  /* sBaoming */
  .sInput3 { width:600px; height:80px; border:1px solid #cccccc; line-height:80px; background-color:#ffffff; padding:0 10px; font-size:24px; margin-bottom:20px; }
  .sButton, .sButton img { display:block; width:600px; height:80px; }
  
  
  
  
  
</style>
<div class="mContain">
      <div class="sBaoming">
        <form action="/Huod/bm/" method="post" name="form<?php echo ($i); ?>" id="form<?php echo ($i); ?>">
          <input type="hidden" name="ClassRoomID" value="<?php echo ($id); ?>">
          <input type="hidden" name="ClassRoomName" value="<?php echo ($list['Title']); ?>">
          <input type="hidden" name="qudao" value="<?php echo ($utm_source); ?>">
          <input type="hidden" value="add" name="action">
          <input type="hidden" value="<?php echo ($Promoterid); ?>" name="Promoterid">
          <input type="hidden" value="<?php echo ($PromoterName); ?>" name="PromoterName">
          <input type="hidden" value="<?php echo ($utm_term); ?>" name="utm_term">
          <input name="CityID" type="hidden" id="CityID" value="<?php echo ($list['CityID']); ?>">
          <input name="CityName" type="hidden" id="CityName" value="<?php echo ($list['CityID']); ?>">
          <input name="renshu" type="hidden" id="renshu" value="1">
          
          <input name="UserName" type="text" placeholder="请输入您的姓名" class="sInput3 " >
          <input name="TelePhone" type="text" placeholder="请输入您的电话" class="sInput3 " >
          <a href="javascript:tijiaos(<?php echo ($i); ?>);" class="sButton ">
            <?php if(empty($vo['image'])): ?><img src="http://www.sc.cc/Public/images/Home/s_button.png" />
            <?php else: ?>
            <img src="http://www.sc.cc/<?php echo ($vo['image']); ?>" /><?php endif; ?>
          </a>
         </form>
         <div class="clear"></div>
      </div>
    </div>


                </div><?php endif; ?>
            <?php if($vo['chajianID'] == 13): ?><a style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;"
                <?php if($vo["url"] == ''): ?>href="javascript:baom()"
                <?php else: ?> 
                    <?php if($Promoterid == '0'): ?>href="<?php echo ($vo["url"]); ?>" target="_blank"
                    <?php else: ?>
                        href="#"<?php endif; endif; ?>>
                
                <script>


function baom()
{
	var diag = new Dialog();
	diag.Width = 580;
	diag.Height = 300;
	diag.Title = "我要报名";
	diag.URL = "/Huod/link/id/<?php echo ($id); ?>?utm_source=<?php echo ($utm_source); ?>&utm_term=<?php echo ($utm_term); ?>&Promoterid=<?php echo ($Promoterid); ?>";
	diag.show();
	$("#_DialogDiv_0").show();
}

</script>
                </a><?php endif; ?>
            <?php if($vo['chajianID'] == 14): ?><div style="position:absolute;text-align: center;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
                <p class="phone_3" style='color: <?php echo ($vo['color']); ?>;font-size: <?php if(empty($vo["font_size"])): ?>26<?php else: echo ($vo["font_size"]); endif; ?>px;width: 204px;height: 29px;font-weight: bold;font-family: "微软雅黑";'><?php echo ($PromoterTel); ?></p>

                </div><?php endif; ?>
            <?php if($vo['chajianID'] == 15): ?><a style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;"  href="javascript:open()">      
                
<script>

function open()
{
	var diag = new Dialog();
	diag.Width = 580;
	diag.Height = 360;
	diag.Title = "发送活动地址到您的手机";
	diag.URL = "/Huod/sendView/id/<?php echo ($id); ?>?utm_source=<?php echo ($utm_source); ?>&utm_term=<?php echo ($utm_term); ?>&Promoterid=<?php echo ($Promoterid); ?>";
	diag.show();
	$("#_DialogDiv_0").show();
}


</script>
                </a><?php endif; ?>
            <?php if($vo['chajianID'] == 16): ?><a style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;"  href="#<?php echo ($vo['url']); ?>">      
                
<script>

function open()
{
	var diag = new Dialog();
	diag.Width = 580;
	diag.Height = 360;
	diag.Title = "发送活动地址到您的手机";
	diag.URL = "/Huod/sendView/id/<?php echo ($id); ?>?utm_source=<?php echo ($utm_source); ?>&utm_term=<?php echo ($utm_term); ?>&Promoterid=<?php echo ($Promoterid); ?>";
	diag.show();
	$("#_DialogDiv_0").show();
}


</script>
                </a><?php endif; ?>
            <?php if($vo['chajianID'] == 17): ?><a style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;"  name="<?php echo ($vo['cid']); ?>" id="<?php echo ($vo['cid']); ?>">     
                
<script>

function open()
{
	var diag = new Dialog();
	diag.Width = 580;
	diag.Height = 360;
	diag.Title = "发送活动地址到您的手机";
	diag.URL = "/Huod/sendView/id/<?php echo ($id); ?>?utm_source=<?php echo ($utm_source); ?>&utm_term=<?php echo ($utm_term); ?>&Promoterid=<?php echo ($Promoterid); ?>";
	diag.show();
	$("#_DialogDiv_0").show();
}


</script>
                </a><?php endif; ?>
            <?php if($vo['chajianID'] == 18): ?><div style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
                <div class="gdh">

<div class="bmrh" >
<span style="font-weight:bold;font-size:22px;display:block;float:left;width:60px;color:<?php echo ($vo['color']); ?>">已有</span>
<p class="bm_numh" style="margin-top:-3px;margin-right:5px;font-size: 24px;float:left;display:block;color:<?php echo ($vo['color']); ?>"></p>
<span style="font-weight:bold;font-size:22px;display:block;float:left;width:90px;color:<?php echo ($vo['color']); ?>">户报名</span>
</div>
<div class="gdk">
<iframe src="/Huod/gd/id/<?php echo ($id); ?>/h/97" width="185" height="97" frameborder="0" scrolling="no" style="color:#FFFFFF;"></iframe>

</div>
</div>

<!-- 
<div class="bmrz">
<span style="font-weight:bold;font-size:18px;display:block;float:left;width:40px;">已有</span>
<p class="bm_numz" style="margin-top:-3px;margin-right:5px;font-size: 24px;float:left;display:block;"></p>
<span style="font-weight:bold;font-size:18px;display:block;float:left;width:70px;">户报名</span></div>
<div class="gdz">
<iframe src="/<?php echo ($city); ?>/Huod/gd/id/<?php echo ($id); ?>/h/97" width="170" height="97" frameborder="0" scrolling="no" style="color:#FFFFFF;"></iframe>
</div>
 -->
                </div><?php endif; ?>
            <?php if($vo['chajianID'] == 19): ?><div style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
                <iframe src="/Huod/hdp/id/<?php echo ($vo['cid']); ?>/width/<?php echo ($vo['width']); ?>/height/<?php echo ($vo['height']); ?>" width="<?php echo ($vo['width']); ?>" height="<?php echo ($vo['height']); ?>" frameborder="0" scrolling="no"></iframe>
                </div><?php endif; ?>
            <?php if($vo['chajianID'] == 20): ?><div style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
                <iframe src="<?php echo ($vo["url"]); ?>" width="<?php echo ($vo['width']); ?>" height="<?php echo ($vo['height']); ?>" frameborder="0" scrolling="no"></iframe>
                </div><?php endif; ?>
            <?php if($vo['chajianID'] == 22): ?><a style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;"  class="" href="javascript:dzp('<?php echo ($cjid); ?>');">  
                </a><?php endif; ?>
            <?php if($vo['chajianID'] == 23): ?><div style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
                <style>
@charset "utf-8";
* {
	margin: 0px;
	padding: 0px;
	font-family:Microsoft YaHei;
	font-size: 28px;
	color: #666;
}
a{
	text-decoration: none;
	font-weight: normal;
}
input { -webkit-appearance: none; -moz-appearance: none; -ms-appearance: none; -o-appearance: none; appearance: none; }
/*h1,h2,h3{
	font-weight: normal;
}*/
/*Fix Float BUG 万能闭合*/
.clearfix:after {
 content: ".";
 display: block;
 height: 0;
 clear: both;
 visibility: hidden;
 line-height: 0px;
}
.fl {
float: left;
}
.fr {
float: right;
}
.clear{
	clear: both;
}
/*公用头部分*/
body{
	background: #eeeeee;
	font-family: "Microsoft YaHei", Arial, Helvetica, sans-serif;
	font-size: 28px;
	color: #666666;
	line-height: 1;
}
.wapM{
	width: 100%;
	min-width: 320px;
	max-width: 640px;
	margin: 0 auto;
	padding-bottom: 50px; 
}
header {
	background-color: #ffffff;
	padding: 15px 3.125%;
}
header h1 { 
	font-size:1px;
	height: 13px;
	line-height: 12px;
}
.city-name { 
	width:55px; 
	height:13px; 
	border:1px solid #ea5404; 
	border-radius:2px; 
	background:url(http://m.sc.cc/Public/2016/images/dowbArrow.png) no-repeat 50px 4px; 
	background-size:11px; 
	padding-right:12px; 
	line-height:12px; 
	text-align:center; 
}
.city-name a { 
	color:#ea5404;
	font-size: 12px;
}	
/* mBanner */
.mBanner{
	width: 100%;
}
.mBanner img { 
	width:100%; 
	height:auto; 
}
.relative {
	position: relative;
	left: 0;
	top: 0;
}
/*public scroll*/
.scroll{margin:0px auto;max-width:640px;}
.scroll_box{overflow:hidden;visibility:hidden;position:relative;}
.scroll_wrap{overflow:hidden; position:relative;}
.scroll_wrap li{position:relative;display:block;width:100%;float:left;}
.scroll_wrap li a{display:block;margin:0 auto;position:relative;}
.scroll_position{position:absolute;left:45%;z-index:400px;bottom:5px;}
.scroll_position li{display:inline-block;width:10px;height:10px;border-radius:10px;background:#fff;}
.scroll_position li a{font-size:0;}
.scroll_position li.on{background-color:#ffd800;}
.scroll_position_bg{position:absolute;bottom:12px;left:42%;padding:0 15px;z-index:380px;height:26px;border-radius:26px;}
/*主体部分*/
.mMain{
	width: 100%;
	padding-top: 5px;
}
.mainNav{
	background-color: #ffffff;
	padding: 13px 3.125%;
}
.mainNav ul{
	padding: 0px;
}
.mainNav ul li{
	width: 25%;
	height: auto;
	text-align: center;
	float: left;
	list-style: none;
}
.mainNav ul li a{
	display: block;
}
.mainNav ul li a img{
	width: 50px;
	height: 50px;
	margin: 0 auto 2.5px;
}
.mainNav ul li a h3{
	height: 20px;
	line-height: 20px;
	font-weight: normal;
}
.mainNav ul li a:hover h3{
	color: #fa4c06;
}
/*快速报价部分*/
.ksbj{
	padding: 13px 3.125%;
	padding-bottom: 8px;
	position: relative;
}
.ksbj select{
	width: 48%;
	height: 62px;
	line-height: 62px;
	/*margin-right: 1.705%;*/
	color: #666;
	margin-bottom: 5px;
}
.ksbj input{
	width: 47.95%;
	text-indent: 3px;
	height: 62px;
	line-height: 62px;
	margin:0px;
	padding: 0px;
	color: #666;
	margin-bottom: 5px;
	border:1px solid #bbb;	
	background: #fff;
	/* background:#fff url(http://m.sc.cc/Public/2016/images/pmBg.png) no-repeat right center; */
	background-size: 15px 16px;
	border-radius: 3px;
}
input#ksbjBtn{
	width: 99.5%;
	height: 62px;
	line-height: 62px;
	background: #fa4c07;
	border-radius: 5px;
	border:none!important;
	color: #fff;
	margin-top:5px;
	cursor: pointer;
	font-size:28px;
}
/*理想装部分*/
.lxzBar{
	width: 100%;
	height: 133px;
	background:url(../images/88Bg.png) no-repeat center top;
}
.lxzBar h1{
	width: 100%;
	text-align: center;
	color: #e94f06;
	font-size: 34px;
	padding-top: 25px;
	font-family: Microsoft YaHei;
}
.lxzBar span{
	width: 100%;
	height:20px;
	line-height: 20px;
	text-align: center;
	display: block;
	color:#010000;
	font-size: 12px;
	padding-top: 5px;
}
/*家装清单*/
.jzqd{
	width: 100%;
	height: auto;
	/*position: relative;*/
	margin:0px;
	padding: 0px;
}
.jzqd img{
	vertical-align: middle;
	width: 100%;
}
.jzqd p{
	position: absolute;
	color: #ffff00;
	font-size: 28px;
	height: 18px;
	line-height: 18px;
}
.jzqdKj,.jzqdZc{
	width: 100%;
	position: relative;
}
.jzqdKj img,.jzqdZc img{
	border-bottom: 1px solid #fff;
}
.jzqdKj p.jzqd01{
	width: 46.875%;
	top:33.15%;
	left: 2.46375%;
}
.jzqd span{
	width: 20px;
	height: 20px;
	line-height: 20px;
	border-radius: 20px;
	background: #ff0000;
	color: #ffff00;
	display: inline-block;
	text-align: center;
}
.jzqdZc  p.jzqd02{
	width: 70%;
	height:auto;
	top:33.928%;
	left: 2.46375%;
	line-height: 14px;
}
.jzqdZc  p.jzqd02 span{
	width: 18px;
	height: 18px;
	line-height: 18px;
	border-radius: 18px;
}
p.jzqd03{
	width: 56.25%;
	top:33.928%;
	left: 2.46375%;
	line-height: 16px;
}
.mFtBanner{
	width: 100%;
	height: auto;
	margin-top:5px;
}
.mFtBanner img{
	width: 100%;
}
.zxqg{
	padding: 13px 3.125%;
}
a.zxzxBtn{
	width: 48%;
	height: 28px;
	line-height:28px;
	background: #fff;
	border:1px solid #fa4c06;
	border-radius: 5px;
	display: block;
	float: left;
	text-align: center;
	color: #fa4c06;
	font-size: 28px;
}
a.ljqgBtn{
	width: 48%;
	height: 28px;
	line-height:28px;
	background: #fa4c06;
	border:1px solid #fa4c06;
	border-radius: 5px;
	display: block;
	float: right;
	text-align: center;
	color: #fff;
	font-size: 14px;
}
.lxzBar h2{
	width: 100%;
	height: 110px;
	line-height: 110px;
	text-align: center;
	color: #fa4c06;
	font-weight: normal;
	font-size: 20px;
}
/*装修案例主体部分*/
.mZxalM{
	padding:10px 0.9375%;
	background: #fff;
	margin-bottom: 5px;
}
.zxalLeft{
	width: 35.03%;
	float: left;
	height: auto;
}
.zxalRight{
	width: 63.70%;
	height: auto;
	float: right;
	position: relative;
}
.zxalLTop{
	width: 100%;
	height: auto;
	position: relative;
}
.zxalLTop img{
	width: 100%;
}
.zxalLTopM{
	padding:13px 2.941px;
	background: #13b5b1;
	border:2px solid #fff;
}
.zxalLTop h1{
	font-size: 18px;
	color:#ffffff;
	height: 24px;
	line-height: 24px;
	position: absolute;
	top:26.77125%;
	left: 11.236%;
}
.zxalLTop p{
	font-size: 12px;
	color:#ffffff;
	height: 20px;
	line-height: 20px;
	position: absolute;
	top:60.63%;
	left: 11.236%;
}
.zxalLBt{
	width: 100%;
	height: auto;
	margin-top:2%;
	position: relative;
}
.zxalLBt img{
	width: 100%;

}
.zxalLBt .zxalInfo{
	position: absolute;
	width: 100%;
	height: 25px;
	line-height: 25px;
	bottom: 2px;
	left: 0px;
	width: 100%;
	text-align: center;
	font-size: 12px;
	color: #ffffff;
	background: rgba( 0, 0, 0, 0.4 );
	overflow: hidden;
}
.zxalRight img{
	width: 100%;
}
.zxalRight .zxalInfo{
	position: absolute;
	width: 100%;
	height: 25px;
	line-height: 25px;
	bottom: 2px;
	left: 0px;
	width: 100%;
	text-align: center;
	font-size: 12px;
	color: #ffffff;
	background: rgba( 0, 0, 0, 0.4 );
	overflow: hidden;
}
/*设计师部分*/
.mSjsm{
	padding:0px 1.5625%;
}
.msjs{
	width: 49.1935%;
	height: auto;
	margin-top:5px;
}
.msjs img{
	width: 100%;
	height: auto;
}
.msjsInfo{
	width: 100%;
	height: auto;
	background: #fff;
	padding:13px 0px;
	text-align: center;
	margin-top:1px;
}
.msjsInfo h2{
	color: #000000;
	font-size: 28px;
	font-family: Microsoft YaHei;
	height: 20px;
	line-height: 20px;
}
.msjsInfo p{
	width: 100%;
	height: 18px;
	line-height: 18px;
	color: #000000;
	font-size: 28px;

}
a.moreSjs,a.moreGl{
	width: 93.75%;
	height: 30px;
	line-height: 30px;
	text-align: center;
	color: #666666;
	font-size: 28px;
	background: #fff;
	display: block;
	margin: 13px auto;
	border-radius: 5px;
	border:1px solid #c9c9c9;
}
a.moreZal{

}
.mzxgl{
	padding:9px 3.125%;
}
.mzxglM{
	width: 100%;
	background: #fff;
	padding-bottom: 4px;
	margin-bottom: 5px;
}
.mzxgl img{
	width: 100%;

}
.mzxgl ul{
	width: 100%;
	padding: 0px;
	margin: 0px;
}
.mzxgl ul li{
	height: 30px;
	line-height: 30px;
	border-bottom: 1px solid #eee;
	list-style: none;
	text-indent: 5px;
	color: #333333;
	font-size: 12px;
}
.mzxgl ul li a{
	width: 100%;
	display: block;
	height: 30px;
	line-height: 30px;
	overflow:hidden;
	text-overflow:ellipsis;
	white-space: nowrap;
	color: #333333;
	font-size: 12px;
	font-family: Microsoft YaHei;
}
.mzxgl ul li a:hover{
	color: #fa4c06;
}
.mzxgl ul li:last-child{
	border-bottom: none;
}
a.moreGl{
	width: 100%;
}
.wapM .footer{
	width: 100%;
	height: 49px;
	position: fixed;
	bottom: 0px;
	left: 0px;
	padding: 0px;
	border-top:1px solid #a7a7a7;
}
.wapM .footer ul{
	background: #fff;
}
.wapM .footer ul li{
	width: 20%;
	padding-top:10px;
	padding-bottom: 10px;
	float: left;
	position: relative;
	text-align: center;
	list-style: none;
}
.wapM .footer ul li a{
	display: block;
}
.wapM .footer ul li img{
	width: 16px;
	height: 16px;
	margin: 0 auto;/*
	margin-bottom: 5px;*/
}
.wapM .footer ul li span{
	width: 100%;
	height: 13px;
	line-height: 20px;
	display: block;
	text-align: center;
}
/*报价弹出框*/
.bjTck{
	position: absolute;
	top:0%;
	left: 3.125%;
	width: 93.75%;
	height: auto;
	z-index:999;
	border:1px solid #999;
	border-radius: 10px;
	background: #ffffff;
	display: none;
}
.bjTckTop{
	width: 100%;
	height: 34px;
	line-height: 34px;
	background: #eeeeee;
	border-top-left-radius: 10px;
	border-top-right-radius: 10px;
	text-indent: 10px;
}
.bjTckTop h1{
	width: 50%;
	height: 34px;
	line-height: 34px;
	float: left;
	display: block;
	font-family: Microsoft YaHei;
	color: #666666;
	font-size: 14px;
	font-weight: normal;
}
.closeBtn{
	width: 22px;
	height: 22px;
	margin-top:6px;
	float: right;
	margin-right: 10px;
	background: url(http://m.sc.cc/Public/2016/images/closeBtn.png) no-repeat left center;
	background-size: 100%; 
	cursor:pointer;
}
.bjTckMain{
	width: 93.72%;
	height: auto;
	margin: 0 auto;
}
.bjTckMain p{
	width: 100%;
	height: auto;
	line-height: 20px;
	padding:10px 0px;
	font-size: 12px;
}
.mYgbj{
	width: 100%;
	height: 100%;
	line-height: 29px;
}
.mYgbj span{
	float: left;
	height: 29px;
	line-height: 29px;
	width: 45%;
	display: block;
	font-weight: bold;
	color: #333333;
	font-size: 12px;
}
a.mYgbjTel{
	display: block;
	width: 43.74%;
	height: 29px;
	line-height: 29px;
	text-align: center;
	float: right;
	background: #fa4c06 url(http://m.sc.cc/Public/2016/images/tel.png) no-repeat 24.2% center;
	background-size: 8%;
	border-radius: 5px;
	color: #fff;
	font-size: 12px;margin-top: 26px;
	font-family: Microsoft YaHei;
}
.mYgbjZc{
	width: 100%;
	height: 29px;
	line-height: 29px;
	background:#fa4c06;
	margin-top:10px;
	margin-bottom: 20px;
	text-align: center;
	border-radius: 5px;
	color: #fff;
	font-size: 12px;
	font-family: Microsoft YaHei;
	cursor: pointer;
}
.bj-button{ background:#ffffff !important; color:#fa4c06 !important; height:38px; line-height:38px; border:#fa4c06 1px solid !important; }
.no-bac{ background:#ffffff !important}

.bj-button-false{ background:#ddd !important; color:#999 !important; height:38px; line-height:38px; border:#ccc 1px solid !important; }
</style>
	<div class="wapM">
		<div class="mMain">
			<div class="ksbj">
				<form id="mbj_chajian" action="<?php echo U('/Index/jisuan/city/'.$city);?>" method="post">
					<input type="hidden" name="utm_source" value="<?php echo ($utm_source); ?>">
					<input type="hidden" name="utm_term" value="<?php echo ($utm_term); ?>">
					<input type="hidden" name="Promoterid" value="<?php echo ($Promoterid); ?>">
					<input type="hidden" name="PromoterName" value="<?php echo ($PromoterName); ?>">
					
					<input type="text" name="NAME"  placeholder="姓名" />
					<input type="text" name="PHONE" maxlength="11" placeholder="电话" />
					<select name="old">
						<option value="1" >新房装修</option>
						<option value="2" >老房装修</option>
					</select>
					<input type="text" name="area"  placeholder="建筑面积" />
	         <input type="text" name="checkCode"   size="4" maxlength="4" class="mInputName" placeholder="验证码" />
                    <input type="button" name="yanCode" onclick="sendcode(this)" value="获得验证码" class="bj-button">			
                  <!--   <input type="text" name="NAME" value="" class="mInputName no-bac" placeholder="验证码" />
                    <input type="button" name="" value="获得验证码" class="bj-button">-->
                    <input type="button" id="ksbjBtn"
					<?php if($vo['image'] ==''): ?>value="快速报价"
						    <?php else: ?> 
								style="background:url(http://www.sc.cc/<?php echo ($vo['image']); ?>);    background-repeat: no-repeat;
    background-size: 100%;"<?php endif; ?>
							 /> 
				</form>
				<div class="bjTck">
					<div class="bjTckTop clearfix">
						<h1>装修报价</h1>
						<div class="closeBtn"></div>
					</div>
					<div class="bjTckMain">
						<p>本次报价仅供参考，实际价格需以设计师的最终报价为准。</p>
						<div class="mYgbj clearfix">
							<span id="jisuanjiage" style="height:100%"></span>
							<a href="tel:<?php if($Promoter["PromoterTel"] != ''): echo ($Promoter["PromoterTel"]); else: echo ($cityinfo["TELEPHONE"]); endif; ?>" class="mYgbjTel">电话咨询</a>
						</div>
						<div class="mYgbjZc">收起</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

function sendcode(obj){
	var self = $(obj).parent('form#mbj_chajian');
	
	if(!$.trim($('input[name="NAME"]').val())){
		alert('请输入您的称呼');
		return false;
	}
	if(!$.trim($('input[name="PHONE"]').val())){
		alert('请输入手机号码');
		return false;
	}

	if ( self.find('input[name="area"]').val().match(/^\d{1,4}\.{0,1}\d{0,2}$/) == null || self.find('input[name="area"]').val() == '' ) { 
		alert('请输入合法面积');
		 return false;
	};

	var phone =$.trim($('input[name="PHONE"]').val());
	var length =$.trim($('input[name="PHONE"]').val()).length;
	var mobile = /^1[3|4|5|8|7][0-9]\d{8}$/;
	
	 if(!(length == 11 && mobile.test(phone))){
	 	alert("请正确填写您的手机号码");
	 	return false;
	 }
	
	var codeNum=0;
	var timmer;
	var flages = 1;
	if(!flages){
		return ;
	}else{
		//safeAccunt();//账户安全--获取手机验证码
		$.ajax({
			type: "post",
			url: "<?php echo U('Index/mcode');?>",
			data: {phone:phone},	
			dataType: "json",
			success: function(data){
			          if(data==1){
			          		$('input[name="yanCode"]').attr('onclick',' ');
			          		timmer=setInterval(codeTime,1000);
			          		$('input[name="yanCode"]').prop('class','bj-button-false');
			          }else{	
			          		return false;
			          }
			}
		})
			
	}
		  

	function codeTime(){
		codeNum++;
		$('input[name="yanCode"]').val('('+(30-codeNum)+') 秒后系统重新发送！');
		if(codeNum>30){
			$('input[name="yanCode"]').prop('class','bj-button');
			$('input[name="yanCode"]').attr('onclick','sendcode(this)');
			codeNum=0;
			clearInterval(timmer);
			$('input[name="yanCode"]').val("再次获取短信校验码");
			   //alert('哈哈！验证码收到没？没收到继续获取哦！！！')
		};
	};//codeTime end
}












	$(function(){
		//$(".ksbj select:even").css({"margin-right":"2.55%"});
		$(".closeBtn,.mYgbjZc").click(function(){
			$(".bjTck").hide();
		});

		$("#ksbjBtn").click(function(){
		var self = $('form#mbj_chajian');

		// alert( self.find('input[name="area"]').val().match(/^\d{11}$/) );
		if ( self.find('input[name="area"]').val().match(/^\d{1,4}\.{0,1}\d{0,2}$/) == null || self.find('input[name="area"]').val() == '' ) { 
			alert('请输入合法面积');
			 return false;
		};
		if ( self.find('input[name="NAME"]').val() == '' ) { 
			alert('请输入姓名');
			 return false;
			};
		if ( self.find('input[name="PHONE"]').val().match(/^1[3|4|5|8|7][0-9]\d{8}$/) == null || self.find('input[name="PHONE"]').val() == '' ) { 
			alert('请输入合法电话');
			 return false;
			};


		//判断验证码是否正确
		if(!$.trim($('input[name="checkCode"]').val())){
				alert('请输入验证码');
				return false;
		}else{
				var mobile = /^\d{4}$/;
				var length = $.trim($('input[name="checkCode"]').val()).length;
				var yzm =$.trim($('input[name="checkCode"]').val());
				if(!(length == 4 && mobile.test(yzm))){
				 	alert("请正确填写验证码");
				 	return false;
				}
				
			$.ajax({
				url: "<?php echo U('Index/check_yzm');?>",
				type: 'post',
				async: false,
				dataType: 'json',
				data: {yzm: yzm},
				success:function(msg){
						if(msg.status==0){
							alert('验证码错误！');
							res_status=0;	
						}else{
							res_status =1;
						}
					}
				})
				
			}

		if(res_status){
			var self = $('form#mbj_chajian');
			$.post(self.attr('action'), self.serialize(),function(data){
				ga('send', 'event', 'huodong', 'tijiao', 'huodong', 350);
				if (data.status) {
					$('#jisuanjiage').html('预估价格：' + data.info + '元');
					$(".bjTck").show();
				} else {
					$('#jisuanjiage').html(data.info);
					$(".bjTck").show();
				}
				
			}, 'json');
			return false;	
		}
		
			//$('#mbj_chajian').submit();
			
		});
	});
		
	</script>
                </div><?php endif; ?>
        <?php if($vo['chajianID'] == 26): ?><a style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;"  href="javascript:getlunbo('<?php echo ($vo["caseid"]); ?>');">      
                <script type="text/javascript" src="/Public/web/js/lb_zDialog.js"></script>
<script type="text/javascript" src="/Public/web/js/lb_zDrag.js"></script>
<script type="text/javascript">
    var DWidth = document.documentElement.clientWidth;
    var DHeight = document.documentElement.clientHeight;
    $(function(){
        //alert(DHeight);
    });
    function getlunbo(id)
    {
        var diag = new LDialog();
        diag.Width = DWidth;
        diag.Height = DHeight;
        diag.Title = "";
        diag.URL = "/Huod/lunbotu/id/"+ id;
        diag.show();
    }
</script>
                </a><?php endif; ?>
				<?php if($vo['chajianID'] == 29): ?><div style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
					
    <style>
        .Imgss img:hover{
            cursor: pointer;
            z-index:999;
        }
        .Imgss {
            z-index:999;
        }
        .Imgss a{
            display:block;
        }
    </style>
<div class="Imgss"><a <?php if($vo["url"] == null): ?>href="javascript:baommouse()"
					<?php else: ?> 
						<?php if($Promoterid == '0'): ?>href="http://www.sc.cc/<?php echo ($vo["url"]); ?>" target="_blank"
						<?php else: ?>
							href="#"<?php endif; endif; ?>><img src="http://www.sc.cc/<?php echo ($vo['backgroundimg']); ?>" /></a></div>

    <script type="text/javascript">
    $(function(){
        $(".Imgss img").mouseover(function(){
            $(this).attr("src","http://www.sc.cc/<?php echo ($vo['image']); ?>");
        });
    });
     $(".Imgss img").mouseout(function(){
        $(this).stop().attr("src","http://www.sc.cc/<?php echo ($vo['backgroundimg']); ?>");
    });
     function baommouse()
     {
     	var diag = new Dialog();
     	diag.Width = 580;
     	diag.Height = 300;
     	diag.Title = "我要报名";
     	diag.URL = "/Huod/link/id/<?php echo ($id); ?>?utm_source=<?php echo ($utm_source); ?>&utm_term=<?php echo ($utm_term); ?>&Promoterid=<?php echo ($Promoterid); ?>";
     	diag.show();
     	$("#_DialogDiv_0").show();
     }


</script>
					</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
	<?php if(empty($list['qiegenum'])){ ?>
   
        <div class="img" id="img" style="background:url(<?php echo ($list['background']); ?>);width:<?php echo ($list['width']); ?>px;height:<?php echo ($list['height']); ?>px; top:0px;"></div>
    
    
     <?php }else{ ?>
	    <div class="img" id="img" style="width:<?php echo ($list['width']); ?>;height:<?php echo ($list['height']+80); ?>;">
	    <?php for($i=0;$i<$list['qiegenum'];$i++){ ?>
	    
	    <img class="tpimg" src="/Public/Uploads/hd/t<?php echo $list['ID'].$i ;?>.jpg" style="width:<?php echo ($list['width']); ?>;height:<?php echo ($list['height']/20); ?>;" />
	    <?php } ?>
	    </div>
    <?php } ?>
    
    <script type="text/javascript">
        $(window).scroll( function() { 
                    //baomingFd.style.top = (document.body.scrollTop+240) +"px";
                    lineKefu.style.top = (document.body.scrollTop+250) +"px";
         } );
        var w = $("body").css("width");
        str=w.replace('px',""); 
        var imgWidth = "<?php echo ($list['width']); ?>";
        if(imgWidth > str){
            root.style.left = "-" + ((imgWidth - str) / 2) + "px";
            //baomingFd.style.left = ((imgWidth - str) / 2) + "px";
            //alert(lef)
            $(".tpimg").css("margin-left","-" + ((imgWidth - str) / 2) + "px");
        }else{
            root.style.left =  ((str - imgWidth) / 2) + "px";
            //alert(lef)
            $(".tpimg").css("margin-left",((str - imgWidth) / 2) + "px");
            //baomingFd.style.left =  "-" + ((str - imgWidth) / 2) + "px";
        }
        var lef = (str - 1200)/2;
    
        $(".hdTop").css("left",lef);
        
        //alert(document.body.scrollTop);
        var url = "/Huod/ajaxgetbmnumber/city/<?php echo ($city); ?>";
        var id = "<?php echo ($id); ?>";
        $.post(url,
            {id:id},
            function(txt){
                    //alert(txt);
                    $(".bm_numz").html('');
                    $(".bm_numz").html(txt);
                    $(".bm_numh").html('');
                    $(".bm_numh").html(txt);
                    $(".bm_num").html(txt);
                }
            
            );
        var mobile = /^1[3|4|5|8|7][0-9]\d{8}$/;
        function baoming(){     		
            var tp =  $("#TelePhone").val();
            var un =  $("#UserName").val();
            if(tp==''){
                alert('请输入您的电话号码');return ;
            }else if(!mobile.test(tp)){
    			alert('请输入有效的手机号码！');
            }else if(un == ''){
                alert('请输入您的姓名');return ;
            }else{
                ga('send', 'event', 'huodong', 'tijiao', 'huodong', 350);
                this.document.formleft.submit();
            }
            
        }
    </script>

    
 <div style="width: 446px;
height: 80px;
position: absolute;
left: 13%;
bottom: 0px;
text-align: center;
font-size: 18px;
line-height: 30px;">Copyright @ <?php echo ($webset["NAME"]); ?>
    移动：<?php echo ($webset["DOMAIN"]); ?> <?php echo ($webset["beian"]); ?></div>
    
    </div>

	
    </div>
</body>
</html>