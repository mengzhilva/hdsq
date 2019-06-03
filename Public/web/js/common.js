/* UEFA Players Slider */
$(document).ready(function(){
	var sUserAgent = navigator.userAgent; 

	var movetime=500;	
	var maxw=500;
	var avgw= 165;	
	var index;
	var t=false; //延时执行
	var _this;


	
	$("#picon li:eq(0)").addClass("cur").css({"width":maxw+"px"});	
	$("#picon li:eq(0)").siblings("li").stop().animate({"width":avgw+"px"});
	$("#picon").find("li").mouseover(function(){									  
		_this=$(this);		
		index=$("#picon li").index( $(this)[0] );
		_this.siblings("li").removeClass("cur");
		_this.find('div').show();
		_this.stop().animate({"width":maxw+"px"},function(){
			
		});
		_this.siblings("li").stop().animate({"width":avgw+"px"});
		_this.siblings("li").find('div').hide();
	});
	
	
	
	
	
	
	

	
	
	

	
	
	getTopMenu();
	$(window).scroll(function(){
		getTopMenu();
	})
})



$(function(){
  var index=0;
  var $_picn=$(".lunbo_pic").length;
 
  setInterval(function(){
    show(index);
    index++;
    if(index==$_picn){index=0;}
  },3000);
  function show(index){
   
    $(".lunbo_pic").eq(index).fadeIn(500).siblings(".lunbo_pic").fadeOut(500);
  }
})




