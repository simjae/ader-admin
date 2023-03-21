<div class="content__card modal__view" style="margin: 0;">
	<input class="param_product" type="hidden" value="<?=$param?>">

	<div class="card__header">
		<div class="flex justify-between">
			<h3>상품 페이지 전체 검색</h3>
			<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
		</div>
		<div class="drive--x"></div>
	</div>
	
	<div class="card__body">
		<form id="frm-M_PR" action="display/menu/modal/product/list/get">
			<input type="hidden" class="sort_type" name="sort_type" value="DESC">
			<input type="hidden" class="sort_value" name="sort_value" value="IDX">
			
			<input type="hidden" class="rows" name="rows" value="10">
			<input type="hidden" class="page" name="page" value="1">
			<div class="content__wrap">
				<div class="content__title">타이틀</div>
				<div class="content__row">
					<input type="text" name="page_title" style="width:100%;">
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">메모</div>
				<div class="content__row">
					<input type="text" name="page_memo" style="width:100%;">
				</div>
			</div>
							
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">게시물 진열 상태</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="display_status_PR_ALL" type="radio" name="display_status" value="ALL" checked>
							<label for="display_status_PR_ALL">전체</label>
							
							<input id="display_status_PR_DPC" type="radio" name="display_status" value="DPC">
							<label for="display_status_PR_DPC">진열중</label>
							
							<input id="display_status_PR_DWT" type="radio" name="display_status" value="DWT">
							<label for="display_status_PR_DWT">진열대기</label>
							
							<input id="display_status_PR_DED" type="radio" name="display_status" value="DED">
							<label for="display_status_PR_DED">진열종료</label>
							
							<input id="display_status_PR_DNO" type="radio" name="display_status" value="DNO">
							<label for="display_status_PR_DNO">진열안함</label>
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
		</form>
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div toggle="hide"></div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getPageProductList();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-M_PR','getPageProductList');"><span>초기화</span></div>
					<div class="defult__color__btn" onClick="modal_close();"><span>취소</span></div>
				</div>
			</div>
		</div>
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
							총 상품 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
						</div>
							
						<div class="content__row">
							<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
								<option value="CREATE_DATE|DESC">등록일 역순</option>
								<option value="CREATE_DATE|ASC" selected>등록일 순</option>
								<option value="UPDATE_DATE|DESC">삭제일 역순</option>
								<option value="UPDATE_DATE|ASC">삭제일 순</option>
								<option value="PRODUCT_NAME|DESC">상품명 역순</option>
								<option value="PRODUCT_NAME|ASC">상품명 순</option>
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
							<TABLE id="excel_table" style="width:100%;">
								<THEAD>
									<TR>
										<TH style="width:100px;">게시물 선택</TH>	
										<TH style="width:250px;">게시물 타입</TH>
										<TH style="width:500px;">게시물 타이틀</TH>
										<TH style="width:500px;">게시물 메모</TH>
										<TH style="width:500px;">게시물 URL</TH>
										<TH style="width:150px;">게시물 진열상태</TH>
										<TH style="width:350px;">게시물 진열기간</TH>
										<TH style="width:200px;">게시물 조회수</TH>
									</TR>
								</THEAD>
								<TBODY class="result_table_M_PR">
									<TR>
										<TD class="default_td" colspan="13" style="text-align:left;">
											조회 결과가 없습니다?.
										</TD>
									</TR>
								</TBODY>
							</TABLE>
						</div>
					</div>
					
					<div class="padding__wrap">
						<input type="hidden" class="total_cnt" tab_num="ALL" value="0" onChange="setModalPaging(this);">
						<input type="hidden" class="result_cnt" tab_num="ALL" value="0" onChange="setModalPaging(this);">
						<div class="paging_PR"></div>
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
	getPageProductList();
});

function getPageProductList(){
	let result_table = $('.result_table_M_PR');
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TR>';
	strDiv += '    <TD class="default_td" colspan="13" style="text-align:left;">';
	strDiv += '        조회 결과가 없습니다.';
	strDiv += '    </TD>';
	strDiv += '</TR>';
	
	result_table.append(strDiv);
	
	var rows = $("#frm-M_PR").find('.rows').val();
	var page = $("#frm-M_PR").find('.page').val();
	get_contents($("#frm-M_PR"),{
		pageObj : $(".paging_PR"),
		html : function(d) {
			if (d.length > 0) {
				result_table.html('');
			}
			
			let strDiv = "";
			d.forEach(function(row) {
				strDiv += '<TR>';
				strDiv += '    <TD>';
				strDiv += '        <div class="btn" page_idx="' + row.page_idx + '" onClick="addPageProduct(this);">';
				strDiv += '            게시물 선택';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.posting_type + '</TD>';
				strDiv += '    <TD>' + row.page_title + '</TD>';
				strDiv += '    <TD>' + row.page_memo + '</TD>';
				strDiv += '    <TD>' + row.page_url + '</TD>';
				strDiv += '    <TD>' + row.display_status + '</TD>';
				strDiv += '    <TD>' + row.display_start_date + ' ~ '+ row.display_end_date + '</TD>';
				strDiv += '    <TD>' + row.page_view + '</TD>';
				strDiv += '</TR>';
			});
			
			result_table.append(strDiv);
		},
	},rows, page);
}

function addPageProduct(obj) {
	let param = $('.param_product').val();
	let tmp_arr = param.split('_');
	
	let action = tmp_arr[0];
	let obj_type = tmp_arr[1];
	let country = tmp_arr[2];
	
	let frm_id = "frm-" + action + "_" + country;
	let obj_div = $('#' + frm_id).find('.param_' + obj_type + '_' + country);
	
	let page_idx = $(obj).attr('page_idx');
	obj_div.find('.page_idx').val(page_idx);
	
	$.ajax({
		url: config.api + "display/menu/modal/get",
		type: "post",
		data: {
			'page_type': 'PR',
			'page_idx': page_idx
		},
		dataType: "json",
		error: function() {
			alert('게시물 선택처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				obj_div.find('.link_type').val('PR');
				obj_div.find('.link_idx').val(page_idx);
				
				let menu_table = obj_div.find('.menu_table');
				let menu_body = menu_table.find('.result_body');
				menu_table.hide();
				menu_body.html('');
				
				let reset_div = "";
				reset_div += '<TD class="default_td" colspan="3" style="text-align:left;">';
				reset_div += '    선택된 게시물이 없습니다. 게시물을 선택해주세요.';
				reset_div += '</TD>';
				
				menu_body.append(reset_div);
				
				let page_table = obj_div.find('.page_table').hide();
				let page_body = page_table.find('.result_body');
				page_table.show();
				page_body.html('');
				
				let data = d.data;
				if (data != null) {
					let strDiv = "";
					
					data.forEach(function(row) {
						obj_div.find('.link_url').val(row.page_url);
						
						strDiv += '<TR>';
						strDiv += '    <TD>' + row.posting_type + '</TD>';
						strDiv += '    <TD>' + row.page_title + '</TD>';
						strDiv += '    <TD>' + row.page_memo + '</TD>';
						strDiv += '    <TD>' + row.page_url + '</TD>';
						strDiv += '    <TD>' + row.display_status + '</TD>';
						strDiv += '    <TD>' + row.display_start_date + ' ~ ' + row.display_end_date + '</TD>';
						strDiv += '    <TD>' + row.page_view + '</TD>';
						strDiv += '</TR>';
					});
					
					page_body.append(strDiv);
					
					modal_close();
				}
			} else {
				alert('게시물 선택처리에 실패했습니다. 선택하려는 게시물을 확인해주세요.');
			}
		}
	});
}
</script>