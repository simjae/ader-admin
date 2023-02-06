<div class="content__card">
	<form id="frm-list" action="display/product/list/get">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">
		
		<div class="card__header">
			<div class="flex justify-between">
				<h3>상품 진열 페이지 검색</h3>
				<div class="black-btn" onclick="openProductDisplayRegistModal();">상품 목록 페이지 등록</div>
			</div>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="content__wrap">
				<div class="content__title">검색</div>
				<div class="content__row">
					<select id="search" name="search" class="fSelect" style="width:130px;">
						<option value="subject">페이지명</option>
						<option value="content">비고(내용)</option>
						<option value="location">진열위치</option>
					</select>
					<input name="search_keyword" type="text" value="" style="width:15%;">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">진열 상태</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="display_status_all" class="radio__input" value="all" name="display_status" checked>
						<label for="display_status_all">전체</label>
						
						<input type="radio" id="display_status_true" class="radio__input" value="true" name="display_status"/>
						<label for="display_status_true">진열중</label>
						
						<input type="radio" id="display_status_false" class="radio__input" value="false" name="display_status"/>
						<label for="display_status_false">진열안함</label>
						
						<input type="radio" id="display_status_wait" class="radio__input" value="wait" name="display_status"/>
						<label for="display_status_wait">진열예약</label>
						
						<input type="radio" id="display_status_end" class="radio__input" value="end" name="display_status"/>
						<label for="display_status_end">진열종료</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">상품수</div>
				<div class="content__row">
					<input type="number" name="product_min" class="" value="" style="width:100px;">
					<span class="">개</span> 
					<span> ~ </span>
					<input type="number" name="product_max" class="" value="" style="width:100px;">
					<span class="">개</span>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">등록일</div>
				<div class="content__row">
					<div class="content__date__wrap">
						<div class="content__date__btn">
							<input id="search_date_product" type="hidden" name="search_date" value="" style="width:150px;">
							<div class="search_date_product date__picker" date_type="product" date="today" type="button"  onclick="searchDateClick(this);">오늘</div>
							<div class="search_date_product date__picker" date_type="product" date="01d" type="button"  onclick="searchDateClick(this);">어제</div>
							<div class="search_date_product date__picker" date_type="product" date="03d" type="button"  onclick="searchDateClick(this);">3일</div>
							<div class="search_date_product date__picker" date_type="product" date="07d" type="button"  onclick="searchDateClick(this);">7일</div>
							<div class="search_date_product date__picker" date_type="product" date="15d" type="button"  onclick="searchDateClick(this);">15일</div>
							<div class="search_date_product date__picker" date_type="product" date="01m" type="button"  onclick="searchDateClick(this);">1개월</div>
							<div class="search_date_product date__picker" date_type="product" date="03m" type="button"  onclick="searchDateClick(this);">3개월</div>
						</div>
						<div class="content__date__picker">
							<input id="product_from" class="date_param " type="date" name="create_from"  placeholder="From" readonly="" style="width:150px" date_type="product" onChange="dateParamChange(this);">
							<font class="" >~</font>
							<input id="product_to" class="date_param " type="date" name="create_to" placeholder="To" readonly="" style="width:150px; " date_type="product" onChange="dateParamChange(this);">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getProdPageInfo();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-list','getProdPageInfo')"><span>초기화</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>
