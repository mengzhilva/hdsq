
var $ = jQuery;
$(function () {
	// 滚动导航定位
	window.onscroll = function () {
		if ($(this).scrollTop() >= 100) {
			$('.subnav').addClass('pos');
		} else {
			$('.subnav').removeClass('pos');
		}
	}

	// 弹出登陆框
	$('.nav .links .tips a, .subnav .content .oper .video').click(showLoginForm);

	// 点击遮罩隐藏登陆框和遮罩层
	$('#login .close').bind('mousedown',function () {
		$('#login').hide();
		$('html').css('overflow', 'auto') || $('body').css('overflow', 'auto');
	});

	// 加入收藏夹
	$('.favorites a').eq(0).click(function () {
		favorites(document.title,window.location);
		return false;
	});

	// 回顶部
	$(window).bind('scroll', function () {
		if ($(this).scrollTop() >= 500) {
			$('#scrollTop').fadeIn('normal');
		} else {
			$('#scrollTop').fadeOut('normal');
		}
	});

	$('#scrollTop').bind('click', function () {
		$('html,body').animate({scrollTop : 0}, 500);
	});

	// 浮窗登录函数
	function showLoginForm () {
		if ($('.tips a').html() == '[三分钟看装修]') {
			$('#cover').show().animate({opacity : 0.7}, '300').css('height',$('body').height());
			$('#login').show();
			toCenter($('#login')[0]);
			$('html').css('overflow', 'hidden') || $('body').css('overflow', 'hidden');
			return false;
		}
	}

	$('a[rel=gallery]').lightBox({
        imageLoading: 'js/lightbox/images/lightbox-ico-loading.gif', // (string) Path and the name of the loading icon
        imageBtnPrev: 'js/lightbox/images/lightbox-btn-prev.gif', // (string) Path and the name of the prev button image
        imageBtnNext: 'js/lightbox/images/lightbox-btn-next.gif', // (string) Path and the name of the next button image
        imageBtnClose: 'js/lightbox/images/lightbox-btn-close.gif', // (string) Path and the name of the close btn
        imageBlank: 'js/lightbox/images/lightbox-blank.gif', // (string) Path and the name of a blank image (one pixel)
        txtImage: '图片',
        txtOf: '/'
    });

    $('a[rel=gallery2]').lightBox({
        imageLoading: 'js/lightbox/images/lightbox-ico-loading.gif', // (string) Path and the name of the loading icon
        imageBtnPrev: 'js/lightbox/images/lightbox-btn-prev.gif', // (string) Path and the name of the prev button image
        imageBtnNext: 'js/lightbox/images/lightbox-btn-next.gif', // (string) Path and the name of the next button image
        imageBtnClose: 'js/lightbox/images/lightbox-btn-close.gif', // (string) Path and the name of the close btn
        imageBlank: 'js/lightbox/images/lightbox-blank.gif', // (string) Path and the name of a blank image (one pixel)
        txtImage: '图片',
        txtOf: '/'
    });

    $('a[rel=gallery3]').lightBox({
        imageLoading: 'js/lightbox/images/lightbox-ico-loading.gif', // (string) Path and the name of the loading icon
        imageBtnPrev: 'js/lightbox/images/lightbox-btn-prev.gif', // (string) Path and the name of the prev button image
        imageBtnNext: 'js/lightbox/images/lightbox-btn-next.gif', // (string) Path and the name of the next button image
        imageBtnClose: 'js/lightbox/images/lightbox-btn-close.gif', // (string) Path and the name of the close btn
        imageBlank: 'js/lightbox/images/lightbox-blank.gif', // (string) Path and the name of a blank image (one pixel)
        txtImage: '图片',
        txtOf: '/'
    });

    $('a[rel=gallery4]').lightBox({
        imageLoading: 'js/lightbox/images/lightbox-ico-loading.gif', // (string) Path and the name of the loading icon
        imageBtnPrev: 'js/lightbox/images/lightbox-btn-prev.gif', // (string) Path and the name of the prev button image
        imageBtnNext: 'js/lightbox/images/lightbox-btn-next.gif', // (string) Path and the name of the next button image
        imageBtnClose: 'js/lightbox/images/lightbox-btn-close.gif', // (string) Path and the name of the close btn
        imageBlank: 'js/lightbox/images/lightbox-blank.gif', // (string) Path and the name of a blank image (one pixel)
        txtImage: '图片',
        txtOf: '/'
    });
    $('a[rel=gallery5]').lightBox({
        imageLoading: 'js/lightbox/images/lightbox-ico-loading.gif', // (string) Path and the name of the loading icon
        imageBtnPrev: 'js/lightbox/images/lightbox-btn-prev.gif', // (string) Path and the name of the prev button image
        imageBtnNext: 'js/lightbox/images/lightbox-btn-next.gif', // (string) Path and the name of the next button image
        imageBtnClose: 'js/lightbox/images/lightbox-btn-close.gif', // (string) Path and the name of the close btn
        imageBlank: 'js/lightbox/images/lightbox-blank.gif', // (string) Path and the name of a blank image (one pixel)
        txtImage: '图片',
        txtOf: '/'
    });



});

//加入收藏夹
function favorites(sTitle,sURL) {       
   try {
		window.external.addFavorite(sURL, sTitle);
	}
	catch (e) {
		try {
			window.sidebar.addPanel(sTitle, sURL, "");
		}
		catch (e) {
			alert("加入收藏失败，请使用Ctrl+D进行添加");
		}
	}
}

/**
 浮窗居中函数，当前窗口高度除以2减去元素本身高度的一半加上滚动条高度＝居中
*/ 
function toCenter (oDiv) {
	var l = ($(window).width()) / 2 - $(oDiv).width() / 2 + $(window).scrollLeft();
	var t = ($(window).height()) / 2 - ($(oDiv).height() / 2) + $(document).scrollTop() - 120; // 减去120向上提比完全居中效果更佳
	$(oDiv).css('left', l).css('top', parseInt(t));
}

