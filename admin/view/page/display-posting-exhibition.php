<div class="content__card">
	<div class="card__header">
		<div class="flex justify-between">
			<h3>기획전 리스트</h3>
			<div class="black-btn" onClick="location.href='/display/posting/exhibition/regist'">추가하기</div>
		</div>
		<div class="drive--x"></div>
	</div>
	
	<div class="flex" style="gap:50px;margin:20px 0;">
		<div class="category__tab exhibition_country_btn" country="ALL" style="color:#140f82;border-bottom: 3px solid #140f82;text-align: center;cursor: pointer;" onClick="exhibitionCountryTabClick(this);">전체</div>
		<div class="category__tab exhibition_country_btn" country="KR" style="height:30px;color:#707070;text-align:center;cursor:pointer;" onClick="exhibitionCountryTabClick(this);">한국몰</div>
		<div class="category__tab exhibition_country_btn" country="EN" style="height:30px;color:#707070;text-align:center;cursor:pointer;" onClick="exhibitionCountryTabClick(this);">영문몰</div>
		<div class="category__tab exhibition_country_btn" country="CN" style="height:30px;color:#707070;text-align:center;cursor:pointer;" onClick="exhibitionCountryTabClick(this);">중문몰</div>
	</div>
	
	<div class="card__body">
		<form id="frm-04-filter" action="display/posting/get">
			<input type="hidden" class="tab_num" name="tab_num" value="04">
			<input type="hidden" class="country" name="country" value="ALL">
			<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" class="rows" name="rows" value="10">
			<input type="hidden" class="page" name="page" value="1">
			<input type="hidden" class="action_type" name="action_type">
		</form>
		<form id="frm-04-list">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 <font id="cnt_04_total" class="info__count">0</font>개 
				</div>
					
				<div class="content__row">
					<select name="searchSorting" onChange="orderChange(this)" style="width:130px;float:right;margin-right:10px;">
						<option value="CREATE_DATE|DESC">등록일 역순</option>
						<option value="CREATE_DATE|ASC">등록일 순</option>
						<option value="UPDATE_DATE|DESC">삭제일 역순</option>
						<option value="UPDATE_DATE|ASC">삭제일 순</option>
						<option value="PAGE_TITLE|DESC">페이지명 역순</option>
						<option value="PAGE_TITLE|ASC">페이지명 순</option>
					</select>

					<select onChange="rowsChange(this);" style="width: 130px;">
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
						<div class="filter__btn" style="width: 130px;" action_type="page_delete" onclick="postingActionClick(this)">페이지 삭제</div>
						<div class="filter__btn" style="width: 130px;" action_type="page_copy" onclick="postingActionClick(this)">페이지 복사</div>
						<div class="filter__btn" style="width: 130px;" action_type="display_true" onclick="postingActionClick(this)">전시</div>
						<div class="filter__btn" style="width: 130px;" action_type="display_false" onclick="postingActionClick(this)">전시취소</div>
					</div>   
					<div>
						<div class="table__setting__btn">설정</div>
					</div>                              
				</div>
				<TABLE>
					<THEAD>
						<TR>
							<TH style="width:1%;">
								<div class="cb__color">
									<label>
										<input type="checkbox" name="selectAll" value="" onclick="selectAllClick(this)">
										<span></span>
									</label>
								</div>
							</TH>
							<TH style="width:5%;">No.</TH>
							<TH>페이지 편집</TH>
							<TH>전시상태</TH>
							<TH style="width:250px;">전시기간</TH>
							<TH style="width:250px;">기획전명</TH>
							<TH style="width:5%;">적용몰</TH>
							<TH style="width:250px;">URL</TH>
							<TH style="width:250px;">비고(내부용)</TH>
							<TH style="width:7%;">조회수</TH>
							<TH style="width:5%;">등록일</TH>
							<TH style="width:5%;">최근수정일</TH>
						</TR>
					</THEAD>
					<TBODY id="result_04_table">
					</TBODY>
				</TABLE>
			</div>
			
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" tab_num="04" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" value="0">
				<div class="paging"></div>
			</div>
		</form>
	</div>
