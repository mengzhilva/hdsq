$.fn.smartFloat = function() {
	var position = function(element) {
		var top = element.position().top;
		var left = element.position().left;
			pos = element.css("position");
		$(window).scroll(function() {
			var scrolls = $(this).scrollTop();
			if (scrolls >= top) {
				if (window.XMLHttpRequest) {
					element.css({
						position: "fixed",
						top: "0px",
						left: left
					});
				} else {
					element.css({
						top: scrolls,
						left: left
					});	
				}
			}else {
				element.css({
					position:"absolute",
					top: top,
					left: left
				});
					//隐藏预定	
			}
		});
};
	return $(this).each(function() {
		position($(this));						 
	});
};
$(document).ready(function() {
   $("#fd").smartFloat();
});