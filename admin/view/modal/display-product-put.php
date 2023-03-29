<style>
#seo{margin-top : 50px;}
.sub{margin-top : 10px;}
#check_duplicate_btn {width:95px;height:28px;background-color:#114400;color:#ffffff;text-align:center;font-size:0.7rem;padding-top:8px;padding-bottom:8px;cursor:pointer;}
</style>

<div class="content__card modal__view" style="width:1024px;">
	
		
	<div class="card__header">
		<h3>상품 진열페이지 수정
			<a onclick="modal_close();" class="btn-close" style="float:right">
				<i class="xi-close"></i>
			</a>
		</h3>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">	
		<form id="frm-put">
			<input id="page_idx" type="hidden" name="page_idx" value="<?=$page_idx?>">
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
				<div class="content__title">레벨별 접근제한</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="display_member_ALL" class="radio__input" value="all" name="display_member_level">
						<label for="display_member_ALL">전체 이용 가능</label>
						
						<input type="radio" id="display_member_MEM" class="radio__input" value="level" name="display_member_level">
						<label for="display_member_MEM">회원 일부 이용 가능</label>
					</div>
				</div>
				
				<div class="content__title"></div>
				<div class="content__row">
					<div id="display_member_wrap" class="cb__color sub hidden" style="width:500px;overflow-x:auto;">
						<?php
							$sql = "
									SELECT
										LV.IDX		AS LEVEL_IDX,
										LV.TITLE	AS LEVEL_TITLE
									FROM 
										MEMBER_LEVEL LV
									ORDER BY
										LV.IDX ASC
							";
							$db->query($sql);
							foreach($db->fetch() as $level_data){
								$level_idx = $level_data['LEVEL_IDX'];
								$level_title = $level_data['LEVEL_TITLE'];
						?>
						<input id="member_level_<?=$level_idx?>" class="member_level" type="checkbox" name="member_level[]" value="<?=$level_idx?>" style="float:left;">
						<label><?=$level_title?></label>			
						<?php
							}
						?>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">접근차단 IP</div>
				<div class="content__row" style="display: block;">
					<div class="flex" style="margin-bottom: 10px;gap: 10px;align-content: center;">
						<input type="text" class="input-ip" value=""  placeholder="" id="prodIp" >
						<div class="defult-btn" onclick="addIp()">IP 추가</div>
					</div>
					<div>
						<div id="ipInputList" style="width: 100%;height:300px;border: 1px solid #000;padding: 10px;overflow-y:scroll;">
							<TABLE>
								<colgroup>
									<col style="width:80%">
									<col style="width:20%">
								</colgroup>
								<THEAD>
									<TR>
										<TH></TH>
										<TH></TH>
									</TR>
								</THEAD>
								<TBODY id="ip_table_result">
								</TBODY>
							</TABLE>
						</div>
					</div>
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
							<input class="display_date display_from" type="date" name="display_from" placeholder="From" readonly style="width:150px">
							
							<select class="display_date display_from_h" type="select" name="display_from_h" style="width:80px">
								<option value="" selected>시간</option>
							</select>
							
							<select class="display_date display_from_m" type="select" name="display_from_m" style="width:80px">
								<option value="" selected>분</option>
							</select>
							
							<br><font>~</font><br>
							
							<input class="display_date display_to" type="date" name="display_to" placeholder="To" readonly style="width:150px;">
							
							<select class="display_date display_to_h" type="select" name="display_to_h" style="width:80px">
								<option value="" selected>시간</option>
							</select>
							
							<select class="display_date display_to_m" type="select" name="display_to_m" style="width:80px">
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
							<input id="search_exposure_flg_TRUE" class="radio__input" type="radio" value="true" name="seo_exposure_flg">
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
				<div  onclick="putPageProduct();" class="blue__color__btn"><span>저장</span></div>
				<div onclick="location.href='/display/product';" class="defult__color__btn"><span>작성 취소</span></div>
			</div>
		</div>
	</div>
</div>
<script>
var seo_description = [];
var seo_alt_text = [];

