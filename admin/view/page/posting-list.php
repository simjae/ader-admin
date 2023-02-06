<style>
#registPostingBtn{
	width:120px;
	height:30px;
	border:1px solid #000000;
	background-color:#ffffff;
	color:#000000;
	margin-right:10px;
	cursor:pointer;
}
</style>

<div class="content__card">
	<form id="frm-filter" action="posting/list/list/get">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="IDX">

		<div class="card__header">
			<h3>게시물 리스트 검색</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="body__info--count" style="display: block;margin:20px 0;">
				<div class="drive--left"></div>
				<div class="flex justify-between" style="gap:20px;">
					<div class="flex items-center" style="gap: 20px;">
						
					</div>
					<div>
						<button id="registPostingBtn" type="button" onClick="location.href='/posting/list/regist'">게시물 리스트 등록</button>
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">국가</div>
					<div class="content__row" style="display: block;">
						<select class="fSelect eSearch" name="country" style="width:163px;">
							<option value="ALL" selected>전체</option>
							<option value="KR">한국몰</option>
							<option value="EN">영문몰</option>
							<option value="CN">중문몰</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">타이틀</div>
				<div class="content__row">
					<div class="cb__color">
						<label>
							<input class="posting_type" type="checkbox" name="posting_type[]" value="ALL" onClick="checkPostingType(this);" checked>
							<span>전체</span>
						</label>
						
						<label>
							<input class="posting_type" type="checkbox" name="posting_type[]" value="COLA" onClick="checkPostingType(this);">
							<span>콜라보레이션</span>
						</label>
						
						<label>
							<input class="posting_type" type="checkbox" name="posting_type[]" value="COLC" onClick="checkPostingType(this);">
							<span>컬렉션</span>
						</label>
						
						<label>
							<input class="posting_type" type="checkbox" name="posting_type[]" value="EDTL" onClick="checkPostingType(this);">
							<span>에디토리얼</span>
						</label>
						
						<label>
							<input class="posting_type" type="checkbox" name="posting_type[]" value="EXHB" onClick="checkPostingType(this);">
							<span>기획전</span>
						</label>
						
						<label>
							<input class="posting_type" type="checkbox" name="posting_type[]" value="LKBK" onClick="checkPostingType(this);">
							<span>룩북</span>
						</label>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">타이틀</div>
				<div class="content__row">
					<input type="text" name="title" style="width:100%;">
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">메모</div>
				<div class="content__row">
					<input type="text" name="memo" style="width:100%;">
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">리스트 전시 상태</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="list_display_status_all" type="radio" name="list_display_status" value="ALL" checked>
							<label for="list_display_status_all">전체</label>
							
							<input id="list_display_status_dpc" type="radio" name="list_display_status" value="DPC">
							<label for="list_display_status_dpc">진열중</label>
							
							<input id="list_display_status_dwt" type="radio" name="list_display_status" value="DWT">
							<label for="list_display_status_dwt">진열대기</label>
							
							<input id="list_display_status_ded" type="radio" name="list_display_status" value="DED">
							<label for="list_display_status_ded">진열종료</label>
							
							<input id="list_display_status_dno" type="radio" name="list_display_status" value="DNO">
							<label for="list_display_status_dno">진열안함</label>
						</div>
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">리스트 진열 기간</div>
					<div class="content__row">
						<div class="content__date__picker">
							<input class="date_param margin-bottom-6" type="date" name="list_date_from" placeholder="From" style="width:150px;">
							<font>~</font>
							<input class="date_param" type="date" name="list_date_to" placeholder="To" readonly style="width:150px;">
						</div>
					</div>
				</div>
			</div>
							
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">게시물 진열 상태</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="posting_display_status_all" type="radio" name="posting_display_status" value="ALL" checked>
							<label for="posting_display_status_all">전체</label>
							
							<input id="posting_display_status_dpc" type="radio" name="posting_display_status" value="DPC">
							<label for="posting_display_status_dpc">진열중</label>
							
							<input id="posting_display_status_dwt" type="radio" name="posting_display_status" value="DWT">
							<label for="posting_display_status_dwt">진열대기</label>
							
							<input id="posting_display_status_ded" type="radio" name="posting_display_status" value="DED">
							<label for="posting_display_status_ded">진열종료</label>
							
							<input id="posting_display_status_dno" type="radio" name="posting_display_status" value="DNO">
							<label for="posting_display_status_dno">진열안함</label>
						</div>
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">게시물 진열 기간</div>
					<div class="content__row">
						<div class="content__date__picker">
							<input class="date_param margin-bottom-6" type="date" name="posting_date_from" placeholder="From" style="width:150px;">
							<font>~</font>
							<input class="date_param" type="date" name="posting_date_to" placeholder="To" readonly style="width:150px;">
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div toggle="hide"></div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getPostingList();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter','getPostingList');"><span>초기화</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="content__card">
	<div class="card__header">
		<h3>게시물 진열순서 변경</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<div class="table table__wrap">
			<div class="overflow-x-auto">
				<TABLE style="width:40%;">
					<THEAD>
						<TR>
							<TH style="width:20%;">진열순서 변경</TH>
							<TH>게시물 타입</TH>
							<TH>작성 게시물 수</TH>
						</TR>
					</THEAD>
					<TBODY id="order_table">
					</TBODY>
				</TABLE>
			</div>
		</div>
	</div>
