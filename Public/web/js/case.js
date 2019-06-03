	$(function(){
		//alert("刷新一次！");
	});

	//加背景颜色
	function addBgcolor(){
		$(this).addClass(".bg-color");
	}
	
	//案例样式选择
	function sechStyle(a,val){
		var housestyle = document.getElementById("housestyle");
		housestyle.value = val;
		submit();
	}

	//案例户型选择
	function sechHu(a,val){
		var housestyle = document.getElementById("househu");
		housestyle.value = val;
		submit();
	}

	//案例空间选择
	function sechKong(a,val){
		var housestyle = document.getElementById("housekong");
		housestyle.value = val;
		submit();
	}

	//案例面积选择
	function sechArea(a,val){
		var housestyle = document.getElementById("housearea");
		housestyle.value = val;
		submit();
	}

	//案例类型选择：3D 非3D
	function sechCase(a,val){
		var caseclass = document.getElementById("caseclass");
		caseclass.value = val;
		submit();
	}

	//案例排序：默认 热门 最新
	function setType(a,val){
		/*if(val!='default' && val!=''){
			$("#d_type").removeClass("bg-color");
		}*/
		var sechtype = document.getElementById("sechtype");
		sechtype.value = val;
		submit();
	}

	//提交搜选链接
	function submit(){
		var housestyle = ($("#housestyle").val()!="")?($("#housestyle").val()):null;
		var househu = ($("#househu").val()!="")?($("#househu").val()):null;
		var housekong = ($("#housekong").val()!="")?($("#housekong").val()):null;
		var housearea = ($("#housearea").val()!="")?($("#housearea").val()):null;
		
		var sechtype  = ($("#sechtype").val()!="")?($("#sechtype").val()):null;
		var caseclass  = ($("#caseclass").val()!="")?($("#caseclass").val()):null;
		
		var casefunction = '';
		
		var lian = "";

		if(housestyle!=null){
			lian += "/housestyle/"+housestyle;
		}
		if(househu!=null){
			lian += "/househu/"+househu;
		}
		if(housekong!=null){
			lian += "/housekong/"+housekong;
		}
		if(housearea!=null){
			lian += "/housearea/"+housearea;
		}
		if(caseclass!=null){
			lian += "/caseclass/"+caseclass;
		}
		if(sechtype!=null){
			lian += "/sechtype/"+sechtype;
		}

		//alert(lian);


		var city=$("#city").val();
		var yu=$("#yu").val();

		if(caseclass=='' || caseclass==null){
			//casefunction = "meitu";
			//caseclass = "meitu";
			casefunction = $("#function").val();
			if(casefunction=='best' || casefunction=='detail3d'){
				casefunction = "meitu";
			}
		}else{
			casefunction = caseclass;
		}

		var url = "http://"+yu+"/"+city+"/xiaoguotu/"+casefunction;
		
		if(housestyle!=null || househu!=null || housekong!=null || housearea!=null || sechtype!=null){
			//window.location.href=encodeURI(url+"/housestyle/"+housestyle+"/househu/"+househu+"/housekong/"+housekong+"/housearea/"+housearea+"/caseclass/"+caseclass+"/sechtype/"+sechtype);
			window.location.href=encodeURI(url+lian+"#dcase_list");
		}else{
			window.location.href=encodeURI(url+"#dcase_list");
		}

	}

	//提交免费户型设计
	function sub_fhdesign(){
		var c=$("#community").val();
		var a=$("#area").val();
		var n=$("#name").val();
		var p=$("#phone").val();

		var city=$("#city").val();
		var yu=$("#yu").val();

		var reg = /^[\u4e00-\u9fa5]+$/i;
		
		//验证输入的小区名是否是汉字
		if(!reg.test(c)){
			alert("请正确输入小区名称！");
			return false;
		}
		
		//验证面积值是否为数字
		if(a!=''){
			if(isNaN(a)){
				alert("请正确输入建筑面积！");
				return false;
			}else{
				if(a>10000 || a<10){
					alert("请确保面积数值在10-10000之间！");
					return false;
				}
			}
		}else{
			alert("建筑面积不能为空！");
				return false;
		}
		
		//验证姓名是否为2-4个汉字
		if(!reg.test(n)){
			alert("请正确输入姓名！");
			return false;
		}else{
			if(n.length>4){
				alert("姓名为2-4个汉字！");
				return false;
			}
		}
		
		//验证电话是否为13|4|5|8打头的11位数字
		if(!p.match(/^1[3|4|5|8|7][0-9]\d{8}$/)){
			alert("请正确输入11位手机号！");
			return false;
		}

		$.post("http://"+yu+"/"+city+"/xiaoguotu/sub_fhdesign",{community:c,area:a,NAME:n,PHONE:p},function(msg){
			if(msg==2){
				alert("该预约已存在！");
				$("#community").val("");
				$("#area").val("");
				$("#name").val("");
				$("#phone").val("");
				return false;
			}else if(msg==1){
				$("#community").val("");
				$("#area").val("");
				$("#name").val("");
				$("#phone").val("");
				alert("信息已提交，我们会尽快给您方案！");
			}else{
				alert("提交失败！");
			}
		});
	}

	//处理搜索
	function sub_key(n){
		if(n!=''){
			var fun = n;
			var key = $("#keywords").val();
			if(key!="请输入您想查找"){
				var url = "http://www.sc.com/xiaoguotu/"+fun;
				window.location.href=encodeURI(url+"/keywords/"+key);
			}else{
				alert("您还没有输入查找的关键字");
				return false;
			}
		}
	}

	document.onkeydown=function(event){ 
        e = event ? event :(window.event ? window.event : null); 
        if(e.keyCode==13){ 
            //执行的方法  
			var n = $("#ye_name").val();
			sub_key(n);
        } 
    } 