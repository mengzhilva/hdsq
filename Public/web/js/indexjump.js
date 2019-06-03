
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