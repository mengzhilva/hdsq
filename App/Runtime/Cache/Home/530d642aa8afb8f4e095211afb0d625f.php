<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>
        <link href="/Public/css/style.css" rel="stylesheet" type="text/css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?php if($chajiantyle == '1'): ?><link href="/Public/css/hddisplay.css" rel="stylesheet" type="text/css" />
        <?php else: ?>
        <link href="/Public/css/hddisplaynew.css" rel="stylesheet" type="text/css" /><?php endif; ?>
    <link href="/Public/css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/hd_nav.css" />
    <link href="/Public/css/hd.css" rel="stylesheet" type="text/css" />

    <title><?php echo ($list['Title']); ?> — <?php echo ($webset["NAME"]); ?></title>

    <script type="text/javascript" src="/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/web/js/zDrag.js"></script>
    <script type="text/javascript" src="/Public/js/zDialog.js"></script>
    <script type="text/javascript" src="/Public/js/zDialogdzp.js"></script>
    <script type="text/javascript" src="/Public/newhd/js/placeholder.min.js"></script>
    <script src="/Public/web/js/jquery.validate.js"></script>
    <script src="/Public/web/js/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="/Public/web/css/jquery-ui.min.css" media="screen"/>
    <script>

        $.validator.setDefaults({
            submitHandler: function () {

            },
            showErrors: function (map, list) {
                // there's probably a way to simplify this
                var focussed = document.activeElement;
                if (focussed && $(focussed).is("input, textarea")) {
                    $(this.currentForm).tooltip("close", {
                        currentTarget: focussed
                    }, true)
                }
                this.currentElements.removeAttr("title").removeClass("ui-state-highlight");
                $.each(list, function (index, error) {
                    $(error.element).attr("title", error.message).addClass("ui-state-highlight");
                });
                if (focussed && $(focussed).is("input, textarea")) {
                    $(this.currentForm).tooltip("open", {
                        target: focussed
                    });
                }
            }
        });
        // 手机号码验证
        jQuery.validator.addMethod("isMobile", function (value, element) {
            var length = value.length;
            var mobile = /^1[3|4|5|8|7][0-9]\d{8}$/;
            return this.optional(element) || (length == 11 && mobile.test(value));
        }, "请正确填写您的手机号码");

    </script>
</head>

