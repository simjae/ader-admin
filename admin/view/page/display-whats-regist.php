<style>
.preview{
	display: grid;
	grid-template-columns: 300px 1fr;
	width: 100%;
	height: 400px;
	border-radius: 20px;
	box-shadow: 2px 1px 8px 0px #7070704a;
}
</style>

<div class="content__card" style="margin: 0;">
	<form id="frm-add" action="display/whats/add" enctype="multipart/form-data">
		<div class="card__header">
			<div class="flex justify-between">
				<h3>WHAT'S NEW 링크 설정</h3>
			</div>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">국가</div>
				<div class="content__row">
					<select id="country" type="select" name="country" style="width:80px">
						<option value="" selected>국가</option>
						<option value="KR" >한국몰</option>
						<option value="EN" >영문몰</option>
						<option value="CN" >중문몰</option>
					</select>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">페이지명</div>
				<div class="content__row">
					<input id="duplicate_check" type="hidden" value="false">
					<input id="page_title" type="text" value="" style="width:80%;" placeholder="" name="page_title">
					<div id="duplicate_btn" class="defult-btn" style="width:95px;background-color:#e43a45;color:#ffffff;font-size:0.5rem;text-align:center;" onclick="duplicateCheck()">중복체크</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">썸네일</div>
				<div class="content__row">
				<div class="edit__img" style="width:100% ;">
					<div class="form-group" style="padding:0px;">
						<div id="img_thumbnail_area" style="border:1px solid #000000;height:330px;padding-left:50px;padding-top:50px;">
							What's New<br>썸네일 이미지를 선택해주세요.
						</div>
						<img class="preview img_thumbnail" src="" style="display:none;">
						<span class="btn btn-large blue" style="margin-top:10px;">
							<i class="xi-image"></i>What's New 썸네일 이미지 선택
							<input class="whats_new_img" id="img_thumbnail" type="file" name="img_thumbnail" class="input-image">
						</span><br>
					</div>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">서브 페이지명</div>
				<div class="content__row">
					<input type="text" value="" style="width:80%;" placeholder="" name="page_sub_title">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">설명</div>
				<div class="content__row">
					<input type="text" value="" style="width:80%;" placeholder=""  name="page_memo">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">페이지 컨텐츠</div>
				<div class="content__row">
					<textarea class="width-100p" id="page_content" name="page_content" required style="width:90%; height:150px;"></textarea>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">진열 예약 설정</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="display_flg" type="hidden" value="false">
						
						<input type="radio" id="display_flg_true" class="radio__input display_flg" value="true" name="display_flg" checked>
						<label for="display_flg_true">상시 오픈</label>
						
						<input type="radio" id="display_flg_false" class="radio__input display_flg" value="false" name="display_flg">
						<label for="display_flg_false" style="gap:5px;">
							지정 시간에만 
						</label>
						
						<div class="content__date__picker">
							<input class="display_date" type="date" name="display_from"  placeholder="From" readonly="" style="width:150px" onChange="">
							<select class="display_date" type="select" name="display_from_h" style="width:80px">시 
								<option value="" selected>시간</option>
							</select>
							<select class="display_date" type="select" name="display_from_m" style="width:80px">분
								<option value="" selected>분</option>
							</select>
							
							<br><font class="" >~</font><br>
							
							<input class="display_date" type="date" name="display_to" placeholder="To" readonly="" style="width:150px; " onChange="">
							<select class="display_date" type="select" name="display_to_h" style="width:80px">시 
								<option value="" selected>시간</option>
							</select>
							<select class="display_date" type="select" name="display_to_m" style="width:80px">분
								<option value="" selected>분</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card__header" id="seo">
			<div class="flex justify-between">
				<h3>검색엔진 최적화(SEO)</h3>
			</div>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">검색 엔진 노출 설정</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="searchExposure1" class="radio__input" value="true" name="seo_exposure_flg" checked/>
						<label for="searchExposure1">노출함</label>
						<input type="radio" id="searchExposure2" class="radio__input" value="false" name="seo_exposure_flg"/>
						<label for="searchExposure2">노출안함</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">검색엔진<br>브라우저 타이틀</div>
				<div class="content__row">
					<input type="text" name="seo_title">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">검색엔진<br>메타태그 Author</div>
				<div class="content__row">
					<input type="text" name="seo_author">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">검색엔진<br>메타태그Description</div>
				<div class="content__row">
					<textarea name="seo_description" id="" cols="70" rows="10" style="border: 1px solid #000;"></textarea>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">검색엔진<br>메타태그Keywords</div>
				<div class="content__row">
					<textarea name="seo_keywords" id="" cols="70" rows="10" style="border: 1px solid #000;"></textarea>
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  onclick="whatsNewRegistCheck();"  class="blue__color__btn"><span>저장</span></div>
					<div onclick="modal_cancel();" class="defult__color__btn"><span>작성 취소</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
