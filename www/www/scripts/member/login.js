$(document).ready(function() {
	$('#member_id').val('');
	var usermember_id = getCookie("usermember_id");
	$('#member_id').val(usermember_id);

	if($('#member_id').val() != ""){
		$("input:checkbox[id='member_id_flg']").prop("checked", true);
	}

	$("input:checkbox[id='member_id_flg']").change(function(){
		if($("input:checkbox[id='member_id_flg']").is(":checked")){
			setCookie("usermember_id", $('#member_id').val(), 7);
		}
		else{
			deleteCookie("usermember_id");
		}
	})

	$('#member_id').keyup(function(){
		if($('input:checked[id="member_id_flg"]').is(":checked")){
			setCookie("usermember_id", $('#member_id').val(), 7);
		}
	})
});

function login() {
	var mail_regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
	var member_id = $('#member_id').val();
	var member_pw = $('#member_pw').val();
	mail_regex.test(member_id);

	$('.font__underline.font__red').text('');
	if(member_id == ''){
		$('.member_id_msg').text('이메일을 입력해주세요');
	
		return false;
	}
	
	if(!mail_regex.test(member_id)){
		$('.member_id_msg').text('이메일을 올바르게 입력해주세요');

		return false;
	}

	if (member_pw == '') {
		$('.member_pw_msg').text('비밀번호를 입력해주세요');

		return false;
	}
	
	$.ajax({
		type: 'POST',
		url: "http://116.124.128.246:80/_api/account/login",
		data: $("#frm-login").serialize(),
		dataType: "json",
		error:function(){
			alert("로그인 처리중 오류가 발생했습니다.");
		},
		success:function(d){
			if(d.code == "200") {
				sessionStorage.login_session = "true";
				location.href='/main';
			} else {
				$('.result_msg').text("로그인정보 재확인 후 다시 시도해주세요.");
			}
		}
	});
}

    function logout(){
        $.ajax(
            {
                url: "http://116.124.128.246:80/_api/account/logout",
                type: 'POST',
                success:function(){
                    exceptionHandling("",'로그아웃');
                    $('#exception-modal .close-btn').attr('onclick', 'location.href="/main"');
                }
            }
        )
    }
function setCookie(cookieName, value, exdays){
	let exdate = new Date();
	exdate.setDate(exdate.getDate() + exdays);
	let cookieValue = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toGMTString());
	document.cookie = cookieName + "=" + cookieValue;
}

//쿠키값 delete
function deleteCookie(cookieName){
	let expireDate = new Date();
	expireDate.setDate(expireDate.getDate() -1);
	document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
}

//쿠키값 get
function getCookie(cookieName){
	cookieName = cookieName + "=";
	let cookieData = document.cookie;
	let start = cookieData.indexOf(cookieName);
	let cookieValue = '';
	if(start != -1){
		start += cookieName.length;
		let end = cookieData.indexOf(';', start);
		if(end == -1)end = cookieData.length;
		cookieValue = cookieData.substring(start, end);
	}
	return unescape(cookieValue); //unescape로 디코딩 후 값 리턴
}

// check
function password_find_check() {
	var mail_regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
	var member_id = $('#member_id').val();
	mail_regex.test(member_id);

	$('.font__underline.font__red').css('visibility','hidden');
	if(member_id == ''){
		
		$('.member_id_msg').css('visibility','visible');
		$('.member_id_msg').text('이메일을 입력해주세요');
	
		return false;
	} else {
		if(!mail_regex.test(member_id)){
			
			$('.member_id_msg').css('visibility','visible');
			$('.member_id_msg').text('이메일을 올바르게 입력해주세요');

			return false;
		}
	}
	$.ajax(
		{
			url: "http://116.124.128.246:80/_api/account/check/check",
			type:'POST',
			data:$("#frm-find").serialize(),
			error:function(data){
				$('.member_id_msg').css('visibility','hidden');
				$('.result_msg').css('visibility','visible');
				$('.result_msg').text("비밀번호 체크처리중 오류가 발생했습니다.");
			},
			success:function(data){
				if(data.code == "200") { // 이메일검사 성공
					$('.member_id_msg').css('visibility','hidden');
					exceptionHandling('',"입력하신 이메일로<br>비밀번호 변경창 링크를 전송했습니다.");
				}
				else {	// 이메일검사 실패
					let err_str = '이메일이 올바르지 않습니다. 다시 입력해주세요';
					if(data.msg != null){
						err_str = data.msg;
					}
					$('.member_id_msg').css('visibility','visible');
					$('.member_id_msg').text(err_str);
				}
			},
			complete:function(data){
				//$("#result1").html(data.responseText);
			},
			dataType:'json'
		}
	);
	
}

