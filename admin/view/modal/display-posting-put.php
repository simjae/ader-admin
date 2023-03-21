<style>
#seo{margin-top : 50px;}
.sub{margin-top : 10px;}
#check_duplicate_btn {width:95px;height:28px;background-color:#114400;color:#ffffff;text-align:center;font-size:0.7rem;padding-top:8px;padding-bottom:8px;cursor:pointer;}
</style>
<!-- START RESPONSE CARD -->

<div class="content__card modal__view">
	
	<div class="card__header">
		<h3 class="page_name">
			<a onclick="modal_close();" class="btn-close" style="float:right">
				<i class="xi-close"></i>
			</a>
		</h3>
		<div class="drive--x"></div>
	</div>	
	
	<div class="card__body">
		<form id="frm-put">
			<input id="page_idx" type="hidden" name="page_idx" value="<?=$page_idx?>">
			<input class="posting_type" type="hidden" name="posting_type" value="">
			<input class="country" type="hidden" name="country" value="">
			<input id="update_flg" type="hidden" name="update_flg" value="">
			<div class="content__wrap">
				<div class="content__title">페이지명</div>
				<div class="content__row">
					<input id="duplicate_check" type="hidden" value="true">
					
					<input class="page_title" type="text" value="" name="page_title" style="width:80%;">
					<div id="check_duplicate_btn" onclick="checkPageTitle()">중복체크</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">페이지메모</div>
				<div class="content__row">
					<input class="page_memo" type="text" value="" name="page_memo" style="width:80%;">
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">진열 예약 설정</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="display_flg_TRUE" class="radio__input" type="radio" name="display_flg" value="true" checked>
						<label for="display_flg_TRUE">상시 오픈</label>
						
						<input id="display_flg_FALSE" class="radio__input" type="radio" name="display_flg" value="false">
						<label for="display_flg_FALSE">지정 시간에만</label>
						
						<div class="content__date__picker">
							<input class="display_from" type="date" name="display_from" placeholder="From" readonly style="width:150px">
							
							<select class="display_from_h" type="select" name="display_from_h" style="width:80px">
								<option value="" selected>시간</option>
							</select>
							
							<select class="display_from_m" type="select" name="display_from_m" style="width:80px">
								<option value="" selected>분</option>
							</select>
							
							<br><font>~</font><br>
							
							<input class="display_to" type="date" name="display_to" placeholder="To" readonly style="width:150px;">
							
							<select class="display_to_h" type="select" name="display_to_h" style="width:80px">
								<option value="" selected>시간</option>
							</select>
							
							<select class="display_to_m" type="select" name="display_to_m" style="width:80px">
								<option value="" selected>분</option>
							</select>
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
							<input id="search_exposure_flg_TRUE" class="radio__input" type="radio" value="true" name="seo_exposure_flg" checked>
							<label for="search_exposure_flg_TRUE">노출함</label>
							
							<input id="search_exposure_flg_FALSE" class="radio__input" type="radio" value="false" name="seo_exposure_flg">
							<label for="search_exposure_flg_FALSE">노출안함</label>
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
						<textarea name="seo_description" id="seo_description" cols="70" rows="10" style="width:90%;"></textarea>
					</div>
				</div>
				
				<div class="content__wrap">
					<div class="content__title">검색엔진<br>메타태그Keywords</div>
					<div class="content__row">
						<input type="text" name="seo_keywords">
					</div>
				</div>

				<div class="content__wrap">
					<div class="content__title">검색엔진<br>메타태그 Alt 텍스트</div>
					<div class="content__row">
						<textarea name="seo_alt_text" id="seo_alt_text" cols="70" rows="10" style="width:90%;"></textarea>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap" style="grid: none;">
			<div class="btn__wrap--lg">
				<div  onclick="putPagePosting();" class="blue__color__btn"><span>저장</span></div>
				<div onclick="location.href='/display/posting'" class="defult__color__btn"><span>작성 취소</span></div>
			</div>
		</div>
	</div>
</div>


<!-- START RESPONSE CARD -->
<script>
var seo_description = [];
var seo_alt_text = [];

$(document).ready(function() {
	setSmartEditor();
	timeSelectInit();
	
	$('.display_date').val('');
	$('.display_date').attr("disabled", true);
	
	$('.page_title').change(function() {
		$('#duplicate_check').val(false);
		
		$('#check_duplicate_btn').css('background-color','#E43A45');
		$('#check_duplicate_btn').text('중복체크');
	});
	
	getPagePosting();
});

function setSmartEditor() {
	//seo
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: seo_description,
		elPlaceHolder: "seo_description",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: seo_alt_text,
		elPlaceHolder: "seo_alt_text",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
}

function timeSelectInit(){
	for(var i = 0; i < 24; i++){
		$(".display_from_h").append('<option value="' + i.toString().padStart(2,'0') + '">' + i.toString().padStart(2,'0') + '시</option>');
		$(".display_to_h").append('<option value="' + i.toString().padStart(2,'0') + '">' + i.toString().padStart(2,'0') + '시</option>');
	}
	
	for(var j = 0; j < 60; j++){
		$(".display_from_m").append('<option value="' + j.toString().padStart(2,'0') + '">' + j.toString().padStart(2,'0') + '분</option>');
		$(".display_to_m").append('<option value="' + j.toString().padStart(2,'0') + '">' + j.toString().padStart(2,'0') + '분</option>');
	}
}

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
});

