// JavaScript Document
$(function(){
	typePassWord();//input 为密码格式时
	mobilePhone();//检测input为手机号
	//safeAccunt();//账户安全--获取手机验证码
	MesGcontrol();//系统消息操作控制
});

//检测input为手机号
function mobilePhone(){
	var $this=$(this);//存this值
	var MobileInput=$('.mobile-hpone'),
	    inputTips=$('.l-input-tips');
	var phoneNum =/^(?:13\d|15[89])-?\d{5}(\d{3}|\*{3})$/;//判断是否为电话格式
	MobileInput.change(function(){
		console.log('d')
	   if(!phoneNum.test(MobileInput.val())){
		   $(this).nextAll(inputTips).show();//验证错误状态
		}else if(phoneNum.test(MobileInput.val())){
		   $(this).nextAll(inputTips).show().html('<i class="ok-icon"></i>');//验证正确状态
		}
	});
}


//input 为密码格式时 使用方法：只要在input添加样式名为：input-type-password 即可
function typePassWord(){
	$('.input-type-password').each(function(){  
		var txt = $(this).val();  
		$(this).focus(function(){
		   $(this).attr('type','password');  
		   if(txt === $(this).val()) $(this).val("");  
		}).blur(function(){ 
		    $(this).attr('type','text');   
			if($(this).val() == "") $(this).val(txt);  
		  }).change(function(){
			 if($(this).val() !== txt){
				 $(this).blur(function(){
					 $(this).attr('type','password'); 
				     $(this).val($(this).val); 
				  });
			 }
		});  
	});
};


/*账户安全--获取手机验证码*/
function safeAccunt(){
	var codeNum=0;
	var timmer;
	var $getCodeBtn=$('.get-code');
	$getCodeBtn.on('click',function(){
		if($getCodeBtn.hasClass('return-false')){
			$(this).on('click',function(){
				return false;//倒计时正在运行状态时点击无效
			})
		  }else{
			$(this).html('<p class="code-container"><strong class="code-time">30</strong>秒后系统重新发送</p>');
			$codeTime=$('.code-time');
			$(this).addClass('return-false'); 
			timmer=setInterval(codeTime,1000);
			$(this).addClass('return-false');
		  };
	});//点击end
	function codeTime(){
		  codeNum++;
		   $codeTime.html((30-codeNum));
		   if(codeNum>30){
			   $getCodeBtn.removeClass('return-false');
			   codeNum=0;
			   clearInterval(timmer);
			   $getCodeBtn.html("再次获取短信校验码");
			   //alert('哈哈！验证码收到没？没收到继续获取哦！！！')
			  };
	     };//codeTime end
		 
};

//系统消息操作控制
function MesGcontrol(){
	var $mesDown=$('.mes-down'),
	    $delateMesBtn=$('.mes-down-btn'),
		$emailIcon=$('.email-icon');
	$('.vip-messaes-container').children('li:last').css({'border-bottom':'none'});
		
	var toggleState=true;
		
		$delateMesBtn.on('mousedown',function(){
			$mesDown.stop(true,true).slideUp();
			//$(this).parent().siblings().find($mesDown).stop(true,true).slideDown();
			if(toggleState){
			   $(this).parent().siblings().find($mesDown).slideDown();
			   $(this).html("收起");
			   $(this).parent().siblings().find($emailIcon).addClass('email-up');
			   toggleState=false;
			}else if(!toggleState){
			   $(this).parent().siblings().find($mesDown).slideUp();
			   $(this).html("展开");
			   $(this).parent().siblings().find($emailIcon).removeClass('email-up');
			   toggleState=true;
			};
		});
};

