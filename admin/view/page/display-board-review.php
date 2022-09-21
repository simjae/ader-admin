<!-- START REQUEST CARD -->
<div class="content__card">
	<div class="card__header">
		<h3>게시판 관리(후기)</h3>
		<div class="drive--x"></div>
	</div>
	<div class="flex"style="gap:50px;margin:20px 0;">
		<div class="category__tab" tab_num="02" subtab_num="01" style="color: #140f82;border-bottom: 3px solid #140f82;text-align: center;cursor: pointer;">전체 게시물 보기</div>
		<div class="category__tab" tab_num="02" subtab_num="02" style="height:30px;color:#707070;text-align:center;cursor:pointer;">전체 댓글 보기</div>
		<div class="category__tab" tab_num="02" subtab_num="03" style="height:30px;color:#707070;text-align:center;cursor:pointer;">신고된 게시글 보기</div>
	</div>
	<input id="subtab_num" type="hidden" value="01">
	<div class="tabNum tabNum_01">
		<form id="frm-list_02_01" action="display/board/get">
			<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" name="tab_num" value="02">
			<input type="hidden" name="subtab_num" value="01">
			<input type="hidden" class="rows" name="rows" value="10">
			<input type="hidden" class="page" name="page" value="1">
			<div class="card__body">
				<div class="content__wrap">
					<div class="content__title">쇼핑몰 선택</div>
					<div class="content__row" style="display: block;">
						<select class="fSelect" name="board_country" id="board_country" style="width:163px;">
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
								<input id="search_date_review" type="hidden" name="search_date" value="" style="width:150px;">
								<div class="search_date_boardListWrite date__picker" date_type="boardListWrite" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
								<div class="search_date_boardListWrite date__picker" date_type="boardListWrite" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
								<div class="search_date_boardListWrite date__picker" date_type="boardListWrite" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
								<div class="search_date_boardListWrite date__picker" date_type="boardListWrite" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
								<div class="search_date_boardListWrite date__picker" date_type="boardListWrite" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
								<div class="search_date_boardListWrite date__picker" date_type="boardListWrite" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
								<div class="search_date_boardListWrite date__picker" date_type="boardListWrite" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
							</div>
							<div class="content__date__picker">
								<input id="review_from" class="date_param " type="date" name="create_from"  placeholder="From" readonly="" style="width:150px" date_type="boardListWrite" onChange="dateParamChange(this);">
								<font class="" >~</font>
								<input id="review_to" class="date_param " type="date" name="create_to" placeholder="To" readonly="" style="width:150px; " date_type="boardListWrite" onChange="dateParamChange(this);">
							</div>
						</div>
					</div>
				</div>
				<div class="content__wrap">
					<div class="content__title">숨김글 관리</div>
					<div class="content__row">
						<select class="fSelect" id="sel_exposure_view" name="sel_exposure_view" onchange="view_board();" style="width:200px;">
							<option value="all">전체</option>
							<option value="not">숨김글 제외</option>
							<option value="only">숨김글만 보기</option>
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
					<div class="content__title">댓글 유무</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="reply_count02_01_1" class="radio__input" value="" name="reply_count" checked/>
							<label for="reply_count02_01_1">전체보기</label>
							<input type="radio" id="reply_count02_01_2" class="radio__input" value="true" name="reply_count"/>
							<label for="reply_count02_01_2">있음</label>
							<input type="radio" id="reply_count02_01_3" class="radio__input" value="false" name="reply_count"/>
							<label for="reply_count02_01_3">없음</label>
						</div>
					</div>
				</div>
				<div class="content__wrap">
					<div class="content__title">신고 상태</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="report_status_02_01_1" class="radio__input" value="" name="report_status" checked/>
							<label for="report_status_02_01_1">전체보기</label>
							<input type="radio" id="report_status_02_01_2" class="radio__input" value="0001" name="report_status"/>
							<label for="report_status_02_01_2">처리 전</label>
							<input type="radio" id="report_status_02_01_3" class="radio__input" value="0002" name="report_status"/>
							<label for="report_status_02_01_3">게시물 숨김</label>
							<input type="radio" id="report_status_02_01_4" class="radio__input" value="0003" name="report_status"/>
							<label for="report_status_02_01_4">게시물 숨김 해제</label>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="searchBtnAction_02()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter('frm-list_02_01', 'searchBtnAction_02')"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</div>
	<div class="tabNum tabNum_02" style="display:none;">
		<form id="frm-list_02_02" action="display/board/get">
			<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" name="tab_num" value="02">
			<input type="hidden" name="subtab_num" value="02">
			<input type="hidden" class="rows" name="rows" value="10">
			<input type="hidden" class="page" name="page" value="1">
			<div class="card__body">
					<div class="content__wrap">
					<div class="content__title">쇼핑몰 선택</div>
					<div class="content__row" style="display: block;">
						<select class="fSelect" name="board_country" id="board_country" style="width:163px;">
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
								<input id="search_date_review_reply" type="hidden" name="search_date" value="" style="width:150px;">
								<div class="search_date_commentListWrite date__picker" date_type="commentListWrite" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
								<div class="search_date_commentListWrite date__picker" date_type="commentListWrite" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
								<div class="search_date_commentListWrite date__picker" date_type="commentListWrite" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
								<div class="search_date_commentListWrite date__picker" date_type="commentListWrite" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
								<div class="search_date_commentListWrite date__picker" date_type="commentListWrite" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
								<div class="search_date_commentListWrite date__picker" date_type="commentListWrite" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
								<div class="search_date_commentListWrite date__picker" date_type="commentListWrite" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
							</div>
							<div class="content__date__picker">
								<input id="review_reply_from" class="date_param " type="date" name="create_from"  placeholder="From" readonly="" style="width:150px;" date_type="commentListWrite" onChange="dateParamChange(this);">
								<font class="">~</font>
								<input id="review_reply_to" class="date_param " type="date" name="create_to" placeholder="To" readonly="" style="width:150px;" date_type="commentListWrite" onChange="dateParamChange(this);">
							</div>
						</div>
					</div>
				</div>
				<div class="content__wrap">
					<div class="content__title">숨김댓글 관리</div>
					<div class="content__row">
						<select class="fSelect" id="sel_exposure_view" name="sel_exposure_view" onchange="view_board();" style="width:200px;">
							<option value="all">전체</option>
							<option value="not">숨김댓글 제외</option>
							<option value="only">숨김댓글 보기</option>
						</select>
					</div>
				</div>
				<div class="content__wrap">
					<div class="content__title">게시글 찾기</div>
					<div class="content__row">
						<select class="fSelect" id="search_type" name="search_type" style="width:163px;">
							<option value="content" selected="">내용</option>
							<option value="writer_name">작성자</option>
							<option value="board_id">아이디</option>
						</select>
						<input type="text" name="search_keyword" value="" style="width:40%;">
					</div>
				</div>
			</div>
		</form>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="searchBtnAction_02()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter('frm-list_02_02', 'searchBtnAction_02')"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</div>
	<div class="tabNum tabNum_03" style="display:none;">
		<form id="frm-list_02_03" action="display/board/get">
			<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" name="tab_num" value="02">
			<input type="hidden" name="subtab_num" value="03">
			<input type="hidden" class="rows" name="rows" value="10">
			<input type="hidden" class="page" name="page" value="1">
			<div class="card__body">
				<div class="content__wrap">
					<div class="content__title">쇼핑몰 선택</div>
					<div class="content__row" style="display: block;">
						<select class="fSelect" name="board_country" id="board_country" style="width:163px;">
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
								<input id="search_date_review_report" type="hidden" name="search_date" value="" style="width:150px;">
								<div class="search_date_reportListWrite date__picker" date_type="reportListWrite" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
								<div class="search_date_reportListWrite date__picker" date_type="reportListWrite" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
								<div class="search_date_reportListWrite date__picker" date_type="reportListWrite" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
								<div class="search_date_reportListWrite date__picker" date_type="reportListWrite" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
								<div class="search_date_reportListWrite date__picker" date_type="reportListWrite" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
								<div class="search_date_reportListWrite date__picker" date_type="reportListWrite" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
								<div class="search_date_reportListWrite date__picker" date_type="reportListWrite" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
							</div>
							<div class="content__date__picker">
								<input id="review_report_from" class="date_param " type="date" name="create_from"  placeholder="From" readonly="" style="width:150px;" date_type="reportListWrite" onChange="dateParamChange(this);">
								<font class="">~</font>
								<input id="review_report_to" class="date_param " type="date" name="create_to" placeholder="To" readonly="" style="width:150px;" date_type="reportListWrite" onChange="dateParamChange(this);">
							</div>
						</div>
					</div>
				</div>
				<div class="content__wrap">
				<div class="content__title">게시글 찾기</div>
					<div class="content__row">
						<select id="search_type" name="search_type" class="fSelect" style="width:130px;">
							<option value="origin_name">작성자</option>
							<option value="report_name">신고자</option>
							<option value="origin_subject">게시글/댓글명</option>
							<option value="origin_id">아이디</option>
							<option value="origin_ip">아이피</option>
						</select>
						<input type="text" name="search_keyword" value="" style="width:40%;">
						<div class="cb__color">
							<label>
								<input type="checkbox" name="boardFlg" value="">
								<span>비회원</span>
							</label>
						</div>
					</div>
				</div>
				<div class="content__wrap">
					<div class="content__title">상태</div>
					<div class="content__row">
						<div class="rd__block">
							<input type="radio" id="report_status_02_03_1" class="radio__input" value="" name="report_status" checked/>
							<label for="report_status_02_03_1">전체보기</label>
							<input type="radio" id="report_status_02_03_2" class="radio__input" value="0001" name="report_status"/>
							<label for="report_status_02_03_2">처리 전</label>
							<input type="radio" id="report_status_02_03_3" class="radio__input" value="0002" name="report_status"/>
							<label for="report_status_02_03_3">게시물 숨김</label>
							<input type="radio" id="report_status_02_03_4" class="radio__input" value="0003" name="report_status"/>
							<label for="report_status_02_03_4">게시물 숨김 해제</label>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="searchBtnAction_02()"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_filter('frm-list_02_03', 'searchBtnAction_02')"><span>초기화</span></div>
				</div>
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
			<form id="frm-02-01">
				<input type="hidden" class="action_type" name="action_type">
				<input type="hidden" name="tab_num" value="02">
				<input type="hidden" name="subtab_num" value="01">
				<div class="info__wrap " style="justify-content:space-between; align-items: center;">
					<div class="body__info--count">
						<div class="drive--left"></div>
						총 <font class="cnt_total info__count">0</font>건
						<div class="drive--left"></div>
						검색결과 <font class="cnt_result info__count">0</font>건
					</div>
						
					<div class="content__row">
						<select class="fSelect" id="eSearchSort" name="searchSort" onChange="orderChange(this);" align="absmiddle" style="width:130px;float:right;margin-right:10px;">
							<option value="" selected="selected">기본정렬</option>
							<option value="REVIEW.TITLE|DESC">제목명 역순</option>
							<option value="REVIEW.TITLE|ASC">제목명 순</option>
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
							<div class="filter__btn" style="width: 130px;" action_type="delete" onclick="boardActionClick(this)">삭제</div>
							<div class="filter__btn" style="width: 130px;" action_type="mlieage_set" onclick="boardActionClick(this)">적립금 일괄 적용</div>
							<div class="filter__btn" style="width: 130px;" action_type="fix_set" onclick="boardActionClick(this)">글고정 지정</div>
							<div class="filter__btn" style="width: 130px;" action_type="fix_non" onclick="boardActionClick(this)">글고정 해제</div>
							<div class="filter__btn" style="width: 130px;" action_type="hidden" onclick="boardActionClick(this)">게시글 숨김</div>
							<div class="filter__btn" style="width: 130px;" action_type="non_hidden" onclick="boardActionClick(this)">게시글 숨김 해제</div>
						</div>                                
					</div>
					<div class="overflow-x-auto">
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
									<TH style="width:7%;">상품명</TH>
									<TH>제목</TH>
									<TH style="width:10%;">작성자</TH>
									<TH style="width:6%;">적립금 적용여부</TH>
									<TH style="width:7%;">글고정 여부</TH>
									<TH style="width:5%;">숨김 여부</TH>
									<TH style="width:10%;">신고처리유무</TH>
									<TH style="width:5%;">삭제여부</TH>
								</TR>
							</THEAD>
							<TBODY id="result_table_02_01">
							</TBODY>
						</TABLE>
					</div>
				</div>
				<div class="padding__wrap">
					<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
					<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
					<div class="paging_02_01"></div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="tabNum tabNum_02" style="display:none;width: 100%;">
	<div class="content__card">
		<div class="card__header">
			<h3>전체 댓글 목록</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<form id="frm-02-02">
				<input type="hidden" class="action_type" name="action_type">
				<input type="hidden" name="tab_num" value="02">
				<input type="hidden" name="subtab_num" value="02">
				<div class="info__wrap " style="justify-content:space-between; align-items: center;">
					<div class="body__info--count">
						<div class="drive--left"></div>
						총 <font class="cnt_total info__count">0</font>건
						<div class="drive--left"></div>
						검색결과 <font class="cnt_result info__count">0</font>건
					</div>
						
					<div class="content__row">
						<select class="fSelect" id="eSearchComment" name="eSearchComment" onChange="orderChange(this);" style="width:163px;float:right;margin-right:10px;">
							<option value="" selected="selected">전체보기(댓글의댓글포함)</option>
							<option value="commentReply">댓글만보기</option>
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
							<div class="filter__btn" style="width: 130px;" action_type="delete" onclick="boardActionClick(this)">삭제</div>
							<div class="filter__btn" style="width: 130px;" action_type="hidden" onclick="boardActionClick(this)">댓글 숨김</div>
							<div class="filter__btn" style="width: 130px;" action_type="non_hidden" onclick="boardActionClick(this)">댓글 숨김 해제</div>
						</div>                                
					</div>
					<div class="overflow-x-auto">
						<TABLE>
							<THEAD>
								<TR>
									<TH style="width:3%;">
										<div class="form-group">
											<label>
												<input type="checkbox" name="selectAll" value="" onclick="selectAllClick(this)">
												<span></span>
											</label>
										</div>
									</TH>
									<TH style="width:4%;">번호</TH>
									<TH style="width:10%;">분류</TH>
									<TH>제목/내용</TH>
									<TH style="width:10%;">작성자</TH>
									<TH style="width:10%;">작성일</TH>
									<TH style="width:5%;">숨김여부</TH>
									<TH style="width:5%;">삭제여부</TH>
								</TR>
							</THEAD>
							<TBODY id="result_table_02_02">
							</TBODY>
						</TABLE>
					</div>
				</div>
				<div class="padding__wrap">
					<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
					<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
					<div class="paging_02_02"></div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="tabNum tabNum_03" style="display:none;width: 100%;">
	<div class="content__card">
		<div class="card__header">
			<h3>신고된 게시물 목록</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<form id="frm-02-03">
				<input type="hidden" class="action_type" name="action_type">
				<input type="hidden" name="tab_num" value="02">
				<input type="hidden" name="subtab_num" value="03">
				<div class="info__wrap " style="justify-content:space-between; align-items: center;">
					<div class="body__info--count">
						<div class="drive--left"></div>
						총 <font class="cnt_total info__count">0</font>건
						<div class="drive--left"></div>
						검색결과 <font class="cnt_result info__count">0</font>건
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
				<div class="table table__wrap" >
					<div class="table__filter">
						<div class="filrer__wrap">
							<div class="filter__btn" style="width: 130px;" action_type="hidden" onclick="boardActionClick(this)">게시물 숨기</div>
							<div class="filter__btn" style="width: 130px;" action_type="non_hidden" onclick="boardActionClick(this)">게시물 숨김 해제</div>
						</div>                                
					</div>
					<div class="overflow-x-auto">
						<TABLE>
							<THEAD>
								<TR>
									<TH style="width:3%;">
										<div class="form-group">
											<label>
												<input type="checkbox" name="selectAll" value="" onclick="selectAllClick(this)">
												<span></span>
											</label>
										</div>
									</TH>
									<TH style="width:5%;">번호</TH>
									<TH style="width:5%;">구분</TH>
									<TH style="width:6%;">신고처리유무</TH>
									<TH style="width:10%;">제목</TH>
									<TH style="width:8%;">작성자</TH>
									<TH style="width:10%;">작성일</TH>
									<TH style="width:20%;">신고사유</TH>
									<TH style="width:8%;">신고자</TH>
									<TH style="width:10%;">신고일</TH>
									<TH style="width:5%;">상태</TH>
								</TR>
							</THEAD>
							<TBODY id="result_table_02_03">
							</TBODY>
						</TABLE>
					</div>
				</div>
				<div class="padding__wrap">
					<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
					<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
					<div class="paging_02_03"></div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- START RESPONSE CARD -->
