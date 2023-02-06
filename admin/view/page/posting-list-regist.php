<div class="content__card">
	<form id="frm-add" action="posting/list/add">
		<?php
		function getUrlParamter($url, $sch_tag) {
			$parts = parse_url($url);
			parse_str($parts['query'], $query);
			return $query[$sch_tag];
		}
		
		$page_url = $_SERVER['REQUEST_URI'];
		$list_idx = getUrlParamter($page_url, 'list_idx');
		?>
		<input id="list_idx" type="hidden" name="list_idx" value="<?=$list_idx?>">
		
		<div class="card__header">
			<h3>게시물 리스트 등록</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">국가</div>
					<div class="content__row" style="display: block;">
						<select id="country" class="fSelect eSearch" name="country" style="width:163px;">
							<option value="">국가 선택</option>
							<option value="KR">한국몰</option>
							<option value="EN">영문몰</option>
							<option value="CN">중문몰</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">리스트 타이틀</div>
				<div class="content__row">
					<input id="list_title" type="text" name="list_title" style="width:100%;">
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">리스트 메모</div>
				<div class="content__row">
					<textarea id="list_memo" name="list_memo" style="width:100%; height:150px; border:solid 1px #bfbfbf;"></textarea>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">리스트 진열 상태</div>
					<div class="content__row">
						<div class="rd__block">							
							<input id="display_flg_false" type="radio" name="display_flg" value="FALSE" checked>
							<label for="display_flg_false">진열안함</label>
							
							<input id="display_flg_true" type="radio" name="display_flg" value="TRUE">
							<label for="display_flg_true">진열함</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">리스트 진열 시작일</div>
					<div class="content__row">
						<div class="content__date__picker">
							<input id="display_start_date" class="date_param margin-bottom-6" type="date" name="display_start_date" placeholder="From" style="width:150px;">
							
							<select id="display_start_h" class="display_date" type="select" name="display_start_h" style="width:80px">
								<option value="" selected>시간</option>
							</select>
							
							<select id="display_start_m" class="display_date" type="select" name="display_start_m" style="width:80px">
								<option value="">분</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">리스트 진열 종료일</div>
					<div class="content__row">
						<div class="content__date__picker">
							<input id="display_end_date" class="date_param" type="date" name="display_end_date" placeholder="To" readonly style="width:150px;">
							
							<select id="display_end_h" class="display_date" type="select" name="display_end_h" style="width:80px">
								<option value="" checked>시간</option>
							</select>
							
							<select id="display_end_m" class="display_date" type="select" name="display_end_m" style="width:80px">
								<option value="" checked>분</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			
			<div class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div class="filter__btn" onclick="getPostingModal();">게시물 검색</div>
					</div>                          
				</div>
				
				<div class="overflow-x-auto">
					<input id="page_idx" type="hidden" name="page_idx" value="0">
					<TABLE id="excel_table" style="width:150%;">
						<THEAD>
							<TR>
								<TH style="width:250px;">게시물 삭제</TH>
								<TH style="width:200px;;">국가</TH>
								<TH style="width:250px;">게시물 타입</TH>
								<TH style="width:500px;">게시물 타이틀</TH>
								<TH style="width:500px;">게시물 메모</TH>
								<TH style="width:500px;">게시물 URL</TH>
								<TH style="width:150px;">게시물 진열상태</TH>
								<TH style="width:350px;">게시물 진열기간</TH>
								<TH style="width:200px;">게시물 조회수</TH>
								<TH style="width:350px;">게시물 작성일</TH>
								<TH style="width:250px;">게시물 작성자</TH>
								<TH style="width:350px;">게시물 수정일</TH>
								<TH style="width:250px;">게시물 수정자</TH>
							</TR>
						</THEAD>
						<TBODY id="result_table">
							<TR>
								<TD class="default_td" colspan="13" style="text-align:left;">
									선택된 게시물이 없습니다. 게시물을 선택해주세요.
								</TD>
							</TR>
						</TBODY>
					</TABLE>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div toggle="hide"></div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="checkPostingList();"><span>등록</span></div>
					<div class="defult__color__btn" onClick="location.href='posting/list'"><span>취소</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	timeSelectInit();
});

