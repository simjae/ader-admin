<div class="content__card modal__view" style="margin: 0;">
	<input id="param" type="hidden" value="<?=$param?>">
	
	<div class="card__header">
		<h3>게시물 검색
			<a onclick="modal_close();" class="btn-close" style="float:right">
				<i class="xi-close"></i>
			</a>
		</h3>
		<div class="drive--x"></div>
	</div>
	<div class="card__body">
		<form id="frm-filter_page" action="display/posting/story/modal/page/list/get">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" class="sort_value" name="sort_value" value="IDX">
			
			<input type="hidden" class="rows" name="rows" value="10">
			<input type="hidden" class="page" name="page" value="1">
			
			<input class="action" type="hidden" value="">
			<input class="country" type="hidden" name="country" value="">
			<input class="story_type" type="hidden" name="story_type" value="">
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">타이틀</div>
					<div class="content__row">
						<input type="text" name="page_title" value="">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">메모</div>
					<div class="content__row">
						<input type="text" name="page_memo" value="">
					</div>
				</div>
			</div>
			
			<div class="content__wrap div_posting_type" style="display:none;">
				<div class="content__title">게시물 타입</div>
				<div class="content__row">
					<div class="cb__color">
						<label>
							<input class="posting_type" type="checkbox" name="posting_type[]" value="ALL" onClick="checkPostingType(this);" checked>
							<span>전체</span>
						</label>
						
						<label>
							<input class="posting_type" type="checkbox" name="posting_type[]" value="RNWY" onClick="checkPostingType(this);">
							<span>런웨이</span>
						</label>
						
						<label>
							<input class="posting_type" type="checkbox" name="posting_type[]" value="EDTL" onClick="checkPostingType(this);">
							<span>에디토리얼</span>
						</label>
						
						<label>
							<input class="posting_type" type="checkbox" name="posting_type[]" value="COLA" onClick="checkPostingType(this);">
							<span>콜라보레이션</span>
						</label>
					</div>
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">게시물 진열 상태</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="display_status_all" type="radio" name="display_status" value="ALL" checked>
							<label for="display_status_all">전체</label>
							
							<input id="display_status_dpc" type="radio" name="display_status" value="DPC">
							<label for="display_status_dpc">진열중</label>
							
							<input id="display_status_dwt" type="radio" name="display_status" value="DWT">
							<label for="display_status_dwt">진열대기</label>
							
							<input id="display_status_ded" type="radio" name="display_status" value="DED">
							<label for="display_status_ded">진열종료</label>
							
							<input id="display_status_dno" type="radio" name="display_status" value="DNO">
							<label for="display_status_dno">진열안함</label>
						</div>
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">게시물 진열 기간</div>
					<div class="content__row">
						<div class="content__date__picker">
							<input class="date_param margin-bottom-6" type="date" name="display_start_date" placeholder="From" style="width:150px;">
							<font>~</font>
							<input class="date_param" type="date" name="display_end_date" placeholder="To" readonly style="width:150px;">
						</div>
					</div>
				</div>
			</div>
			<div class="card__footer">
				<div class="footer__btn__wrap">
					<div toggle="hide"></div>
					<div class="btn__wrap--lg">
						<div  class="blue__color__btn" onClick="getRelativePageList();"><span>검색</span></div>
						<div class="defult__color__btn" onClick="init_fileter('frm-filter_page','getRelativePageList');"><span>초기화</span></div>
						<div class="defult__color__btn" onClick="modal_close();"><span>취소</span></div>
					</div>
				</div>
			</div>
		</form>
		<div class="content__card">
			<form id="frm-list_all">
				<div class="card__header">
					<h3>게시물 검색 결과</h3>
					<div class="drive--x"></div>
				</div>
				<div class="card__body">
					<div class="info__wrap " style="justify-content:space-between; align-items: center;">
						<div class="body__info--count">
							<div class="drive--left"></div>
							총 게시물 수 <font class="cnt_page_total info__count" >0</font>개 / 검색결과 <font class="cnt_page_result info__count" >0</font>개
						</div>
							
						<div class="content__row">
							<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
								<option value="CREATE_DATE|DESC">등록일 역순</option>
								<option value="CREATE_DATE|ASC" selected>등록일 순</option>
								<option value="PAGE_TITLE|DESC">게시물 타이틀 역순</option>
								<option value="PAGE_TITLE|ASC">게시물 타이틀 순</option>
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
						<div class="overflow-x-auto">
							<TABLE style="width:150%;">
								<colgroup>
									<col width="150px;">
									<col width="150px;">
									<col width="500px;">
									<col width="500px;">
									<col width="500px;">
									<col width="200px;">
									<col width="auto;">
									<col width="200px;">
									<col width="auto;">
									<col width="250px;">
									<col width="auto;">
									<col width="250px;">
								</colgroup>
								<THEAD>
									<TR>
										<TH>게시물 선택</TH>
										<TH>게시물 타입</TH>
										<TH>게시물 메모</TH>
										<TH>게시물 타이틀</TH>
										<TH>게시물 URL</TH>
										<TH>게시물 진열상태</TH>
										<TH>게시물 진열기간</TH>
										<TH>게시물 조회수</TH>
										<TH>게시물 작성일</TH>
										<TH>게시물 작성자</TH>
										<TH>게시물 수정일</TH>
										<TH>게시물 수정자</TH>
									</TR>
								</THEAD>
								<TBODY id="result_table_page_modal">
									
								</TBODY>
							</TABLE>
						</div>
					</div>
					
					<div class="padding__wrap">
						<input type="hidden" class="total_cnt" paging_type="page" value="0" onChange="setPaging(this);">
						<input type="hidden" class="result_cnt" paging_type="page" value="0" onChange="setPaging(this);">
						<div class="paging"></div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="card__footer">
		<div class="footer__btn__wrap">
			<div class="tmp" toggle="tmp"></div>
			<div class="btn__wrap--lg" style="display:block">
				<div class="defult__color__btn" style="margin:0 auto" onClick="modal_close();"><span>돌아가기</span></div>
			</div>
		</div>
	</div>