<style>*{margin:0px;}
    body{overflow-x:hidden;height:{$list['height']}px;background:<?php echo ($list['backgroundcolor']); ?>;} 
    .root{position: absolute;}
    .img{z-index:-1; position:absolute;}
    .tou{background:#fff;}
    .lineKefu{position: absolute!important;}
    /*	#newHdcj .nextpage{_position: absolute;_bottom:0px; left:0px;}
            #newHdcj .xf_b{ margin-left:auto !important; margin-right:auto !important}*/

    #newHdcj .baom_rightF {_position: absolute !important;_bottom:0px !important; _right:0px !important  ;}



</style>
<body>

    <?php if(($id) != "4126"): ?><div class="hdTop"><div class="spNav" style="height: 53px">
                <a href="<?php echo C('scurl')['INDEX_INDEX'];?>" target="_blank"><div class="spLogo">
                <img src="<?php echo ($webset["headerlogo"]); ?>"></div></a>
                <ul>
                    <li><a href="<?php echo ($webset["DOMAIN"]); ?>" target="_blank" class="cur">首 页</a></li>
                    <?php if(is_array($webmenu)): $i = 0; $__LIST__ = $webmenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["url"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="spRight"><?php echo ($PromoterTel); ?></div>
            </div></div>
    </div><?php endif; ?>

    <script type="text/javascript">
        function dzp(cjid) {

            var diag = new Dialogdzp();
            diag.Width = 850;
            diag.Height = 440;
            diag.Title = "我要报名";
            diag.URL = "<?php echo C('scurl')['WXDZP_INDEX'];?>" + "?cjid=" + cjid + "&t=1";
            diag.show();
            $("#_DialogDiv_1").show();
        }
        function tijiaos(i) {
            if (i != 0) {

                if (i == 9999990) {
                } else {
                }
                var form = $("#form" + i);
                form.submit();
            }
        }
    </script>

    <div class="root" id="root" style="left: 0;width:<?php echo ($list['width']); ?>px;height:<?php echo ($list['height']); ?>px;">



        <?php if(is_array($chajians)): $i = 0; $__LIST__ = $chajians;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo['chajianID'] == 1): ?><div style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
                    <style>
<!--

-->

.baomingh table tr td{
font-size:14px;color:<?php echo ($vo['color']); ?>;font-family:Microsoft YaHei;
}
.bmrh{
color:<?php echo ($vo['color']); ?>;width:200px;
}
.bmrh span{
color:<?php echo ($vo['color']); ?>;
}
.bm_numh{
	color: <?php echo ($vo['color']); ?>;
	font-family: Arial,Helvetica,sans-serif;
	
	text-align: center;
	}
  .LpNamem{
    background:#fff url(/Public/images/Home/mjBg.png) no-repeat 95% center;    
    width: 150px;
    height: 30px;
    line-height: 30px;
    padding: 0px 0px 0px 4px;
    border: 1px solid #dcdcdc;
  }
</style>

<div class="baomingh">
<form action="<?php echo C('scurl')['HD_INDEX'];?>bm/" method="post" class="formhengzong" name="form<?php echo ($i); ?>" id="form<?php echo ($i); ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:12px;">
  <tbody><tr>
      <td colspan="2">
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
    <td height="38" align="right" width="10%" style="color:<?php echo ($vo['color']); ?>">姓名:&nbsp;</td>
    <td height="38"><input name="UserName" type="text" class="input i1"></td>
    <td height="38" align="right" style="color:<?php echo ($vo['color']); ?>">面积:&nbsp;</td>
    <td height="38"><input name="LpNamem" class="LpNamem" type="text" class="input i1" size="1"></td>
  </tr>
  <tr>
    <td height="38" align="right" style="color:<?php echo ($vo['color']); ?>">电话:&nbsp;</td>
    <td height="38"><input type="text" class="input i2" name="TelePhone" size="5" maxlength="11"></td>
    <td height="38" align="right" width="10%" >&nbsp;&nbsp;</td>
    <td height="40" ><a href="javascript:tijiaos(<?php echo ($i); ?>);">
    <?php if($vo['image'] ==''): ?><img src="/Public/images/Home/button_04.jpg" border="0" class="baoming" id="a4">
    <?php else: ?> 
    <img src="<?php echo ($vo['image']); ?>" border="0" class="baoming" id="a4"><?php endif; ?>
  </tr>
  <tr>
    
   </tr>
</tbody></table>
    </form>
    
<script>

(function() {
  // use custom tooltip; disable animations for now to work around lack of refresh method on tooltip
  $("#form<?php echo ($i); ?>").tooltip({
    show: false,
    hide: false
  });

//横、纵报名框报名

  $("#form<?php echo ($i); ?>").validate({
    submitHandler: function(form){  

        var formParam = $(form).serialize();//序列化表格内容为字符串  

        $.ajax({    
            type:'post',        
            url:"<?php echo C('scurl')['HD_INDEX'];?>bm/",    
            data:formParam,    
            cache:false,    
            dataType:'json',    
            success:function(data){ 
            	if(data.state == 1){
            		bmok();
            		$(".input").val('');
            	}else{
            		bmsb(data.msg);
            	}
            	//alert(data.info);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //alert('提交失败');
            },
            complete:function(){
            }  
        });  
        //alert("formParam");    
    },     
    rules: {
        UserName: "required",
        TelePhone: { 
            required:true, 
            isMobile:true 
        },

    },
    messages: {
        UserName: "请输入您的姓名",
        TelePhone: {
            required: "请输入您的联系电话",
            isMobile: "您输入的电话号码有误！"
        },
    }
  });


})();

</script>    
    
    
</div>

                </div><?php endif; ?>
            <?php if($vo['chajianID'] == 2): if(empty($vo['color'])): $vo['color'] = '#0f0f0f'; endif; ?>
                <div style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
                    <style>
<!--

-->

.baomingz table tr td{
font-size:14px;color:<?php echo ($vo['color']); ?>;font-family:Microsoft YaHei;
}
.bmrz{
color:<?php echo ($vo['color']); ?>;width:200px;padding-left:65px;
}
.bmrh span{
color:<?php echo ($vo['color']); ?>;
}
.bm_numz{
	color: <?php echo ($vo['color']); ?>;
	font-family: Arial,Helvetica,sans-serif;
	
	text-align: center;
	}
   .LpNamem{
    background:#fff url(/Public/images/Home/mjBg.png) no-repeat 95% center;    
    width: 150px;
    height: 30px;
    line-height: 30px;
    padding: 0px 0px 0px 4px;
    border: 1px solid #dcdcdc;
  }
</style>
<script type="text/javascript">
<!--

//-->
function chkadd(){

}
</script>
<div class="baomingz">
<form action="<?php echo C('scurl')['HD_INDEX'];?>bm/" method="post" class="formhengzong" name="form<?php echo ($i); ?>" id="form<?php echo ($i); ?>" onsubmit="return chkadd();">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:12px;">
  <tbody><tr>
      <td colspan="2">
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
    <td width="" height="40" align="right" style="color:<?php echo ($vo['color']); ?>">姓名:&nbsp;</td>
    <td width="" height="40"><input name="UserName" type="text" class="input"></td>
  </tr>
  <tr>
    <td height="40" align="right" style="color:<?php echo ($vo['color']); ?>">电话:&nbsp;</td>
    <td height="40"><input type="text" class="input" name="TelePhone" size="5" maxlength="11"></td>
  </tr>
  <tr>
    <td height="40" align="right" style="color:<?php echo ($vo['color']); ?>">面积:&nbsp;</td>
    <td height="40"><input name="LpNamem" class="LpNamem" type="text" class="input" size="1"></td>
  </tr>
  <tr>
    <td height="40" colspan="2" align="center">
    <a href="javascript:tijiaos(<?php echo ($i); ?>);">
    <?php if($vo['image'] ==''): ?><img src="/Public/images/Home/button_03.jpg" border="0" class="baoming" id="a4">
    <?php else: ?> 
		<img src="<?php echo ($vo['image']); ?>" border="0" class="baoming" id="a4"><?php endif; ?>
    </a></td>
 </tr>
</tbody></table>
</form>
<script>

(function() {
  // use custom tooltip; disable animations for now to work around lack of refresh method on tooltip
  $("#form<?php echo ($i); ?>").tooltip({
    show: false,
    hide: false
  });

//横、纵报名框报名

  $("#form<?php echo ($i); ?>").validate({
    submitHandler: function(form){  

        var formParam = $(form).serialize();//序列化表格内容为字符串  

        $.ajax({    
            type:'post',        
            url:"<?php echo C('scurl')['HD_INDEX'];?>bm/",    
            data:formParam,    
            cache:false,    
            dataType:'json',    
            success:function(data){ 
            	if(data.state == 1){
            		bmok();

            		$(".input").val('');
            	}else{
            		bmsb(data.msg);
            	}
            	//alert(data.info);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                //alert('提交失败');
            },
            complete:function(){
            }  
        });  
        //alert("formParam");    
    },     
    rules: {
        UserName: "required",
        TelePhone: { 
            required:true, 
            isMobile:true 
        },

    },
    messages: {
        UserName: "请输入您的姓名",
        TelePhone: {
            required: "请输入您的联系电话",
            isMobile: "您输入的电话号码有误！"
        },
    }
  });


})();

</script>    
    
</div>

                </div><?php endif; ?>
            <?php if($vo['chajianID'] == 3): ?><a style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;"
                   <?php if($vo["url"] == null): ?>href="javascript:baom()"
                        <?php else: ?> 
                        <?php if($Promoterid == '0'): ?>href="<?php echo ($vo["url"]); ?>" target="_blank"
                            <?php else: ?>
                            href="#"<?php endif; endif; ?>>

                    <script>


function baom()
{
	var diag = new Dialog();
	diag.Width = 420;
	diag.Height =280;
	diag.Title = "我要报名";
	diag.URL = "<?php echo C('scurl')['HD_INDEX'];?>link/id/<?php echo ($id); ?>?utm_source=<?php echo ($utm_source); ?>&utm_term=<?php echo ($utm_term); ?>&Promoterid=<?php echo ($Promoterid); ?>";
	diag.show();
	$("#_DialogDiv_0").show();
}

</script>
                </a><?php endif; ?>
            <?php if($vo['chajianID'] == 4): ?><div style="position:absolute;text-align: center;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
                    <p class="phone_3" style='color: <?php echo ($vo['color']); ?>;font-size: <?php if(empty($vo["font_size"])): ?>23<?php else: echo ($vo["font_size"]); endif; ?>px;width: 204px;height: 29px;font-weight: bold;font-family: "微软雅黑";'><?php echo ($PromoterTel); ?></p>

                </div><?php endif; ?>
            <?php if($vo['chajianID'] == 5): ?><a style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;"  href="javascript:openphone()">		
                    
<script>

function openphone()
{
	var diag = new Dialog();
	diag.Width = 400;
	diag.Height = 230;
	diag.Title = "获取活动地址";
	diag.URL = "<?php echo C('scurl')['HD_INDEX'];?>sendView/id/<?php echo ($id); ?>?utm_source=<?php echo ($utm_source); ?>&utm_term=<?php echo ($utm_term); ?>&Promoterid=<?php echo ($Promoterid); ?>";
	diag.show();
	$("#_DialogDiv_0").show();
}


</script>
                </a><?php endif; ?>
            <?php if($vo['chajianID'] == 6): ?><a style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;"  href="#<?php echo ($vo['url']); ?>">		
                    
<script>

function openphone()
{
	var diag = new Dialog();
	diag.Width = 400;
	diag.Height = 230;
	diag.Title = "获取活动地址";
	diag.URL = "<?php echo C('scurl')['HD_INDEX'];?>sendView/id/<?php echo ($id); ?>?utm_source=<?php echo ($utm_source); ?>&utm_term=<?php echo ($utm_term); ?>&Promoterid=<?php echo ($Promoterid); ?>";
	diag.show();
	$("#_DialogDiv_0").show();
}


</script>
                </a><?php endif; ?>
            <?php if($vo['chajianID'] == 7): ?><a style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;"  name="<?php echo ($vo['cid']); ?>" id="<?php echo ($vo['cid']); ?>">		
                    
<script>

function openphone()
{
	var diag = new Dialog();
	diag.Width = 400;
	diag.Height = 230;
	diag.Title = "获取活动地址";
	diag.URL = "<?php echo C('scurl')['HD_INDEX'];?>sendView/id/<?php echo ($id); ?>?utm_source=<?php echo ($utm_source); ?>&utm_term=<?php echo ($utm_term); ?>&Promoterid=<?php echo ($Promoterid); ?>";
	diag.show();
	$("#_DialogDiv_0").show();
}


</script>
                </a><?php endif; ?>
            <?php if($vo['chajianID'] == 8): ?><div style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
                    <div class="gdh">

<div class="bmrh" >
<span style="font-weight:normal;font-size:14px;display:block;float:left;color:<?php echo ($vo['color']); ?>">已有</span>
<p class="bm_numh" style="margin-top:-3px;padding-left:10px;padding-right:10px;font-size: 24px;float:left;display:block;color:<?php echo ($vo['color']); ?>"></p>
<span style="font-weight:normal;font-size:14px;display:block;float:left;color:<?php echo ($vo['color']); ?>">户报名</span>
</div>
<div class="gdk">
<iframe src="<?php echo C('scurl')['HD_INDEX'];?>gd/id/<?php echo ($id); ?>/h/97" width="155" height="68" frameborder="0" scrolling="no" style="color:#FFFFFF;"></iframe>

</div>
</div>

<!-- 
<div class="bmrz">
<span style="font-weight:bold;font-size:18px;display:block;float:left;width:40px;">已有</span>
<p class="bm_numz" style="margin-top:-3px;margin-right:5px;font-size: 24px;float:left;display:block;"></p>
<span style="font-weight:bold;font-size:18px;display:block;float:left;width:70px;">户报名</span></div>
<div class="gdz">
<iframe src="<?php echo C('scurl')['HD_INDEX'];?>gd/id/<?php echo ($id); ?>/h/97" width="170" height="97" frameborder="0" scrolling="no" style="color:#FFFFFF;"></iframe>
</div>
 -->
                </div><?php endif; ?>
            <?php if($vo['chajianID'] == 9): ?><div  style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
                    <iframe  src="<?php echo C('scurl')['HD_INDEX'];?>hdp/id/<?php echo ($vo['cid']); ?>/width/<?php echo ($vo['width']); ?>/height/<?php echo ($vo['height']); ?>" width="<?php echo ($vo['width']); ?>" height="<?php echo ($vo['height']); ?>" frameborder="0" scrolling="no"></iframe>
                </div><?php endif; ?>
            <?php if($vo['chajianID'] == 10): ?><div id="<?php echo (substr(strrchr($vo['url'],'/'),1)); ?>" class="<?php echo ($Promoterid); ?>" style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
                    <iframe  src="<?php echo ($vo["url"]); ?>" width="<?php echo ($vo['width']); ?>" height="<?php echo ($vo['height']); ?>" frameborder="0" scrolling="no"></iframe>
                </div><?php endif; ?>
           
            <?php if($vo['chajianID'] == 21111): ?><a style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;" class="cd-popup-trigger">	
                </a>	
                
<script src="/Public/web/cj/js/jquery.1.11.1.js"></script>
<script src="/Public/web/cj/js/main.js"></script> 
<link type="text/css" rel="stylesheet" href="/Public/web/cj/css/style1.css">
<link type="text/css" rel="stylesheet" href="/Public/web/cj/css/iframe.css">

<style>
.scCjName{
color:<?php echo ($vo['color']); ?>
}
.scCjInfo{
color:<?php echo ($vo['color']); ?>
}
#jpword{
color:<?php echo ($vo['color']); ?>
}
<?php if($vo['image'] !=''): ?>.scCj{
background:url(http://www.sc.cc/<?php echo ($vo['backgroundimg']); ?>) no-repeat center top;
}<?php endif; ?> 
</style>

	<div class="cd-popup" role="alert">
	<div class="cd-popup-container">
		<div class="scCj">
			<div class="scCjMain">
				<div class="scCjImg">
					<img id="jpimg" src=""  style="height: 120px;margin-top: 5px;" />
				</div>
				<h2 id="jpword"> </h2>
			</div>
		<form action="<?php echo C('scurl')['CJ_BM'];?>id/<?php echo ($cjid); ?>/" method="post" id="form1">
			<div class="scCjBm clearfix">
				<input type="hidden"  id="jid" name="jid" value="" />
				<input type="hidden"  name="qudao" value="<?php echo ($utm_term); ?>" />
				<input type="hidden"  name="Promoterid" value="<?php echo ($Promoterid); ?>" />
				<input type="hidden"  name="utm_term" value="<?php echo ($qudao); ?>" />
				<div class="scCjName">姓名<input type="text"  name="UserName" id="name" /></div>
				<div class="scCjName scCjTel">电话<input name="TelePhone" id="phone"  maxlength="11" type="text" /></div>
			</div>
			</form>
			<a href="javascript:bm();">
			<div class="scCjLjBtn">
			    <?php if($vo['image'] ==''): ?><img src="/Public/web/cj/images/ljBtn.png">
			    <?php else: ?> 
						<img src="<?php echo ($vo['image']); ?>" style="width:126px;height:34px"><?php endif; ?>
			</div></a>
			<div class="scCjInfo">详情请咨询<?php echo ($PromoterTel); ?></div>
		</div>
		<a href="#" class="cd-popup-close img-replace">关闭</a>
	</div> <!-- cd-popup-container -->
</div>
<script type="text/javascript">

function bm(){
	var name = $("#name").val();
	var phone = $("#phone").val();
	if(name == ''){
		alert('请填写姓名！');
		return 
	}
	if(phone == ''){
		alert('请填写电话！');
		return 
	}
    if(phone.length!=11)
    {
		alert('请输入有效的手机号码');
        return 
    }    
	var  re = /^1\d{10}$/;
	if(!re.test(phone)){
		alert('请输入有效的手机号码');
        return 
	}
	if(name != '' && phone != ''){
		$('#form1').submit();
	}
}
function cj(){

	var urls = "<?php echo C('scurl')['CJ_INDEX'];?>cjajax/id/<?php echo ($cjid); ?>/";
	var flag = false;
	var tim = "<?php echo ($time); ?>";
	$.ajax({
        type: "post",
        url: urls,
        async:false,
        data: 
		{
		},
        dataType: "json",
        success: function(data){
        	if(tim == -1){
	    		alert('活动尚未开始，敬请期待！');
	    	}else if(tim == 1){
	    		alert('活动已结结束了，请关注下次活动吧！');
	    	}else if(data.state == 1){
        		$('#jpword').html(data.title);
        		$('#jpimg').attr('src',data.background);
        		$('#jid').val(data.id);
    			//event.preventDefault();
    			$('.cd-popup').addClass('is-visible');
                        return false; 

	    	}else if(data.state == -1){
	    		alert('很遗憾，手太慢了，奖品已发完！')
	    	}
        }
	});
}
</script>
<!--弹出报名框--><?php endif; ?>
            <?php if($vo['chajianID'] == 24): ?><a style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;"
                   href="javascript:dzp('<?php echo ($cjid); ?>')" >
                    <img src="<?php echo ($vo["backgroundimg"]); ?>" border="0" class="baoming" id="a4" />
                </a><?php endif; ?>
            <?php if($vo['chajianID'] == 25): ?><div  style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
                    <style>
.left{ float:left}
.right{ float:right !important}
.index-bm {
width: 200px;
margin-right: -590px;
background: url(/Public/images/Home/ksbjBg.png) center 20px no-repeat;
padding: 81px 20px 30px;
z-index: 2;
}
table {
border-collapse: collapse;
border-spacing: 0;
}
td.radioNew .newHouse{
	width:90px!important;
	height: 30px;
	line-height: 30px;
	color: #999999;
	font-size: 12px;
	font-family:"微软雅黑";
	display: inline-block;
	cursor: pointer;
	background: #fff;
}
td.radioNew{
	/*width:93px!important;*/
	width:90px;
	*width:90px;
	height: 30px;
	/*background: #fff;*/
	float: left;
	margin-bottom: 10px;
	/*border:1px solid #dbdbdb;*/
	line-height: 30px;
	color: #999999;
	font-size: 12px;
	font-family: "微软雅黑";
/*	display: inline-block;*/
	text-indent: 10px;
	cursor: pointer;
	margin-bottom:10px;
}
/* td.active {
border: 1px solid #fa4c06;
color: #fa4c06;
width:90px!important;
background: url(http://www.sc.cc/public/web/2016/images/checked.png) no-repeat 70% center;
} */
td.active span.newHouse{
color: #fa4c06;
border: 1px solid #fa4c06;
color: #fa4c06;
width:90px!important;
background:#fff url(http://www.sc.cc/public/web/2016/images/checked.png) no-repeat 70% center;	
}
.index-input-03{ width:208px; padding-left:10px; height:30px; border:#dbdbdb solid 1px; line-height:30px;color: #000000;box-sizing:border-box;}
#area{background:#fff  url(/Public/images/Home/mjBg.png) no-repeat 95% center;}
.index-button-02{ width:208px; height:32px; background:#fa4c06; color:#ffffff; text-align:center; line-height:32px; cursor:pointer; font-size:18px;border:none;}
.index-button-02:hover{  background:#cc0000; }
.index-advertising{ padding:20px 0px; background:#ebebeb;}
.advertising-con{ border-bottom:#cccccc 2px solid; padding-bottom:5px;}
.advertising-con h3{ font-size:48px; color:#fa4c06; font-weight:600; width:260px; height:50px; overflow:hidden}
.advertising-con span{ width:920px ; height:51px;}
.index-box1{ background:url(http://www.sc.cc/public/web/2016/images/index-box-bg1.jpg) center top no-repeat; height:auto; padding-top:10px;padding-bottom:20px;}
.box{ width:350px; height:265px; margin:17px 20px 30px 0px; padding:115px 15px 0px; display:inline}
.box-1{ background:url(http://www.sc.cc/public/web/2016/images/index-box-1.jpg) center top no-repeat;}
.box p{ line-height:26px; width:350px;}
.box b{ width:27px; height:27px; background:#ff0000; color:#ffffff; display:block; text-align:center; border-radius:50%}
.box p span{ color:#ffff00}
.box-2{ background:url(http://www.sc.cc/public/web/2016/images/index-box-2.jpg) center top no-repeat;}
.box-3{ background:url(http://www.sc.cc/public/web/2016/images/index-box-3.jpg) center top no-repeat; margin-right:0px !important; }
.banner-silder{ position:absolute; left:0px; top:0px; width:100%; height:400px;}
.banner{ height:400px;}
.index-input-dx,.index-input-btn{ width:90px; height:30px; line-height:30px; display:block; text-align:center}
.index-input-btn{ background:#fa4c06 !important; color:#ffffff; cursor:pointer; border:none}
.bj-tr{ width:200px; float:left; display:inline}
#radioOld{ float:right !important}
.bj-td{ float:left; width:90px !important;}

.index-input-btn-false{ width:90px; height:30px; line-height:30px; display:block; text-align:center;background:#ccc !important; color:#999; cursor:pointer}
</style>
<div class="index-bm" id="index_bm"> 
			<form class="rightform1" method="post" novalidate="novalidate">
				<table border="0" cellspadding="0" cellspacing="0" style="table-layout:fixed">
						<tbody><tr>
							<td height="45" colspan="2" width="100%"><input type="text" class="index-input-03" placeholder="请输入您的姓名" id="name" name="name"></td>
						</tr>
						
						<tr>
							<td height="45" colspan="2"><input type="text" class="index-input-03" placeholder="请输入您的房屋面积" id="area" name="area"></td>
						</tr>
						<tr>
							<td  height="42" class="radioNew active" ><span class=" newHouse left" id="old1" name="0">新房</span></td>
							<td  height="42" class="radioNew"  id="radioOld"><span class=" newHouse right" id="old2" name="0">老房</span></td>
						</tr>
                        <tr>
							<td height="45" colspan="2" width="100%"><input type="text" maxlength="11" class="index-input-03" placeholder="请输入您的手机" id="phone" name="phone"></td>
						</tr>
                         <tr>
                          <td height="40" class="bj-td"><input type="text"  name="checkCode" size="4" maxlength="4"  class="index-input-dx left" placeholder="请输入验证码"/></td>
                          <td  height="40" class="bj-td" id="radioOld"><input type="button" name="yanCode" onclick="bjyzm(this)" class="index-input-btn right" value="获取验证码" /></td>
                        </tr>
						<!--<tr>
							<td  height="45" class="radioNew " ><div class="newHouse left" id="old1" name="0">新房</div></td>
							<td  height="45" class="radioNew "  id="radioOld"><div class="newHouse right" id="old2" name="0">老房</div></td>
						</tr>-->
                     
						<tr>
							<td height="45" colspan="2" width="100%">
							<input type="button" id="sm1" onclick="bjbaoming(this)" class="index-button-02 all-hover-animate" value="获取报价" 
							<?php if($vo['image'] ==''): else: ?> 
								style="background:url(<?php echo ($vo['image']); ?>);"<?php endif; ?>
							>
							</td>
						</tr>
					</tbody></table>
					<input type="hidden" value="" name="PromoterId">
					<input type="hidden" value="" name="PromoterName">
				</form>     
				</div>
	
<script src="/Public/web/js/jquery.validate.js" type="text/javascript"></script>
<script src="/Public/web/js/jquery-ui.min.js"></script>
<link rel="stylesheet" media="screen" href="/Public/web/css/jquery-ui.min.css">
<script>
//发送手机验证码
var isbm = 0;
var checks = '.checkCode';
function bjbaoming(){
	isbm = 1;
	 $('#checkCode').removeClass('checkCode');
	$('.rightform1').submit();
}

function bjyzm(){
	isbm = 0;
	 $('#checkCode').removeClass('checkCode');
	 $('#checkCode').addClass('checkCode');
	
	 $('.rightform1').submit();
	var name =$.trim($('input[name="name"]').val());
	var area =$.trim($('input[name="area"]').val());
	var phone =$.trim($('input[name="phone"]').val());
	if(!name) {
		return ;
		
	}
	if(!area){
		return ;
		
	} 
	if(!phone){
		 return ;
		
	}
	var codeNum=0;
	
			
		$.ajax({
			type: "post",
			url: "<?php echo C('scurl')['COUNTPRICE_MCODE'];?>",
			data: {phone:phone},	
			dataType: "json",
			success: function(data){
				if(data==1){
				          	$('input[name="yanCode"]').attr('onclick',' ');
				          	timmer=setInterval(codeTime,1000);
				          	$('input[name="yanCode"]').prop('class','index-input-btn-false right');
				}else{	
				         return false;
				}
			}
		})
	
	

	function codeTime(){
		codeNum++;
		$('input[name="yanCode"]').val((30-codeNum)+'秒后发送！');
		if(codeNum>30){
			$('input[name="yanCode"]').prop('class','index-input-btn right');
			$('input[name="yanCode"]').attr('onclick','bjyzm(this)');
			codeNum=0;
			clearInterval(timmer);
			$('input[name="yanCode"]').val("获取校验码");
			   //alert('哈哈！验证码收到没？没收到继续获取哦！！！')
		};
	};//codeTi

}



$("#index_bm td.radioNew").click(function(){
	$('.newHouse').attr('name',0);
	$(this).find('.newHouse').attr('name', 1);
	$(this).addClass("active").siblings().removeClass("active");

});

function bmcg(a,b,c)
{
	var diag = new Dialog();
	diag.Width = 500;
	diag.Height = 300;
	diag.Title = "获取报价";
	diag.URL = "http://sh.sc.cc/index/bmcg/haohua/"+a+"/jiandan/"+b+"/jingzhi/"+c;
	diag.show();
}

$.validator.setDefaults({
	submitHandler: function() {

	},
	showErrors: function(map, list) {
		// there's probably a way to simplify this
		var focussed = document.activeElement;
		if (focussed && $(focussed).is("input, textarea")) {
			$(this.currentForm).tooltip("close", {
				currentTarget: focussed
			}, true)
		}
		this.currentElements.removeAttr("title").removeClass("ui-state-highlight");
		$.each(list, function(index, error) {
			$(error.element).attr("title", error.message).addClass("ui-state-highlight");
		});
		if (focussed && $(focussed).is("input, textarea")) {
			$(this.currentForm).tooltip("open", {
				target: focussed
			});
		}
	}
});
// 手机号码验证
jQuery.validator.addMethod("isMobile", function(value, element) {
	var length = value.length;
	var mobile = /^1[3|4|5|8|7][0-9]\d{8}$/;
	return this.optional(element) || (length == 11 && mobile.test(value));
}, "请正确填写您的手机号码");

(function() {

	$(".rightform1, .problem").tooltip({
		show: false,
		hide: false
	});
var res_status=0;
$(".rightform1").validate({
	onkeyup:false,
	ignore:'.checkCode',
	submitHandler: function(form){ 
	if(isbm == 0){
		return ;
	}
	var name = $("#name").val();
	var phone = $("#phone").val();
	var area = $("#area").val();
	var old1 = $("#old1").attr('name');
	var old2 = $("#old2").attr('name');
	var cid = "<?php echo ($cityinfo["ID"]); ?>";

	var yzm =$.trim($('input[name="checkCode"]').val());


	// $.ajax({
	// 	url: "<?php echo C('scurl')['COUNTPRICE_CHECK_YZM'];?>",
	// 	type: 'post',
	// 	async: false,
	// 	dataType: 'json',
	// 	data: {yzm: yzm},
	// 	success:function(msg){
	// 		if(msg.status==0){
	// 			return false;
	// 		}else{
	// 			res_status =1;
	// 		}
	// 	}
	// })			
	// if(res_status){	
		$.ajax({    
			type:'post',        
			url:"<?php echo C('scurl')['COUNTPRICE_JISUAN'];?>",    
			data:{
				name:name,
				phone:phone,
				area:area,
				old1:old1,
				old2:old2,
				cid:cid,
				source:'24'
			},    
			cache:false,    
			dataType:'json',    
			success:function(data){   
				// alert(data);
				ga('send', 'event', 'baojia', 'dianji', 'shouye', 2);
				bmcg(data.haohua, data.jiandan, data.jingzhi);
				$('.index-input-03').val('');
			},

		});  
		//alert("formParam"); 
	// }else{
	// 	return false;
	// 	//alert("formParam");    
	// }   
	},     
	rules: {
		name: "required",
		phone: { 
			required:true, 
			isMobile:true 
		},
		area: {
		  required: true,
		  digits: true,
		},
		checkCode: { 
			required:true, 
			remote: {
				url: "<?php echo C('scurl')['COUNTPRICE_CHECK_YZM'];?>",     //后台处理程序
				type: "post",               //数据发送方式
				dataType: "json",           //接受数据格式   
            		}
		}

	},
	messages: {
		name: "请输入您的姓名",
		phone: {
			required: "请输入您的联系电话",
			isMobile: "请输入一个有效的联系电话"
		},
		area: {
		  required: '请输入您的面积',
		  digits: '只能输入整数',
		},
		checkCode: { 
			required:'请输入验证码',
		    	remote: "验证码错误"
		},
	}

  });


	


})();
</script>			
				
                </div><?php endif; ?>
            <?php if($vo['chajianID'] == 27): ?><a style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;"  href="javascript:getlunbo('<?php echo ($vo["caseid"]); ?>');">      
                    <script type="text/javascript" src="/Public/web/hdlunbotu/js/lb_zDialog.js"></script>
<script type="text/javascript" src="/Public/web/hdlunbotu/js/lb_zDrag.js"></script>
<script type="text/javascript">
    function getlunbo(id)
    {
        var diag = new LDialog();
        diag.Width = 760;
        diag.Height = 640;
        diag.Title = "";
        diag.URL = "/hd/lunbotu/id/"+ id;
        diag.show();
    }
</script>
                </a><?php endif; ?>
            <?php if($vo['chajianID'] == 28): ?><div style="position:absolute;left:<?php echo ($vo['lefts']); ?>;top:<?php echo ($vo['tops']); ?>;width:<?php echo ($vo['width']); ?>;height:<?php echo ($vo['height']); ?>;">
                    
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
						<?php if($Promoterid == '0'): ?>href="<?php echo ($vo["url"]); ?>" target="_blank"
						<?php else: ?>
							href="#"<?php endif; endif; ?>><img src="<?php echo ($vo['backgroundimg']); ?>" /></a></div>

    <script type="text/javascript">
    $(function(){
        $(".Imgss img").mouseover(function(){
            $(this).attr("src","<?php echo ($vo['image']); ?>");
        });
    });
     $(".Imgss img").mouseout(function(){
        $(this).stop().attr("src","<?php echo ($vo['backgroundimg']); ?>");
    });

function baommouse()
{
	var diag = new Dialog();
	diag.Width = 420;
	diag.Height =280;
	diag.Title = "我要报名";
	diag.URL = "<?php echo C('scurl')['HD_INDEX'];?>link/id/<?php echo ($id); ?>?utm_source=<?php echo ($utm_source); ?>&utm_term=<?php echo ($utm_term); ?>&Promoterid=<?php echo ($Promoterid); ?>";
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
	    
	    <img class="tpimg" src="/Public/Uploads/hd/t<?php echo $list['ID'].$i ;?>.jpg" />
	    <?php } ?>
	    </div>
    <?php } ?>
    
    </div>



<!-- 新活动插件 -->


<LINK href="/Public/newhd/css/iframes.css" type=text/css rel=stylesheet>


<div id="newHdcj">


    <div class="nextpage" id="gotops" style="display:none;">
        <div class="xf_b" >
             <div class="xf_w">
                <form method="post" name="newform2" id="newform2">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="ClassRoomID" value="<?php echo ($id); ?>" />
                                <input type="hidden"  name="ClassRoomName" value="<?php echo ($list['Title']); ?>" />
                                <input type="hidden"  name="qudao" value="<?php echo ($utm_source); ?>" />
                                <input type="hidden" value="add" name="action" />
                                <input type="hidden" value="<?php echo ($Promoterid); ?>" name="Promoterid" />
                                <input type="hidden" value="<?php echo ($PromoterName); ?>" name="PromoterName" />
                                <input type="hidden" value="<?php echo ($utm_term); ?>" name="utm_term" />
                                <input name="CityID" type="hidden" id="CityID" value="<?php echo ($list['CityID']); ?>" />
                                <input name="CityName" type="hidden" id="CityName" value="<?php echo ($list['CityName']); ?>" />
                                <input name="renshu" type="hidden" id="renshu" value="1" />
                            </td>
                        </tr>
                        <tr>
                            <td height="45"><input name="UserName" type="text" class="inputp" size="5" placeholder="请输入您的姓名"/></td>
                            <td height="45" class="td-bm">已有<span class="bm_num1"></span> 人报名</td>
                        </tr>
                        <tr>
                            <td height="45"><input type="text" class="inputp" name="TelePhone" size="5" maxlength="11" placeholder="请输入您的手机"/></td>
                            <td height="45"><a href="javascript:;" onClick="$('#newform2').submit();"><img src="/Public/newhd/images/button-02.jpg"border="0" /></a></td>
                        </tr>
                    </table>
                </form>    
            </div>
            <p class="t_phone"><?php echo ($PromoterTel); ?></p>
            <div class="closeFoot"></div>
        </div>
    </div>
    <div class="footSmall"></div>
</div>

</body>

<script type="text/javascript">
    // $(window).scroll( function() { 
    // 	//baomingFd.style.top = (document.body.scrollTop+240) +"px";
    // 	lineKefu.style.top = (document.body.scrollTop+250) +"px";
    //  } );
$(function(){
    var w = $("body").css("width");
    str = w.replace('px', "");
    var imgWidth = "<?php echo ($list['width']); ?>";
    if (imgWidth > str) {
        root.style.left = "-" + ((imgWidth - str) / 2) + "px";
        //baomingFd.style.left = ((imgWidth - str) / 2) + "px";
       // $(".tpimg").css("margin-left","-" + ((imgWidth - str) / 2) + "px");
    } else {
        root.style.left = ((str - imgWidth) / 2) + "px";
        //baomingFd.style.left =  "-" + ((str - imgWidth) / 2) + "px";
        //$(".tpimg").css("margin-left",((str - imgWidth) / 2) + "px");
    }
    var lef = (str - 1200) / 2;

    $(".hdTop").css("left", lef);

    //alert(document.body.scrollTop);
    var id = "<?php echo ($id); ?>";
    var url = "<?php echo C('scurl')['HD_INDEX'];?>ajaxgetbmnumber/id/" + id;
    $.ajax({
        type: "get",
        url: url,
        data:
                {
                },
        dataType: "html",
        success: function (data) {
            $(".bm_numz").html('');
            $(".bm_numz").html(data);
            $(".bm_numh").html('');
            $(".bm_numh").html(data);
            $(".bm_num").html(data);
            $(".bm_num1").html(data);
        }
    });


    function baoming() {
        var tp = $("#TelePhone").val();
        var un = $("#UserName").val();
        if (tp == '') {
            alert('请输入您的电话号码');
            return;
        } else if (un == '') {
            alert('请输入您的姓名');
            return;
        } else {
            this.document.formleft.submit();
        }

    }
});
    
</script>

<script>
    (function () {
        // use custom tooltip; disable animations for now to work around lack of refresh method on tooltip
        $("#newform1, #newform2,.formhengzong").tooltip({
            show: false,
            hide: false
        });

        $("#newform1").validate({
            submitHandler: function (form) {

                var formParam = $(form).serialize();//序列化表格内容为字符串  

                $.ajax({
                    type: 'post',
                    url: '<?php echo U( "hd/onekey");?>',
                    data: formParam,
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                        alert(data.info);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert('提交失败');
                    },
                    complete: function () {
                    }
                });
                //alert("formParam");    
            },
            rules: {
                UserName: "required",
                TelePhone: {
                    required: true,
                    isMobile: true
                },
            },
            messages: {
                UserName: "请输入您的姓名",
                TelePhone: {
                    required: "请输入您的联系电话",
                    isMobile: "您输入的电话号码有误！"
                },
            }
        });
//横、纵报名框报名

        $("#form").validate({
            submitHandler: function (form) {

                var formParam = $(form).serialize();//序列化表格内容为字符串  

                $.ajax({
                    type: 'post',
                    url: "<?php echo C('scurl')['HD_INDEX'];?>bm/",
                    data: formParam,
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                        if ($data.state == 1) {
                            bmok();
                        } else {
                            alert(data.msg)
                        }
                        //alert(data.info);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        //alert('提交失败');
                    },
                    complete: function () {
                    }
                });
                //alert("formParam");    
            },
            rules: {
                UserName: "required",
                TelePhone: {
                    required: true,
                    isMobile: true
                },
            },
            messages: {
                UserName: "请输入您的姓名",
                TelePhone: {
                    required: "请输入您的联系电话",
                    isMobile: "您输入的电话号码有误！"
                },
            }
        });


        $("#newform2").validate({
            submitHandler: function (form) {

                var formParam = $(form).serialize();//序列化表格内容为字符串  

                $.ajax({
                    type: 'post',
                    url: '<?php echo U( "hd/onekey");?>',
                    data: formParam,
                    cache: false,
                    dataType: 'json',
                    success: function (data) {
                        if (data.statusCode == 200) {
                            bmok();
                        } else {
                            bmsb(data.info);
                        }

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        bmsb(data.info)
                    },
                    complete: function () {
                    }
                });
                //alert("formParam");    
            },
            rules: {
                UserName: "required",
                TelePhone: {
                    required: true,
                    isMobile: true
                },
            },
            messages: {
                UserName: "请输入您的姓名",
                TelePhone: {
                    required: "请输入您的联系电话",
                    isMobile: "您输入的电话号码有误！"
                },
            }
        });

    })();



    function bmok() {

        var diag = new Dialog();
        diag.Width = 500;
        diag.Height = 180;
        diag.Title = "我要报名";
        diag.URL = "<?php echo C('scurl')['HD_INDEX'];?>bmok";
        diag.show();
        $("#_DialogDiv_0").show();
    }
    function bmsb(msg) {

        var diag = new Dialog();
        diag.Width = 500;
        diag.Height = 180;
        diag.Title = "我要报名";
        diag.URL = "<?php echo C('scurl')['HD_INDEX'];?>bmsb?msg=" + msg;
        diag.show();
        $("#_DialogDiv_0").show();
    }
</script>

<script type="text/javascript" src="/Public/newhd/js/scroll.js"></script>
<script type="text/javascript">
    $(function () {
        // $('input, textarea').placeholder();
    });
</script>

<?php if(($list["istopbaoming"]) == "0"): ?><script type="text/javascript">
$(function(){
    var windowW = document.documentElement.clientWidth || document.body.clientWidth;
    var YRight = 0;
    YRight = (windowW - 1180) / 2;
    document.getElementById("baoMXF").style.right = (YRight - 8) + "px";
    // alert(YRight-8);
    document.getElementById("baoMXF").style.top = "20px";

    document.getElementById("baoMXF").style.display = 'block';
});
</script><?php endif; ?>
<script type="text/javascript">
    $(function () {
        $('#gotop').click(function () {
            $('html,body').animate({scrollTop: '0px'}, 800);
        });
        $(".closeFoot").click(function () {
            $(".nextpage").animate({left: '-100%'}, 1000);
            $(".footSmall").show(1000);
            $(".bodyFt").css({"height": "1349px"});
        });
        $(".footSmall").click(function () {
            $(".footSmall").hide(1000);
            $(".nextpage").animate({left: '0px'}, 1000);
            $(".bodyFt").css({"height": "1471px"});
        });
        $(".zsYbj ul li:last-child,.ftTjtw ul li:last-child").css({"margin-right": "0px"});
    });

</script>
<?php if(($list["istopbaoming"]) == "0"): ?><script type="text/javascript">
    $(function () {
        $(".baom_gd .list_lh").myScroll({
            speed: 40, //数值越大，速度越慢
            rowHeight: 2000 //li的高度
        });
    });
</script><?php endif; ?>
<script type="text/javascript">
    function pyConsultPyL() {
        var w = window, d = document, e = encodeURIComponent;
        var b = location.href, c = d.referrer, f, g = d.cookie, h = g.match(/(^|;)\s*ipycookie=([^;]*)/), i = g.match(/(^|;)\s*ipysession=([^;]*)/);
        if (w.parent != w) {
            f = b;
            b = c;
            c = f;
        }
        ;
        u = '//stats.ipinyou.com/cvt?a=' + e('tG.GCs.YrnyZF3BsWRUPp8nRDeO00') + '&c=' + e(h ? h[2] : '') + '&s=' + e(i ? i[2].match(/jump\%3D(\d+)/)[1] : '') + '&u=' + e(b) + '&r=' + e(c) + '&rd=' + (new Date()).getTime() + '&e=';
        (new Image()).src = u;
    }

    var lxbCbInputBtnBindedOne = false;
    var lxbCbInputBtnBindedTwo = false;
    var _interval = window.setInterval(function () {
        //在线咨询（右侧）
        if ($('.icoTc').length > 0 && !lxbCbInputBtnBindedOne) {
            $('.icoTc').bind("click", function () {
                pyConsultPyL();
            });
            lxbCbInputBtnBindedOne = true;
        }

        //在线咨询（悬浮窗）
        if ($('#doyoo_mon_accept').length > 0 && !lxbCbInputBtnBindedTwo) {
            $('#doyoo_mon_accept').bind("click", function () {
                pyConsultPyL();
            });
            lxbCbInputBtnBindedTwo = true;
        }
        if (lxbCbInputBtnBindedOne && lxbCbInputBtnBindedTwo) {
            window.clearInterval(_interval);
        }
    }, 200);
</script>


</html>