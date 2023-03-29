<style>
#seo{margin-top : 50px;}
.sub{margin-top : 10px;}
</style>
<div class="content__card" style="margin: 0;">
	<form id="frm-add" action="display/product/add">
		<input type="hidden" name="">
	
		<div class="card__header">
			<div class="flex justify-between">
				<h3>상품 진열 페이지 등록</h3>
				<a href="javascript:;" style="cursor:pointer;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
			</div>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
		<div class="content__wrap">
			<div class="content__title">페이지명</div>
				<div class="content__row">
					<input id="duplicate_check" type="hidden" value="false">
					<input id="page_title" type="text" value="" style="width:80%;" placeholder="" name="page_title">
					<div id="duplicate_btn" class="defult-btn" style="width:95px;background-color:#e43a45;color:#ffffff;font-size:0.5rem;text-align:center;" onclick="duplicateCheck()">중복체크</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">비고</div>
				<div class="content__row">
					<input type="text" value="" style="width:80%;" placeholder=""  name="page_memo">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">회원등급별 접근제한</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="prodRank1" class="radio__input" value="all" name="display_member_level" checked>
						<label for="prodRank1">전체 이용 가능</label>
						<input type="radio" id="prodRank2" class="radio__input" value="member" name="display_member_level">
						<label for="prodRank2">회원 전체 이용 가능</label>
						<input type="radio" id="prodRank3" class="radio__input" value="level" name="display_member_level">
						<label for="prodRank3">회원 일부 이용 가능</label>
					</div>
				</div>
				<div class="content__title"></div>
                <div class="content__row">
					<div class="cb__color sub hidden">
<?php
	$sql = "
			SELECT
				IDX,
				TITLE
			FROM 
				MEMBER_LEVEL
			ORDER BY
				IDX ASC
	";
	$db->query($sql);
	foreach($db->fetch() as $data){
		$level_idx = $data['IDX'];
		$level_title = $data['TITLE'];
?>
						<input type="checkbox" id="member_level_<?=$level_idx?>" value="<?=$level_idx?>" name="member_level[]"/>
						<label><?=$level_title?></label>			
<?PHP
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
						<div id="ipInputList" style="width: 100%;height:300px;border: 1px solid #000;padding:10px;overflow-y:scroll;">
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
						<input id="display_flg" type="hidden" value="false">
						<input type="radio" id="display_flg_true" class="radio__input display_flg" value="true" name="display_flg" checked/>
						<label for="display_flg_true">상시 오픈</label>
						
						<input type="radio" id="display_flg_false" class="radio__input display_flg" value="false" name="display_flg"/>
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
					<div  onclick="productDisplayRegistCheck();"  class="blue__color__btn" onClick=""><span>저장</span></div>
					<div onclick="modal_cancel();" class="defult__color__btn"><span>작성 취소</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>
<script>
$(document).ready(function() {
	//수정
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
});

$("input[name='display_member_level']").change(function(){
	if($(this).val() == 'level'){
		$('.sub').removeClass('hidden');  
	}
	else{
		$('.sub').addClass('hidden');
	}
});

$('.radio__input').change(function(){
	var radio_type = $(this).attr('radio_type');
	
	if (radio_type == "display") {
		var val = $(this).val();
		if (val == "true") {
			$('.display_date').val('');
			$('.display_date').attr("disabled", true);
		} else {
			$('.display_date').removeAttr("disabled");
		}
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
		} else{
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

function duplicateCheck(){
	var page_title = $('#page_title').val();
	var page_table = "product";
	
	if(page_title.length == 0 || page_title == null){
		alert('페이지명을 입력해주세요.');
		return false;
		
	} else{
		$.ajax({
			type: "post",
			data: {
				'page_title':page_title,
				'page_table':page_table
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

function productDisplayRegistCheck(){
	var duplicate_check = $('#duplicate_check').val();
	
	if (duplicate_check == "false") {
		alert('상품 진열페이지 등록을 위해 페이지명 죽복검사를 확인해주세요.');
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
	insertLog("전시관리 > 상품진열", "상품 진열 페이지 등록", null);
	modal_submit($('#frm-list'),'getProdPageInfo');
}
</script>