</div>

<div class="content__card">
	<form id="frm-list">
		<div class="card__header">
			<h3>게시물 리스트 검색 결과</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 상품 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
				</div>
					
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
						<option value="CREATE_DATE|DESC">등록일 역순</option>
						<option value="CREATE_DATE|ASC" selected>등록일 순</option>
						<option value="UPDATE_DATE|DESC">수정일 역순</option>
						<option value="UPDATE_DATE|ASC">수정일 순</option>
						<option value="LIST_TITLE|DESC">LIST_TITLE 역순</option>
						<option value="LIST_TITLE|ASC">LIST_TITLE 순</option>
					</select>
					<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="rowsChange(this);">
						<option value="10" selected>10개씩보기</option>
						<option value="20">20개씩보기</option>
						<option value="30">30개씩보기</option>
						<option value="50">50개씩보기</option>
						<option value="100">100개씩보기</option>
						<option value="200">200개씩보기</option>
						<option value="300">300개씩보기</option>
						<option value="500">500개씩보기</option>
					</select>
				</div>
			</div>
			
			<div class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div class="filter__btn" onclick="">복사</div>
						<div class="filter__btn" onclick="deletePostingList();">삭제</div>
						<div class="filter__btn" onclick="">엑셀 다운로드</div>
					</div>                          
					
					<div>
						<div class="table__setting__btn">설정</div>
					</div>      
				</div>
				
				<div class="overflow-x-auto">
					<TABLE id="excel_table" style="width:250%;">
						<THEAD>
							<TR>
								<TH style="width:50px;">
									<div class="cb__color">
										<label>
											<input type="checkbox" onClick="selectAllClick(this);">
											<span></span>
										</label>
									</div>
								</TH>
								<TH style="width:100px;">No.</TH>
								<TH style="width:200px;">국가</TH>
								<TH style="width:500px;">리스트 타이틀</TH>
								<TH style="width:500px;">리스트 메모</TH>
								<TH style="width:150px;">리스트 진열상태</TH>
								<TH style="width:350px;">리스트 진열기간</TH>
								<TH style="width:250px;">게시물 타입</TH>
								<TH style="width:500px;">게시물 타이틀</TH>
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
								<TD class="default_td" colspan="18" style="text-align:left;">
									조회 결과가 없습니다.
								</TD>
							</TR>
						</TBODY>
					</TABLE>
				</div>
			</div>
			
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" tab_num="ALL" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" tab_num="ALL" value="0" onChange="setPaging(this);">
            	<div class="paging"></div>
        	</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	getPostingOrder();
	getPostingList();
});

function checkPostingType(obj) {
	let posting_type = $(obj).val();
	
	if (posting_type != "ALL") {
		$('.posting_type').eq(0).prop('checked',false);
	} else {
		for (let i=1; i<$('.posting_type').length; i++) {
			$('.posting_type').eq(i).prop('checked',false);
		}
	}
}

function displayNumCheck(obj) {
	let action_type = $(obj).attr('action_type');
	let recent_idx = $(obj).attr('recent_idx');
	let recent_num = $(obj).attr('recent_num');
	
	let cnt = 0;
	cnt = $('.order_idx').length;
	
	if (action_type == "up") {
		if (recent_num == 1) {
			alert('진열순서를 변경할 수 없습니다');
			return false;
		} else {
			updateDisplayNum(action_type,recent_idx,recent_num);
		}
	} else if (action_type == "down") {
		if (recent_num == cnt) {
			alert('진열순서를 변경할 수 없습니다');
			return false;
		} else {
			updateDisplayNum(action_type,recent_idx,recent_num);
		}
	}
}