<div class="content__card">
	<form id="frm-01" action="display/product/put">
		<input type="hidden" class="action_type" name="action_type">
		<div class="card__header">
			<h3>상품 목록 페이지 리스트 결과</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 <font class="cnt_total info__count" >0</font>개  
					<div class="drive--left"></div>
					검색결과 <font class="cnt_result info__count" >0</font>개
				</div>
					
				<div class="content__row">
					<select name="searchSorting" class="fSelect" style="width:130px;float:right;margin-right:10px;" onchange="orderChange(this)">
						<option value="CREATE_DATE|DESC" selected>등록일 역순</option>
						<option value="CREATE_DATE|ASC">등록일 순</option>
						<option value="UPDATE_DATE|DESC">수정일 역순</option>
						<option value="UPDATE_DATE|ASC">수정일 순</option>
						<option value="PRODUCT_CNT|DESC">상품수 역순</option>
						<option value="PRODUCT_CNT|ASC">상품수 순</option>
					</select>
					<select name="rows" style="width: 130px;" onchange="rowsChange(this)">
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
						<div class="filter__btn" style="width: 130px;" action_type="page_copy" onclick="productDisplayActionClick(this)">페이지 복사</div>
						<div class="filter__btn" style="width: 130px;" action_type="page_delete" onclick="productDisplayActionClick(this)">페이지 삭제</div>
						<div class="filter__btn" style="width: 130px;" action_type="display_true" onclick="productDisplayActionClick(this)">진열</div>
						<div class="filter__btn" style="width: 130px;" action_type="display_false" onclick="productDisplayActionClick(this)">진열취소</div>
					</div>                                
					<div>
						<div class="table__setting__btn">설정</div>
					</div>  
				</div>
				<div class="overflow-x-auto">
					<TABLE style="width:150%;">
						<THEAD>
							<TR>
								<TH style="width:3%;">
									<div class="cb__color">
										<label>
											<input type="checkbox" name="selectAll" onclick="selectAllClick(this);">
											<span></span>
										</label>
									</div>
								</TH>
								<TH>NO</TH>
								<TH>미리보기</TH>
								<TH>페이지 편집</TH>
								<TH>진열상태</TH>
								<TH style="width:250px;">진열기간</TH>
								<TH style="width:250px;">페이지명(내부용)</TH>
								<TH style="width:250px;">비고(내부용)</TH>
								<TH style="width:250px;">URL</TH>
								<TH style="width:250px;">진열위치</TH>
								<TH>등록일</TH>
								<TH>최근수정일</TH>
							</TR>
						</THEAD>
						<TBODY id="result_table">
							<TR>
								<TD class="default_td" colspan="13">
									조회 결과가 없습니다
								</TD>
							</TR>
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
	getProdPageInfo();
});

function openProductDisplayRegistModal() {
	modal('/add');
}

function openProductDisplayUpdateModal(idx) {
	modal('/put', 'idx='+idx);
}

function searchDateClick(obj) {
	var date = $(obj).attr('date');
	$(obj).css('background-color','#707070');
	$(obj).css('color','#fff');
	$('.date__picker').not($(obj)).css('color','#000');
	$('.date_param').css('color','#000');

	
	var date_type = $(obj).attr('date_type');

	if (date_type == "product") {
		$('.search_date_product').not($(obj)).css('background-color','#ffffff');
		
		$('#search_date_product').val(date);
		
		$('#product_from').val('');
		$('#product_to').val('');
	} 

}

function dateParamChange(obj) {
	var date_type = $(obj).attr('date_type');
	var date_from = $("#" + date_type + "_from").val();
	var date_to = $("#" + date_type + "_to").val();
	
	var start_date = new Date(date_from);
	var end_date = new Date(date_to);
	var now_date = new Date();


	$('.search_date_' + date_type).css('background-color','#ffffff');
	$('.search_date_' + date_type).css('color','#000');
	$('#search_date_' + date_type).val('');

	if(start_date > end_date) {
		alert('검색 시작일/종료일에 올바른 날짜를 입력해주세요.');
		$(obj).val('');
		return false;
	}
	/*
	if (date_type == "product") {
		$('.search_date_product').css('background-color','#ffffff');
		$('.search_date_product').css('color','#000');
		
		$('#search_date_product').val('');
	} 
	*/
}

function selectAllClick(obj) {
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$("#result_table").find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$("#result_table").find('.select').prop('checked',false);
	}
}