var page_content = [];
var infoHtml = "Company ADER | Business Name FIVE SPACE CO.,LTD | Business License 760-87-01757 |MAIL-ORDER LICENSE NO. 2021-서울성동-01588 | CEO HANN| office ADER 3F 53, Yeonmujang-gil, Seongdong-gu, Seoul, KoreaC/S office ADER 3F 53, Yeonmujang-gil, Seongdong-gu, Seoul, Korea TEL. 02-792-2232 | Office hour Mon - Fri AM 10:00 - PM 5:00 ©2021 ADER All Rights Reserved";

$(document).ready(function() {
	timeSelectInit();

	$('.display_flg').click(function() {
		var display_flg = $(this).val();
		$('#display_flg').val(display_flg);
	});
	
	$('#page_title').change(function() {
		$('#duplicate_check').val(false);
		$('#duplicate_btn').css('background-color','#E43A45');
		$('#duplicate_btn').text('중복체크');
	});

	nhn.husky.EZCreator.createInIFrame({
		oAppRef: page_content,
		elPlaceHolder: "page_content",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
});
$('.whats_new_img').on('change', function() {
	ext = $(this).val().split('.').pop().toLowerCase(); //확장자
	
	//배열에 추출한 확장자가 존재하는지 체크
	if($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
		resetFormElement($(this)); //폼 초기화
		window.alert('이미지 파일만 등록 가능합니다. (gif, png, jpg, jpeg 만 업로드 가능)');
	} else {
		var file = $(this).prop("files")[0];
		
		var img_id = $(this).attr('id');
		
		blobURL = window.URL.createObjectURL(file);
		$('#' + img_id + '_area').hide();
		$('.' + img_id).show();
		$('.' + img_id).attr('src', blobURL);
		$('.' + img_id).slideDown(); //업로드한 이미지 미리보기 
		//$(this).slideUp(); //파일 양식 감춤
	}
});
$('.radio__input').change(function(){
	var val = this.value;
	
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

function duplicateCheck(){
	var country = $('#country').val();
	var page_title = $('#page_title').val();
	
	var page_table = "whats";
	
	if (country.length == 0 || country == null) {
		alert('국가를 입력해주세요.');
		return false;
	}
	
	if (page_title.length == 0 || page_title == null){
		alert('페이지명을 입력해주세요.');
		return false;
		
	}
	
	$.ajax({
		type: "post",
		data: {
			'country' : country,
			'page_title' : page_title,
			'page_table' : page_table
		},
		dataType: "json",
		url: config.api + "display/check",
		error: function() {
			alert('페이지명 중복체크에 실패했습니다.');
		},
		success: function(d) {
			var data = d.data;
			if(data != null) {
				var page_cnt = data[0].page_cnt;
				if(page_cnt > 0){
					$('#duplicate_btn').css('background-color','#E43A45');
					$('#duplicate_btn').text('중복체크');
	
					alert("페이지명이 중복됩니다. 다른 페이지명을 입력해주세요.");
				} else{
					$('#duplicate_check').val(true);
					$('#duplicate_btn').css('background-color','#114400');
					$('#duplicate_btn').text('체크완료');
				}
			}
		}
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

function whatsNewRegistCheck(){
	var country 		= $('select[name=country]');
	var page_title		= $('input[name=page_title]');
	var page_sub_title 	= $('input[name=page_sub_title]');
	var page_url 		= $('input[name=page_url]');
	
	page_content.getById["page_content"].exec("UPDATE_CONTENTS_FIELD", []);

	if(country.val() == null){
		alert("국가를 선택해주세요", country.focus());
		return false;
	}
	
	if(page_title.val() == null){
		alert("페이지명을 입력해주세요", page_title.focus());
		return false;
	}
	
	if(page_sub_title.val() == null){
		alert("서브 페이지명을 입력해주세요",page_sub_title.focus());
		return false;
	}
	
	var duplicate_check = $('#duplicate_check').val();
	
	if (duplicate_check == "false") {
		alert('상품 진열페이지 등록을 위해 페이지명 중복검사를 확인해주세요.');
		return;
	}
	
	var display_flg = $('#display_flg').val();
	if (display_flg == "false") {
		var display_start_date = $("input[name='display_from']").val() + ' ' + $("select[name='display_from_h']").val() + ':' + $("select[name='display_from_m']").val();
		var display_end_date = $("input[name='display_to']").val() + ' ' + $("select[name='display_to_h']").val() + ':' + $("select[name='display_to_m']").val();
		
		if (display_start_date != null && display_end_date != null) {
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
	var form = $("#frm-add")[0];
	var formData = new FormData(form);

	confirm("What's New를 생성하시겠습니까?",function() {
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "display/whats/add",
			cache: false,
			contentType: false,
			processData: false,
			error: function() {
				alert("What's NEW 생성 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					insertLog("전시관리 > What's New 관리", "새 What's New 링크 생성", null);
					alert("What's NEW 생성 처리에 성공했습니다.",function pageLocation() {
						location.href='/display/whats/list';
					});					
				}
			}
		});
	});
}
</script>