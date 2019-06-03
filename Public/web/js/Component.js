// JavaScript Document
$(function(){
	selectDown();//jq模拟下拉选择
	InputPlaceholder();//处理input的placeholder
	MessageTips();//信息浏览器右侧底部弹
	
});

function addCookie() { // 加入收藏
	if (document.all) {
		window.external.addFavorite('http://www.sc.cc/', '实创装饰-让家居生活更幸福！');
	}
	else if (window.sidebar) {
		window.sidebar.addPanel('实创装饰-让家居生活更幸福！', 'http://www.sc.cc', "");
	}
};

//tab 切换
function tabDemo(DeMtabN,DeMtabBody){
	 var $DeMtabName=$(DeMtabN);
	 var $DeMtabBody=$(DeMtabN).parents('.demo-TabName').nextAll('.demo-TabWrap');
	 $DeMtabName.addClass('t-active').siblings().removeClass('t-active');
	 $DeMtabBody.children('.demo-TabBody').eq($DeMtabName.index()).show().siblings().hide();
};

//******************扩展插件******************//
$.fn.extend({
	poupDailog : function(obj){
				 var $this=$(this);
				 var objId=$(obj).attr('id');
				 $this.on('click',function(){
					poupPOs();//弹出框定位计算
					$('#'+objId).fadeIn();
				  });
			    }
	
});
//弹框效果封装 结束
function poupPOs(){
	var $poupContent=$('.poup-content'),
	    $poupMark=$('.poup-mark'),
	    poupContentW=$poupContent.width()/2,
		poupContentH=$poupContent.height()/2;
        $poupContent.css({'margin-left':-poupContentW,'margin-top':-poupContentH,'top':'50%','left':'50%'});
		$poupMark.fadeIn();
//		$poupMark.on('click',function(){
//			$('.poup-content').fadeOut();
//			$(this).fadeOut();
//		});
};
function closeDailog(){
	$('.poup-mark').fadeOut();
	$('.poup-content').fadeOut();
}
//******************扩展插件 结束******************//

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

//处理input的placeholder
function InputPlaceholder(){
	$('input:text').each(function(){  
		var txt = $(this).val();  
		$(this).focus(function(){  
		   if(txt === $(this).val()) $(this).val("");  
		}).blur(function(){  
			if($(this).val() == "") $(this).val(txt);  
			});  
		});	
};
//处理input的placeholder 

//信息浏览器右侧底部弹框
function MessageTips(){
	var MessageBox=$('.message-tipx-layout'),
	    CloseMessage=$('.close-m');
	var MessageState=true;
	
	if(MessageState){
		MessageBox.animate({bottom:0},1000);
	}else{
		MessageBox.animate({bottom:-110});
	};
	
	//点击关闭
	CloseMessage.on('click',function(){
		MessageBox.animate({bottom:-110});
	});
	
}