function getProdPageInfo() {
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TR>';
	strDiv += '    <TD class="default_td" colspan="13">';
	strDiv += '        조회 결과가 없습니다';
	strDiv += '    </TD>';
	strDiv += '</TR>';
	
	$("#result_table").append(strDiv);
	
	var rows = $('#frm-list').find('.rows').val();
	//var page = $('#frm-list').find('.page').val();
	$('#frm-list').find('.page').val(1);
	
	get_contents($("#frm-list"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
			}
			
			d.forEach(function(row) {
				if (row.page_memo == null) {
					row.page_memo = '';
				}
				if (row.display_location == null) {
					row.display_location = '';
				}
				
				var strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <TD>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label>';
				strDiv += '                <input type="checkbox" name="select_idx[]" class="select" value="' + row.page_idx + '" >';
				strDiv += '                <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD>' + row.num + '</TD>';
				strDiv += '    <TD>';
				strDiv += '        <button type="button" page_idx="' + row.page_idx + '" style="font-size:0.5rem;width:40px;height:30px;border:1px solid;background-color:#ffffff;">미리보기</button>';
				strDiv += '    </TD>';
				strDiv += '    <TD>';
				strDiv += '        <button type="button" page_idx="' + row.page_idx + '" page_url="' + row.page_url + '" style="font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;" onClick="location.href=\'/display/product/page?page_idx=' + row.page_idx + '\';">페이지 편집</button>';
				strDiv += '    </TD>';
				
				var display_flg = "";
				var display_str = "";
				var display_date = "";
				
				var today = new Date();
				var start_date = new Date(row.start_date);
				var end_date = new Date(row.end_date);					
				
				if (row.end_date == '9999-12-31 23:59') {
					display_date = "상시진열";
				}
				
				if (row.display_flg == true) {
					display_flg = true;
					
					if ((today <= start_date)) {
						display_str = "진열예약";
						if (display_date.length == 0) {
							display_date = "진열시작 : " + row.start_date + "<br>진열종료 : " + row.end_date;
						}
						
					} else if ((today >= start_date) && (today <= end_date)) {
						display_str = "진열중";
						if (display_date.length == 0) {
							display_date = "진열시작 : " + row.start_date + "<br>진열종료 : " + row.end_date;
						}
						
					} else if ((today >= start_date) && (today > end_date)) {
						display_str = "진열종료";
						if (display_date.length == 0) {
							display_date = "진열시작 : " + row.start_date + "<br>진열종료 : " + row.end_date;
						}
					}
				} else {
					display_flg = false;
					
					display_str = "진열안함";
					if (display_date.length == 0) {
						display_date = "진열시작 : " + row.start_date + "<br>진열종료 : " + row.end_date;
					}
				}
				
				strDiv += '    <TD>';
				strDiv += '        <input id="display_flg_' + row.idx + '" type="hidden" value="' + display_flg + '">';
				strDiv += '        ' + display_str;
				strDiv += '    </TD>';
				strDiv += '    <TD>' + display_date + '</TD>';
				strDiv += '    <TD><font style="cursor:pointer;" onClick="openProductDisplayUpdateModal(' + row.page_idx + ');">' + row.page_title + '</font></TD>';
				strDiv += '    <TD>' + row.page_memo + '</TD>';
				strDiv += '    <TD>' + row.page_url + '</TD>';
				strDiv += '    <TD>' + row.display_location + '</TD>';
				strDiv += '    <TD>' + row.create_date + '</TD>';
				strDiv += '    <TD>' + row.update_date + '</TD>';
				strDiv += '</TR>';
				
				$("#result_table").append(strDiv);
			});
		},
	},rows,1);
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-list').find('.sort_value').val(order_value[0]);
	$('#frm-list').find('.sort_type').val(order_value[1]);
	
	getProdPageInfo();
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-list').find('.rows').val(rows);
	//$('#frm-list').find('.page').val(1);
	
	getProdPageInfo();
}

function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function productDisplayActionClick(obj) {
	var action_type = $(obj).attr('action_type');
	$('.action_type').val(action_type);
	
	var action_name = "";
	
	switch (action_type) {
		case "page_copy" :
			action_name = "페이지복사";
			break;
		
		case "page_delete" :
			action_name = "페이지삭제";
			break;
		
		case "display_true" :
			action_name = "진열";
			break;
		
		case "display_false" :
			action_name = "진열취소";
			break;
	}
	
	var formData = new FormData();
	formData = $("#frm-01").serializeObject();

	var select_idx = [];
	var length = $("#frm-01").find('.select').length;
	var true_cnt = 0;
	var false_cnt = 0;
	for (var i=0; i<length; i++) {
		var select = $("#frm-01").find('.select').eq(i);
		if (select.prop('checked') == true) {
			if ($('#display_flg_' + select.val()).val() == "true") {
				true_cnt++;
			} else if ($('#display_flg_' + select.val()).val() == "false") {
				false_cnt++;
			}
			
			select_idx.push(select.val());
		}		
	}
	
	if (action_type == "display_true" && true_cnt > 0) {
		alert('현재 미진열중인 페이지만 진열상태로 변경할 수 있습니다. 선택한 페이지의 진열상태를 확인해주세요.');
		return false;
	} else if (action_type == "display_false" && false_cnt > 0) {
		alert('현재 진열중인 페이지만 미진열상태로 변경할 수 있습니다. 선택한 페이지의 진열상태를 확인해주세요.');
		return false;
	}
	
	if (select_idx.length > 0) {
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "display/product/put",
			error: function() {
				alert(action_name + " 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert(action_name + ' 처리에 성공했습니다.');
					insertLog("전시관리 > 상품진열", action_name, select_idx.length);
					$('input[name="selectAll"]').prop('checked', false);
					getProdPageInfo();
				}
			}
		});
	} else {
		alert(action_name + ' 처리 할 상품을 선택해주세요.');
	}
}
function init_fileter(frm_id, func_name){
	var formObj = $('#'+frm_id);
	formObj.find('.rd__block').find('input:radio[value="all"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value="ALL"]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=number]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');
	
	window[func_name]();
}
</script>