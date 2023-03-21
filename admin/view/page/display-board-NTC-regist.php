<div class="content__card" style="margin: 0;">
	<form id="frm-add" >
		<div class="card__header">
			<div class="flex justify-between">
				<h3>공지사항 등록</h3>
			</div>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
            <div class="content__wrap">
				<div class="content__title">쇼핑몰</div>
				<div class="content__row">
					<select id="country" type="select" name="country" style="width:150px">
						<option value="" selected>쇼핑몰 선택</option>
						<option value="KR" >한국몰</option>
						<option value="EN" >영문몰</option>
                        <option value="CN" >중국몰</option>
					</select>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">카테고리</div>
				<div class="content__row">
					<select id="category" type="select" name="category" style="width:150px">
						<option value="" selected>카테고리 선택</option>
						<option value="CMN" >일반</option>
						<option value="UDL" >미확인입금자명단</option>
					</select>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">제목</div>
				<div class="content__row">
					<input type="text" value="" style="width:80%;" placeholder=""  name="title">
				</div>
			</div>
            <div class="content__wrap">
				<div class="content__title">글고정 여부</div>
				<div class="content__row">
                    <div class="rd__block">
                        <input type="radio" id="fix_flg_true" class="radio__input" value="true" name="fix_flg" checked/>
                        <label for="fix_flg_true">글고정 함</label>
                        <input type="radio" id="fix_flg_false" class="radio__input" value="false" name="fix_flg"/>
                        <label for="fix_flg_false">글고정 안함</label>
                    </div>
				</div>
			</div>
            <div class="content__wrap">
				<div class="content__title">게시글 노출시간 설정</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="display_flg" type="hidden" value="true">
						
						<input type="radio" id="display_flg_true" class="radio__input display_flg" value="true" name="display_flg" checked>
						<label for="display_flg_true">상시 노출</label>
						
						<input type="radio" id="display_flg_false" class="radio__input display_flg" value="false" name="display_flg">
						<label for="display_flg_false" style="gap:5px;">
							지정 시간에만 
						</label>
						
						<div class="content__date__picker">
							<input class="display_date" type="date" name="display_from"  placeholder="From" readonly="" style="width:150px" onChange="" disabled>
							<select class="display_date" type="select" name="display_from_h" style="width:80px" disabled>시 
								<option value="" selected>시간</option>
							</select>
							<select class="display_date" type="select" name="display_from_m" style="width:80px" disabled>분
								<option value="" selected>분</option>
							</select>
							
							<br><font class="" >~</font><br>
							
							<input class="display_date" type="date" name="display_to" placeholder="To" readonly="" style="width:150px; " onChange="" disabled>
							<select class="display_date" type="select" name="display_to_h" style="width:80px" disabled>시 
								<option value="" selected>시간</option>
							</select>
							<select class="display_date" type="select" name="display_to_m" style="width:80px" disabled>분
								<option value="" selected>분</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">내용</div>
				<div class="content__row">
					<textarea class="width-100p" id="contents" name="contents" required style="width:90%; height:100px;"></textarea>
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div onclick="noticeRegistCheck();"  class="blue__color__btn"><span>저장</span></div>
					<div onclick="modal_cancel();" class="defult__color__btn"><span>작성 취소</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
var contents = [];
var infoHtml = "Company ADER | Business Name FIVE SPACE CO.,LTD | Business License 760-87-01757 |MAIL-ORDER LICENSE NO. 2021-서울성동-01588 | CEO HANN| office ADER 3F 53, Yeonmujang-gil, Seongdong-gu, Seoul, KoreaC/S office ADER 3F 53, Yeonmujang-gil, Seongdong-gu, Seoul, Korea TEL. 02-792-2232 | Office hour Mon - Fri AM 10:00 - PM 5:00 ©2021 ADER All Rights Reserved";

$(document).ready(function() {
    timeSelectInit();

    $('.radio__input.display_flg').click(function() {
		var display_flg = $(this).val();
		$('#display_flg').val(display_flg);
	});

	nhn.husky.EZCreator.createInIFrame({
		oAppRef: contents,
		elPlaceHolder: "contents",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
});
$('.radio__input.display_flg').change(function(){
	var val = $(this).val();
	
	switch(val){
		case 'true':
			$('.display_date').val('');
			$('.display_date').attr("disabled", true);
			break;
		case 'false':
			$('.display_date').removeAttr("disabled");
			break;
	}
})
function noticeRegistCheck(){
	contents.getById["contents"].exec("UPDATE_CONTENTS_FIELD", []);

    var formData = new FormData();
	formData = $("#frm-add").serializeObject();

	if(formData.country.length == 0){
		alert("쇼핑몰을 선택해주세요", $('select[name=country]').focus());
		return false;
	}
	if(formData.category.length == 0){
		alert("공지사항 카테고리를 입력해주세요", $('select[name=category]').focus());
		return false;
	}
	if(formData.title.length == 0){
		alert("공지사항 제목을 입력해주세요", $('input[name=title]').focus());
		return false;
	}
	if(formData.contents == '<p>&nbsp;</p>'){
		alert("공지사항 내용을 기입해주세요");
		return false;
	}

    var display_flg = $('#display_flg').val();
	if (display_flg == "false") {
		var display_start_date = $("input[name='display_from']").val() + ' ' + $("select[name='display_from_h']").val() + ':' + $("select[name='display_from_m']").val();
		var display_end_date = $("input[name='display_to']").val() + ' ' + $("select[name='display_to_h']").val() + ':' + $("select[name='display_to_m']").val();
		
		if ($("input[name='display_from']").val().length != 0 && $("input[name='display_to']").val().length != 0) {
			var start_date = new Date(display_start_date);
			var end_date = new Date(display_end_date);
			
			if (start_date > end_date) {
				alert('진열 시작일/종료일에 올바른 날짜를 입력해주세요.');
				return false;
			}
		} else {
			alert('진열 시작일/종료일에 정확한 날짜를 입력해주세요.');
			return false;
		}
	}
	confirm("공지사항을 등록 하시겠습니까?",function() {
		$.ajax({
			type: "post",
            data: formData,
			dataType: "json",
			url: config.api + "page/board/notice/add",
			error: function() {
				alert("공지사항 등록이 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert("공지사항 등록에 성공했습니다.",function(){
						location.href='/display/board';
					});
				}
                else{
                    alert("공지사항 등록이 실패했습니다.");
                }
			}
		});
	});
}

function timeSelectInit(){
	for(var i = 0; i < 24; i++){
		$("select[name='display_from_h']").append('<option value="'+i+'">'+i+'시</option>');
		$("select[name='display_to_h']").append('<option value="'+i+'">'+i+'시</option>');
	}
	for(var j = 0; j < 60; j++){
		$("select[name='display_from_m']").append('<option value="'+j+'">'+j+'분</option>');
		$("select[name='display_to_m']").append('<option value="'+j+'">'+j+'분</option>');
	}
}
</script>