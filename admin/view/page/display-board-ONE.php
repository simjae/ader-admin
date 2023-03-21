<div class="content__card">
	<div class="card__header">
		<h3>게시판 관리(1:1 문의)</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<form id="frm-filter-ONE" action="page/board/inquiry/list/get">
			<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">

			<input type="hidden" name="tab_status" value="ONE">

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
						<input id="date_param_ONE" type="hidden" name="date_param" value="" style="width:150px;">

						<div class="date__picker" date_type="ONE" date="all" type="button" onclick="searchDateClick(this);">전체</div>
						<div class="date__picker" date_type="ONE" date="today" type="button" onclick="searchDateClick(this);">오늘</div>
						<div class="date__picker" date_type="ONE" date="01d" type="button" onclick="searchDateClick(this);">어제</div>
						<div class="date__picker" date_type="ONE" date="03d" type="button" onclick="searchDateClick(this);">3일</div>
						<div class="date__picker" date_type="ONE" date="07d" type="button" onclick="searchDateClick(this);">7일</div>
						<div class="date__picker" date_type="ONE" date="15d" type="button" onclick="searchDateClick(this);">15일</div>
						<div class="date__picker" date_type="ONE" date="01m" type="button" onclick="searchDateClick(this);">1개월</div>
						<div class="date__picker" date_type="ONE" date="03m" type="button" onclick="searchDateClick(this);">3개월</div>
						<div class="date__picker" date_type="ONE" date="01y" type="button" onclick="searchDateClick(this);">1년</div>
					</div>

					<div class="content__date__picker">
						<input id="date_from_ONE" class="date_param_ONE" type="date" name="date_from" class="margin-bottom-6" placeholder="From" readonly style="width:150px;" date_type="ONE" onChange="dateParamChange(this);">
						<font>~</font>
						<input id="date_to_ONE" class="date_param_ONE" type="date" name="date_to" placeholder="To" readonly style="width:150px;" date_type="ONE" onChange="dateParamChange(this);">
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">게시판 선택</div>
				<div class="content__row">
					<select class="fSelect" id="board_category" name="board_category" style="width:130px;">
						<option value=""> 카테고리 전체</option>
						<option value="DAE">배송/기타문의</option>
						<option value="CAR">취소/환불</option>
						<option value="OAP">주문/결제</option>
						<option value="FAD">출고/배송</option>
						<option value="RAE">반품/교환</option>
						<option value="RST">재입고</option>
						<option value="PIQ">제품문의</option>
						<option value="BAR">블루마크/정가품</option>
						<option value="AFS">A/S</option>
						<option value="VUC">바우처</option>
						<option value="ETC">기타서비스</option>
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
				<div class="content__title">답변 상태</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="answer_state_ONE_ALL" class="radio__input" value="" name="answer_state" checked />
						<label for="answer_state_ONE_ALL">전체보기</label>
						
						<input type="radio" id="answer_state_ONE_NAS" class="radio__input" value="NAS" name="answer_state" />
						<label for="answer_state_ONE_NAS">답변전</label>
						
						<input type="radio" id="answer_state_ONE_PCS" class="radio__input" value="PCS" name="answer_state" />
						<label for="answer_state_ONE_PCS">처리중</label>
						
						<input type="radio" id="answer_state_ONE_RCP" class="radio__input" value="RCP" name="answer_state" />
						<label for="answer_state_ONE_RCP">답변완료</label>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">첨부파일 여부</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="file_flg_ONE_ALL" class="radio__input" value="" name="file_flg"
							checked />
						<label for="file_flg_ONE_ALL">전체보기</label>
						<input type="radio" id="file_flg_ONE_TRUE" class="radio__input" value="true" name="file_flg" />
						<label for="file_flg_ONE_TRUE">있음</label>
						<input type="radio" id="file_flg_ONE_FALSE" class="radio__input" value="false"
							name="file_flg" />
						<label for="file_flg_ONE_FALSE">없음</label>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap" style="grid: none;">
			<div class="btn__wrap--lg">
				<div class="blue__color__btn" onClick="getBoardInfoList_ONE()"><span>검색</span></div>
				<div class="defult__color__btn" onClick="init_filter('frm-filter-ONE','getBoardInfoList_ONE')">
					<span>초기화</span>
				</div>
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
		<form id="frm-list-ONE">
			<input type="hidden" class="action_type" name="action_type">
			<input type="hidden" name="tab_status" value="ONE">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 <font class="cnt_total info__count">0</font>건
					<div class="drive--left"></div>
					검색결과 <font class="cnt_result info__count">0</font>건
				</div>

				<div class="content__row">
					<select class="fSelect" id="eSearchSort" name="searchSort" onChange="orderChange(this);"
						align="absmiddle" style="width:130px;float:right;margin-right:10px;">
						<option value="" selected="selected">기본정렬</option>
						<option value="BOARD.TITLE|DESC">제목명 역순</option>
						<option value="BOARD.TITLE|ASC">제목명 순</option>
						<option value="BOARD.MEMBER_NAME|DESC">작성자명 역순</option>
						<option value="BOARD.MEMBER_NAME|ASC">작성자명 순</option>
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
			<div class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div class="filter__btn" style="width: 130px;" action_type="delete"
							onclick="boardActionClick(this)">삭제</div>
					</div>
				</div>
				<div class="overflow-x-auto">
					<TABLE>
						<colgroup>
							<col width="50px;">
							<col width="80px;">
							<col width="150px;">
							<col width="auto;">
							<col width="100px;">
							<col width="150px;">
							<col width="150px;">
						</colgroup>
						<THEAD>
							<TR>
								<TH>
									<div class="cb__color">
										<label>
											<input type="checkbox" name="selectAll" value=""
												onclick="selectAllClick(this)">
											<span></span>
										</label>
									</div>
								</TH>
								<TH>진열순서</TH>
								<TH>카테고리</TH>
								<TH>문의제목</TH>
								<TH>답변하기</TH>
								<TH>작성자정보</TH>
								<TH>접속IP</TH>
							</TR>
						</THEAD>
						<TBODY id="result_table_ONE">
						</TBODY>
					</TABLE>
				</div>
			</div>
			
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" tab_status="ONE" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" tab_status="ONE" value="0" onChange="setPaging(this);">
				<div class="paging_ONE"></div>
			</div>
		</form>
	</div>
</div>

<script>
$(document).ready(function() {
	
});
</script>