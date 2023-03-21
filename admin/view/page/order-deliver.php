<style>
	.cb__color > label {
		padding: 2px 0;
	}
</style>

<?php //include_once("check.php"); ?>


<div class="filter-wrap" style="width:100%;margin-bottom:20px;display:flex;">
	<button class="delivery_tab_btn tap__button" country="KR" style="width:150px; background-color: #000;color: #fff;font-weight: 500;" onClick="deliveryTabBtnClick(this);">한국몰</button>
	<button class="delivery_tab_btn tap__button" country="EN" style="width:150px;" onClick="deliveryTabBtnClick(this);">영문몰</button>
	<button class="delivery_tab_btn tap__button" country="CN" style="width:150px;" onClick="deliveryTabBtnClick(this);">중국몰</button>
</div>

<input id="country" type="hidden" value="KR">

<div id="delivery_tab_KR" class="row delivery_tab" style="margin-top:0px;">
	<?php include_once("order-delivery-kr.php"); ?>
</div>

<div id="delivery_tab_EN" class="row delivery_tab" style="display:none;margin-top:0px;">
	<?php include_once("order-delivery-en.php"); ?>
</div>

<div id="delivery_tab_CN" class="row delivery_tab" style="display:none;margin-top:0px;">
	<?php include_once("order-delivery-cn.php"); ?>
</div>

<script>
$(document).ready(function(){

})
function deliveryTabBtnClick(obj) {
	let country = $(obj).attr('country');
	$('#country').val(country);
	
	$('.delivery_tab').hide();
	$('#delivery_tab_' + country).show();
	
	$(obj).css('background-color','#000');
	$(obj).css('color','#ffffff');
	
	$('.delivery_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.delivery_tab_btn').not($(obj)).css('color','#000000');
}
function updateDeliveryMsg(country){
	let frm = $('#frm-msg-update-' + country);
	var formData = new FormData();
	formData = frm.serializeObject();

	confirm("배송 메세지를 수정하시겠습니까?",function() {
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "order/delivery/message/put",
			error: function() {
				alert("배송 메세지 수정에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					insertLog("주문 > 배송설정 ", "배송메세지 수정", null);
					alert("배송메세지를 수정했습니다.");
				}
			}
		});
	});
}
function getDeliveryCompanyList(country){
	$("#result_company_table_" + country).html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="11">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_company_table_" + country).append(strDiv);
	
	let frm_filter = $("#frm-company-filter-" + country)
	var rows = frm_filter.find('.rows').val();
	var page = frm_filter.find('.page').val();
	get_contents(frm_filter,{
		pageObj : frm_filter.find(".paging"),
		html : function(d) {
			if(d != null){
				if (d.length > 0) {
					$("#result_company_table_" + country).html('');
				}
				let strDiv = "";
				d.forEach(function(row) {
					let country_str = '';
					switch(row.country){
						case 'KR':
							country_str = "한국";
							break;
						case 'EN':
							country_str = "미국";
							break;
						case 'CN':
							country_str = "중국";
							break;
					}

					let delivery_country_str = '';
					switch(row.delivery_country){
						case 'KR':
							delivery_country_str = "국내";
							break;
						case 'KF':
							delivery_country_str = "국내/외";
							break;
					}
					strDiv += `
						<tr>
							<td>
								<div class="cb__color">
									<label>
										<input type="checkbox" class="select" name="sel_idx[]" value="${row.idx}">
									</label>
								</div>
							</td>
							<td style="text-align:center;">
								<div type="button" class="btn" onclick="updateCompany(${row.idx})">수정</div>
							</td>
							<td>${country_str}</td>
							<td>${row.company_name!=null?row.company_name:''}</td>
							<td>${delivery_country_str}</td>
							<td>${row.company_tel!=null?row.company_tel:''}</td>
							<td>${row.company_sub_tel!=null?row.company_sub_tel:''}</td>
							<td>${row.company_email!=null?row.company_email:''}</td>
							<td>${row.delivery_price!=null?row.delivery_price:''}</td>
							<td>${row.homepage!=null?row.homepage:''}</td>
							<td>${row.default_flg==true?'기본배송사':'-'}</td>
						</tr>
					`;
				});
				
				$("#result_company_table_" + country).append(strDiv);
			}
		},
	},rows, page)
}
function getDeliveryLocationList(country){
	$("#result_location_table_" + country).html('');
	
	var strDiv = '';
	strDiv += '<TD class="default_td" colspan="7">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#result_location_table_" + country).append(strDiv);
	
	let frm_filter = $("#frm-location-filter-" + country)
	var rows = frm_filter.find('.rows').val();
	var page = frm_filter.find('.page').val();
	get_contents(frm_filter,{
		pageObj : frm_filter.find(".paging"),
		html : function(d) {
			if(d != null){
				if (d.length > 0) {
					$("#result_location_table_" + country).html('');
				}
				let strDiv = "";
				d.forEach(function(row) {
					let country_str = '';
					switch(row.country){
						case 'KR':
							country_str = "한국";
							break;
						case 'EN':
							country_str = "미국";
							break;
						case 'CN':
							country_str = "중국";
							break;
					}

					let type_str = '';
					switch(row.isolated_flg){
						case 1:
							type_str = "도서산간지역";
							break;
						case 0:
							type_str = "공통";
							break;
					}
					let zipcode_str = '';
					if(row.start_zipcode != null && row.end_zipcode == null){
						zipcode_str = `[${row.start_zipcode}]`;
					}
					else if(row.start_zipcode != null && row.end_zipcode != null){
						zipcode_str = `[${row.start_zipcode}] ~ [${row.end_zipcode}]`;
					}
					strDiv += `
						<tr>
							<td>
								<div class="cb__color">
									<label>
										<input type="checkbox" class="select" name="sel_idx[]" value="${row.idx}">
									</label>
								</div>
							</td>
							<td style="text-align:center;">
								<div type="button" class="btn" onclick="updateLocation(${row.idx})">수정</div>
							</td>
							<td>${country_str}</td>
							<td>${type_str}</td>
							<td>${row.area_name!=null?row.area_name:''}</td>
							<td>${zipcode_str}</td>
							<td>${row.delivery_price!=null?row.delivery_price:''}</td>
						</tr>
					`;
				});
				
				$("#result_location_table_" + country).append(strDiv);
			}
		},
	},rows, page)
}
function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$(obj).parents('.card__body').find('.cnt_total').text(total_cnt.val());
	$(obj).parents('.card__body').find('.cnt_result').text(result_cnt.val());
}

