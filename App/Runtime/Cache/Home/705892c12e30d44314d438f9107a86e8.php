<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta name="baidu-site-verification" content="iYtZEaZDzq" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo ($title); ?></title>
		<meta name="keywords" content="<?php echo ($keywords); ?>" /> 
		<meta name="description" content="<?php echo ($description); ?>" />
        <link rel="stylesheet" type="text/css" href="/Public/web/2016/css/common.css" />
        <link rel="stylesheet" type="text/css" href="/Public/2016/css/common.css" />
        <link rel="stylesheet" type="text/css" href="/Public/web/2016/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/Public/web/2016/css/nav.css" />
        <script type="text/javascript" src="/Public/web/2016/js/jquery.js"></script>
        <script type="text/javascript" src="/Public/web/2016/js/banner.js"></script>
        <script type="text/javascript" src="/Public/web/2016/js/nav.js"></script>
        <script type="text/javascript" src="/Public/web/2016/js/zDrag.js"></script>
        <script type="text/javascript" src="/Public/web/2016/js/zDialog.js"></script>
        <script type="text/javascript" src="/Public/web/2016/js/toggles.js"></script>

        <script type="text/javascript">
			function zdfs()
			{
				var diag = new Dialog();
				diag.Width = 500;
				diag.Height = 350;
				diag.Title = "预约装修";
				diag.URL = "<?php echo C('scurl')['INDEX_ZDFS'];?>";
				diag.show();
			}
			function opin()
			{
				var diag = new Dialog();
				diag.Width = 500;
				diag.Height = 330;
				diag.Title = "在线报修";
				diag.URL = "<?php echo C('scurl')['INDEX_OPINION'];?>";
				diag.show();
			}
			function bmcg(a,b,c)
			{
				var diag = new Dialog();
				diag.Width = 700;
				diag.Height = 450;
				diag.Title = "获取报价";
				diag.URL = "<?php echo C('scurl')['INDEX_INDEX'];?>index/bjcg/jiandan/"+a+"/shichang/"+b+"/phone/"+c;
				diag.show();
			}
			
		</script>
    </head>
	<body>
    <!-- 顶部广告-->