function timeSelectInit(){
	for(var i = 0; i < 24; i++){
		$("select[name='display_start_h']").append('<option value="' + i.toString().padStart(2,'0') + '">' + i.toString().padStart(2,'0') + '시</option>');
		$("select[name='display_end_h']").append('<option value="' + i.toString().padStart(2,'0') + '">' + i.toString().padStart(2,'0') + '시</option>');
	}
	
	for(var j = 0; j < 60; j++){
		$("select[name='display_start_m']").append('<option value="' + j.toString().padStart(2,'0') + '">' + j.toString().padStart(2,'0') + '분</option>');
		$("select[name='display_end_m']").append('<option value="' + j.toString().padStart(2,'0') + '">' + j.toString().padStart(2,'0') + '분</option>');
	}
}

function getPostingModal() {
	modal('/get');
}

function deletePostingPage(obj) {
	$('#result_table').html('');
	
	let strDiv = "";
	strDiv += '<TR>';
	strDiv += '    <TD class="default_td" colspan="13" style="text-align:left;">';
	strDiv += '        선택된 게시물이 없습니다. 게시물을 선택해주세요.';
	strDiv += '    </TD>';
	strDiv += '</TR>';
	
	$('#result_table').append(strDiv);
	$('#page_idx').val(0);
}

function checkPostingList() {
	let country = $('#country').val();
	if (country == "" || country == null) {
		alert('게시물 리스트의 국가를 선택해주세요.');
		return false;
	}
	
	let list_title = $('#list_title').val();
	if (list_title == "" || list_title == null) {
		alert('타이틀을 입력해주세요.');
		return false;
	}
	
	let display_flg = $("input[name='display_flg']:checked").val();
	
	let display_start_date = $('#display_start_date').val();
	let display_start_h = $('#display_start_h').val();
	let display_start_m = $('#display_start_m').val();
	
	let display_end_date = $('#display_end_date').val();
	let display_end_h = $('#display_end_h').val();
	let display_end_m = $('#display_end_m').val();
	
	if (
		display_start_date == "" || display_start_h == "" || display_start_m == "" ||
		display_start_date == null || display_start_h == null || display_start_m == null
	) {
		alert('리스트 진열 시작일/시간을 선택해주세요.');
		return false;
	}
	
	if (
		display_end_date == "" || display_end_h == "" || display_end_m == "" ||
		display_end_date == null || display_end_h == null || display_end_m == null
	) {
		alert('리스트 진열 종료일/시간을 선택해주세요.');
		return false;
	}
	
	let now = new Date();
	let display_from_date = new Date(display_start_date + ' ' + display_start_h + ':' + display_start_m);
	let display_to_date = new Date(display_end_date + ' ' + display_end_h + ':' + display_end_m);
	if (display_from_date != null && display_to_date != null) {
		if (display_from_date > display_to_date) {
			alert('리스트 진열 시작일/종료일에 올바른 날짜를 입력해주세요.');
			return false;
		}
		
		if (now >= display_to_date) {
			alert('리스트 진열 시작일/종료일에 올바른 날짜를 입력해주세요.');
			return false;
		}
	} else {
		alert('진열 시작일/종료일에 정확한 날짜를 입력해주세요.');
		return false;
	}
	
	let page_idx = $('#page_idx').val();
	if (page_idx == 0) {
		alert('게시물을 선택해주세요.');
		return false;
	}
	
	addPostingList();
}

function addPostingList() {
	var form = $("#frm-add")[0];
	var formData = new FormData(form);

	confirm("게시물 리스트를 등록하시겠습니까?",function() {
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "posting/list/add",
			cache: false,
			contentType: false,
			processData: false,
			error: function() {
				alert("게시물 리스트 등록 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					confirm("게시물 리스트 등록 처리에 성공했습니다.",function pageLocation() {
						location.href='/posting/list';
					});					
				}
			}
		});
	});
}
</script>