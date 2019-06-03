$(function(){
	if($('.nalist-wrap')){
		$(".index-nav .select").hover(
			function(){
				$('#whitebg').show();
				$(this).find('i').show();
				$(this).next('.nalist-wrap').show();
			},
			function(){
				$('#whitebg').hide();
				$(this).find('i').hide();
				$(this).next('.nalist-wrap').hide();
			}
		)
		$(".index-nav .nalist-wrap").hover(
			function(){
				$('#whitebg').show();
				$(this).prev('.select').find('i').show();
				$(this).show();
			},
			function(){
				$('#whitebg').hide();
				$(this).prev('.select').find('i').hide();
				$(this).hide();
			}
		)
	}
})

$(function(){
    //获得文本框对象
    /*var t = $(".min").parents('.text_box-wrap').find(".text_box");
	 if (parseInt(t.val())==1){
		$(".text_box").parents('.text_box-wrap').find('.min').attr('disabled',true);
	 }*/
    //数量增加操作
    /*$(".add").click(function(){  
		var t = $(this).parents('.text_box-wrap').find(".text_box");  
         $(this).parents('.text_box-wrap').find(".text_box").val(parseInt(t.val())+1)
        if (parseInt(t.val())!=1){
            $(this).parents('.text_box-wrap').find('.min').attr('disabled',flase);
        }
        setTotal();
    }) 
    $(".min").click(function(){
		var t = $(this).parents('.text_box-wrap').find(".text_box");
        $(this).parents('.text_box-wrap').find(".text_box").val(parseInt(t.val())-1);
        if (parseInt(t.val())==1){
            $(this).parents('.text_box-wrap').find('.min').attr('disabled',true);
        }
        setTotal();
    })*/
	
	$(".add").click(function(){ 
		var t=$(this).parent().find('input'); 
		t.val(parseInt(t.val())+1) 
		sumprice(parseInt(t.val()));
	}) 
	$(".min").click(function(){ 
		var t=$(this).parent().find('input'); 
		t.val(parseInt(t.val())-1) ;
		sumprice(parseInt(t.val()));
		if(parseInt(t.val())<1){ 
			t.val(1); 
		} 
	})
	
})
function sumprice(n){
	var danjia = $("#danjia").html();
	var sum = danjia*n;
	if(n>=1){
		$("#sumprice").html("￥"+sum);
	}
}
$(function(){
	
	/*倒计时*/
	// var intDiff = parseInt(12000);//倒计时总秒数量
	var intDiff = $(".timer").attr("id");
	
	function timer(intDiff){
		window.setInterval(function(){
		var day=0,
			hour=0,
			minute=0,
			second=0;//时间默认值        
		if(intDiff > 0){
			day = Math.floor(intDiff / (60 * 60 * 24));
			hour = Math.floor(intDiff / (60 * 60)) - (day * 24);
			minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);
			second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);
		}
		if (minute <= 9) minute = '0' + minute;
		if (second <= 9) second = '0' + second;
		$('#day_show').html(day+"天");
		$('#hour_show').html('<s id="h"></s>'+hour+'时');
		$('#minute_show').html('<s></s>'+minute+'分');
		$('#second_show').html('<s></s>'+second+'秒');
		intDiff--;
		}, 1000);
	} 
	timer(intDiff);
	
	$('.demo-TabName li').hover(function(){
		 var that=this;
		 timer = setTimeout(function(){
			 tabDemo($(that));
		   },200);
		 },function(){
		clearTimeout(timer);
	});
	
	$('.video-list li').hover(
		function(){
			$(this).find('.title').hide();
			$(this).find('.shadow').animate({height:'+158px'},'normal');
		},
		function(){
			$(this).find('.title').show();
			$(this).find('.shadow').animate({height:'-158px'},'normal');
		}
	)
	$('.index-3 li').hover(
		function(){
			$(this).find('.shadow').stop().animate({height:'+130px'},'normal');
		},
		function(){
			$(this).find('.shadow').stop().animate({height:'-130px'},'normal');
		}
	)
	$('.index-4 li').hover(
		function(){
			$(this).find('.shadow').animate({height:'+158px'},'normal');
		},
		function(){
			$(this).find('.shadow').animate({height:'-158px'},'normal');
		}
	)
	$('.close').click(function(){
		$(this).parents('.tips').hide();
	})
	$('.yangban-list li').hover(
		function(){
			$(this).find('.bgwraper').animate({height:'+430px'},'normal');
			$(this).find('.d3').show();
		},
		function(){
			$(this).find('.bgwraper').animate({height:'-430px'},'normal');
			$(this).find('.d3').hide();
		}
	)
	$('.square-bottom li').hover(
		function(){
			$(this).find('.shadow').stop().animate({height:'+220px'},'normal');
		},
		function(){
			$(this).find('.shadow').stop().animate({height:'-220px'},'normal');
		}
	)
	$('.photob').hover(
		function(){
			$(this).find('.floor').show();
		},
		function(){
			$(this).find('.floor').hide();
		}
	)
	$('.floor-02 li').hover(
		function(){
			$(this).find('.apply-free').animate({width:'+88px'},'normal');
		},
		function(){
			$(this).find('.apply-free').animate({width:'-88px'},'normal');
		}
	)
	$('.floor-03 li').hover(
		function(){
			$(this).find('.btm-slid').animate({height:'+30px'},'normal');
		},
		function(){
			$(this).find('.btm-slid').animate({height:'-30px'},'normal');
		}
	)
	$('.photo-choose li').hover(
		function(){
			$(this).find('.shadow').animate({height:'+150px'},'normal');
			$(this).find('h3').show();
		},
		function(){
			$(this).find('.shadow').animate({height:'-150px'},'normal');
			$(this).find('h3').hide();
		}
	)
})
/*tab切换*/
$(function(){
	$('.demo-TabName .pink').hover(function(){
		 var that=this;
		 timer = setTimeout(function(){
			 tabDem($(that));
		   },200);
		 },function(){
		clearTimeout(timer);
	});

})

