

+ function($) {"use strict";

var MSlide=function (element,opt) {
	
    this.opt=$.extend(MSlide.DEFAULTS, opt);
    this.$wrap=$(element);
    this.$ctrl=this.$wrap.find(this.opt.ctrl);
    this.$prev=this.$wrap.find(this.opt.prev);
    this.$next=this.$wrap.find(this.opt.next);
    this.$items=this.$wrap.find(this.opt.items);
    this.$dotItems=this.$wrap.find(this.opt.dotItems);
    this.i=this.opt.i;
    this.len=this.$items.length;
    this.speed=this.opt.speed;
    this.rSpeed=this.opt.roundSpeed;
    this.isAuto=this.opt.isAuto;
    this.moveW=this.opt.moveWidth;
    this.manualTimer=null;
    this.autoRoundTimer=null;
    this.canSlide=true;
    this.nextI=0;
    this.preI=0;
   
    this.init(this.i);
   };
  
   MSlide.DEFAULTS={
        ctrl:".slide_screen .i-ctrl",
        prev: ".slide_screen .i-ctrl .ctrl-prev",
        next: ".slide_screen .i-ctrl .ctrl-next",
        items: ".slide_screen  .li1 .piece",
        dotItems:".slide_screen .libtn li",
        i: 0, //当前索引,默认第几个显示
        isRandom: false, //是否随机
        speed: 500,//每张图片移动的动画速度  单位 ms
		roundSpeed: 4000,//多长时间轮转更新一组图片  单位 ms
		isAuto:false,//是否自动轮播
		moveWidth:990
    };
    
   MSlide.prototype ={
   	    
   	     init:function(i){
   	       var that=this;
   	       that.$items.eq(i).show();
	 	   that.$dotItems.eq(i).addClass('selected');
	 	   that.addEvent();
	 	   if(that.isAuto){
	 	   	  that.autoSlide();
	 	   }
   	     },
   	     addEvent:function(){
			var that = this;
			that.$dotItems.hover(function() {
				var _this = $(this), index = _this.index(), left = that.moveW * index;

				that.manualTimer = setTimeout(function() {
					if (index == that.i) return;

					that.$dotItems.removeClass('selected');
					that.$dotItems.eq(index).addClass('selected');
					
					if (index > that.i) {//从右往左滑
						that.$items.eq(index).css('left', that.moveW).show().animate({
							'left' : 0
						}, that.speed);
						that.$items.eq(that.i).animate({
							'left' : -that.moveW
						}, that.speed);
					} else {
						that.$items.eq(index).css('left', -that.moveW).show().animate({
							'left' : 0
						}, that.speed);
						that.$items.eq(that.i).animate({
							'left' : that.moveW
						}, that.speed);
					}
					that.i = index;
					that.lazyImg(that.i);
				}, that.speed);
			}, function() {
				clearTimeout(that.manualTimer);
		    }); 
		     
		    //给整个滑动元素加hover事件
			that.$wrap.hover(function(ev){
			   that.$ctrl.stop(true, true).fadeIn(300);
			   that.clearAllAni();
			   },function(ev){
			   	  that.$ctrl.hide();
			   	  if(that.autoRoundTimer==null&&that.isAuto){
					 that.autoSlide();
				  } 
 			}); 
		   
			that.$next.bind("click",function() {
				if (that.canSlide) {
					that._next();
				}
			});
			that.$prev.bind("click",function() {
				if (that.canSlide) {
					that._prev();
				}
			});
			// 键盘切换
			// $(document).keyup(function(e) {
				// if (Home.isInScreen(next)) {
					// if (e.which == 37 || e.which == 75) {
						// if (moveFlag) {
							// _prev(i);
						// }
					// }
					// if (e.which == 39 || e.which == 74) {
						// if (moveFlag) {
							// _next(i);
						// }
					// }
				// }
			// }); 
    },
   	_next:function() {
   		var that=this;
        that.i = that.i == (that.len - 1) ? 0 : (that.i + 1);
        that.nextI = that.i;
        that.canSlide = false;
        that.$items.eq(that.nextI).css('left', that.moveW).show().animate({'left': 0}, that.speed, function () {
            that.canSlide = true;
        });
        that.$items.eq(that.i - 1).animate({'left': -that.moveW}, that.speed);
        
        that.$dotItems.removeClass('selected');
		that.$dotItems.eq(that.nextI).addClass('selected');
        that.lazyImg(that.nextI);
    },
    _prev:function(){
    	var that=this;
    	that.preI = (that.i == 0) ? (that.len - 1) : (that.i - 1);
        that.canSlide = false;
        that.$items.eq(that.preI).css('left', -that.moveW).show().animate({'left': 0}, that.speed, function () {
            that.canSlide = true;
        });
        that.$items.eq(that.i).animate({'left': that.moveW}, that.speed);
        
        that.$dotItems.removeClass('selected');
		that.$dotItems.eq(that.preI).addClass('selected');
       
        that.i = that.i == 0 ? (that.len - 1) : (that.i - 1);
        that.lazyImg(that.preI);
    	
    },
    autoSlide:function(){
    	var slidenum = $("#slidenum").html();
    	if(slidenum == 1){
    		return ;
    	}
    	var that=this;
    	that.autoRoundTimer=setInterval(function(){
	 			that._next();
	 	}, that.rSpeed);
    },
    clearAllAni:function(){
	 		var that=this;
	 		clearTimeout(that.manualTimer);
			clearInterval(that.autoRoundTimer);
			that.manualTimer=null;
			that.autoRoundTimer = null;
	},
	lazyImg:function(i){
			var that = this;

			that.$items.eq(i).find('img[data-src3]').each(function() {
				var _this = $(this);
				_this.attr('src', _this.attr('data-src3')).removeAttr('data-src3').addClass('err-product');
			}); 
			
			that.$items.eq(i).find('img[data-src2]').each(function() {
				var _this = $(this);
				_this.attr('src', _this.attr('data-src2')).removeAttr('data-src2').addClass('err-product');
			});
	}
   	
 };
 $.fn.mSlide = function(options) {
		return this.each(function() {
			var $this = $(this);
		    new MSlide(this, options);
		});
 };

}(window.jQuery);

   

  
