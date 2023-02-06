<div class="content__card">
	<form id="frm-filter_HED" action="display/product/banner/list/get">
		<input class="banner_type" type="hidden" name="banner_type" value="HED">
		
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<div class="flex justify-between">
				<h3>배너 헤드 이미지 검색</h3>
				<div class="black-btn" onclick="location.href='/display/product/banner/head/regist'">배너 헤드 등록</div>
			</div>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">배너 헤드 타이틀</div>
				<div class="content__row">
					<input type="text" name="banner_title" value="">
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">배너 헤드 메모</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="text" name="banner_memo" value="">
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div class="blue__color__btn" onclick="getBannerInfoList('HED');"><span>검색</span></div>
					<div class="defult__color__btn" onclick="init_fileter('frm-filter_HED','getBannerInfoList('HED')')"><span>초기화</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="content__card">
	<form id="frm-list">
		<div class="card__header">
			<h3>배너 헤드 검색 결과</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 이미지 수 <font class="cnt_total_HED info__count" >0</font>개 / 검색결과 <font class="cnt_result_HED info__count" >0</font>개
				</div>
					
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
						<option value="CREATE_DATE|DESC">등록일 역순</option>
						<option value="CREATE_DATE|ASC">등록일 순</option>
						<option value="UPDATE_DATE|DESC">갱신일 역순</option>
						<option value="UPDATE_DATE|ASC">갱신일 순</option>
						<option value="IMG_TITLE|DESC">이미지 타이틀 역순</option>
						<option value="IMG_TITLE|ASC">이미지 타이틀 순</option>
						<option value="IMG_TYPE|DESC">이미지 타입 역순</option>
						<option value="IMG_TYPE|ASC">이미지 타입 순</option>
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
						<div style="width: 140px;" class="filter__btn" onclick="deleteBannerInfo('HED');">삭제</div>
					</div>                                
				</div>
				<TABLE id="excel_table">
					<THEAD>
						<TR>
							<TH style="width:3%;">
								<div class="cb__color">
									<label>
										<input type="checkbox" banner_type="HED" onClick="selectAllClick(this);">
										<span></span>
									</label>
								</div>
							</TH>
							<TH style="width:5%;">No.</TH>
							<TH>배너 편집</TH>
							<TH>배너 썸네일</TH>
							<TH style="width:15%;">배너 타이틀</TH>
							<TH style="width:15%;">배너 메모</TH>
							<TH>배너 경로</TH>
							<TH style="width:8%;">배너 등록일</TH>
							<TH style="width:8%;">작성자</TH>
							<TH style="width:8%;">배너 갱신일</TH>
							<TH style="width:8%;">갱신자</TH>
						</TR>
					</THEAD>
					<TBODY id="result_table_HED">
					</TBODY>
				</TABLE>
			</div>
			<div class="padding__wrap">
				<input type="hidden" banner_type="HED" class="total_cnt" value="0" onChange="setPaging(this);">
				<input type="hidden" banner_type="HED" class="result_cnt" value="0" onChange="setPaging(this);">
            	<div class="paging_HED"></div>
        	</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	getBannerInfoList('HED');
});
</script>