//area1 背景经过变色
$(document).ready(function() {
	$(".area1").hover(function() {
		$(this).addClass("bg2");
	}, function() {
		$(this).removeClass("bg2");
	});
});

//预定说明提示定义
$(document).ready(function() {
	$(".u-ts strong").hover(function() {
		$(".u-ts div").show();
	}, function() {
		$(".u-ts div").hide();
	});
});

//定义content默认高度
$(document).ready(function() {
	var h = $(".content").height();
	if (h < 500) {
		$(".content").height(500);
	}
});