<style>
#seo{margin-top : 50px;}
.sub{margin-top : 10px;}
</style>
<div class="content__card" style="margin: 0;">
	<form id="frm-list" action="display/product/grid/lib/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="CREATE_DATE">
		<input type="hidden" class="rows" name="rows" value="5">
		<input type="hidden" class="page" name="page" value="1">
		
		<input type="hidden" name="product_idx" value="<?=$product_idx?>">
		
		<div class="card__header">
			<div class="flex justify-between">
				<h3>라이브러리 검색</h3>
				<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
			</div>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body" style="width:1000px;">
			<div class="card__body--hide">
				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">상품 코드</div>
						<div class="content__row">
							<input type="text" style="width:90%;">
						</div>
					</div>
					
					<div class="half__box__wrap">
						<div class="content__title">상품 이름</div>
						<div class="content__row">
							<input type="text" style="width:90%;">
						</div>
					</div>
				</div>
			</div>
			
			<div class="card__body--hide">
				<div class="content__wrap grid__half">
					<div class="half__box__wrap">
						<div class="content__title">바코드</div>
						<div class="content__row">
							<input type="text" style="width:90%;">
						</div>
					</div>
					
					<div class="half__box__wrap">
						<div class="content__title">옵션 이름</div>
						<div class="content__row">
							<input type="text" style="width:90%;">
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">상품 구분</div>
				<div class="content__row">
					<div class="rd__block">
						<input id="product_type_all" type="radio" name="product_type" value="ALL" checked>
						<label for="product_type_all">전체</label>
						
						<input id="product_type_b" type="radio" name="product_type" value="B" >
						<label for="product_type_b">일반 상품</label>
						
						<input id="product_type_s" type="radio" name="product_type" value="S" >
						<label for="product_type_s">세트 상품</label>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  onclick="getProductLib();"  class="blue__color__btn"><span>검색</span></div>
					<div onclick="modal_cancel();" class="defult__color__btn"><span>작성 취소</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>

<div class="content__card">
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
					<option value="CREATE_DATE|DESC" selected>등록일 역순</option>
					<option value="CREATE_DATE|ASC">등록일 순</option>
					<option value="PRODUCT_NAME|DESC">상품 이름 역순</option>
					<option value="PRODUCT_NAME|ASC">상품 이름 순</option>
					<option value="PRODUCT_CODE|DESC">상품 코드 역순</option>
					<option value="PRODUCT_CODE|ASC">상품 코드 순</option>
					<option value="PRODUCT_CODE|DESC">상품 재고 역순</option>
					<option value="PRODUCT_CODE|ASC">상품 재고 순</option>
				</select>
				<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="rowsChange(this);">
					<option value="5" selected>5개씩보기</option>
					<option value="10">10개씩보기</option>
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
				<TABLE id="excel_table">
					<THEAD>
						<TR>
							<TH style="width:3%;">
								<div class="cb__color">
									<label>
										<input type="checkbox" onClick="selectAllClick(this);">
										<span></span>
									</label>
								</div>
							</TH>
							<TH style="width:5%;">No.</TH>
							<TH style="width:3%;">상품<br>구분</TH>
							<TH>스타일 코드</TH>
							<TH>컬러 코드</TH>
							<TH>상품 코드</TH>
							<TH>상품명</TH>
							<TH style="width:8%;">판매가<br>(한국몰)</TH>
							<TH style="width:8%;">판매가<br>(영문몰)</TH>
							<TH style="width:8%;">판매가<br>(중국몰)</TH>
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
</div>

<script>
$(document).ready(function() {	
	getProductLib();
});

