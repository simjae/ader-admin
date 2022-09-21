
<!-- START REQUEST CARD -->
<div class="content__card">
	<div class="card__header">
		<h3>게시판 관리(faq)</h3>
		<div class="drive--x"></div>
	</div>
	<div class="flex"style="gap:50px;margin:20px 0;">
		<div class="category__tab" tab_num="04" subtab_num="01" style="color: #140f82;border-bottom: 3px solid #140f82;text-align: center;cursor: pointer;">전체 게시물 보기</div>
	</div>
	<input id="subtab_num" type="hidden" value="01">
	<div class="tabNum tabNum_01">
		<form id="frm-list_04_01" action="display/board/get">
			<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" name="tab_num" value="04">
			<input type="hidden" name="subtab_num" value="01">
			<input type="hidden" class="rows" name="rows" value="10">
			<input type="hidden" class="page" name="page" value="1">
			<div class="card__body">
				<div class="content__wrap">
					<div class="content__title">쇼핑몰 선택</div>
					<div class="content__row" style="display: block;">
						<select name="board_country" id="board_country" style="width:163px;">
							<option value="">전체</option>
							<option value="KR">한국몰</option>
							<option value="EN">영문몰</option>
							<option value="CN">중문몰</option>
						</select>
					</div>
				</div>
				<div class="content__wrap">
					<div class="content__title">작성일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__btn">
								<input id="search_date_faq" type="hidden" name="search_date" value="" style="width:150px;">
								<div class="search_date_boardListWrite date__picker" date_type="boardListWrite" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
								<div class="search_date_boardListWrite date__picker" date_type="boardListWrite" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
								<div class="search_date_boardListWrite date__picker" date_type="boardListWrite" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
								<div class="search_date_boardListWrite date__picker" date_type="boardListWrite" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
								<div class="search_date_boardListWrite date__picker" date_type="boardListWrite" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
								<div class="search_date_boardListWrite date__picker" date_type="boardListWrite" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
								<div class="search_date_boardListWrite date__picker" date_type="boardListWrite" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
							</div>
							<div class="content__date__picker">
								<input id="fna_from" class="date_param  " type="date" name="create_from"  placeholder="From" readonly="" style="width:150px" date_type="boardListWrite" onChange="dateParamChange(this);">
								<font class="" >~</font>
								<input id="fna_to" class="date_param  " type="date" name="create_to" placeholder="To" readonly="" style="width:150px; " date_type="boardListWrite" onChange="dateParamChange(this);">
							</div>
						</div>
					</div>
				</div>
				<div class="content__wrap">
					<div class="content__title">게시판 선택</div>
					<div class="content__row">
						<select class="fSelect" id="board_category" name="board_category" style="width:130px;">
							<option value=""> 카테고리 전체</option>
							<option value="0001">배송/기타문의</option>
							<option value="0002">취소/환불</option>
							<option value="0003">주문/결제</option>
							<option value="0004">출고/배송</option>
							<option value="0005">반품/교환</option>
							<option value="0006">재입고</option>
							<option value="0007">제품문의</option>
							<option value="0008">블루마크/정가품</option>
							<option value="0009">A/S</option>
							<option value="0010">바우처</option>
							<option value="0011">기타서비스</option>
						</select>
					</div>
				</div>
				<div class="content__wrap">
					<div class="content__title">게시글 찾기</div>
					<div class="content__row">
						<select id="search_type" name="search_type" class="fSelect" style="width:130px;">
							<option value="subject">제목</option>
							<option value="content">내용</option>
							<option value="writer_name">작성자</option>
							<option value="product">상품명</option>
							<option value="board_id">아이디</option>
							<option value="client_ip">아이피</option>
						</select>
						<input type="text" name="search_keyword" value="" style="width:40%;">
						<div class="cb__color">
							<label>
								<input type="checkbox" name="boardFlg" value="" >
								<span>비회원</span>
							</label>
						</div>
					</div>
				</div>
				<div class="content__wrap">
					<div class="content__title">첨부파일 여부</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="file_flg_04_01_1" class="radio__input" value="" name="file_flg" checked/>
							<label for="file_flg_04_01_1">전체보기</label>
							<input type="radio" id="file_flg_04_01_2" class="radio__input" value="true" name="file_flg"/>
							<label for="file_flg_04_01_2">있음</label>
							<input type="radio" id="file_flg_04_01_3" class="radio__input" value="false" name="file_flg"/>
							<label for="file_flg_04_01_3">없음</label>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap" style="grid: none;">
			<div class="btn__wrap--lg">
				<div  class="blue__color__btn" onClick="getBoardTabInfo_04()"><span>검색</span></div>
				<div class="defult__color__btn" onClick=""><span>초기화</span></div>
			</div>
		</div>
	</div> 
