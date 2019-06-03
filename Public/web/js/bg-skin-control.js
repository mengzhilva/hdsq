var binggoNameSpace=binggoNameSpace||{};


//顶通广告
binggoNameSpace.topActive = function () {
    var box = $('#__TOP_ACTIVE__'),
        wrap = box.find('.top-active-wrap'),
        img = wrap.find('img'),
        height = 0,
        btn = box.find('.btn'),
        cookieFlag = true;
    img.load(function(){
        height = img[0].height;
    });
    box.on('click', '.btn', function () {
        var _this = $(this);
        if (!_this.hasClass('btn-open')) {
            btn.removeClass('btn-close').addClass('btn-open').attr('title', '打开');
            if (height > 0) {
                wrap.stop(true).animate({"height": 0}, 200);
            } else {
                wrap.hide();
            }

        } else {
            btn.removeClass('btn-open').addClass('btn-close').attr('title', '关闭');
            if (height > 0) {
                wrap.stop(true).animate({"height": height}, 200);
            } else {
                wrap.show().css('height', 'auto');
            }
        }
        //写cookie，保存时间为1天
        var exp = new Date();
        exp.setTime(exp.getTime() + 24 * 60 * 60 * 1000);

        if (cookieFlag) {
            cookieFlag = false;
            document.cookie = "topActiveStatus=true;expires=" + exp;
        }
    })
};

//左侧导航条
binggoNameSpace.slideNav = function () {
	var slideLi=$('.sn-list').children('li'),
	    snListWrap=$('.slide-nav-wrap'),
	    navPoupcatsWrap=$('.nav-poupcats-wrap'),
		navPoupcatsContainer=$('.nav-poupcats'),
		navPcLL=$('.nav-poupcats-cl-l'),
		navPclR=$('.nav-poupcats-cl-r');
		/*navPcLL.css({'min-height':navPoupcatsWrap.innerHeight()});*/
		//navPcLL.height(navPoupcatsWrap.innerHeight());
	//鼠标滑过显示类别
	slideLi.on('mouseenter',function(){
		var $this=$(this);
		var navLength=$(this).index();
		var slideLiLengthOffsetT=$(this).position().top;
		navPoupcatsWrap.stop(true,true).animate({width:560},150,function(){
			navPclR.fadeIn(150);
		}).show();
		//navPoupcatsWrap.animate({left:240},500);
		navPoupcatsContainer.hide();
		navPoupcatsContainer.eq(navLength).show();
		if(navLength<=4){
			navPoupcatsWrap.css({top:slideLiLengthOffsetT,bottom:'auto'})
		}else{
			navPoupcatsWrap.css({bottom:0,top:'auto'})
		};
		$(this).delay(100).addClass('sn-li-hover').siblings().removeClass('sn-li-hover');
	});
	
	//鼠标离开显示类别
	snListWrap.on('mouseleave',function(){
		navPoupcatsWrap.stop(true,true).animate({width:0},50).hide();
		slideLi.removeClass('sn-li-hover');
		navPclR.hide();
	});
	
};



$(function(){
	binggoNameSpace.topActive();//顶通广告
	binggoNameSpace.slideNav();//左侧导航条
	/*幻灯片轮播  */
	$("#super-slide").mSlide({
		isAuto:false,//是否自动轮播
        moveWidth:950,
        roundSpeed: 4000
	});	
	$("#hufu-slide").mSlide({
		isAuto:false,//是否自动轮播
        moveWidth:370,
        roundSpeed: 4000
	});	
	$("#rh-slide").mSlide({
		isAuto:false,//是否自动轮播
        moveWidth:370,
        roundSpeed: 4000
	});	
	$("#meiti-slide").mSlide({
		isAuto:false,//是否自动轮播
        moveWidth:575,
        roundSpeed: 4000
	});	
	$("#cz-slide").mSlide({
		isAuto:false,//是否自动轮播
        moveWidth:370,
        roundSpeed: 4000
	});	
	$("#man-slide").mSlide({
		isAuto:false,//是否自动轮播
        moveWidth:370,
        roundSpeed: 4000
	});	
	$("#hw-slide").mSlide({
		isAuto:false,//是否自动轮播
        moveWidth:575,
        roundSpeed: 4000
	});	
	$("#daren-slide").mSlide({
		isAuto:false,//是否自动轮播
        moveWidth:240,
        roundSpeed: 4000
	});
});