function rowsChange(obj, type) {
	var country = $('#country').val();
	var rows = $(obj).val();
	$('#frm-' + type + '-filter-' + country).find('.rows').val(rows);
	$('#frm-' + type + '-filter-' + country).find('.page').val(1);
	
	if(type == 'company'){
		getDeliveryCompanyList(country);
	}
	else if(type == 'location'){
		getDeliveryLocationList(country);
	}
}
function orderChange(obj, type) {
	let country = $('#country').val();
	
	let frm = $('#frm-' + type + '-filter-' + country);
	
	var select_value = $(obj).val();
	var order_value = [];
	order_value = select_value.split('|');
	
	frm.find('.sort_value').val(order_value[0]);
	frm.find('.sort_type').val(order_value[1]);

	if(type == 'company'){
		getDeliveryCompanyList(country);
	}
	else if(type == 'location'){
		getDeliveryLocationList(country);
	}
}
function selectAll(obj, type) {
	var country = $('#country').val();
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$('#result_' + type + '_table_' + country).find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$('#result_' + type + '_table_' + country).find('.select').prop('checked',false);
	}
}
function init_fileter(frm_id, func_name, country){
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
	
	window[func_name](country);
}

function deleteCompany(country){
	confirm('선택하신 배송업체 삭제를 진행하시겠습니까?', function () {
		var formData = new FormData();
		formData = $("#frm-company-filter-" + country).serializeObject();

		if(formData['sel_idx[]'].length < 1){
			alert('삭제하시려는 배송업체를 선택해주세요');
			return false;
		}
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "order/delivery/company/delete",
			error: function () {
				alert('배송업체 삭제 처리에 실패했습니다.');
			},
			success: function (d) {
				if (d.code == 200) {
					alert('배송업체 삭제 처리에 성공했습니다.');
					insertLog("주문 > 배송 설정 ", "배송업체 삭제", null);
					getDeliveryCompanyList(country);
				}
			}
		});
	})
}
function deleteLocation(country){
	confirm('선택하신 지역별 배송비정보 삭제를 진행하시겠습니까?', function () {
		var formData = new FormData();
		formData = $("#frm-location-filter-" + country).serializeObject();

		if(formData['sel_idx[]'].length < 1){
			alert('삭제하시려는 지역별 배송비정보를 선택해주세요');
			return false;
		}
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "order/delivery/location/delete",
			error: function () {
				alert('지역별 배송비정보 삭제 처리에 실패했습니다.');
			},
			success: function (d) {
				if (d.code == 200) {
					alert('지역별 배송비정보 삭제 처리에 성공했습니다.');
					insertLog("주문 > 배송 설정 ", "지역별 배송비정보 삭제", null);
					getDeliveryLocationList(country);
				}
			}
		});
	})
}

function addCompany(country){
	modal('company/add', 'country=' + country);
}
function updateCompany(idx){
	modal('company/put', 'sel_idx=' + idx);
}

function addLocation(country){
	modal('location/add', 'country=' + country);
}
function updateLocation(idx){
	modal('location/put', 'sel_idx=' + idx);
}
</script>
