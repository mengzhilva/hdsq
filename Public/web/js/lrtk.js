$(function(){
	//将内容插入到body开始处，页面加载完毕后自动展开
	$('body').prepend("<div class='lrtk'><a href='http://www.lanrentuku.com/' target='_blank' class='link'></a></div>");
	$('.lrtk').slideDown(1500,function(){
		$('.lrtk').append("<a href='javascript:;' class='up'></a>");									  
	});	
	$('.lrtk').append("<a href='javascript:;' class='scGgMain'></a>");
	$('.lrtk').append("<a href='javascript:;' class='scInfoBar'></a>");
	$('.lrtk').append("<a href='javascript:;' class='scGwBar'></a>");
	$(".close").click(function(){
		$(".lrtk").animate({
			height:'0'						 
		});
	});
	//设置延时函数
	function adsUp(){
		$('.lrtk').animate({
			height:'100px'						 
		},1000,function(){
			$(this).find('.up').addClass('down').removeClass('up');	
		});	
	}
	//五秒钟后自动收起
	var t = setTimeout(adsUp,5000);
	//点击收起
	$('.lrtk a.up').live('click',function(){
		clearTimeout(t);
		$('.lrtk').animate({
			height:'100px'						 
		},function(){
			$(this).find('.up').addClass('down').removeClass('up');	
		});	 
	});	
	
	//点击下拉
	$('.lrtk a.down').live('click',function(){
		$(this).css({
			opacity:'0'	,
			filter:'alpha(opacity=0)'
		});
		$('.lrtk').css({
			height:'1080px'
		},function(){
			$(this).find('.down').addClass('up').removeClass('down').css({opacity:'1',filter:'alpha(opacity=100)'});
		});	 
	});
});