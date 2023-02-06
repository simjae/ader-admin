<style>
.addFilterBtn {width:120px;height:30px;border:1px solid;background-color:#000000;color:#ffffff;cursor:pointer;}
.updateFilterBtn {width:80px;height:25px;padding:5px;text-align:center;cursor:pointer;}
</style>

<div class="content__card">
	<form id="frm-filter" action="product/filter/list/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>상품 필터 관리</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="body__info--count" style="display: block;margin:20px 0;">
				<div class="drive--left"></div>
				<div class="flex justify-between" style="gap:20px;">
					<div>
						<button class="addFilterBtn" type="button" onClick="openAddFilterModal();">신규 필터 등록</button>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">필터타입</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="filter_type_ALL" type="radio" name="filter_type" value="ALL" checked>
						<label for="filter_type_ALL">전체</label>
						
						<input id="filter_type_CL" type="radio" name="filter_type" value="CL">
						<label for="filter_type_CL">컬러</label>
						
						<input id="filter_type_SZ" type="radio" name="filter_type" value="SZ" >
						<label for="filter_type_SZ">사이즈</label>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">필터이름</div>
				<div class="content__row">
					<select class="country" name="country">
						<option value="KR" selected>한국몰</option>
						<option value="EN">영문몰</option>
						<option value="CN">중문몰</option>
					</select>
					
					<input class="filter_name" type="text" name="filter_name" value="" style="width:80%;">
				</div>
			</div>
			
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">RGB코드</div>
					<div class="content__row">
						<input class="rgb_color" type="text" name="rgb_color" value="">
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">사이즈 타입</div>
					<div class="content__row">
						<select class="size_type" name="size_type">
							<option value="ALL" selected>전체</option>
							<option value="UP">상의</option>
							<option value="LW">하의</option>
							<option value="HT">모자</option>
							<option value="SH">신발</option>
							<option value="JW">주얼리</option>
							<option value="AC">악세서리</option>
							<option value="TA">테크 악세서리</option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">메모</div>
				<div class="content__row country_price">
					<input class="memo" type="text" name="memo" value="">
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div class="detail_hidden"></div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getFilterInfoList();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter','getFilterInfoList');"><span>초기화</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="content__card">
	<form id="frm-list">
		<input type="hidden" class="action_type" name="action_type">
		<input type="hidden" class="action_name" name="action_name">
		
		<div class="card__header">
			<h3>상품 목록 검색 결과</h3>
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
				<div class="table__filter">
					<div class="filrer__wrap">
						<div style="width: 140px;" class="filter__btn" onclick="deleteFilterInfo(this);">삭제</div>
					</div>                                
				</div>
				<div class="overflow-x-auto">
					<TABLE id="excel_table">
						<THEAD>
							<TR>
								<TH style="width:3%;">
									<div class="cb__color">
										<label>
											<input class="selectAll" type="checkbox" onClick="selectAllClick(this);">
											<span></span>
										</label>
									</div>
								</TH>
								<TH style="width:5%;">No.</TH>
								<TH>필터편집</TH>
								<TH style="width:3%;">필터타입</TH>
								<TH>필터 한국몰 이름</TH>
								<TH>필터 영문몰 이름</TH>
								<TH>필터 중문몰 이름</TH>
								<TH>RGB코드</TH>
								<TH>사이즈타입</TH>
								<TH style="width:250px;">메모</TH>
								<TH>필터 작성일</TH>
								<TH>필터 작성자</TH>
								<TH>필터 수정일</TH>
								<TH>필터 수정자</TH>
								<TH>적용 상품 수</TH>
							</TR>
						</THEAD>
						<TBODY id="result_table">
						</TBODY>
					</TABLE>
				</div>
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
	getFilterInfoList();
});

function openAddFilterModal() {
	modal('/add');
}

function getFilterInfoList(){
	let result_table = $("#result_table");
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="14" style="text-align:left;">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	result_table.append(strDiv);
	
	var rows = $("#frm-filter").find('.rows').val();
	var page = $("#frm-filter").find('.page').val();
	
	get_contents($("#frm-filter"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				result_table.html('');
			}
			
			let strDiv = "";
			d.forEach(function(row) {
				strDiv += '<TR>';
                strDiv += '    <TD>';
                strDiv += '        <div class="cb__color">';
                strDiv += '            <label>';
                strDiv += '                <input class="filter_checkbox" type="checkbox" name="filter_idx[]" value="' + row.filter_idx + '">';
                strDiv += '                <span></span>';
                strDiv += '            </label>';
                strDiv += '        </div>';
                strDiv += '    </TD>';
                strDiv += '    <TD>' + row.num + '</TD>';
                strDiv += '    <TD><div class="btn updateFilterBtn" onClick="openPutFilterModal(' + row.filter_idx + ')">필터편집</div></TD>';
                strDiv += '    <TD>' + row.filter_type + '</TD>';
                strDiv += '    <TD>' + row.filter_name_kr + '</TD>';
                strDiv += '    <TD>' + row.filter_name_en + '</TD>';
                strDiv += '    <TD>' + row.filter_name_cn + '</TD>';
                strDiv += '    <TD>' + row.rgb_color + '</TD>';
                strDiv += '    <TD>' + row.size_type + '</TD>';
                strDiv += '    <TD>' + row.memo + '</TD>';
                strDiv += '    <TD>' + row.product_cnt + '</TD>';
                strDiv += '    <TD>' + row.create_date + '</TD>';
                strDiv += '    <TD>' + row.creater + '</TD>';
                strDiv += '    <TD>' + row.update_date + '</TD>';
                strDiv += '    <TD>' + row.updater + '</TD>';
                strDiv += '</TR>';
			});
			
			result_table.append(strDiv);
		},
	},rows, page);
}

function openPutFilterModal(filter_idx) {
	modal('/put','filter_idx=' + filter_idx);
}

function deleteFilterInfo() {
	let result_table = $('#result_table');
	
	let cnt = result_table.find('.filter_checkbox').length;
	
	let filter_idx = [];
	for (let i=0; i<cnt; i++) {
		let filter_checkbox = result_table.find('.filter_checkbox').eq(i);
		if (filter_checkbox.prop('checked') == true) {
			filter_idx.push(filter_checkbox.val());
		}
	}
	
	if (filter_idx.length > 0) {
		$.ajax({
			type: "post",
			data: {
				'filter_idx' : filter_idx
			},
			dataType: "json",
			url: config.api + "product/filter/delete",
			error: function() {
				alert("필터 수정처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					getFilterInfoList();
					$('.selectAll').prop('checked',false);
					alert('선택한 필터가 삭제되었습니다.');
				}
			}
		});
	} else {
		alert('삭제하려는 필터를 선택해주세요.');
		return false;
	}
}

function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function selectAllClick(obj) {
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$("#result_table").find('.filter_checkbox').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$("#result_table").find('.filter_checkbox').prop('checked',false);
	}
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);

	getProdTabInfo();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getProdTabInfo();
}

function init_fileter(frm_id, func_name){
	var formObj = $('#'+frm_id);
	formObj.find('.rd__block').find('input:radio[value="all"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value="ALL"]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');

	window[func_name]();
}
</script>