<?php if ($publicTop !=1): ?>
   <?php if($slidebanner != ''): ?><div class="new-width top-gg" id="top-gg">
      <a href="<?php echo ($slidebanner["url"]); ?>" class="new-width-img" target="_blank"><img src="<?php echo ($slidebanner["image"]); ?>" alt="<?php echo ($slidebanner["name"]); ?>"></a>  
       <a class="top-gg-colse" id="closee"><img src="/Public/web/2016/images/index-colse.png" alt=""></a>
     </div><?php endif; ?>
 <?php endif ?>       

    <div class="index-top">
    	<div class="it-content">
        	<div class="itc-left left">城市：<a class="a-city" href="http://<?php echo ($cityinfo["DOMAIN"]); ?>.sc.cc<?php echo C('scurl')['GHOUZHUI'];?>"><?php echo ($cityinfo["NAME"]); ?></a><a id="gh">[更换]</a></div>
            <!--城市弹出层始-->
			<div class="city_name" id="city_select">
					<dl>
						<dt>东北</dt>
						<dd>
							<?php if(is_array($citys)): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["AreaName"] == '东北'): ?><a href="http://<?php echo ($vo["DOMAIN"]); echo C('scurl')['DOMAIN']; echo C('scurl')['GHOUZHUI'];?>"  <?php if($vo["DOMAIN"] == $city): ?>style="color: #ec4e21; font-weight: bold;"<?php endif; ?>><?php echo ($vo["NAME"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</dd>
					</dl>

					<dl style="height: 60px;">
						<dt>华北</dt>
						<dd>
							<?php if(is_array($citys)): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["AreaName"] == '华北'): ?><a href="http://<?php echo ($vo["DOMAIN"]); echo C('scurl')['DOMAIN']; echo C('scurl')['GHOUZHUI'];?>"  
							 <?php if($vo["DOMAIN"] == $city): ?>style="color: #ec4e21; font-weight: bold;"<?php endif; ?>
							<?php if($vo["DOMAIN"] == 'bj'): ?>style=" font-weight: bold;"<?php endif; ?>
							><?php echo ($vo["NAME"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</dd>
					</dl>
					<dl>
						<dt>华东</dt>
						<dd>
							<?php if(is_array($citys)): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["AreaName"] == '华东'): ?><a href="http://<?php echo ($vo["DOMAIN"]); echo C('scurl')['DOMAIN']; echo C('scurl')['GHOUZHUI'];?>"  <?php if($vo["DOMAIN"] == $city): ?>style="color: #ec4e21; font-weight: bold;"<?php endif; ?>
							<?php if($vo["DOMAIN"] == 'sh'): ?>style=" font-weight: bold;"<?php endif; ?>><?php echo ($vo["NAME"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</dd>
					</dl>
					<dl>
						<dt>中南</dt>
						<dd>
							<?php if(is_array($citys)): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["AreaName"] == '中南'): ?><a href="http://<?php echo ($vo["DOMAIN"]); echo C('scurl')['DOMAIN']; echo C('scurl')['GHOUZHUI'];?>"  <?php if($vo["DOMAIN"] == $city): ?>style="color: #ec4e21; font-weight: bold;"<?php endif; ?>
							<?php if($vo["DOMAIN"] == 'gz'): ?>style=" font-weight: bold;"<?php endif; ?>><?php echo ($vo["NAME"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</dd>
					</dl>
					<dl>
						<dt>西南</dt>
						<dd>
							<?php if(is_array($citys)): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["AreaName"] == '西南'): ?><a href="http://<?php echo ($vo["DOMAIN"]); echo C('scurl')['DOMAIN']; echo C('scurl')['GHOUZHUI'];?>"  <?php if($vo["DOMAIN"] == $city): ?>style="color: #ec4e21; font-weight: bold;"<?php endif; ?>><?php echo ($vo["NAME"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</dd>
					</dl>
					<dl>
						<dt>西北</dt>
						<dd>
							<?php if(is_array($citys)): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["AreaName"] == '西北'): ?><a href="http://<?php echo ($vo["DOMAIN"]); echo C('scurl')['DOMAIN']; echo C('scurl')['GHOUZHUI'];?>"  <?php if($vo["DOMAIN"] == $city): ?>style="color: #ec4e21; font-weight: bold;"<?php endif; ?>><?php echo ($vo["NAME"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</dd>
					</dl>
			</div>
			<!--弹出层末-->
            <div class="itc-right right">

            	
            	<a class="right indexZx"  rel="nofollow" href="http://j.looyu.com/WebModule/chat/p.do?c=<?php echo ($cityinfo["LEYUCID"]); ?>&f=<?php echo ($cityinfo["LEYUFID"]); ?>&<?php echo ($leyurl); ?>" rel="nofollow" target="_blank">咨询客服</a>

                <?php if($user != ''): $httpUrl = explode(".",$_SERVER['HTTP_HOST']); if(in_array("zhuangxiuxiaoguotu",$httpUrl)){ ?>
                    <a class="right" href="<?php echo C('scurl')['XIAOGUOTU_YUN'];?>logout/">[退出]<a>
                        <?php }else{ ?>
                        <a class="right" href="<?php echo C('scurl')['USER_INDEX'];?>logout/">[退出]<a>
                            <?php
 } endif; ?>
            	
            	
				<?php if($user == ''): ?><a class="right" href="<?php echo C('scurl')['USER_LOGIN'];?>" rel="nofollow" target="_blank">登录</a><?php endif; ?>
				<?php if($user != ''): ?><a class="right" href="<?php echo C('scurl')['VIP_INDEX'];?>" target="_blank"><?php if($user["username"] != ''): echo ($user["username"]); endif; if($user["username"] == ''): echo ($user["mobilephone"]); endif; ?></a><?php endif; ?>

            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="new-width new-top">
       <div class="new-top-con con">
         <div class="new-top-con-left left">
            <div class="new-top-con-logo left"><a href="<?php echo C('scurl')['INDEX_INDEX'];?>"><img src="/Public/web/2016/images/index-logo.png" width="220" height="26" alt="实创装饰整体家装"></a></div>
            <span class="left"><img src="/Public/web/2016/images/index-slo.png" width="178" height="26"></span>
         </div>
         <div class="new-top-con-sou left">
            <div class="sou-left left">
              <select name="" class="index-input-02" id="searchtype">
                <option value="1" <?php if((CONTROLLER_NAME) == "Xiaoguotu"): ?>selected<?php endif; ?>>案例</option>
                <option value="2" <?php if((CONTROLLER_NAME) == "Designer"): ?>selected<?php endif; ?>>设计师</option>
                <option value="3" <?php if((CONTROLLER_NAME) == "Gonglue"): ?>selected<?php endif; ?>>装修知识</option>
                <option value="4" <?php if((CONTROLLER_NAME) == "Cases"): ?>selected<?php endif; ?> <?php if((CONTROLLER_NAME) == "Hotcom"): ?>selected<?php endif; ?>>找小区</option>
             </select>
            </div>
           <div class="sou-right left">
             <input type="text" class="index-input-01 left" id="searchkeyword" placeholder="请输入关键词" value="<?php echo ($keyword); ?>" />
             <a href="javascript:;" class="index-button-01 all-hover-animate left" id="searchurls" ></a>
           </div>
          <div class="sou-con left">
           <?php if ($SERVER_NAME='test.sitrue.cc'): ?>
                <a href="http://www.sc.cc/baojia/" target="_blank">装修报价</a>
            <?php else: ?>
               <a href="<?php echo C('scurl')['COUNTPRICE_ZXYS'];?>" target="_blank">装修报价</a>
          <?php endif ?>
            
             <a href="http://gonglue.sc.cc/jiajufengshui/" target="_blank">家居风水</a>
             <a href="http://gonglue.sc.cc/zhuangxiuliucheng/" target="_blank">装修流程</a>
             <a href="http://zhuangxiuxiaoguotu.sc.cc/keting/" target="_blank">客厅装修效果图</a>
             <a href="http://zhuangxiuxiaoguotu.sc.cc/tatami/" target="_blank">榻榻米装修效果图</a>   
           </div>
        
         </div>
         <script>
  			var url = "<?php echo C('scurl')['XIAOGUOTUE_MEITU_KEYWORDS'];?>";
        	function changeword(){
         		var searchkeyword = $("#searchkeyword").val();
         		var type = $("#searchtype").val();
         		if(type ==1){
            		 url = "<?php echo C('scurl')['XIAOGUOTU_MEITU_KEYWORD'];?>"+searchkeyword;
        		}else if(type == 2){
            		 url = "<?php echo C('scurl')['DESIGNER_LISTS'];?>?search="+searchkeyword;
        		}else if(type == 3){
            		 url = "<?php echo C('scurl')['GONGLUE_SEARCH_KEYWORD'];?>"+searchkeyword;
        		}else if(type == 4){
            		 url = "<?php echo C('scurl')['CASES_INDEX'];?>keyword="+searchkeyword;
        		}
        	}
        	$("#searchurls").click(function(){
        		changeword();
         		window.open(url);
        		//$("#searchkeyword").css('border','1px solid #ff6600');
        	})
         	$("#searchkeyword").keydown(function(){
         		changeword();
         	})
              //取消默认回车调转 增加填写form回车跳转；
          $(function(){
                   $('input').focus(function(event) {
                       inputId= $(this).attr('id') ;  
                   });
                   document.onkeydown=function(event){
                     var e = event || window.event || arguments.callee.caller.arguments[0];
                     if(e && e.keyCode==13){ // enter 键

                          if(inputId=='searchkeyword'){
                               changeword();
                                window.open(url);     //要做的事情
                          }else{
                           
                              return false;
                          }
                     }
                   };   
          })
         </script>

        <div class="new-top-con-right right">
            <p class="right">
				<?php if($Promoter["PromoterTel"] != ''): echo ($Promoter["PromoterTel"]); else: echo ($cityinfo["TELEPHONE"]); endif; ?></p>
            
           </div>
         
      </div>
    </div>
    <div class="nav2016">
        <div class="navCenter">
            <ul>
                <li>
                    <a href="<?php echo C('scurl')['INDEX_INDEX'];?>">首页</a>
                </li>
                <li>
                    <a href="<?php echo C('scurl')['LIXIANGZHUANG']; echo ($lixiang); echo C('scurl')['GHOUZHUI'];?>" target="_blank" >理想装</a>
  				  
                </li>
                <li class="nav2016Xgt">
                    <a href="<?php echo C('scurl')['XIAOGUOTU_HOMEPIC'];?>" target="_blank">效果图</a>
                </li>
                <li>
                    <a href="<?php echo C('scurl')['COUNTPRICE_ZXYS'];?>" target="_blank">装修报价</a>
                </li>
                <li>
                    <a href="<?php echo C('scurl')['DESIGNER_INDEX'];?>" target="_blank">设计师</a>
                </li>
                <li>
                    <a href="<?php echo C('scurl')['CASES_INDEX'];?>" target="_blank">小区装修</a>
                </li>
                <li>
                    <a href="<?php echo C('scurl')['GONGLUE_INDEX']; echo C('scurl')['GHOUZHUI'];?>" target="_blank">装修知识</a>
                </li>
                <li>
                    <a href="<?php echo C('scurl')['ABOUT_INDEX'];?>" target="_blank">关于实创</a>
                </li>
            </ul>
            <div class="navXgtxq">
                <ul>
                    <li>
                        <a href="<?php echo C('scurl')['XIAOGUOTU_HOMEPIC'];?>tuce/" target="_blank">灵感美图</a>
                    </li>
                    <li>
                        <a href="<?php echo C('scurl')['XIAOGUOTU_MEITU'];?>" target="_blank">家装案例</a>
                    </li>
                    <li>
                        <a href="<?php echo C('scurl')['XIAOGUOTU_THREE'];?>" target="_blank">3D样板间</a>
                    </li>
                    <li class="navLf">
                        <a href="<?php echo C('scurl')['XIAOGUOTU_YUN'];?>" target="_blank">3D云设计</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
     <script type="text/javascript">
        $(function(){
            $(".nav2016Xgt,.navXgtxq").mouseover(function(){
                $(".navXgtxq").css({"display":"block"});
                $(".nav2016Xgt").css({"background":"#12b5b2"});
                $(".nav2016Xgt").css({"background":"#12b5b2"});
            });
            $(".nav2016Xgt,.navXgtxq").mouseout(function(){
                $(".navXgtxq").css({"display":"none"});
                $(".nav2016Xgt").css({"background":"#00908c"});
            });
        });
        </script>
    <!---导航结束-->

<link href="/Public/2016/www/css/new-sc-style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div class="new-sc-box new-sc-box1">
   <div class="new-sc-box-con">
    <dl class="new-sc-dl">
     <dt>东北</dt>
     <dd>
		<?php if(is_array($citys)): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["AreaName"] == '东北'): ?><a href="http://<?php echo ($vo["DOMAIN"]); echo C('scurl')['DOMAIN']; echo C('scurl')['GHOUZHUI'];?>"  <?php if($vo["DOMAIN"] == $city): ?>style=""<?php endif; ?>><?php echo ($vo["NAME"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?> 
	</dd>          
     <dt>华北</dt><dd>
		<?php if(is_array($citys)): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["AreaName"] == '华北'): ?><a href="http://<?php echo ($vo["DOMAIN"]); echo C('scurl')['DOMAIN']; echo C('scurl')['GHOUZHUI'];?>"  <?php if($vo["DOMAIN"] == $city): ?>style=""<?php endif; ?>><?php echo ($vo["NAME"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?> 
		</dd>
     <dt>中南</dt><dd>
		<?php if(is_array($citys)): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["AreaName"] == '中南'): ?><a href="http://<?php echo ($vo["DOMAIN"]); echo C('scurl')['DOMAIN']; echo C('scurl')['GHOUZHUI'];?>"  <?php if($vo["DOMAIN"] == $city): ?>style=""<?php endif; ?>><?php echo ($vo["NAME"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?> 
		</dd>          
     <dt>华东</dt><dd>
		<?php if(is_array($citys)): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["AreaName"] == '华东'): ?><a href="http://<?php echo ($vo["DOMAIN"]); echo C('scurl')['DOMAIN']; echo C('scurl')['GHOUZHUI'];?>"  <?php if($vo["DOMAIN"] == $city): ?>style=""<?php endif; ?>><?php echo ($vo["NAME"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?> 
		</dd>
	 <dt>西南</dt>
	 	<dd>
		<?php if(is_array($citys)): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["AreaName"] == '西南'): ?><a href="http://<?php echo ($vo["DOMAIN"]); echo C('scurl')['DOMAIN']; echo C('scurl')['GHOUZHUI'];?>"  <?php if($vo["DOMAIN"] == $city): ?>style=""<?php endif; ?>><?php echo ($vo["NAME"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?> 
		</dd>                          
     <dt>西北</dt>
		<dd>
		<?php if(is_array($citys)): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["AreaName"] == '西北'): ?><a href="http://<?php echo ($vo["DOMAIN"]); echo C('scurl')['DOMAIN']; echo C('scurl')['GHOUZHUI'];?>"  <?php if($vo["DOMAIN"] == $city): ?>style=""<?php endif; ?>><?php echo ($vo["NAME"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?> 
		</dd>
     </dl>
   </div>
</div>
<div class="new-sc-box new-sc-box2">
   <div class="new-sc-box-con">
     <b class="new-sc-box-con-b new-sc-box-con-b1">我们从事家装行业17年</b>
     <b class="new-sc-box-con-b new-sc-box-con-b2">服务了200000+家庭用户</b>
     <b class="new-sc-box-con-b new-sc-box-con-b3">覆盖全国28个城市</b>
     <b class="new-sc-box-con-b new-sc-box-con-b4">累计共获荣誉136项</b>
     <p class="new-sc-box-con-b new-sc-box-con-p new-sc-box-con-p1">17年来产品几经变革，不断升级，唯坚持“好家装 实创造”的理念从未动摇</p>
     <p class="new-sc-box-con-b new-sc-box-con-p new-sc-box-con-p2">2015年，我们为满足家装用户愈来愈强烈的个性化家装需求，整合自身产业链的优势，隆重推出实创整体家装十年经典新作</p>
   </div>
 </div>
 <div class="new-sc-box new-sc-box3">
   <div class="new-sc-box-con">
     <span class="new-sc-box-con-b new-sc-box-span">客厅/餐厅/厨房/卫生间/卧室/阳台/儿童房/老人房/书房</span>
   </div>
 </div>
  <div class="new-sc-box new-sc-box4">
   <div class="new-sc-box-con">
     <h4 class="new-sc-box-con-b new-sc-box-con-p new-sc-box-con-h">理想装—整装全包</h4>
     <p class="new-sc-box-con-p3 new-sc-box-con-p4">包量房<br />免费上门量房</p>
     <p class="new-sc-box-con-p3 new-sc-box-con-p5">包主材<br />国际进口主材</p>
     <p class="new-sc-box-con-p3 new-sc-box-con-p6">包施工<br />欧标工艺实小创监理</p>
     <p class="new-sc-box-con-p3 new-sc-box-con-p7">包配送<br />送货服务到家</p>
     <p class="new-sc-box-con-p3 new-sc-box-con-p8">包售后<br />全责售后拒绝拖拉</p>
   </div>
 </div>
 <div class="new-sc-box new-sc-box5">
  <div class="new-sc-box-con">
  <h4 class="new-sc-box-con-b new-sc-box-con-p new-sc-box-con-h1">理想装—个性之选</h4>
  </div>
 </div>
 <div class="new-sc-box new-sc-box6"></div>
 <div class="new-sc-box new-sc-box7">
   <div class="new-sc-box-con1">
     <h4 class=" new-sc-box-con-h2">美好的装修都是从找灵感开始</h4>
     <div class="new-sc-index-pic">
       <ul>
         <li><img src="/Public/2016/www/images/new-sc-index-pic-00.jpg" width="185" height="300" /><a href="<?php echo C('scurl')['XIAOGUOTU_HOMEPIC'];?>oushi/" target="_blank">欧式风格</a></li>
         <li><img src="/Public/2016/www/images/new-sc-index-pic-01.jpg" width="185" height="300" /><a href="<?php echo C('scurl')['XIAOGUOTU_HOMEPIC'];?>xiandaijianyue/" target="_blank">现代简约</a></li>
         <li><img src="/Public/2016/www/images/new-sc-index-pic-02.jpg" width="185" height="300" /><a href="<?php echo C('scurl')['XIAOGUOTU_HOMEPIC'];?>dizhonghai/" target="_blank">地中海风格</a></li>
         <li><img src="/Public/2016/www/images/new-sc-index-pic-03.jpg" width="185" height="300" /><a href="<?php echo C('scurl')['XIAOGUOTU_HOMEPIC'];?>xiangcuntianyuan/" target="_blank">乡村田园</a></li>
         <li><img src="/Public/2016/www/images/new-sc-index-pic-04.jpg" width="185" height="300" /><a href="<?php echo C('scurl')['XIAOGUOTU_HOMEPIC'];?>zhongshi/" target="_blank">中式风格</a></li>
         <li class="li-no"><img src="/Public/2016/www/images/new-sc-index-pic-05.jpg" width="185" height="300" /><a href="<?php echo C('scurl')['XIAOGUOTU_HOMEPIC'];?>hunda/" target="_blank">混搭风格</a></li>
       </ul>
     </div>
     <div class="new-sc-index-gonglue">
       <div class="gonglue-arcitle left">
         <dl>
           <dt><a  href="<?php echo C('scurl')['GONGLUE_LISTS_CLASSID']; echo gonglue_pinyin_list(157);?>" target="_blank"><img src="/Public/2016/www/images/new-sc-index-pic-06.jpg" width="120" height="120" /><span>小户型</span> </a></dt>
           <dd>
			 <?php if(is_array($xiaohuxing)): $i = 0; $__LIST__ = $xiaohuxing;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span><a href="<?php echo C('scurl')['GONGLUE_INFO_ID']; echo (gonglue_pinyin_id($vo['id'])); echo C('scurl')['HOUZHUI'];?>" target="_blank"><?php echo ($vo["Title"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
           </dd>
         </dl>
       </div>
       <div class="gonglue-arcitle left">
         <dl>
           <dt><a  href="<?php echo C('scurl')['GONGLUE_LISTS_CLASSID']; echo gonglue_pinyin_list(46);?>" target="_blank"><img src="/Public/2016/www/images/new-sc-index-pic-06.jpg" width="120" height="120" /><span>老房</span> </a></dt>
           <dd>
			 <?php if(is_array($laofang)): $i = 0; $__LIST__ = $laofang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span><a href="<?php echo C('scurl')['GONGLUE_INFO_ID']; echo (gonglue_pinyin_id($vo['id'])); echo C('scurl')['HOUZHUI'];?>" target="_blank"><?php echo ($vo["Title"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
           </dd>
         </dl>
       </div>
       <div class="gonglue-arcitle left li-no">
         <dl>
           <dt><a  href="<?php echo C('scurl')['GONGLUE_LISTS_CLASSID']; echo gonglue_pinyin_list(58);?>" target="_blank"><img src="/Public/2016/www/images/new-sc-index-pic-06.jpg" width="120" height="120" /><span>风水</span> </a></dt>
           <dd>
			 <?php if(is_array($fengshui)): $i = 0; $__LIST__ = $fengshui;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span><a href="<?php echo C('scurl')['GONGLUE_INFO_ID']; echo (gonglue_pinyin_id($vo['id'])); echo C('scurl')['HOUZHUI'];?>" target="_blank"><?php echo ($vo["Title"]); ?></a></span><?php endforeach; endif; else: echo "" ;endif; ?>
           </dd>
         </dl>
       </div>
     </div>
   </div>
 </div>
				<div class="pic-con con">
				 <div class="index-pic">
					<div class="index-yqlj-top con left">
						<ul>
							<li class="li-cur left">友情链接</li>
							<li class="left">服务城市</li>
							<li class="left">热点标签</li>
						</ul>
					</div>
					<div class="index-yqlj-bottom left">
						<ul>
							
							<li class="left show">
								<!--<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=2087605121&site=qq&menu=yes" rel="nofollow">友链合作</a> |-->
								<?php if(is_array($friend)): $i = 0; $__LIST__ = $friend;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$friendvo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($friendvo["url"]); ?>" target="_blank"><?php echo ($friendvo["link_name"]); ?></a> |<?php endforeach; endif; else: echo "" ;endif; ?>
								<a href="http://www.sc.cc/about/link/" target="_blank">更多>></a>
							</li>
							<li class="left">
								<?php if(is_array($citys)): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$citysvo): $mod = ($i % 2 );++$i;?><a href="http://<?php echo ($citysvo["DOMAIN"]); echo C('scurl')['DOMAIN']; echo C('scurl')['GHOUZHUI'];?>" target="_blank"><?php echo ($citysvo["NAME"]); ?>装饰公司</a> |<?php endforeach; endif; else: echo "" ;endif; ?>
							</li>
							<li class="left">
								<?php if(is_array($redian)): $i = 0; $__LIST__ = $redian;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$redianvo): $mod = ($i % 2 );++$i;?><a href="<?php echo ($redianvo["url"]); ?>" target="_blank"><?php echo ($redianvo["link_name"]); ?></a> |<?php endforeach; endif; else: echo "" ;endif; ?>
							</li>
						</ul>
					</div>
				 </div>
		 </div>
          <div class="index-xff">
          <ul>
            <li class="left index-xff-li4" id="gotop"><a>顶部</a></li>
          </ul>
        </div>
<script type="text/javascript" src="/Public/2016/www/js/gotopp.js"></script>


   <!--主体部分结束-->
     <!--footer-->
    <div class="footer-box">
        <div class="footer">
        	<div class="footer-part1 left">
            	<dl>
                	<dt>帮助中心</dt>
					<dd><a target="_blank" href="<?php echo C('scurl')['STANDARD_QZSH'];?>">售后服务</a></dd>
					<dd><a target="_blank" href="<?php echo C('scurl')['SERVICE_COMPANY'];?>">企业客户入口</a></dd>
					<dd><a target="_blank" href="<?php echo C('scurl')['SERVICE_SITE_MAP'];?>">网站地图</a></dd>
                </dl>
            </div>
            <div class="footer-part1 left">
            	<dl>
                	<dt>服务支持</dt>
					<dd><a target="_blank" href="<?php echo C('scurl')['DESIGNER_INDEX'];?>">设计师团队</a></dd>
					<dd><a target="_blank" href="<?php echo C('scurl')['SERVICE_CSHOPLIST'];?>">线下体验店</a></dd>
					<dd><a target="_blank" href="<?php echo C('scurl')['SERVICE_INDEX'];?>">自助服务</a></dd>
                </dl>
            </div>
            <div class="footer-part1 left">
            	<dl>
                	<dt>关于实创</dt>
					<dd><a target="_blank" href="<?php echo C('scurl')['DESIGNER_DJYS'];?>">独家优势</a></dd>
					<dd><a target="_blank" rel="nofollow" href="http://sc.hirede.com/CareerSite/EmployerBasic">加入我们</a></dd>
					<dd><a target="_blank" href="<?php echo C('scurl')['ABOUT_LEGAL'];?>">法律声明</a></dd>
                </dl>
            </div>
            <div class="footer-part2 left">
            	<dl>
                	<dt>关注我们</dt>
					<dd><a target="_blank" class="weibo" href="http://weibo.com/i28800" rel="nofollow">新浪微博</a></dd>
					<dd><a target="_blank" class="qzone" href="http://user.qzone.qq.com/26800/main" rel="nofollow">QQ空间</a></dd>
					<dd><a target="_blank" class="tmall" href="https://sitrust.tmall.com/index.htm?spm=a1z10.3.w5002-2886372590.2.MfuueF" rel="nofollow">天猫商城</a></dd>
                </dl>
            </div>
            <div class="footer-part3 left">
            	<dl>
                	<dt>官方微信</dt>
					<dd><img src="/Public/2016/img/index_22.png" width="94" height="93" alt="实创装饰官方微信" /></dd>
                </dl>
            	
            </div>
            <div class="footer-part4 left">
            <dl>
                	<dt>抢定热线</dt>
                    <dd><p class="footer-part4-phone"><?php if($Promoter["PromoterTel"] != ''): echo ($Promoter["PromoterTel"]); else: echo ($cityinfo["TELEPHONE"]); endif; ?></p></dd>
                    
             </dl>
			
				<a target="_blank"  rel="nofollow" href="http://j.looyu.com/WebModule/chat/p.do?c=<?php echo ($cityinfo["LEYUCID"]); ?>&f=<?php echo ($cityinfo["LEYUFID"]); ?>&<?php echo ($leyurl); ?>" class="all-hover-animate" rel="nofollow">在线咨询</a>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <!--bottom-->
    <div class="index-bottom">
    	<div class="bottom-content">
       	  <span class="left">Copyright @ 1999-2016北京实创装饰工程有限公司</span>
       	  <span class="right">京ICP备09034105号 京公网安备110102000606</span>
        </div>
    </div>


<!-- 问卷调查 -->
<style>
  .wjdc{
    float: left;
    position: fixed;
    left: 0px;
    bottom: 0px;
  }
</style>
<div class="wjdc"><a href="http://tp.sojump.cn/jq/9033179.aspx" rel="nofollow" target="_blank"><img src="http://www.sc.cc/public/web/images/pcImg.jpg"></a></div>



    <?php if($denglong != '1'): ?><div class="index-xf">
      <ul>
        <li class="left index-xf-li1"><a  rel="nofollow" href="http://j.looyu.com/WebModule/chat/p.do?c=<?php echo ($cityinfo["LEYUCID"]); ?>&f=<?php echo ($cityinfo["LEYUFID"]); ?>&<?php echo ($leyurl); ?>" target="_blank" rel="nofollow">在线咨询</a></li>
        <li class="left index-xf-li2"><a href="javascript:zdfs()" >预约装修</a></li>
        <li class="left index-xf-li3"><a href="javascript:opin()" >售后电话</a></li>
        <li class="left index-xf-li4" id="go_top"><a>返回顶部</a></li>
      </ul>
      <div class="xfTel"><?php if($Promoter["PromoterTel"] != ''): echo ($Promoter["PromoterTel"]); else: echo ($cityinfo["PHONE"]); endif; ?></div>
    </div><?php endif; ?>
<!--  <script type="text/javascript" src="/Public/web/2016/js/toggle.js"></script>-->
  <?php if($denglong != '1'): ?><script type="text/javascript" src="/Public/web/2016/js/gotop.js"></script><?php endif; ?>
  <script type="text/javascript" src="/Public/web/2016/js/placeholder.min.js"></script>
  <script type="text/javascript">
    $(function(){
        $('input, textarea').placeholder();
        $(".index-xf-li3 a").mouseover(function(){
          $(".xfTel").stop().show(300);
        });
        $(".index-xf-li3 a").mouseout(function(){
           $(".xfTel").stop().hide(300);
        });
		
        
        var h= document.documentElement.clientHeight || document.body.clientHeight;
        var sTop=parseInt(h/2-291/2);
        $(".index-xf").css({"top":sTop});
    });
 </script>
 <script type="text/javascript" src="/Public/web/2016/js/scrolltext.js"></script>
 <script type="text/javascript">
        
        if(document.getElementById("jsfoot02")){
            var scrollup = new ScrollText("jsfoot02");
            scrollup.LineHeight = 22;        //单排文字滚动的高度
            scrollup.Amount = 1;            //注意:子模块(LineHeight)一定要能整除Amount.
            scrollup.Delay = 20;           //延时
            scrollup.Start();             //文字自动滚动
            scrollup.Direction = "up";   //默认设置为文字向上滚动
        }
        </script>


	<!--  ptmind的热力图分析代码-->
<script type="text/javascript">
    window._pt_lt = new Date().getTime();
    window._pt_sp_2 = [];
    _pt_sp_2.push('setAccount,142b1723');
    var _protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    (function() {
        var atag = document.createElement('script'); atag.type = 'text/javascript'; atag.async = true;
        atag.src = _protocol + 'js.ptengine.cn/pta.js';
        var stag = document.createElement('script'); stag.type = 'text/javascript'; stag.async = true;
        stag.src = _protocol + 'js.ptengine.cn/pts.js';
        var s = document.getElementsByTagName('script')[0]; 
        s.parentNode.insertBefore(atag, s); s.parentNode.insertBefore(stag, s);
    })();
</script>

	  <!--谷歌统计代码-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46195401-1', 'auto');
  ga('send', 'pageview');

</script>



<!--获取手机号代码-->
<!--<script type='text/javascript'>document.write("<scr"+"ipt type='text/javascript' src='http://ww1.seoyx.net/m7/?jsuid=16&r="+new Date().getTime()+"'><\/script>");</script>-->
<!--获取手机号代码-->

<!--唯众DSP渠道-->
<script type="text/javascript">
var _py = _py || [];
_py.push(['a', 'tG..Q7Fx4-PNjuKaCidlzwGtc0']);
_py.push(['domain','stats.ipinyou.com']);
_py.push(['e','']);
-function(d) {
var s = d.createElement('script'),
e = d.body.getElementsByTagName('script')[0]; e.parentNode.insertBefore(s, e),
f = 'https:' == location.protocol;
s.src = (f ? 'https' : 'http') + '://'+(f?'fm.ipinyou.com':'fm.p0y.cn')+'/j/adv.js';
}(document);
</script>
<noscript><img src="//stats.ipinyou.com/adv.gif?a=tG..Q7Fx4-PNjuKaCidlzwGtc0&e=" style="display:none;"/></noscript>

<!--唯众DSP渠道 END-->


<?php if($Promoter == ''): ?><script>

document.write("<scr"+"ipt src=\"http://gate.looyu.com/31779/<?php echo ($cityinfo["LEYUTID"]); ?>.js\"></sc"+"ript>");
</script><?php endif; ?>
<script>
(function(){
    var bp = document.createElement('script');
    bp.src = '//push.zhanzhang.baidu.com/push.js';
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
<script type="text/javascript">
	function pyConsultPyL(){
	var w=window,d=document,e=encodeURIComponent;
	var b=location.href,c=d.referrer,f,g=d.cookie,h=g.match(/(^|;)\s*ipycookie=([^;]*)/),i=g.match(/(^|;)\s*ipysession=([^;]*)/);
	if (w.parent!=w){f=b;b=c;c=f;};u='//stats.ipinyou.com/cvt?a='+e('tG.GCs.YrnyZF3BsWRUPp8nRDeO00')+'&c='+e(h?h[2]:'')+'&s='+e(i?i[2].match(/jump\%3D(\d+)/)[1]:'')+'&u='+e(b)+'&r='+e(c)+'&rd='+(new Date()).getTime()+'&e=';
	(new Image()).src=u;
}

	var lxbCbInputBtnBindedOne = false;
	var lxbCbInputBtnBindedTwo = false;
	var _interval = window.setInterval(function(){
		//在线咨询（右侧）
		if($('.icoTc').length>0 && !lxbCbInputBtnBindedOne){
			$('.icoTc').bind("click",function(){
				pyConsultPyL();
			});
			lxbCbInputBtnBindedOne = true;
		}
		
		//在线咨询（悬浮窗）
		if($('#doyoo_mon_accept').length>0 && !lxbCbInputBtnBindedTwo){
			$('#doyoo_mon_accept').bind("click",function(){
				pyConsultPyL();
			});
			lxbCbInputBtnBindedTwo = true;
		}
		if(lxbCbInputBtnBindedOne && lxbCbInputBtnBindedTwo){
			window.clearInterval(_interval);
		}
	},200);
</script>


<!-- 问卷调查 -->
<style>
  .wjdc{
    float: left;
    position: fixed;
    left: 0px;
    bottom: 0px;
  }
</style>
<div class="wjdc"><a href="http://tp.sojump.cn/jq/9033179.aspx" rel="nofollow" target="_blank"><img src="http://www.sc.cc/public/web/images/pcImg.jpg"></a></div>
</body>
</html>