<?php include_once("check.php"); ?>

<div class="content__card">
	<form id="frm-filter" action="product/recommend/list/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>추천상품 리스트</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					추천상품 리스트 수 <font class="cnt_total info__count" >0</font>개
				</div>
					
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
						<option value="CREATE_DATE|DESC" selected>등록일 역순</option>
						<option value="CREATE_DATE|ASC">등록일 순</option>
						<option value="UPDATE_DATE|DESC">수정일 역순</option>
						<option value="UPDATE_DATE|ASC">수정일 순</option>
					</select>
					<select style="width:163px;margin-right:10px;float:right;" onChange="rowsChange(this);">
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
						<div style="width: 140px;" class="filter__btn" onclick="location.href='/product/recommend/regist';">등록</div>
						<div style="width: 140px;" class="filter__btn" onclick="deletePageRecommend();">삭제</div>
					</div>                                
				</div>
				<TABLE id="excel_table" class="table_list">
					<THEAD>
						<TR>
							<TH style="width:3%;">
								<div class="cb__color">
									<label>
										<input type="checkbox" table_type="list" onClick="selectAllClick(this);">
										<span></span>
									</label>
								</div>
							</TH>
							<TH style="width:5%;">No.</TH>
							<TH>추천상품 리스트 타이틀</TH>
							<TH>추천상품 리스트 메모</TH>
							<TH>추천상품 활성상태</TH>
							<TH>추천상품 수량</TH>
							<TH>추천상품 리스트 작성일</TH>
							<TH>추천상품 리스트 작성자</TH>
							<TH>추천상품 리스트 수정일</TH>
							<TH>추천상품 리스트 수정자</TH>
						</TR>
					</THEAD>
					<TBODY id="result_table">
						<TR>
							<TD class="default_td" colspan="10" style="text-align:left;">
								조회 결과가 없습니다.
							</TD>
						</TR>
					</TBODY>
				</TABLE>
			</div>
			
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
				<input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
            	<div class="paging"></div>
        	</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	getPageRecommendList();
});

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);

	getPageRecommendList();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getPageRecommendList();
}

function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function selectAllClick(obj) {
	let table_type = $(obj).attr('table_type');
	let table = $('.table_' + table_type);
	
	if ($(obj).prop('checked') == true) {
		table.find('.select').prop('checked',true);
	} else {
		table.find('.select').prop('checked',false);
	}
}

function getPageRecommendList(){
	let frm = $('#frm-filter');
	let result_table = $("#result_table");
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="10" style="text-align:left;">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	result_table.append(strDiv);
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val(1);
	
	get_contents(frm,{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				result_table.html('');
			}
			
			d.forEach(function(row) {
				let strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <td>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label>';
				strDiv += '                <input class="select page_idx" type="checkbox" name="page_idx[]" value="' + row.page_idx + '">';
				strDiv += '                <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </td>';
				strDiv += '    <TD>' + row.num + '</TD>';
				strDiv += '    <TD style="cursor:pointer;" onClick="location.href=\'/product/recommend/update?page_idx=' + row.page_idx + '\';">' + row.page_title + '</TD>';
				strDiv += '    <TD>' + row.page_memo + '</TD>';
				
				let active_flg = "";
				if (row.active_flg == true) {
					active_flg = "활성";
				} else {
					active_flg = "비활성";
				}
				strDiv += '    <TD>' + active_flg + '</TD>';
				strDiv += '    <TD>' + row.product_qty + '</TD>';
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

function openPageRecommendRegistModal() {
	modal('/add');
}

function openPageRecommendUpdateModal(page_idx) {
	modal('/put','page_idx=' + page_idx);
}

function deletePageRecommend() {
	let cnt = $('.page_idx').length;
	
	if (cnt > 0) {
		let page_idx = [];
		for (let i=0; i<cnt; i++) {
			let checkbox = $('.page_idx').eq(i);
			if (checkbox.prop('checked') == true) {
				let checked_val = checkbox.val();
				page_idx.push(checked_val);
			}
		}
		
		if (page_idx.length > 0) {
			$.ajax({
				type: "post",
				data: {
					'page_idx':page_idx
				},
				dataType: "json",
				url: config.api + "product/recommend/delete",
				error: function() {
					alert('추천상품 리스트 삭제처리중 오류가 발생했주세요.');
				},
				success: function(d) {
					if(d.code == 200) {
						getPageRecommendList();
						alert('선택 한 추천상품 리스트가 삭제되었습니다.');
					}
				}
			});
		} else {
			alert('삭제하려는 추천상품 리스트를 선택해주세요.');
			return false;
		}
	} else {
		alert('삭제하려는 추천상품 리스트를 선택해주세요.');
		return false;
	}
}

</script>