<script>
$(document).ready(function() {
});
function searchBtnAction_02(){
	var tab_num = $('#tab_num').val();
	var subtab_num = $('#board_tab_'+tab_num).find('#subtab_num').val();

	$('#frm-list_'+tab_num+"_"+subtab_num).find('.page').val(1);
	getBoardTabInfo_02();
}
function getBoardTabInfo_02() {
	var tab_num = $('#tab_num').val();
	var subtab_num = $('#board_tab_'+tab_num).find('#subtab_num').val();
	
	$("#result_table_02_"+subtab_num).html('');
	var colsNum = 0;
	switch(subtab_num){
		case '01':
			colsNum = 11;
			break;
		case '02':
			colsNum = 8;
			break;
		case '03':
			colsNum = 11;
			break;
	}
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="'+colsNum+'">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table_02_"+subtab_num).append(strDiv);
	
	var rows = $('#frm-list_02_'+subtab_num).find('.rows').val();
	$('#frm-list_02_'+subtab_num).find('.page').val(1);
	
	get_contents($('#frm-list_02_'+subtab_num),{
		pageObj : $(".paging_02_" + subtab_num),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table_02_"+subtab_num).html('');
			}
			
			d.forEach(function(row) {
				var strDiv = ''; 
				var status_str = '-';
				var mileage_btn = '';
				if( row.status == '게시판 숨김'){
					status_str = '신고로 인한 숨김상태';
				}
				if(row.answer_state == null){ 
					row.answer_state = '-';
				}

				if(row.mileage_flg == '1'){
					mileage_btn = '<button class="mileage_flg_btn" style="width:70px;height:30px;border:1px solid;background-color:#3598dc;color:#ffffff;font-size:0.5rem;cursor:pointer;" action_type="mlieage_set" onclick="boardActionClick(this)">적립금 적용</button>';
				}
				else if(row.mileage_flg == '0'){
					mileage_btn = '<button class="mileage_flg_btn" style="width:70px;height:30px;border:1px solid;background-color:#e7505a;color:#ffffff;font-size:0.5rem;cursor:pointer;" action_type="mlieage_set" onclick="boardActionClick(this)">적립금 미적용</button>';
				}

				switch(subtab_num){
					case '01':
						strDiv = `
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
									<TD style="text-decoration:underline;">상품 후기</TD>
									<TD>${row.product_name}</TD>
									<TD>
										<div class="row">
											<font style="cursor:pointer;" onClick="openBoardPreviewModal(${row.idx}, 'review');">${row.title}</font>
										</div>
									</TD>
									<TD style="text-decoration:underline;line-height: 1.4;">
										${row.creater_name}<br>
										(${row.creater_level})
									</TD>
									<TD>${mileage_btn}</TD>
									<TD class="fix_flg_td">${row.fix_flg}</TD>
									<TD>${row.exposure_flg}</TD>
									<TD>${status_str}</TD>
									<TD class="del_flg_td">${row.del_flg}</TD>
								</TR>
						`;
						break;
					case '02':
						strDiv = `
								<TR>
									<TD>
										<div class="form-group">
											<label>
												<input type="checkbox" class="select" name="board_idx[]" value="${row.idx}" >
												<span></span>
											</label>
										</div>
									</TD>
									<TD>${row.num}</TD>
									<TD style="text-decoration:underline;">상품 후기</TD>
									<TD>${row.contents}</TD>
									<TD style="text-decoration:underline;line-height: 1.4;">
										${row.creater_name}<br>
										(${row.creater_level})
									</TD>
									<TD>${row.create_date}</TD>
									<TD>${row.display_flg}</TD>
									<TD>${row.del_flg}</TD>
								</TR>
						`;
						break;
					case '03':
						var division_str = '';
						if (row.report_division == 'REPLY') {
							division_str = "답글";
						}
						else if(row.report_division == 'BOARD'){
							division_str = "게시글";
						}

						var report_processing_str = '처리전';
						if (row.processing_flg == true) {
							report_processing_str = "처리완료";
						}
						if(row.origin_status == null){ row.origin_status = '-'; }
						strDiv = `
								<TR>
									<TD>
										<div class="form-group">
											<label>
												<input type="checkbox" class="select" name="board_idx[]" value="${row.idx}" >
												<span></span>
											</label>
										</div>
									</TD>
									<TD>${row.num}</TD>
									<TD>
										${division_str}
									</TD>
									<TD>${status_str}</TD>
									<TD>${row.origin_title}</TD>
									<TD style="text-decoration:underline;">
										${row.origin_creater_name}<br>
										(${row.origin_creater_level})
									</TD>
									<TD>${row.origin_create_date}</TD>
									<TD>${row.reason}</TD>
									<TD style="text-decoration:underline;line-height: 1.4;">
										${row.creater_name}<br>
										(${row.creater_level})
									</TD>
									<TD>${row.create_date}</TD>
									<TD>${report_processing_str}</TD>
								</TR>
						`;
						break;
				}
				
				$("#result_table_02_"+subtab_num).append(strDiv);
			});
			$('input[name="selectAll"]').prop("checked", false);
		},
	},rows,1);
}
</script>