</div>



<script>
$(document).ready(function() {
	let frm = $('#frm-filter_page');
	
	let param = $('#param').val();
	let tmp_arr = param.split('_');
	
	frm.find('.action').val(tmp_arr[0]);
	frm.find('.country').val(tmp_arr[1]);
	frm.find('.story_type').val(tmp_arr[2]);
	
	if (tmp_arr[2] != "NEW") {
		$('.div_posting_type').hide();
	} else {
		$('.div_posting_type').show();
	}
	
	getRelativePageList();
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

function getRelativePageList(){
	let frm = $('#frm-filter_page');
	
	let action = frm.find('.action').val();
	let country = frm.find('.country').val();
	let story_type = frm.find('.story_type').val();
	
	let result_table = $("#result_table_page_modal");
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TR>';
	strDiv += '    <TD colspan="13" style="text-align:left;">';
	strDiv += '        조회 결과가 없습니다.';
	strDiv += '    </TD>';
	strDiv += '</TR>';
	
	result_table.append(strDiv);
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();
	
	get_contents((frm),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				result_table.html('');
			}
			
			d.forEach(function(row) {
				let strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <TD style="text-align:center;">';
				strDiv += '        <div class="btn" onClick="addRelativePage(' + row.page_idx + ');">';
				strDiv += '            게시물 선택';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.posting_type + '</TD>';
				strDiv += '    <TD>' + row.page_memo + '</TD>';
				strDiv += '    <TD>' + row.page_title + '</TD>';
				strDiv += '    <TD>' + row.page_url + '</TD>';
				strDiv += '    <TD>' + row.display_status + '</TD>';
				strDiv += '    <TD>' + row.display_start_date + ' ~ ' + row.display_end_date + '</TD>';
				strDiv += '    <TD>' + row.page_view + '</TD>';
				strDiv += '    <TD>' + row.create_date + '</TD>';
				strDiv += '    <TD>' + row.creater + '</TD>';
				strDiv += '    <TD>' + row.update_date + '</TD>';
				strDiv += '    <TD>' + row.updater + '</TD>';
				strDiv += '</TR>';
				
				result_table.append(strDiv);
			});
		},
	},rows, page);
}

function addRelativePage(page_idx) {
	let frm = $('#frm-filter_page');
	
	let action = frm.find('.action').val();
	let country = frm.find('.country').val();
	
	let parent_frm = $("#frm-" + action + "_" + country);
	parent_frm.find('.page_idx').val(page_idx);
	
	$.ajax({
		url: config.api + "display/posting/story/modal/page/get",
		type: "post",
		data: {
			'page_idx': page_idx,
		},
		dataType: "json",
		error: function() {
			alert('게시물 선택처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				let result_table = $("#result_table_" + action + "_page_" + country);
				
				result_table.html('');
				
				let data = d.data;
				if (data != null) {
					data.forEach(function(row) {
						let strDiv = "";
						strDiv += '<TR>';
						strDiv += '    <TD>' + row.posting_type + '</TD>';
						strDiv += '    <TD>' + row.page_title + '</TD>';
						strDiv += '    <TD>' + row.page_memo + '</TD>';
						strDiv += '    <TD>' + row.page_url + '</TD>';
						strDiv += '    <TD>' + row.display_status + '</TD>';
						strDiv += '    <TD>' + row.display_start_date + ' ~ ' + row.display_end_date + '</TD>';
						strDiv += '    <TD>' + row.page_view + '</TD>';
						strDiv += '    <TD>' + row.create_date + '</TD>';
						strDiv += '    <TD>' + row.creater + '</TD>';
						strDiv += '    <TD>' + row.update_date + '</TD>';
						strDiv += '    <TD>' + row.updater + '</TD>';
						strDiv += '</TR>';
						
						result_table.append(strDiv);
					});
					
					modal_close();
				}
			} else {
				alert('게시물 선택처리에 실패했습니다. 선택하려는 게시물을 확인해주세요.');
			}
		}
	});
}

</script>