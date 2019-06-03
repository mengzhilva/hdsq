var g_num = 0;
$(document).ready(function() {
	validatepage();
	$("#getCode").on("click.send",
	function() {
		var ymbase = $("#path").val();
		var mobile = $("input[name='mobile']").val();
		if (!mobile) {
			yunma_print_error("mobile", "手机号不能为空！");
			return false
		}
	})
});
var timer = null,
ntimer = null;
var isobj_verify = $("input[name='verify']");
function yunma_ismobile(mobile) {
	var reg = /^(13|15|18|14|17)\d{9}$/;
	return reg.test($.trim(mobile))
}
function yunma_first_mobile() {
	var mobile = $("input[name='mobile']").val();
	mobile = $.trim(mobile);
	if (mobile != "") {
		if (!yunma_ismobile(mobile)) {
			yunma_print_error("mobile", "手机号格式有误")
		} else {
			$("input[name='mobile']").attr("style", "color:#CBCABC;")
		}
	} else {
		if ($("input[name='mobile']").attr("value").length <= 0) {
			yunma_print_error("mobile", "请填写正确的手机号")
		}
	}
}
function yunma_first_verify() {
	var verify = $("input[name='verify']").val();
	verify = $.trim(verify);
	if (verify == "") {
		if ($("input[name='verify']").attr("value").length <= 0) {
			yunma_print_error("verify", "请输入验证码内容")
		}
	} else {
		$("input[name='verify']").attr("style", "color:#CBCABC;")
	}
}
function yunma_first_verify() {
	var verify = $("input[name='verify']").val();
	verify = $.trim(verify);
	if (verify == "") {
		if ($("input[name='verify']").attr("value").length <= 0) {
			yunma_print_error("verify", "请输入您获取的手机验证码")
		}
	} else {
		$("input[name='verify']").attr("style", "color:#CBCABC;")
	}
}
function yunma_print_error(id, mes) {
	mes = $.trim(mes);
	$("input[name='" + id + "']").addClass("placered");
	$("input[name='" + id + "']").attr("style", "color:red;");
	$("input[name='" + id + "']").attr("value", "");
	$("input[name='" + id + "']").attr("value", mes)
}
function yunma_print_right(id, mes) {
	mes = $.trim(mes);
	$("input[name='" + id + "']").removeClass("placered");
	$("input[name='" + id + "']").attr("style", "color:#CBCABC;");
	$("input[name='" + id + "']").attr("value", "");
	$("input[name='" + id + "']").attr("value", mes)
}
function validatepage() {
	var isobj_mobile = $("input[name='mobile']");
	var isobj_verify = $("input[name='verify']");
	var isobj_submit_data = $("#submit_data");
	if (isobj_mobile) {
		$("input[name='mobile']").mouseout(function() {
			yunma_first_mobile()
		});
		$("input[name='mobile']").blur(function() {
			yunma_first_mobile()
		})
	}
	if (isobj_verify) {
		$("input[name='verify']").mouseout(function() {
			yunma_first_verify()
		});
		$("input[name='verify']").blur(function() {
			yunma_first_verify()
		})
	}
	if (isobj_submit_data) {
		$("#submit_data").click(function() {
			var mobile = $("input[name='mobile']").val();
			mobile = $.trim(mobile);
			if (mobile == "") {
				yunma_print_error("mobile", "请先填写手机号");
				return
			}
			var verify = $("input[name='verify']").val();
			verify = $.trim(verify);
			if (!yunma_ismobile(mobile)) {
				yunma_print_error("mobile", "手机号格式有误");
				return
			}
			if (verify == "") {
				yunma_print_error("verify", "短信验证码不能为空！");
				return
			}
			firstNext()
		})
	}
};