function getProductLib() {
	$("#result_table").html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="10">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_table").append(strDiv);
	
	var rows = $("#frm-list").find('.rows').val();
	var page = $("#frm-list").find('.page').val();
	get_contents($("#frm-list"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				$("#result_table").html('');
			}
			
			d.forEach(function(row) {
				var strDiv = "";
				strDiv += '<tr>';
				strDiv += '    <td>';
				strDiv += '        <div class="cb__color">';
				strDiv += '            <label>';
				strDiv += '                <input type="checkbox" class="select" name="no[]" value="' + row.product_idx + '">';
				strDiv += '                <span></span>';
				strDiv += '            </label>';
				strDiv += '        </div>';
				strDiv += '    </td>';
				strDiv += '    <td>' + row.num + '</td>';
				
				var product_type = "";
				if (row.product_type == "B") {
					product_type = "일반";
				} else if (row.product_type == "S") {
					product_type = "세트";
				}
				
				strDiv += '    <td>' + product_type + '</td>';
				strDiv += '    <td><font product_idx="' + row.product_idx + '" onClick="openProductUpdateModal(this);" style="cursor:pointer;">' + row.style_code + '</font></td>';
				strDiv += '    <td><font product_idx="' + row.product_idx + '" onClick="openProductUpdateModal(this);" style="cursor:pointer;">' + row.color_code + '</font></td>';
				strDiv += '    <td><font product_idx="' + row.product_idx + '" onClick="openProductUpdateModal(this);" style="cursor:pointer;">' + row.product_code + '</font></td>';
				strDiv += '    <TD>';
				strDiv += '        <div class="product__img__wrap">';
				
				var background_url = "background-image:url('" + row.img_location + "');";
				
				strDiv += '            <div class="product__img" style="' + background_url + '">';
				strDiv += '            </div>';
				strDiv += '            <div>';
				strDiv += '                <p>' + row.product_name + '</p><br>';
				strDiv += '            	   <p style="color:#EF5012">' + row.update_date + '</p>';
				strDiv += '            </div>';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				
				strDiv += '    <td style="text-align: right;">';
				var discount_kr = row.discount_kr;
				if (discount_kr > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_kr + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_kr.toLocaleString('ko-KR') + "</span></br>";
					strDiv += '        <span>' + row.sales_price_kr.toLocaleString('ko-KR') + "</span></br>";
				} else {
					strDiv += '        ' + row.price_kr.toLocaleString('ko-KR');
				}
				
				strDiv += '    </td>';
				
				strDiv += '    <td style="text-align: right;">';
				var discount_en = row.discount_en;
				if (discount_en > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_en + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_en.toLocaleString('ko-KR') + "</span></br>";
					strDiv += '        <span>' + row.sales_price_en.toLocaleString('ko-KR') + "</span></br>";
				} else {
					strDiv += '        ' + row.price_en.toLocaleString('ko-KR');
				}
				
				strDiv += '    </td>';
				
				strDiv += '    <td style="text-align: right;">';
				var discount_cn = row.discount_cn;
				if (discount_cn > 0) {
					strDiv += '        <span style="color:#EF5012;">' + discount_cn + '%</span><br>';
					strDiv += '        <span style="color:#EF5012;text-decoration: line-through;">' + row.price_cn.toLocaleString('ko-KR') + "</span></br>";
					strDiv += '        <span>' + row.sales_price_cn.toLocaleString('ko-KR') + "</span></br>";
				} else {
					strDiv += '        ' + row.price_cn.toLocaleString('ko-KR');
				}
				
				strDiv += '    </td>';
				strDiv += '</tr>';
				
				$("#result_table").append(strDiv);
			});
		},
	},rows, page);
}

function rowsChange(obj) {
	var rows = $(obj).val();
	
	$('#frm-filter').find('.rows').val(rows);
	$('#frm-filter').find('.page').val(1);

	getProductLib();
}

function orderChange(obj) {
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	$('#frm-filter').find('.sort_value').val(order_value[0]);
	$('#frm-filter').find('.sort_type').val(order_value[1]);

	getProductLib();
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
		$("#result_table").find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$("#result_table").find('.select').prop('checked',false);
	}
}

function productDisplayUpdateCheck(){
	var duplicate_check = $('#duplicate_check').val();
	
	if (duplicate_check == "false") {
		alert('상품 진열페이지 등록을 위해 페이지명 죽복검사를 확인해주세요.');
		return;
	}
	
	var display_flg = $('#display_flg').val();
	if (display_flg == "false") {
		var display_start_date = $("input[name='display_from']").val() + ' ' + $("select[name='display_from_h']").val() + ':' + $("select[name='display_from_m']").val();
		var display_end_date = $("input[name='display_to']").val() + ' ' + $("select[name='display_to_h']").val() + ':' + $("select[name='display_to_m']").val();
		
		if (display_start_date != null && display_end_date != null) {
			var start_date = new Date(display_start_date);
			var end_date = new Date(display_end_date);
			
			if (start_date > end_date) {
				alert('진열 시작일/종료일에 올바른 날짜를 입력해주세요.');
				return false;
			}
		} else {
			alert('진열 시작일/종료일에 정확한 날짜를 입력해주세요.');
			return false;
		}
	}
	
	modal_submit($('#frm-list'),'getProdPageInfo');
}
</script>