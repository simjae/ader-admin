<div class="content__card">
	<div class="card__header">
		<div style="display:flex;">
			<div style="width:50%;">
				<h3>추천 검색어 관리</h3>
			</div>
			<div style="width:50%;">
				<div class="save_story_btn" onclick="saveSearchInfo('EN','KEY')">추천 검색어 저장</div>
			</div>
		</div>
		
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">
		<form id="frm-KEY_EN">
			<input class="menu_sort" type="hidden" value="0">
			<input class="menu_idx" type="hidden" value="0">
			
			<div class="table table__wrap">
				<div class="overflow-x-auto">
					<TABLE>
						<THEAD>
							<TR>
								<TH style="width:200px;">검색 키워드</TH>
								<TH style="width:50px;">메뉴검색</TH>
								<TH style="width:250px;">메뉴 타이틀</TH>
								<TH style="width:auto;">메뉴 경로</TH>
								<TH style="width:auto;">메뉴 링크</TH>
								<TH style="width:30px;">키워드추가</TH>
							</TR>
						</THEAD>
						<TBODY>
							<TR>
								<TD>
									<input class="keyword_txt" type="text" name="keyword_txt">
								</TD>
								<TD style="text-align:center;">
									<div class="search_posting_btn" onClick="getKeywordModal('EN','ADD',0);">검색</div>
								</TD>
								<TD>
									<input class="menu_title" readonly type="text" name="menu_title">
								</TD>
								<TD>
									<input class="menu_location" readonly type="text" name="menu_location">
								</TD>
								<TD>
									<input class="menu_link" readonly type="text" name="menu_link">
								</TD>
								<TD style="text-align:center;">
									<div class="add_recommend_keyword_btn btn" onClick="addRecommendKeyword('EN');">등록</div>
								</TD>
							</TR>
						</TBODY>
					</TABLE>
				</div>
			</div>
		</form>
	</div>
	
	<div class="card__body">
		<div class="table table__wrap">
			<div class="table__filter">
				<div class="filrer__wrap">
					<div style="width: 140px;" class="filter__btn" onClick="deleteRecommendKeyword('EN');">삭제</div>
				</div>                                
			</div>
				
			<div class="overflow-x-auto">
				<TABLE>
					<THEAD>
						<TR>
							<TH style="width:3%;">
								<div class="cb__color">
									<label>
										<input type="checkbox" onClick="clickSelectAll(this);" checkbox_type="KEY">
										<span></span>
									</label>
								</div>
							</TH>
							<TH style="width:50px;">순서 변경</TH>
							<TH style="width:200px;">검색 키워드</TH>
							<TH style="width:250px;">메뉴 타이틀</TH>
							<TH style="width:auto;">메뉴 경로</TH>
							<TH style="width:auto;">메뉴 링크</TH>
							<TH style="width:30px;">메뉴검색</TH>
							<TH style="width:30px;">키워드 편집</TH>
						</TR>
					</THEAD>
					<TBODY class="result_table_KEY_EN">
						<TD class="default_td" colspan="7" style="text-align:center;">
							조회 결과가 없습니다
						</TD>
					</TBODY>
				</TABLE>
			</div>
		</div>
	</div>
</div>

<div class="content__card">
	<div class="card__header">
		<div style="display:flex;">
			<div style="width:50%;">
				<h3>실시간 인기 상품 관리</h3>
			</div>
			<div style="width:50%;">
				<div class="save_story_btn" onclick="saveSearchInfo('EN','PRD')">실시간 인기 상품 저장</div>
			</div>
		</div>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">
		<form id="frm-PRD_EN">
			<div class="table table__wrap">
				<div class="table__filter">
					<div class="filrer__wrap">
						<div style="width: 140px;" class="filter__btn" onClick="deletePopularProduct('EN');">삭제</div>
						<div style="width: 140px;" class="filter__btn" onClick="getProductModal('EN');">추가</div>
					</div>                                
				</div>
				
				<div class="overflow-x-auto">
					<TABLE>
						<THEAD>
							<TR>
								<TH style="width:3%;">
									<div class="cb__color">
										<label>
											<input type="checkbox" onClick="clickSelectAll(this);" checkbox_type="PRD">
											<span></span>
										</label>
									</div>
								</TH>
								<TH style="width:50px;">순서 변경</TH>
								<TH style="width:3%;">상품<br>구분</TH>
								<TH>스타일 코드</TH>
								<TH>컬러 코드</TH>
								<TH>상품 코드</TH>
								<TH>상품명</TH>
								<TH style="width:8%;">판매가<br>(한국몰)</TH>
								<TH style="width:8%;">판매가<br>(영문몰)</TH>
								<TH style="width:8%;">판매가<br>(중국몰)</TH>
								<TH style="width:50px;">총 재고량</TH>
								<TH style="width:50px;">재고수량</TH>
								<TH style="width:50px;">판매수량</TH>
								<TH style="width:50px;">안전재고</TH>
								<TH style="width:15%;">상품 상세 페이지 링크</TH>
							</TR>
						</THEAD>
						<TBODY class="result_table_PRD_EN">
							<TD class="default_td" colspan="15" style="text-align:left;">
								조회 결과가 없습니다
							</TD>
						</TBODY>
					</TABLE>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
$(document).ready(function() {
	getRecommendKeywordList('EN');
	getPopularProductList('EN');
});
</script>