</div>
<!-- END REQUEST CARD -->

<!-- START RESPONSE CARD -->
<div class="tabNum tabNum_01" style="width: 100%;">
	<div class="content__card">
		<div class="card__header">
			<h3>전체 게시물 목록</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<form id="frm-04-01">
				<input type="hidden" class="action_type" name="action_type">
				<input type="hidden" name="tab_num" value="04">
				<input type="hidden" name="subtab_num" value="01">
				<div class="info__wrap " style="justify-content:space-between; align-items: center;">
					<div class="body__info--count">
						<div class="drive--left"></div>
						오늘 등록된 새 글 <font class="cnt_total info__count">0</font>건 검색결과 <font class="cnt_result info__count">0</font>건
					</div>
						
					<div class="content__row">
						<select class="fSelect" id="eSearchSort" name="searchSort" onChange="orderChange(this);" align="absmiddle" style="width:130px;float:right;margin-right:10px;">
							<option value="" selected="selected">기본정렬</option>
							<option value="H">조회수많은순</option>
						</select>	

						<select name="rows" onChange="rowsChange(this);" style="width: 130px;">
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
				<div class="table__wrap table">
					<div class="table__filter">
						<div class="filrer__wrap">
							<div class="filter__btn" style="width: 130px;" action_type="delete" onclick="boardActionClick(this)">삭제</div>
							<div class="filter__btn" style="width: 130px;" action_type="fix_set" onclick="boardActionClick(this)">글고정 지정</div>
							<div class="filter__btn" style="width: 130px;" action_type="fix_non" onclick="boardActionClick(this)">글고정 해제</div>
							<div class="filter__btn" style="width: 130px;" action_type="setting" onclick="">설정</div>
						</div>                                
					</div>
					<TABLE>
						<THEAD>
							<TR>
								<TH style="width:3%;">
									<div class="cb__color">
										<label>
											<input type="checkbox" name="selectAll" value="" onclick="selectAllClick(this)">
											<span></span>
										</label>
									</div>
								</TH>
								<TH style="width:5%;">번호</TH>
								<TH style="width:10%;">분류</TH>
								<TH style="width:10%;">카테고리</TH>
								<TH>제목</TH>
								<TH>글고정 상태</TH>
								<TH style="width:10%;">작성자</TH>
							</TR>
						</THEAD>
						<TBODY id="result_table_04_01">
						</TBODY>
					</TABLE>
				</div>
				<div class="padding__wrap">
					<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
					<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
					<div class="paging_04_01"></div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- START RESPONSE CARD -->
<script>
$(document).ready(function() {
	
});
function getBoardTabInfo_04() {
	var tab_num = $('#tab_num').val();
	var subtab_num = $('#board_tab_'+tab_num).find('#subtab_num').val();
	
	$("#result_table_04_"+subtab_num).html('');
	console.log(subtab_num);
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="8">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table_04_"+subtab_num).append(strDiv);
	
	var rows = $('#frm-list_04_'+subtab_num).find('.rows').val();
	var page = $('#frm-list_04_'+subtab_num).find('.page').val();
	
	get_contents($('#frm-list_04_'+subtab_num),{
		pageObj : $(".paging_04_" + subtab_num),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table_04_"+subtab_num).html('');
			}
			d.forEach(function(row) {
				var fix_flg = '';
				if(row.fix_flg == true) {
					fix_flg = "글고정";
				}
				else{
					fix_flg = "고정안함";
				}

				if(row.answer_state == null){ 
					row.answer_state = '-';
				}
				var strDiv = `
					<TR>
						<TD>
							<div class="cb__color">
								<label>
									<input type="checkbox" class="select" name="board_idx[]" value="${row.idx}" >
									<span></span>
								</label>
							</div>
						</TD>
						<TD>${row.num}</TD>
						<TD style="text-decoration:underline;">FAQ</TD>
						<TD>${row.category}</TD>
						<TD>
							<div class="row">
								<font style="cursor:pointer;" onClick="openBoardPreviewModal(${row.idx}, 'faq');">${row.title}</font>
								<button style="width:30px;height:30px;border:1px solid;background-color:#ffffff;margin-left:10px;"></button>
							</div>
						</TD>
						<TD>${fix_flg}</TD>
						<TD style="text-decoration:underline;">
							${row.creater_name}<br>
							(${row.creater_level})
						</TD>
					</TR>
				`;
				$("#result_table_04_"+subtab_num).append(strDiv);
			});
		},
	},rows,page);
}
</script>