function updateDisplayNum(action_type,recent_idx,recent_num) {
	$.ajax({
		url: config.api + "posting/list/order/put",
		type: "post",
		data: {
			'action_type': action_type,
			'recent_idx': recent_idx,
			'recent_num': recent_num
		},
		dataType: "json",
		error: function() {
			alert('게시물 진열순서 변경처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				$('#order_table').html('');
				getPostingOrder();
			} else {
				alert('진열순서 변경 처리에 실패했습니다. 변경하려는 게시물 타입의 진열순서를 확인해주세요.');
			}
		}
	});
}

function getPostingOrder() {
	$.ajax({
		url: config.api + "posting/list/order/get",
		type: "post",
		dataType: "json",
		error: function() {
			alert('게시물 리스트 진열순서 조회처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			if (d != null) {
				let data = d.data;
				
				data.forEach(function(row) {
					let strDiv = "";
					strDiv += '<TR>';
					strDiv += '	<TD class="order_idx">';
					strDiv += '		<div class="btn" onclick="displayNumCheck(this)" recent_idx="' + row.order_idx + '" recent_num="' + row.display_num + '" action_type="up">';
					strDiv += '			<i class="xi-angle-up"></i>';
					strDiv += '			<span class="tooltip top">위로</span>';
					strDiv += '		</div>';
					strDiv += '		<div class="btn" onclick="displayNumCheck(this)" recent_idx="' + row.order_idx + '" recent_num="' + row.display_num + '" action_type="down">';
					strDiv += '			<i class="xi-angle-down"></i>';
					strDiv += '			<span class="tooltip top">아래로</span>';
					strDiv += '		</div>';
					strDiv += '	</TD>';
					strDiv += '	<TD>' + row.posting_type + '</TD>';
					strDiv += '	<TD>' + row.posting_cnt + '</TD>';
					strDiv += '<TR>';
					
					$('#order_table').append(strDiv);
				});
			}
		}
	});
}

function deletePostingStory() {
	let checkbox = $('.list_idx');
	let cnt = checkbox.length;
	
	let list_idx = [];
	for (let i=0; i<cnt; i++) {
		if (checkbox.eq(i).prop('checked') == true) {
			let checked_val = checkbox.eq(i).val();
			list_idx.push(checked_val);
		}
	}
	
	$.ajax({
		url: config.api + "posting/list/delete",
		type: "post",
		data: {
			'list_idx': list_idx,
		},
		dataType: "json",
		error: function() {
			alert('게시물 리스트 삭제처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				getPostingList();
				alert('선택한 게시물 리스트가 삭제되었습니다.');
			} else {
				alert('선택한 게시물 리스트의 삭제 처리에 실패했습니다. 삭제하려는 게시물 리스트를 확인해주세요.');
			}
		}
	});
}

function setPaging(obj) {
	var tab_num = $(obj).attr('tab_num');

	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function getPostingList(){
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TR>';
	strDiv += '    <TD class="default_td" colspan="18" style="text-align:left;">';
	strDiv += '        조회 결과가 없습니다.';
	strDiv += '    </TD>';
	strDiv += '</TR>';
	
	$("#result_table").append(strDiv);
	
	var rows = $("#frm-filter").find('.rows').val();
	var page = $("#frm-filter").find('.page').val();
	get_contents($("#frm-filter"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
			}
			
			d.forEach(function(row) {
				let strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <TD>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label>';
				strDiv += '                <input class="select list_idx" type="checkbox" name="list_idx[]" value="' + row.list_idx + '">';
				strDiv += '                <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.num + '</TD>';
				strDiv += '    <TD>' + row.country + '</TD>';
				strDiv += '    <TD>';
				strDiv += '        <a href="/posting/list/update?list_idx=' + row.list_idx + '">' + row.list_title + '</a>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.list_memo + '</TD>';
				strDiv += '    <TD>' + row.list_display_status + '</TD>';
				strDiv += '    <TD>' + row.list_start_date + ' ~ ' + row.list_end_date + '</TD>';
				strDiv += '    <TD>' + row.posting_type + '</TD>';
				strDiv += '    <TD>' + row.page_title + '</TD>';
				strDiv += '    <TD>' + row.page_url + '</TD>';
				strDiv += '    <TD>' + row.posting_display_status + '</TD>';
				strDiv += '    <TD>' + row.posting_start_date + ' ~ '+ row.posting_end_date + '</TD>';
				strDiv += '    <TD>' + row.page_view + '</TD>';
				strDiv += '    <TD>' + row.create_date + '</TD>';
				strDiv += '    <TD>' + row.creater + '</TD>';
				strDiv += '    <TD>' + row.update_date + '</TD>';
				strDiv += '    <TD>' + row.updater + '</TD>';
				strDiv += '</TR>';
				
				$("#result_table").append(strDiv);
			});
		},
	},rows, page);
}
</script>