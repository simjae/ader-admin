function transition_background(obj,now,total,term) {
	var next = now+1;
	if(now+1 > total) next = 1;
	var html;

	html = "<div id='_tmp_background_cnt_" + next + "' style=\"background:url('/images/media/bg" + next + ".jpg') center center no-repeat ; background-size : cover ; opacity : 0\"></div>";

	$(obj).append(html);

	$("#_tmp_background_cnt_" + next).animate({"opacity":1},{duration:1000,complete:function() {
		$("#_tmp_background_cnt_" + now).remove();
	}});

	_login_bg = setTimeout("transition_background('" + obj + "'," + next + "," + total + "," + term + ")",term);
}

function login() {
	if($("#frm").formvaild()) {
		$.ajax(
			{
				url:'/_api/account/login',
				type:'POST',
				data:$("#frm").serialize(),
				error:function(d){
					$("#alert-box > span").html("모듈에 문제가 발생했습니다.");
					$("#alert-box").removeClass('display-hide')
				},
				success:function(d){
					if(d.code == "200") { // 로그인 성공
						//location.reload();
						let permition_type = d.data;
						console.log(permition_type);
						if (permition_type == "PCS") {
							location.href = "/pcs";
						} else {
							location.href = "/analysis/dashboard";
						}
					}
					else {	// 로그인 실패
						$("#alert-box > span").html("로그인 실패입니다. 로그인정보 재확인 후 다시 시도하여 주십시오.");
						$("#alert-box").removeClass('display-hide')
					}
				},
				complete:function(data){
					//$("#result1").html(data.responseText);
				},
				dataType:'json'
			}
		);
	}
}

function forgetpassword() {
	if($("#frm2").formvaild()) {
		$.ajax(
			{
				url:'controller/forgetpassword.php',
				type:'POST',
				data:$("#frm2").serialize(),
				error:function(data){
					$("#alert-box2 > span").html("모듈에 문제가 발생했습니다.");
					$("#alert-box2").removeClass('display-hide')
				},
				success:function(data){
					if(data.code == "200") { // 임시비번 생성 성공
						$("#alert-box2 > span").html("이메일 확인 후 임시 비밀번호로 로그인해주십시오.");
						$("#alert-box2").removeClass('display-hide')
					}
					else if(data.code == "322") {
						$("#alert-box2 > span").html("이메일 형식이 맞지 않습니다.<br>확인 후 다시 시도하여 주세요.");
						$("#alert-box2").removeClass('display-hide')
					}
					else if(data.code == "321") {
						$("#alert-box2 > span").html("존재하지 않는 이메일입니다.<br>확인 후 다시 시도하여 주세요.");
						$("#alert-box2").removeClass('display-hide')
					}
					else {
						$("#alert-box2 > span").html(data.msg);
						$("#alert-box2").removeClass('display-hide')
					}
				},
				complete:function(data){
					$("#alert-box2 > span").html("임시비밀번호가 메일로 발송되었습니다.<br>확인 후 로그인해주세요.");
					$("#alert-box2").removeClass('display-hide')
					frm2.reset();
				},
				dataType:'json'
			}
		);
	}
}


var _login_bg;
$(document).ready(function() {
	$("button.close").click(function() {
		$(".alert").addClass("display-hide");
	});

	$("#forget-password").click(function() {
	});

	$("#pwbox").hide();

	_login_bg = setTimeout("transition_background('#login-background',0,4,5000)",0);
});
