$(document).ready(function(){
	var topMain=336//是头部的高度加头部与nav导航之间的距离
	$(".nav_scroll").css("display","none");
	$(window).scroll(function(){
		if($(window).scrollTop()>topMain){ 
			//如果滚动条顶部的距离大于topMain则就nav_scroll导航显示，否则就隐藏
			$(".nav_scroll").css("display","block");
		}else{
			$(".nav_scroll").css("display","none");
		}
	});
})

function ShowSpecialImg2s(Curr2s, Count2s){
	for (var i=1; i <= Count2s; i ++){
			if  (i == Curr2s){
				document.getElementById("zxrj_img_"+i).style.display='';
			}else{
				document.getElementById("zxrj_img_"+i).style.display='none';
			}
	}
}

function baoming(){
  var city=$("#city").val();
  var yu=$("#yu").val();
  var diag = new Dialog();
  diag.Width = 620;
  diag.Height = 300;
  diag.Title = "申请免费预约";
  diag.URL = "http://"+yu+"/"+city+"/package/baoming";
  diag.show();
}