function tabDem(DeMtabN,DeMtabBody){
	 var $DeMtabName=$(DeMtabN);
	 var $DeMtabBody=$(DeMtabN).parents('.demo-TabName').prevAll('.square-01 .demo-TabWrap');
	 $DeMtabName.addClass('gray').siblings().removeClass('gray');
	 var tabItems=$DeMtabBody.children('.demo-TabBody');
	 var i=$DeMtabName.index();
	 tabItems.eq(i).show().siblings().hide();
	 /*m_lazyDom(tabItems,i);*/
	
};
// JavaScript Document
function AdvImg(){
	var $AdvContainer=$('.squee-adv .squee-adv-ul'),
		$AdvLength=$AdvContainer.children('li');
		$AdvSubImg=$AdvContainer.find('.adv-sub-img'),
		$AdvBigImg=$AdvContainer.find('.adv-big-img');
	 $AdvLength.on('mouseenter',function(){
		  $(this).parent().find($AdvBigImg).hide();
		  $(this).parent().find($AdvSubImg).show(500);
		  $(this).find($AdvBigImg).show().css({'margin-right':'5px'});
		  $(this).find($AdvSubImg).hide();

	 });
};


$(function(){
	/*$("#index-banner").mSlide({
		isAuto:true,//是否自动轮播
        moveWidth:1920,
        roundSpeed: 3000
	});
	$("#side-slide").mSlide({
		isAuto:true,//是否自动轮播
        moveWidth:260,
        roundSpeed: 3000
	});
	$("#designer-banner").mSlide({
		isAuto:false,//是否自动轮播
        moveWidth:1180,
        roundSpeed: 3000
	});*/
})

//jq模拟下拉选择
function selectDown(){
	var $selectInput=$('.select-input,.choose-down');
	var $selectDownList=$('.select-down-list');
	var $selectDownListIetm=$selectDownList.find('span');
	var downListMaxHeight=$selectDownListIetm.eq(1).height();
	
	
	$selectInput.on('click',function(){
		var selectLenght=$(this).next('.select-down-list').children().length;
		var selectInputWidth=$(this).width()+parseInt($(this).css('margin-left'))+parseInt($(this).css('padding-left'));
		$(this).nextAll('.select-down-list').width(selectInputWidth);
		//$(this).nextAll('.select-down-list').css({left:$selectInput.position().left});
		if(selectLenght>5){
				$selectDownList.css({'height':downListMaxHeight*5+'px','overflow-y':'auto'});
		 };//处理最大高度
		 $selectDownList.hide();
		 $(this).parent().find($selectDownList).show(200);
		 $selectDownListIetm.on('click',function(){
			$(this).parent().parent().find($selectInput).val($(this).html());
		});
	});
	$selectDownList.on('mouseleave',function(){
		$(this).hide();
	});
	//jq模拟下拉选择 结束
	
};

/*jump m site start*/
        function IsPC()  
            {  
                       var userAgentInfo = navigator.userAgent;  
                       //alert(userAgentInfo);
                       var Agents = new Array("Android", "iPhone", "SymbianOS", "Windows Phone", "iPod");  
                       var flag = true;  
                       for (var v = 0; v < Agents.length; v++) {  
                           if (userAgentInfo.indexOf(Agents[v]) > 0) { flag = false; break; }  
                       }  
                       return flag;  
            }

            var jumpPc = IsPC();
            var Promoterid = $("#Promoterid").html();
            var citynam = $("#citynam").html();
           // alert(citynam);
            if(jumpPc==false){
            	if(Promoterid !='' && Promoterid !='undefined'){
            		window.location.href = "http://m.sc.cc"+"/index.php/index/index/city/"+citynam+".html";
            	}else{
            		window.location.href = "http://m.sc.cc";
            	}
            	
            }
/*jump m site end*/     
function change(){
    var state = $("#city_select").css('display');
    if(state == 'none'){
        var state = $("#city_select").css('display','block');
    }
    if(state == 'block'){
        var state = $("#city_select").css('display','none');
    }
}
$(function(){ 
    $(document).bind("click",function(e){ 
        var target = $(e.target); 
        var state = $("#city_select").css('display');
        if(target.closest("#city_select").length == 0 &&target.closest(".ct").length == 0 ){ 
            if(state == 'block'){
                $("#city_select").css('display','none');
            }
        } 
    }) 
});

function keyLogin(){
  if (event.keyCode==13)   //回车键的键值为13
  var l = document.getElementById("userlogin");
  if(l != null)
     l.click();  //调用登录按钮的登录事件
}
