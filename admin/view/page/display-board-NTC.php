<div class="content__card">
	<div class="card__header">
		<div class="flex justify-between">
			<h3>게시판 관리(공지사항)</h3>
			<div class="black-btn" onClick="location.href='/display/board/NTC/regist'">추가하기</div>
		</div>
	</div>
	<div class="card__body">
		<form id="frm-filter-NTC" action="page/board/notice/list/get">
			<input type="hidden" class="sort_value" name="sort_value" value="BOARD.IDX">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">

			<input type="hidden" name="tab_status" value="NTC">

			<input type="hidden" class="rows" name="rows" value="10">
			<input type="hidden" class="page" name="page" value="1">
			
			<div class="content__wrap">
				<div class="content__title">쇼핑몰 선택</div>
				<div class="content__row" style="display: block;">
					<select class="fSelect" name="country" id="country" style="width:163px;">
						<option value="KR">한국몰</option>
						<option value="EN">영문몰</option>
						<option value="CN">중문몰</option>
					</select>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">작성일</div>
				<div class="content__row">
					<div class="content__date__btn">
						<input id="date_param_NTC" type="hidden" name="date_param" value="" style="width:150px;">

						<div class="date__picker" date_type="NTC" date="all" type="button" onclick="searchDateClick(this);">전체</div>
						<div class="date__picker" date_type="NTC" date="today" type="button" onclick="searchDateClick(this);">오늘</div>
						<div class="date__picker" date_type="NTC" date="01d" type="button" onclick="searchDateClick(this);">어제</div>
						<div class="date__picker" date_type="NTC" date="03d" type="button" onclick="searchDateClick(this);">3일</div>
						<div class="date__picker" date_type="NTC" date="07d" type="button" onclick="searchDateClick(this);">7일</div>
						<div class="date__picker" date_type="NTC" date="15d" type="button" onclick="searchDateClick(this);">15일</div>
						<div class="date__picker" date_type="NTC" date="01m" type="button" onclick="searchDateClick(this);">1개월</div>
						<div class="date__picker" date_type="NTC" date="03m" type="button" onclick="searchDateClick(this);">3개월</div>
						<div class="date__picker" date_type="NTC" date="01y" type="button" onclick="searchDateClick(this);">1년</div>
					</div>

					<div class="content__date__picker">
						<input id="date_from_NTC" class="date_param_NTC" type="date" name="date_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="NTC" onChange="dateParamChange(this);">
						<font>~</font>
						<input id="date_to_NTC" class="date_param_NTC" type="date" name="date_to" placeholder="To" readonly style="width:150px;" date_type="NTC" onChange="dateParamChange(this);">
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">게시판 선택</div>
				<div class="content__row">
					<select class="fSelect" id="board_category" name="board_category" style="width:130px;">
						<option value="ALL"> 카테고리 전체</option>
						<option value="CMN">일반</option>
						<option value="UDL">미확인입금자명단</option>
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
						<option value="client_ip">아이피</option>
					</select>
					<input type="text" name="search_keyword" value="" style="width:40%;">
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">첨부파일 여부</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="file_flg_NTC_ALL" class="radio__input" value="ALL" name="file_flg" checked/>
						<label for="file_flg_NTC_ALL">전체보기</label>
						
						<input type="radio" id="file_flg_NTC_TRUE" class="radio__input" value="true" name="file_flg"/>
						<label for="file_flg_NTC_TRUE">있음</label>
						
						<input type="radio" id="file_flg_NTC_FALSE" class="radio__input" value="false" name="file_flg"/>
						<label for="file_flg_NTC_FALSE">없음</label>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap" style="grid: none;">
			<div class="btn__wrap--lg">
				<div  class="blue__color__btn" onClick="getBoardInfoList_NTC()"><span>검색</span></div>
				<div class="defult__color__btn" onClick="init_filter('frm-filter-NTC','getBoardInfoList_NTC')"><span>초기화</span></div>
			</div>
		</div>
	</div> 
</div>

<div class="content__card">
	<div class="card__header">
		<h3>전체 게시물 목록</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<form id="frm-list-NTC">
			<input type="hidden" class="action_type" name="action_type">
			<input type="hidden" name="tab_status" value="NTC">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>총 <font class="cnt_NTC_total info__count">0</font>건 <div class="drive--left"></div>검색결과 <font class="cnt_NTC_result info__count">0</font>건
				</div>
					
				<div class="content__row">
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
			
			<div class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div class="filter__btn" style="width:130px;" action_type="delete" onclick="boardActionClick(this)">삭제</div>
						<div class="filter__btn" style="width:130px;" action_type="fix_set" onclick="boardActionClick(this)">글고정 지정</div>
						<div class="filter__btn" style="width:130px;" action_type="fix_non" onclick="boardActionClick(this)">글고정 해제</div>
						<div class="filter__btn" style="width:130px;" action_type="exposure_date_set" onclick="openExposureDateModal(this)">게시글 노출시간 설정</div>
					</div>                                
				</div>
				
				<div class="overflow-x-auto">
					<TABLE>
						<colgroup>
							<col width="50px;">
							<col width="100px;">
							<col width="80px;">
							<col width="150px;">
							<col width="auto;">
							<col width="150px;">
							<col width="100px;">
							<col width="150px;">
							<col width="150px;">
							<col width="200px;">
						</colgroup>
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
								<TH>진열순서변경</TH>
								<TH>진열순서</TH>
								<TH>카테고리</TH>
								<TH>제목</TH>
								<TH>작성자</TH>
								<TH>공지사항편집</TH>
								<TH>글고정상태</TH>
								<TH>노출상태</TH>
								<TH>노출시간</TH>
							</TR>
						</THEAD>
						<TBODY id="result_table_NTC">
						</TBODY>
					</TABLE>
				</div>
			</div>
			
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" tab_status="NTC" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" value="0" tab_status="NTC" onChange="setPaging(this);">
				<div class="paging_NTC"></div>
			</div>
		</form>
	</div>
</div>
<!-- START RESPONSE CARD -->
<script>
$(document).ready(function() {
	
});
</script>