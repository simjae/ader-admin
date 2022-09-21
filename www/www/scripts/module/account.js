
function set_social(d) {
	if($("#frm-join").length) {
		if(d.state == 'already') {
			alert('기존 회원 계정으로 로그인됩니다.',function() {
				location.href = "/";
			});
		}
		else {
			let f = $("#frm-join");

			$(f).find(".sns > button").each(function() {
				if($(this).data("social") == d.social) {
					$(this).addClass("on");
				}
				else $(this).remove();
			});

			$(f).find("input[name='social']").val(d.social);
			$(f).find("input[name='id']").val(d.id).focus().focusout().prop("readonly",true);
			$(f).find("input[name='name']").val(d.name).focus().focusout().prop("readonly",true);
			$(f).find("input[name='email']").val(d.email).focus().focusout().prop("readonly",true);
			$(f).find("input[name='profile_image']").val(d.picture);

			if(d.mobile) $(f).find("input[name='mobile']").val(d.mobile).focus().focusout().prop("readonly",true);
		}
	}
	else {
		if(d.state == 'none') {
			alert("가입되지 않은 계정입니다.");
		}
		else if(d.state == 'already') {
			location.href = "/";
		}
	}
}

/***** 공통 SNS 처리 *****/
$(".sns > button").click(function() {
	/*
	if($("#frm-join").length) {
		if($("#frm-join input[name='agree1']").prop("checked") == false) {
			alert("서비스 이용약관에 동의하셔야 회원 가입이 가능합니다.");
			return;
		}
		else if($("#frm-join input[name='agree2']").prop("checked") == false) {
			alert("개인정보 취급방침에 동의하셔야 회원 가입이 가능합니다.");
			return;
		}
	}
	*/

	$.ajax({
		url: config.api + "member/login/social",
		data: { social : $(this).data("social") },
		success: function(d) {
			if(d.code == 200) {
				window.open(d.link,'social_login','resizable=no,scrollbars=no,status=no,width=600px,height=600px');
			}
			else {
				alert(d.msg);
			}
		}
	});
});

/***** 로그인 *****/
if($("section.account > article.login").length > 0) {
	$("#frm-login").submit(function() {
		$.ajax({
			url: config.api + "member/login",
			data: new FormData($(this)[0]),
			processData:false,
			contentType:false,
			success: function(d) {
				if(d.code == 200) {
					if(d.type == '파트너') {
						location.href = "/partner";
					}
					else {
						location.href = "/";
					}
				}
				else {
					alert(d.msg);
				}
			}
		});
		return false;
	});
}

/***** 회원 가입 *****/
else if($("section.account > article.join").length > 0) {
	let f = $("#frm-join");

	/** 휴대폰 본인 인증 문자 **/
	$(f).find("input[name='mobile'] ~ button.btn").click(function() {
		if($(f).find("input[name='mobile']").parent().hasClass("auth-ok")) {
			confirm("다른 번호로 인증 시도할까요?",function() {
				$(f).find("input[name='mobile']").prop("readonly",false).val("").focus();
				$(f).find("input[name='mobile']").parent().removeClass("auth-ok");
			});
			return;
		}

		if($(this).hasClass("disabled")) {
			$("#mobile-confirm").addClass("hidden");
			$("#mobile-confirm .counter").empty();
			$(f).find("input[name='mobile']").prop("disable",false).val("");
			$(this).removeClass("disabled");
			return;
		}
		$(this).addClass("disabled");
		$("#mobile-confirm .counter").empty();
		$(f).find("input[name='mobile_confirm']").val("");
		$.ajax({
			url: config.api + "auth/mobile",
			data: {
				number : $(this).parent().find("input").val()
			},
			success: function(d) {
				if(d.code == 200) {
					$("#mobile-confirm").removeClass("hidden");
					$(f).find("input[name='mobile']").prop("disable",true);
					let check_mobile_confirm = setInterval(function() {
						if(d.count == 0) {
							clearInterval(check_mobile_confirm);
							alert("인증 시간이 초과되었습니다. 본인인증을 다시 시도하여 주세요.",function() {
								$("#mobile-confirm").addClass("hidden");
								$(f).find("input[name='mobile']").prop("disable",false);
								$(f).find("input[name='mobile'] ~ button.btn").removeClass("disabled");
								$("#mobile-confirm .counter").empty();
							});
						}
						else {
							d.count--;
							$("#mobile-confirm .counter").html(`${Math.floor(d.count/60)}:${addzero(d.count%60)}`);
						}
					},1000);

					/** 인증 번호 입력 **/
					$(f).find("input[name='mobile_confirm']").focus();
					$(f).find("input[name='mobile_confirm'] ~ button").click(function() {
						$.ajax({
							url: config.api + "auth/ok",
							data: {
								auth_number : $(this).parent().find("input").val()
							},
							success: function(d) {
								if(d.code == 200) {
									$("#mobile-confirm").addClass("hidden");
									$(f).find("input[name='mobile']").parent().addClass("auth-ok");
									$(f).find("input[name='mobile']").prop("readonly",true);
									$(f).find("input[name='mobile'] ~ button.btn").removeClass("disabled");
								}
								else {
									alert(d.msg);
								}
							}
						});
					});
				}
				else {
					alert(d.msg);
					$(f).find("input[name='mobile'] ~ button.btn").removeClass("disabled");
				}
			}
		});
	});


	/** 약관 동의 **/
	$("#frm-join input[name='all_agree']").click(function() {
		$("#frm-join input[name*='agree']").prop("checked",$(this).prop("checked"));
	});
	$("#frm-join input[name*='agree']").click(function() {
		if($(this).prop("checked") == false) {
			$("#frm-join input[name='all_agree']").prop("checked",false);
		}

		if($("#frm-join input[name*='agree']:checked").length == $("#frm-join input[name*='agree']").length-1) {
			$("#frm-join input[name='all_agree']").prop("checked",true);
		}
	});

	$("#frm-join").submit(function() {
		if($("#frm-join input[name='agree1']").prop("checked") == false) {
			alert("서비스 이용약관에 동의하셔야 회원 가입이 가능합니다.");
		}
		else if($("#frm-join input[name='agree2']").prop("checked") == false) {
			alert("개인정보 취급방침에 동의하셔야 회원 가입이 가능합니다.");
		}
		else {
			$.ajax({
				url: config.api + "member/join",
				data: $(this).serialize(),
				success: function(d) {
					if(d.code == 200) {
						alert("회원 가입이 완료되었습니다.",function() {
							location.href = "/";
						});
					}
					else {
						alert(d.msg);
					}
				}
			});
		}

		return false;
	});
}