</div>
<script>
$(document).ready(function() {
	getPostingExhibitionInfo();
});

function exhibitionCountryTabClick(obj) {
	var country = $(obj).attr('country');
	if (country != null) {
		$('#frm-04-filter').find('input[name="country"]').eq(0).val(country);
		$('.exhibition_country_btn').not($(obj)).css('color','#707070');
		$('.exhibition_country_btn').not($(obj)).css('border-bottom','none');
		$(obj).css('color','#140f82');
		$(obj).css('border-bottom','3px solid #140f82');
		
		getPostingExhibitionInfo();
	}
}

function getPostingExhibitionInfo() {
	$("#result_04_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="12">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_04_table").append(strDiv);
	
	var rows = $('#frm-04-filter').find('.rows').val();
	var page = $('#frm-04-filter').find('.page').val();

	get_contents($('#frm-04-filter'),{
		pageObj : $('#frm-04-list').find(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_04_table").html('');
			}
			d.forEach(function(row) {
				if(row.page_memo == null) {
					row.page_memo = '';
				}
				
				var strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <TD>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label style="display: block;">';
				strDiv += '                <input type="checkbox" name="select_idx[]" class="select" value="' + row.idx + '" >';
				strDiv += '                <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.num + '</TD>';
				
				var display_flg = "";
				var display_str = "";
				var display_date = "";
				
				var today = new Date();
				var start_date = new Date(row.display_start_date);
				var end_date = new Date(row.display_end_date);					
				
				if (row.display_end_date == '9999-12-31 23:59') {
					display_date = "상시진열";
				}
				
				if (row.display_flg == true) {
					display_flg = true;
					
					if ((today <= start_date)) {
						display_str = "진열예약";
						if (display_date.length == 0) {
							display_date = "진열시작 : " + row.display_start_date + "<br>진열종료 : " + row.display_end_date;
						}
						
					} else if ((today >= start_date) && (today <= end_date)) {
						display_str = "진열중";
						if (display_date.length == 0) {
							display_date = "진열시작 : " + row.display_start_date + "<br>진열종료 : " + row.display_end_date;
						}
						
					} else if ((today >= start_date) && (today > end_date)) {
						display_str = "진열종료";
						if (display_date.length == 0) {
							display_date = "진열시작 : " + row.display_start_date + "<br>진열종료 : " + row.display_end_date;
						}
					}
				} else {
					display_flg = false;
					
					display_str = "진열안함";
					if (display_date.length == 0) {
						display_date = "진열시작 : " + row.display_start_date + "<br>진열종료 : " + row.display_end_date;
					}
				}
				strDiv += '    <TD>';
				strDiv += '        <button type="button" page_idx="' + row.idx + '" page_url="' + row.page_url + '" style="font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;" onClick="location.href=\'/display/posting/exhibition/page?page_idx=' + row.idx + '\';">페이지 편집</button>';
				strDiv += '    </TD>';
				strDiv += '    <TD>';
				strDiv += '        <input id="display_flg_' + row.idx + '" type="hidden" value="' + display_flg + '">';
				strDiv += '        ' + display_str;
				strDiv += '    </TD>';
				strDiv += '    <TD>' + display_date + '</TD>';
				strDiv += '    <TD><font style="cursor:pointer;" onClick="openPostingUpdateModal(' + row.idx + ');">' + row.page_title + '</font></TD>';
				strDiv += '    <TD>' + row.country + '</TD>';
				strDiv += '    <TD>' + row.page_url + '</TD>';
				strDiv += '    <TD>' + row.page_memo + '</TD>';
				strDiv += '    <TD>' + row.page_view + '</TD>';
				strDiv += '    <TD>' + row.create_date + '</TD>';
				strDiv += '    <TD>' + row.update_date + '</TD>';
				strDiv += '</TR>';
				
				$('#frm-04-list').find('input[name="selectAll"]').prop('checked', false);
				$("#result_04_table").append(strDiv);
			});
		},
	},rows,page);
}
</script>