$(document).ready(function() {
	setSmartEditor();
	timeSelectInit();
	getPageProduct();
	
	$('.display_date').val('');
	$('.display_date').attr("disabled", true);
	
	$('.page_title').change(function() {
		$('#duplicate_check').val(false);
		
		$('#check_duplicate_btn').css('background-color','#E43A45');
		$('#check_duplicate_btn').text('중복체크');
	});
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

$("input[name='display_member_level']").change(function(){
	if($("input[name='display_member_level']:checked").val() == 'level'){
		$('.sub').removeClass('hidden');  
	}
	else{
		$('.sub').addClass('hidden');
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
});

function addIp(){
	var filter = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/;
	var ipAddr = $('#prodIp').val();
	if(overlapChkIp(ipAddr) == false){
		alert("이미 입력하신 IP입니다.");
	}
	else{
		if(filter.test(ipAddr) == true){
		var strDiv = "";
		strDiv += '<tr>';
		strDiv += '    <td>';
		strDiv += '        <input class="tempIp" type="hidden" value="' + ipAddr + '" name="prodIp[]"/>';
		strDiv += '        <span>' + ipAddr + '</span>';
		strDiv += '    </td>';
		strDiv += '    <td>';
		strDiv += '        <button class="defult-btn" onclick="delIp(this)">삭제</button>';
		strDiv += '    </td>';
		strDiv += '<tr>';

		$('#ip_table_result').append(strDiv);
		}
		else{
			alert("IP를 올바르게 입력해 주십시오");
		}
	}
}	
function overlapChkIp(str){
	for(var i = 0; i < $('#ip_table_result').find('.tempIp').length; i++){
		if($('#ip_table_result').find('.tempIp').eq(i).val() == str){
			return false;
		}
	}
	return true;
}

function delIp(obj){
	$(obj).parent().parent().remove();
}

function timeSelectInit(){
	for(var i = 0; i < 24; i++){
		$("select[name='display_from_h']").append('<option value="' + i.toString().padStart(2,'0') + '">' + i.toString().padStart(2,'0') + '시</option>');
		$("select[name='display_to_h']").append('<option value="' + i.toString().padStart(2,'0') + '">' + i.toString().padStart(2,'0') + '시</option>');
	}
	
	for(var j = 0; j < 60; j++){
		$("select[name='display_from_m']").append('<option value="' + j.toString().padStart(2,'0') + '">' + j.toString().padStart(2,'0') + '분</option>');
		$("select[name='display_to_m']").append('<option value="' + j.toString().padStart(2,'0') + '">' + j.toString().padStart(2,'0') + '분</option>');
	}
}

function getPageProduct() {
	var page_idx = $("#page_idx").val();
	
	$.ajax({
		type: "post",
		url: config.api + "display/product/get",
		data: {
			'page_idx' : page_idx
		},
		dataType: "json",
		error: function() {
			alert("상품 진열 페이지 불러오기 중 오류가 발생했습니다.");
		},
		success: function(d) {
			if(d.code == 200) {
				let data = d.data[0];
				
				if (data.seo_description == null) {
					data.seo_description = '';
				}
				
				if (data.seo_keywords  == null) {
					data.seo_keywords = '';
				}

				$("input[name='page_title']").val(data.page_title);
				$("input[name='page_memo']").val(data.page_memo);
				
				let display_member_level = data.display_member_level;
				if (display_member_level != "0") {
					let cnt = display_member_level.length;
					
					for (let i=0; i<cnt; i++) {
						$('#member_level_' + display_member_level[i]).prop('checked',true);
					}
					
					$('#display_member_MEM').prop('checked',true);
					$('#display_member_wrap').removeClass('hidden');
				} else {
					$('#display_member_ALL').prop('checked',true);
				}
				
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
				
				if (d.data.ip != null) {
					for(var ip of d.data.ip){
						var strDiv = "";
						strDiv += '<tr>';
						strDiv += '    <td>';
						strDiv += '        <input class="tempIp" type="hidden" value="' + ip + '" name="prodIp[]"/>';
						strDiv += '        <span>' + ip + '</span>';
						strDiv += '    </td>';
						strDiv += '    <td>';
						strDiv += '        <button class="defult-btn" onclick="delIp(this)">삭제</button>';
						strDiv += '    </td>';
						strDiv += '<tr>';
						
						$('#ip_table_result').append(strDiv);
					}
				}
			}
		}
	});
}

function checkPageTitle(){
	var page_title = $('.page_title').val();
	if (page_title.length == 0 || page_title == null){
		alert('페이지명을 입력해주세요.');
		return false;
	}
	
	$.ajax({
		type: "post",
		data: {
			'page_title' : page_title
		},
		dataType: "json",
		url: config.api + "display/product/check",
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

function putPageProduct(){
	let page_title = $('.page_title').val();
	if(page_title.length == 0 || page_title == null){
		alert("페이지명을 입력해주세요");
		return false;
	}
	
	let duplicate_check = $('#duplicate_check').val();
	if (duplicate_check == "false") {
		alert('상품 진열페이지 등록을 위해 페이지명 중복검사를 확인해주세요.');
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
	
	confirm('상품 진열 페이지를 수정하시겠습니까?',function() {
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "display/product/put",
			error: function() {
				alert("상품 진열 페이지 수정 처리 중 오류가 발생했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert(
						'상품 진열  페이지가 수정되었습니다.',
						function () {
							insertLog("전시관리 > 상품 진열 페이지", "상품 진열 페이지 수정", 1);
							getPageProductList();
							modal_close();
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