function checkPageTitle(){
	var country = $('.country').val();
	var posting_type = $('#posting_type').val();
	var page_title = $('.page_title').val();
	
	if (country.length == 0 || country == null){
		alert('국가를 선택해주세요.');
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
			'posting_type' : posting_type,
			'page_title' : page_title
		},
		dataType: "json",
		url: config.api + "display/posting/check",
		error: function() {
			alert('페이지명 중복체크중 오류가 발생했습니다.');
		},
		success: function(d) {
			if (d.code == 200) {
				$('#duplicate_check').val(true);
				
				$('#check_duplicate_btn').css('background-color','#114400');
				$('#check_duplicate_btn').text('체크완료');
			} else {
				$('#check_duplicate_btn').css('background-color','#E43A45');
				$('#check_duplicate_btn').text('중복체크');
				
				alert(d.msg);
				return false;
			}
		}
	});
}

function getPagePosting() {
	let page_idx = $('#page_idx').val();
	
	$.ajax({
		type: "post",
		data: {
			'page_idx' : page_idx
		},
		dataType: "json",
		url: config.api + "display/posting/get",
		error: function() {
			alert(page_name + " 페이지 조회 처리 중 오류가 발생했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data[0];
				
				$('.country').val(data.country);
				$('.posting_type').val(data.posting_type);
				
				let posting_type = "";
				switch (data.posting_type) {
					case "EDTL" :
						posting_type = "에디토리얼";
						break;
					
					case "RNWY" :
						posting_type = "런웨이";
						break;
					
					case "COLC" :
						posting_type = "컬렉션";
						break;
					
					case "COLA" :
						posting_type = "콜라보레이션";
						break;
				}
				
				console.log(data.posting_type);
				
				$('.page_name').html(`${posting_type} 수정 
				<a onclick="modal_close();" class="btn-close" style="float:right">
					<i class="xi-close"></i>
				</a>`);
				
				$("input[name='page_title']").val(data.page_title);
				$("input[name='page_memo']").val(data.page_memo);
				
				if (data.end_date == '9999-12-31') {
					$('#display_flg_TRUE').prop('checked',true);
					$('.display_date').attr("disabled", true);
				} else {
					$('#display_flg_FALSE').prop('checked',true);
					$('.display_date').removeAttr("disabled");
				}
				
				$('.display_from').val(data.start_date);
				$('.display_to').val(data.end_date);
				
				$("select[name='display_from_h']").val(data.start_h);
				$("select[name='display_from_m']").val(data.start_m);

				$("select[name='display_to_h']").val(data.end_h);
				$("select[name='display_to_m']").val(data.end_m);
				
				var seo_exposure_flg = data.seo_exposure_flg;
				if (seo_exposure_flg == true) {
					$("input[name='seo_exposure_flg'][value='true']").prop('checked',true);
				} else {
					$("input[name='seo_exposure_flg'][value='false']").prop('checked',true);
				}
				
				$("input[name='seo_title']").val(data.seo_title);
				$("input[name='seo_author']").val(data.seo_author);
				$("textarea[name='seo_description']").text(data.seo_description);
				$("textarea[name='seo_keywords']").text(data.seo_keywords);
			} else {
				alert(d.msg);
			}
		}
	});
}

function putPagePosting(){
	let country = $('.country').val();
	if(country.length == 0 || country == null){
		alert("게시물을 전시 할 국가를 선택해주세요");
		return false;
	}
	
	let page_title = $('.page_title').val();
	if(page_title.length == 0 || page_title == null){
		alert("페이지명을 입력해주세요");
		return false;
	}
	
	let duplicate_check = $('#duplicate_check').val();
	if (duplicate_check == "false") {
		alert('상품 진열페이지 수정을 위해 페이지명 중복검사를 확인해주세요.');
		return;
	}
	
	let display_flg = $("input[name='display_flg']:checked").val();
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
	
	seo_description.getById["seo_description"].exec("UPDATE_CONTENTS_FIELD", []); 
	seo_alt_text.getById["seo_alt_text"].exec("UPDATE_CONTENTS_FIELD", []); 
	
	$('#update_flg').val(true);
	
	var formData = new FormData();
	formData = $("#frm-put").serializeObject();
	
	let posting_type = $('.posting_type').val();
	
	let page_name = "";
	switch (posting_type) {
		case "EDTL" :
			page_name = "에디토리얼";
			break;
		
		case "RNWY" :
			page_name = "런웨이";
			break;
		
		case "COLA" :
			page_name = "콜라보레이션";
			break;
	}
	
	confirm('게시물 페이지를 수정하시겠습니까?',function() {
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "display/posting/put",
			error: function() {
				alert(page_name + " 페이지 수정 처리 중 오류가 발생했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert(
						page_name + ' 페이지가 수정되었습니다.',
						function () {
							insertLog("전시관리 > 게시물 관리", "새 기획전 페이지 수정", 1);
							location.href='/display/posting';
						}
					);
				} else {
					alert(d.msg);
				}
			}
		});
	});
}
</script>