<style>
.table__wrap {margin-top:0px!important;}
.table__toggle__btn {background-color:#fafafa;border:1px solid #000000;color:#000000;width:100%;height:28px;text-align:center;font-size:12px;font-weight:300;line-height:2.4;cursor:pointer;margin-top:15px;}
.modal > .con > .body.modal__wrap{height:90vh!important;display:flex;flex-direction:column;}
.modal__wrap, .modal__wrap .modal__body{height:90vh}
.modal__wrap .modal__body{flex: 1;overflow-y:scroll}
.xi-close{float:right;}
</style>

<div class="body modal__wrap">
	<div class="modal__header">
		<h1>
			운영자 정보 수정
			<a onclick="modal_close();" class="btn-close">
				<i class="xi-close" ></i>
			</a>
		</h1>
	</div>
	
    <div class="contents modal__body" >
		<form id="frm-put" action="store/admin/put">
			<input type="hidden" name="admin_update_flg" value="true">
			<input class="admin_idx" type="hidden" name="admin_idx" value="">
			
			<h2>기본 정보</h2>
			<div class="form-group">
				<input type="text" name="admin_id" value="" required="" readonly>
				<label class="control-label">아이디</label>
			</div>

			<div class="form-group">
				<input type="text" name="admin_name" minlength="2" maxlength="10" value="" class="width-150" required="">
				<label class="control-label">이름</label>
			</div>

			<div class="form-group">
				<input type="password" name="admin_pw" minlength="4" maxlength="20">
				<label class="control-label">현재 비밀번호</label>
			</div>

			<div class="form-group">
				<input type="password" name="pw_new" minlength="4" maxlength="20">
				<label class="control-label">비밀번호 변경</label>
			</div>

			<div class="form-group">
				<input type="password" name="pw_confirm" minlength="4" maxlength="20">
				<label class="control-label">비밀번호 변경 확인</label>
			</div>
			
			<h2>추가 정보</h2>
			<div class="form-group">
				<span class="btn btn-large blue">
					<i class="xi-image"></i> 선택
					<input class="input-image profile_img" type="file" name="profile_img">
				</span><br>
				<img id="profile_img" class="preview" src="/images/ico-avatar.png">
				<label class="control-label">프로필사진</label>
			</div>
			<div class="form-group">
				<input type="text" name="admin_nick" value="" minlength="2" maxlength="10" class="width-150">
				<label class="control-label">닉네임</label>
			</div>
			<div class="form-group">
				<input type="text" name="admin_email" value="">
				<label class="control-label">이메일</label>
			</div>
			<div class="form-group">
				<label class="control-label">연락처</label>
				<div class="form-row">
					<input type="text" name="tel_mobile" value="" maxlength="13" class="width-150 phone">
					<span class="-describe"></span>
				</div>
			</div>
			<div class="form-group">
				<input type="text" name="admin_fax" value="" maxlength="13" class="width-150 phone">
				<label class="control-label">팩스</label>
			</div>
			
			<div sort="COMMON" class="table__toggle__btn toggle_permition">공통</div>
			<input type="hidden" name="permition_idx" value="">
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_COMMON">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="DASHBOARD" class="table__toggle__btn toggle_permition">1. 대시보드</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_DASHBOARD">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="STORE" class="table__toggle__btn toggle_permition">2. 상점관리</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_STORE">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="MEMBER" class="table__toggle__btn toggle_permition">3. 회원</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_MEMBER">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="PRODUCT" class="table__toggle__btn toggle_permition">4. 상품</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_PRODUCT">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="DISPLAY" class="table__toggle__btn toggle_permition">5. 전시</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_DISPLAY">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="PROMOTION" class="table__toggle__btn toggle_permition">6. 프로모션</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_PROMOTION">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="ORDER" class="table__toggle__btn toggle_permition">7. 주문</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_ORDER">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="COLUMN" class="table__toggle__btn toggle_permition">항목관리</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_COLUMN">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="SUBMATERIAL" class="table__toggle__btn toggle_permition">부자재관리</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_SUBMATERIAL">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="ORDERSHEET" class="table__toggle__btn toggle_permition">상품관리(오더시트)</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_ORDERSHEET">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="WHOLESALE" class="table__toggle__btn toggle_permition">홀세일관리</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_WHOLESALE">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="SAMPLE" class="table__toggle__btn toggle_permition">샘플관리</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_SAMPLE">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="FACTORY" class="table__toggle__btn toggle_permition">생산업체관리</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_FACTORY">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
			
			<div sort="BLUEMARK" class="table__toggle__btn toggle_permition">블루마크</div>
			<div class="table__wrap table" style="display:none;">
				<TABLE class="table_BLUEMARK">
					<colgroup>
						<col width="5%;">
						<col width="40%;">
						<col width="40%;">
						<col width="5%;">
						<col width="15%;">
					</colgroup>
					<THEAD>
						<tr>
							<th>권한구분</th>
							<th>권한이름</th>
							<th>권한URL</th>
							<th>권한탭</th>
							<th>권한설정</th>
						</tr>
					</THEAD>
					<TBODY class="result_body">
					</TBODY>
				</TABLE>
			</div>
		</form>
	</div>
	
	<div class="footer modal__footer">
		<a onclick="modal_cancel();" class="btn"><i class="xi-close"></i>작성 취소</a>
		<a onclick="putAdminInfo();" class="btn red"><i class="xi-check"></i>적용</a>
	</div>
</div>
<script>
$(document).ready(function() {
	getAdminInfo();
	$('.profile_img').on('change', function() {
		ext = $(this).val().split('.').pop().toLowerCase(); //확장자
		
		//배열에 추출한 확장자가 존재하는지 체크
		if($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
			resetFormElement($(this)); //폼 초기화
			window.alert('이미지 파일이 아닙니다! (gif, png, jpg, jpeg 만 업로드 가능)');
		} else {
			file = $(this).prop("files")[0];
			
			blobURL = window.URL.createObjectURL(file);
			
			$('#profile_img').attr('src', blobURL);
			$('#profile_img').slideDown(); //업로드한 이미지 미리보기 
			//$(this).slideUp(); //파일 양식 감춤
		}
	});
	
	$('.toggle_permition').click(function() {
		let sort = $(this).attr('sort');
		if (sort != null) {
			$('.table_' + sort).parent().toggle();
		}
	});
});

function getAdminInfo() {
	$.ajax({
		type: "post",
		data: {
			'admin_idx' : "<?=$admin_idx?>"
		},
		dataType: "json",
		url: config.api + "store/admin/get",
		error: function() {
			alert("운영자 정보 불러오기가 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data[0];
				
				$("input[name='admin_idx']").val(data.admin_idx);
				$("input[name='admin_id']").val(data.admin_id);
				$("input[name='admin_name']").val(data.admin_name);
				$("input[name='admin_nick']").val(data.admin_nick);
				$("input[name='admin_email']").val(data.admin_email);
				$("input[name='tel_mobile']").val(data.tel_mobile);
				$("input[name='admin_fax']").val(data.admin_fax);
				
				var profile_img = data.img_location;
				if (profile_img != null) {
					$('#profile_img').attr('src',profile_img);
				} else {
					$('#profile_img').attr('src','/images/ico-avatar.png');
				}
				
				let permition_mapping = data.permition_mapping;
				getAdminPermitionList(permition_mapping);
			}
		}
	});
}

function getAdminPermitionList(permition_mapping) {
	$.ajax({
		type: "post",
		dataType: "json",
		url: config.api + "store/admin/permition/get",
		error: function() {
			alert("운영자 삭제 처리에 실패했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let permition_sort = d.data.permition_sort;
				let permition_info = d.data.permition_info;
				
				if (permition_sort != null && permition_info != null) {
					for (let i=0; i<permition_sort.length; i++) {
						let sort_value = permition_sort[i];
						
						let permition_table = $('.table_' + sort_value);
						let result_body = permition_table.find('.result_body');
						
						let strDiv = "";
						
						let num = 0;
						permition_info[sort_value].forEach(function(row) {
							num++;
							
							strDiv += '<TR>';
							strDiv += '    <TD>' + row.permition_type + '</TD>';
							strDiv += '    <TD>' + row.permition_name + '</TD>';
							strDiv += '    <TD>' + row.permition_url + '</TD>';
							strDiv += '    <TD>' + row.permition_tab + '</TD>';
							
							strDiv += '    <TD>';
							strDiv += '        <div class="flex" style="gap:10px;">';
							
							let checked_true = "";
							let checked_false = "";
							
							if (permition_mapping[row.permition_idx] == true) {
								checked_true = "checked";
							} else {
								checked_false = "checked";
							}
							
							strDiv += '            <label class="rd__square">';
							strDiv += '                <input class="permition_idx" type="radio" permition_idx="' + row.permition_idx + '" name="radio_' + sort_value + '_' + num + '" value="true" ' + checked_true + '>';
							strDiv += '                <div><div></div></div>';
							strDiv += '                <span>권한허용</span>';
							strDiv += '            </label>';
							
							strDiv += '            <label class="rd__square">';
							strDiv += '                <input class="permition_idx" type="radio" name="radio_' + sort_value + '_' + num + '" value="false" ' + checked_false + '>';
							strDiv += '                <div><div></div></div>';
							strDiv += '                <span>권한없음</span>';
							strDiv += '            </label>';
							
							strDiv += '        </div>';
							strDiv += '    </TD>';

							strDiv += '</TR>';
						});
						
						result_body.append(strDiv);
					}
				}
			}
		}
	});
}

function putAdminInfo(){
	let frm = $('#frm-put');
	
	let admin_id = frm.find('input[name=admin_id]');
	let admin_name = frm.find('input[name=admin_name]');
	let admin_pw = frm.find('input[name=admin_pw]');
	let pw_new = frm.find('input[name=pw_new]');
	let pw_confirm = frm.find('input[name=pw_confirm]');
	let admin_email = frm.find('input[name=admin_email]');
	
	let permition_idx = frm.find('input[name=permition_idx]');
	
	let reg_email = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;
	let spl_id = admin_id.val().search(/\s/g);

	if(admin_id.val().length == 0){
		alert("아이디를 입력해주세요", admin_id.focus());
		return false;
	}
	
	if(admin_id.val().search(/[a-z]/ig) < 0){
		alert("아이디에 영문과 숫자가 조합되어야 합니다.",admin_id.focus());
		return false;
	}
	
	if(spl_id >= 0){
		alert("아이디에 공백이 포함될 수 없습니다.",admin_id.focus());
		return false;
	}
	
	if(admin_name.val().length == 0){
		alert("이름를 입력해주세요",admin_name.focus());
		return false;
	}
	
	if(admin_email.val().length == 0){
		alert("이메일을 입력해주세요", admin_email.focus());
		return false;
	}
	
	if(reg_email.test(admin_email.val()) == false){
		alert("이메일을 정확히 입력해주세요", admin_email.focus());
		return false;
	}
	
	if(admin_pw.val().length == 0){
		alert("관리자 정보 변경을 위해 현재 비밀번호를 입력해주세요.",admin_pw.focus());
		return false;
	}
	
	if (pw_new.val().length > 0 || pw_confirm.val().length > 0) {
		if(pw_new.val().length == 0){
			alert("변경 비밀번호를 입력해주세요",pw_new.focus());
			return false;
		} else {
			if(pwValidationCheck(pw_new) == false){
				return false;
			};
		}
		
		if(pw_confirm.val().length == 0){
			alert("변경확인 비밀번호를 입력해주세요",pw_confirm.focus());
			return false;
		} else {
			if(pwValidationCheck(pw_confirm) == false){
				return false;
			};
		}
		
		if(pw_new.val() != pw_confirm.val()){
			alert("변경하려는 비밀번호가 일치하지 않습니다.",pw_confirm.focus());
			return false;
		} else {
			if(pwValidationCheck(pw_confirm) == false){
				return false;
			};
		}
	}
	
	let tmp_permition_idx = [];
	let cnt = $('.permition_idx').length;
	for (let i=0; i<cnt; i++) {
		let tmp_idx = $('.permition_idx').eq(i);
		if (tmp_idx.prop('checked') == true && tmp_idx.val() == "true") {
			tmp_permition_idx.push(tmp_idx.attr('permition_idx'));
		}
	}
	
	permition_idx.val(tmp_permition_idx);
	
	let formData = new FormData();
	formData = $("#frm-put").serializeObject();
	
	confirm(
		'운영자 정보를 수정하시겠습니까?',
		function() {
			$.ajax({
				type: "post",
				data: formData,
				dataType: "json",
				url: config.api + "store/admin/put",
				error: function() {
					alert("운영자 정보 수정처리중 오류가 발생했습니다.");
				},
				success: function(d) {
					if(d.code == 200) {
						alert(
							"선택한 운영자 정보가 수정되었습니다.",
							function() {
								insertLog("상점관리 > 운영자 관리 > 운영자 목록","운영자 개별 정보수정: ",1);
								getAdminInfoList();
								modal_close();
							}
						)
					} else {
						alert("운영자 정보 수정처리에 실패했습니다. 수정하려는 운영자 정보를 확인해주세요.");
						return false;
					}
				}
			});
		}
	)
}

function pwValidationCheck(pw) {
	var num_cnt 		= pw.val().search(/[0-9]/g);
	var eng 			= pw.val().search(/[a-z]/ig);
	var large_eng_cnt 	= pw.val().search(/[A-Z]/g);
	var sck 			= pw.val().search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);
	var spl_pw			= pw.val().search(/\s/g);

	if(pw.val().length < 8){
		alert("비밀번호의 길이는 8 이상입니다.", pw.focus());
		return false;
	}
	
	if(num_cnt < 0){
		alert("하나 이상의 숫자가 필요합니다.", pw.focus());
		return false;
	}
	
	if(eng < 0){
		alert("하나 이상의 알파벳이 필요합니다.", pw.focus());
		return false;
	}
	
	if(large_eng_cnt < 0){
		alert("하나 이상의 대문자 알파벳이 필요합니다.", pw.focus());
		return false;
	}
	
	if(sck < 0){
		alert("하나 이상의 특수문자가 필요합니다.", pw.focus());
		return false;
	}
	
	if(spl_pw >= 0){
		alert("비밀번호에 공백이 포함될 수 없습니다.",pw.focus());
		return false;
	}
	
	return true;
}
</script>