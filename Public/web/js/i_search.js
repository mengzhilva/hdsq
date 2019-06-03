
	$(function(){
		$("a").dblclick(function(){
			var fx = $("#fxing").val();
			if(fx!=''){
				choose('area');
			}
			var style = $("#style").val();
			if(style!=''){
				choose('color');
			}
			var color = $("#color").val();
			if(color!=''){
				choose('result');
			}
		});
	});

	document.onkeydown=function(event){ 
        e = event ? event :(window.event ? window.event : null); 
        if(e.keyCode==13){ 
            //执行的方法  
			//var area = $("#area").val();
			// choose('style');
			 if(event){

                    e.returnValue = false; 

                }else{                    

                    e.preventDefault();

                }    
        } 
    } 
	
	//智能搜索进入各页面
	function choose(s){
		var city=$("#city").val();
		var yu=$("#yu").val();
var nowurl=window.location.href;

if(nowurl.indexOf("reno_process")>0){
	var ch = "";
		if(s=='area'){
			var fxing = $("#fxing").val();
			if(fxing!=''){
				ch = $("#fxing").val();
			}else{
				alert("请选择房型！");
				return false;
			}

		}
}

		if(s=='style'){
			var area = $("#area").val();
			//获取面积值
			if(area!=''){
				if(isNaN(area)){
					alert("请正确输入建筑面积！");
					return false;
				}else{
					if(area>1000 || area<10){
						alert("请确保面积数值在10-1000之间！");
						return false;
					}
				}
			}else{
				alert("面积不能为空！");
				return false;
			}
			
			ch = $("#area").val();
		}
		if(s=='color'){
			var style = $("#style").val();
			if(style==''){
				alert("请选择风格！");
				return false;
			}
			//获取风格
			ch = $("#style").val();

		}
		if(s=='result'){
			var color = $("#color").val();
			if(color==''){
				alert("请选择色系！");
				return false;
			}
			//获取色系
			ch = $("#color").val();
		}
		if(ch!=''){
			$.get("http://"+yu+"/"+city+"/xiaoguotu/storage/",{step:s,cn:ch},function(msg){
				if(msg==4){
					location.href="http://"+yu+"/"+city+"/xiaoguotu/intelligent_search/step/area#reno_process"
				}
				else if(msg==1){
					location.href="http://"+yu+"/"+city+"/xiaoguotu/intelligent_search/step/style#hold";
				}else if(msg==2){
					location.href="http://"+yu+"/"+city+"/xiaoguotu/intelligent_search/step/color#hold";
				}else if(msg==3){
					location.href="http://"+yu+"/"+city+"/xiaoguotu/intelligent_search/step/result#reno_process";
				} 
			});
		}
		
	}

	//存取房型
	function fxing(val){
		if(val=='新房'){
			$("#fx_new").addClass("hover");
			$("#fx_old").removeClass("hover");
		}else if(val=='老房'){
			$("#fx_old").addClass("hover");
			$("#fx_new").removeClass("hover");
		}
		var style = document.getElementById("fxing");
		style.value = val;
	}

	//存取样式
	function styles(val){
		if(val=="欧式"){
			$("#li_1").addClass("hover");
			$("#li_2").removeClass("hover");
			$("#li_3").removeClass("hover");
			$("#li_4").removeClass("hover");
			$("#li_5").removeClass("hover");
			$("#li_6").removeClass("hover");
		}
		if(val=="中式"){
			$("#li_1").removeClass("hover");
			$("#li_2").addClass("hover");
			$("#li_3").removeClass("hover");
			$("#li_4").removeClass("hover");
			$("#li_5").removeClass("hover");
			$("#li_6").removeClass("hover");
		}
		if(val=="现代简约"){
			$("#li_1").removeClass("hover");
			$("#li_2").removeClass("hover");
			$("#li_3").addClass("hover");
			$("#li_4").removeClass("hover");
			$("#li_5").removeClass("hover");
			$("#li_6").removeClass("hover");
		}
		if(val=="乡村田园"){
			$("#li_1").removeClass("hover");
			$("#li_2").removeClass("hover");
			$("#li_3").removeClass("hover");
			$("#li_4").addClass("hover");
			$("#li_5").removeClass("hover");
			$("#li_6").removeClass("hover");
		}
		if(val=="地中海"){
			$("#li_1").removeClass("hover");
			$("#li_2").removeClass("hover");
			$("#li_3").removeClass("hover");
			$("#li_4").removeClass("hover");
			$("#li_5").addClass("hover");
			$("#li_6").removeClass("hover");
		}
		if(val=="其他"){
			$("#li_1").removeClass("hover");
			$("#li_2").removeClass("hover");
			$("#li_3").removeClass("hover");
			$("#li_4").removeClass("hover");
			$("#li_5").removeClass("hover");
			$("#li_6").addClass("hover");
		}
		var style = document.getElementById("style");
		style.value = val;
	}
	//存取色系
	function colors(val){
		if(val=="深蓝"){
			$("#color1").addClass("hover");
			$("#color2").removeClass("hover");
			$("#color3").removeClass("hover");
			$("#color4").removeClass("hover");
			$("#color5").removeClass("hover");
			$("#color6").removeClass("hover");
		}
		if(val=="浅蓝"){
			$("#color1").removeClass("hover");
			$("#color2").addClass("hover");
			$("#color3").removeClass("hover");
			$("#color4").removeClass("hover");
			$("#color5").removeClass("hover");
			$("#color6").removeClass("hover");
		}
		if(val=="青白"){
			$("#color1").removeClass("hover");
			$("#color2").removeClass("hover");
			$("#color3").addClass("hover");
			$("#color4").removeClass("hover");
			$("#color5").removeClass("hover");
			$("#color6").removeClass("hover");
		}
		if(val=="火红"){
			$("#color1").removeClass("hover");
			$("#color2").removeClass("hover");
			$("#color3").removeClass("hover");
			$("#color4").addClass("hover");
			$("#color5").removeClass("hover");
			$("#color6").removeClass("hover");
		}
		if(val=="橙色"){
			$("#color1").removeClass("hover");
			$("#color2").removeClass("hover");
			$("#color3").removeClass("hover");
			$("#color4").removeClass("hover");
			$("#color5").addClass("hover");
			$("#color6").removeClass("hover");
		}
		if(val=="暖黄"){
			$("#color1").removeClass("hover");
			$("#color2").removeClass("hover");
			$("#color3").removeClass("hover");
			$("#color4").removeClass("hover");
			$("#color5").removeClass("hover");
			$("#color6").addClass("hover");
		}
		var color = document.getElementById("color");
		color.value = val;
	}
	//提交智能搜索结果
	function sub_search(){

		var area = $("#s_area").text();
		var style= $("#s_style").val();
		var color= $("#s_color").val();

		var city=$("#city").val();
		var yu=$("#yu").val();

		var url = "http://"+yu+"/"+city+"/xiaoguotu/meitu/area/"+area+"/houseStyle/"+style+"/color/"+color;
		window.location.href=encodeURI(url);
	}