//login-update
$(document).ready(function() {
	$('input[name="password"]').keyup(function(){
		if(memberPwConfirm($(this).val()) || $(this).val().length == 0){
			$('.font__underline.warn__msg.member_pw').css('visibility','hidden');
		}
		else{
			$('.font__underline.warn__msg.member_pw').css('visibility','visible');
		};
	});
	urlParsing();
});

function urlParsing(){
	var url = location.href;
	var idx = url.indexOf("?");
	
	if(idx >= 0){
		var data = url.substring( idx + 1, url.length);
		var data_arr = data.split("=");
		if(data_arr[0] == 'member_idx'){
			$('input [name="idx"]').val(data_arr[1]);
		}
	}
}

function memberPwConfirm(str){	
	//  대소문자/숫자/특수문자 중 3가지 이상 조합, 8자-16자
	//  입력 가능 특수문자 : '!@#$%^()_-={}[]|;:<>,.?/					
	var password_reg = /^(?=.*[\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(])(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[\da-zA-Z\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(]{8,16}/;
	//  공백 입력 불가능
	var space_reg = /\s/g;
	//var password_str = $('input[name="password"]').eq(0).val();

	if(space_reg.test(str) == false){
		return password_reg.test(str);
	}
	else{
		return false;
		//공백 포함 예외처리
	}
}

//.css('visibility','hidden');
function updateMemberPw(){
	//member_idx : 
	//비밀번호 변경 -> 이메일로 변경페이지 링크생성될때 파라미터로 주어진 값.
	//로그인 유무와는 상관없음.
	var member_idx = $('input[name="member_idx"]').val();
	var country = $('input[name="country"]').val();

	var member_pw = $('input[name="member_pw"]').val();
	var member_pw_confirm = $('input[name="member_pw_confirm"]').val();

	$('.warn__msg').css('visibility','hidden');
	
	if(memberPwConfirm(member_pw) == false){
		$('.font__underline.warn__msg.member_pw').css('visibility','visible');
		return false;
	}
	if(member_pw != member_pw_confirm){
		$('.warn__msg.member_pw_confirm').css('visibility','visible');
		return false;
	}

	$.ajax(
		{
			url: "http://116.124.128.246:80/_api/account/put",
			type:'POST',
			data: { 'country' : country,
					'member_idx' : member_idx,
					'member_pw' : member_pw },
			error:function(data){
			},
			success:function(data){
				if(data.code == "200") {
					//location.reload();
					exceptionHandling("비밀번호 변경","비밀번호 변경에 성공했습니다.");
					location.href='/login';
				}
				else{
					let err_msg = ''
					if(data.msg != null){
						err_msg = data.msg;
					}
					exceptionHandling("비밀번호 변경",err_msg);
				}
			},
			complete:function(data){
				//$("#result1").html(data.responseText);
			},
			dataType:'json'
		}
	);
}
//login-password-pub 
$(document).ready(function() {
	$('#pw_desciption').hide();
	$('input[name="member_pw"]').keyup(function(){
		if(memberPwConfirm($(this).val()) || $(this).val().length == 0){
			$('.font__underline.warn__msg.member_pw').css('visibility','hidden');
			hidePwDescription();
		}
		else{
			$('.font__underline.warn__msg.member_pw').css('visibility','visible');
			showPwDescription();
		};
	});
});
function memberPwConfirm(str){	
	//  대소문자/숫자/특수문자 중 3가지 이상 조합, 8자-16자
	//  입력 가능 특수문자 : '!@#$%^()_-={}[]|;:<>,.?/					
	var password_reg = /^(?=.*[\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(])(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[\da-zA-Z\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(]{8,16}/;
	//  공백 입력 불가능
	var space_reg = /\s/g;
	//var password_str = $('input[name="password"]').eq(0).val();

	if(space_reg.test(str) == false){
		return password_reg.test(str)
			return true;
	}
	else{
		return false;
		//공백 포함 예외처리
	}
}
function showPwDescription(){
	$('#pw_desciption').show();
	$('#hide_area').hide();
}
function hidePwDescription(){
	$('#pw_desciption').hide();
	$('#hide_area').show();
}

//join
$(document).ready(function() {
	$('#pw_desciption').hide();
	$('input[name="member_pw"]').keyup(function(){
		if(memberPwConfirm($(this).val()) || $(this).val().length == 0){
			$('.font__underline.warn__msg.member_pw').css('visibility','hidden');
			hidePwDescription();
		}
		else{
			$('.font__underline.warn__msg.member_pw').css('visibility','visible');
			showPwDescription();
		};
	});
	$('.component').click(function(){
		var sel_cnt = $('.component:checked').length;
		if(sel_cnt == 3){
			$('.select__all').prop('checked',true);
		}
		else{
			$('.select__all').prop('checked',false);
		}
	});
});

function selectAllClick(obj) {
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$(".login__check__option").prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$(".login__check__option").prop('checked',false);
	}
}

function memberPwConfirm(str){	
	//  대소문자/숫자/특수문자 중 3가지 이상 조합, 8자-16자
	//  입력 가능 특수문자 : '!@#$%^()_-={}[]|;:<>,.?/					
	var password_reg = /^(?=.*[\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(])(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[\da-zA-Z\{\}\[\]\/?.,;:|\)*`!^\-_<>@\#$%\=\(]{8,16}/;
	//  공백 입력 불가능
	var space_reg = /\s/g;
	//var password_str = $('input[name="password"]').eq(0).val();

	if(space_reg.test(str) == false){
		return password_reg.test(str)
			return true;
	}
	else{
		return false;
		//공백 포함 예외처리
	}
}
//.css('visibility','hidden');
function joinAction(){
	var mail_regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
	var member_id = $('input[name="member_id"]').val();
	var member_pw = $('input[name="member_pw"]').val();
	var member_pw_confirm = $('input[name="member_pw_confirm"]').val();
	var member_name = $('input[name="member_name"]').val();
	var birth_year = $('input[name="birth_year"]').val();
	var birth_month = $('input[name="birth_month"]').val();
	var birth_day = $('input[name="birth_day"]').val();
	var terms_of_service_flg = $('#terms_of_service_flg').is(':checked');

	mail_regex.test(member_id);

	$('.warn__msg').css('visibility','hidden');
	if(memberPwConfirm(member_pw) == false){
		$('.font__underline.warn__msg.member_pw').css('visibility','visible');
		showPwDescription();
		return false;
	}
	if(member_id == '' || !mail_regex.test(member_id)){
		$('.warn__msg.member_id').css('visibility','visible');
		return false;
	}
	else if(member_pw != member_pw_confirm){
		$('.warn__msg.member_pw_confirm').css('visibility','visible');
		return false;
	}
	else if(member_name == ''){
		$('.warn__msg.member_name').css('visibility','visible');
		return false;
	}
	else if(birth_year == '' || birth_month == '' || birth_day == ''){
		$('.warn__msg.birth').css('visibility','visible');
		return false;
	}
	else if(terms_of_service_flg == false){
		$('.warn__msg.essential').css('visibility','visible');
		$('.warn__msg.essential').text('필수항목을 선택해주세요');
		return false;
	}

	$.ajax(
		{
			url: "http://116.124.128.246:80/_api/account/add",
			type:'POST',
			data:$("#frm-regist").serialize(),
			error:function(data){
			},
			success:function(data){
				if(data.code == "200") {
					//location.reload();
					exceptionHandling("회원가입","회원가입에 성공하셨습니다.<br>로그인창으로 돌아갑니다.");
					$('#exception-modal .close-btn').attr('onclick', 'location.href="/login"');
				}
				else {
					if(data.code == "303"){
						$('.warn__msg.essential').css('visibility','visible');
						$('.warn__msg.essential').text(data.msg);
					}
				}
			},
			complete:function(data){
				//$("#result1").html(data.responseText);
			},
			dataType:'json'
		}
	);
}

function showPwDescription(){
	$('#pw_desciption').show();
	$('#hide_area').hide();
}

function hidePwDescription(){
	$('#pw_desciption').hide();
	$('#hide_area').show();
}
$('#member_pw, #member_id').on('keypress', function(e){
	if(e.keyCode == '13'){
		login();
	}
})
