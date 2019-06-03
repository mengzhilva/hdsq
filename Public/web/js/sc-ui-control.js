// JavaScript Document
$(function(){
	desList();//设计师首页列表处理
});

//设计师首页列表处理
function desList(){
	$('.des-list-ul li:nth-child(4n)').css({'margin-right':'0'});
};

$(function(){
	$("#side-slide").mSlide({
		isAuto:true,//是否自动轮播
        moveWidth:260,
        roundSpeed: 3000
	});
	$("#honor-banner").mSlide({
		isAuto:false,//是否自动轮播
        moveWidth:780,
        roundSpeed: 3000
	});
	$('.represent').hover(
		function(){
			$(this).find('.floor').show();
		},
		function(){
			$(this).find('.floor').hide();
		}
	)
});
