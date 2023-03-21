<style>
.display__none__status{backdrop-filter:brightness(60%);filter:brightness(60%);}	
.double__table__container{display:flex;}
table.standby__checkbox__table{width:30px;margin-bottom:14px;}

.select_copy {width:150px;height:30px;border:1px solid #bfbfbf;border-radius:5px;float:right;margin-right:10px;}
.save_font {font-size:12px;font-family:'NanumSquareRound',sans-serif;line-height:2.8;float:right;margin-right:10px;}
</style>

<?php include_once("check.php"); ?>

<div class="filter-wrap" style="width:100%;margin-bottom:20px;display:flex;">
	<div style="width:50%;">
		<button class="standby_tab_btn tap__button" country="KR" style="width:150px; background-color: #000;color: #fff;font-weight: 500;" onClick="standbyTabBtnClick(this);">한국몰</button>
		<button class="standby_tab_btn tap__button" country="EN" style="width:150px;" onClick="standbyTabBtnClick(this);">영문몰</button>
		<button class="standby_tab_btn tap__button" country="CN" style="width:150px;" onClick="standbyTabBtnClick(this);">중국몰</button>
	</div>
	
	<div style="width:50%;">
		<div class="btn" style="float:right;" onClick="copyStandby();">복사</div>				
		
		<font class="save_font">로 복사</font>
		
		<select id="country_to" class="select_copy">
			<option value="KR">한국몰</option>
			<option value="EN">영문몰</option>
			<option value="CN">중문몰</option>
		</select>
		
		<font class="save_font">데이터를</font>
		
		<select id="country_from" class="select_copy" style="">
			<option value="KR">한국몰</option>
			<option value="EN">영문몰</option>
			<option value="CN">중문몰</option>
		</select>
	</div>
</div>

<input id="country" type="hidden" value="KR">

<div id="standby_tab_KR" class="row standby_tab" style="margin-top:0px;">
	<?php include_once("display-standby-kr.php"); ?>
</div>

<div id="standby_tab_EN" class="row standby_tab" style="display:none;margin-top:0px;">
	<?php include_once("display-standby-en.php"); ?>
</div>

<div id="standby_tab_CN" class="row standby_tab" style="display:none;margin-top:0px;">
	<?php include_once("display-standby-cn.php"); ?>
</div>

<script>
function standbyTabBtnClick(obj) {
	var country = $(obj).attr('country');
	$('#country').val(country);
	$('.standby_tab').hide();
	$('#standby_tab_' + country).show();
	
	document.querySelectorAll('.marker_td_'+country).forEach(
		(el,idx)=>
			{
				$('.checkbox_tr_'+country).eq(idx).css('height',el.offsetHeight);
			}
	);

	$(obj).css('background-color','#000');
	$(obj).css('color','#ffffff');
	
	$('.standby_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.standby_tab_btn').not($(obj)).css('color','#000000');
}
function timeSelectSet(country){
	$('#standby_tab_' + country).find('.hour').html('');
	var hourOption = '<option value="">선택</option>';
	
	for(var i = 0; i <= 24; i++){
		var hour_val = i.toString().padStart(2,'0');
		hourOption += `
			<option value='${hour_val}'>${hour_val}</option>
		`;
	}
	$('#standby_tab_' + country).find('.hour').append(hourOption);
	$('#standby_tab_' + country).find('.hour').attr('disabled', true);
}
function dateParamChange(obj) {
	let form = $(obj).parents('form');
	let type = $(obj).attr('type');
	let date_type = $(obj).attr('date_type');

	let param_start_date = form.find('input[name=' + date_type + '_start_date]').val();
	let param_start_time = form.find('select[name=' + date_type + '_start_time]').val();
	let param_end_date = form.find('input[name=' + date_type + '_end_date]').val();
	let param_end_time = form.find('select[name=' + date_type + '_end_time]').val();

	let start_date = new Date(`${param_start_date} ${param_start_time!=''?param_start_time + ':':''}`);
	let end_date = new Date(`${param_end_date} ${param_end_time!=''?param_end_time + ':':''}`);

	if(param_start_time.length > 0 && param_end_time.length > 0 && start_date > end_date){
		alert('종료일을 시작일 이후로 지정해주세요.');
		$(obj).val('');
		return false;
	}
	else{
		if((param_start_date.length > 0 && param_end_date.length > 0) 
			&& param_start_time.length + param_end_time.length == 0 && start_date > end_date){
			alert('종료일을 시작일 이후로 지정해주세요.');
			$(obj).val('');
			return false;
		}
	}

	if(type == "date"){
		$(obj).parents('.content__row').find('select').attr('disabled',false);
	}
}
function getStandbyList(country){
	$("#standby_checkbox_table_" + country).html('');
	$("#standby_result_table_" + country).html('');

	var strCheckboxDiv = '';
	strCheckboxDiv += '<TD class="checkbox_tr_' + country + '">';
	strCheckboxDiv += '</TD>';

	var strDiv = '';
	strDiv += '<TD class="default_td marker_td_' + country + '" colspan="15">';
	strDiv += '    조회 결과가 없습니다';
	strDiv += '</TD>';
	
	$("#standby_checkbox_table_" + country).append(strCheckboxDiv);
	$("#standby_result_table_" + country).append(strDiv);
	
	var rows = $('#frm-standby-filter_' + country).find('.rows').val();
	var page = $('#frm-standby-filter_' + country).find('.page').val();
	
	get_contents($("#frm-standby-filter_" + country),{
		pageObj : $("#frm-standby-list_" + country).find(".paging"),
		html : function(d) {
			if(d != null){

				if (d.length > 0) {
					$("#standby_checkbox_table_" + country).html('');
					$("#standby_result_table_" + country).html('');
				}
				
				d.forEach(function(row) {
					var rowspan_num = 1;
					var qty_info = row.qty_info;

					if(qty_info != null && qty_info.length > 0){
						rowspan_num = qty_info.length;
					}
					var display_flg_class = "";
					if(row.entry_end_date != null){
						let entry_end = new Date(row.entry_end_date);
						let now_date = new Date();
						if(now_date > entry_end){
							display_flg_class = "display__none__status";
						}
					}
					if(row.display_flg == false){
						display_flg_class = "display__none__status";
					}

					var strCheckboxDiv = '';
					strCheckboxDiv = `
							<tr style="width:30px;"class="checkbox_tr_KR" >
								<td  class="check__box__area">
									<div class="cb__color">
										<label>
											<input type="checkbox" class="select" name="standby_idx[]" value="${row.standby_idx}" ">
											<span></span>
										</label>
									</div>
								</td>
							</tr>
					`;

					var strDiv = '';
					strDiv = `
						<tr>
							<td rowspan="${rowspan_num}" class="marker_td_KR">        
								<div class="btn" action_type="up" display_num="${row.display_num}" idx=${row.standby_idx} onclick="displayNumCheck(this)">            
									<i class="xi-angle-up"></i>            
									<span class="tooltip top">위로</span>        
								</div>        
								<div class="btn" action_type="down" display_num="${row.display_num}" idx=${row.standby_idx} onclick="displayNumCheck(this)">          
									<i class="xi-angle-down"></i>            
									<span class="tooltip top">아래로</span>        
								</div>   
							</td>
							<td rowspan="${rowspan_num}">${row.display_num}</td>
							<td rowspan="${rowspan_num}" style="cursor:pointer;" onClick="window.open(\'http://116.124.128.246:81/product/detail/basic?product_idx=${row.product_idx}\')">
								<p style="margin-bottom:5px;"></p>
								<div class="product__img__wrap">
									<div class="product__img ${display_flg_class}"
										style="background-image:url('${row.img_location}');">
									</div>
									<span>
										<p>${row.product_code}</p><br>
										<p>${row.product_name}</p><br>
										<p>${parseInt(row.sales_price).toLocaleString('ko-KR')} ₩</p><br>
										<p>Color : ${row.color}</p><br>
									</span>
							</td>
					`;

					var optionDiv = '';
					var optionDivTotal = '';
					row.qty_info.forEach(function(qty_row, index){
						optionDiv = `
							<td>${qty_row.option_name}</td>
							<td>${qty_row.product_qty}</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>
								<div class="btn" onclick="viewStandbyEntry(${row.standby_idx}, ${qty_row.option_idx},'KR')">조회</div>
							</td>
						`;
						if(index != 0){
							optionDiv = '<tr>'+optionDiv;
							optionDiv = optionDiv+'</tr>';
							optionDivTotal += optionDiv;
						}
						else if(index == 0){
							strDiv += optionDiv; 
						}
					})
					display_str = '';
					if(row.display_flg == 1){
						display_str = '비활성화';
					}
					else{
						display_str = '활성화';
					}
					strDiv += `
							<td rowspan="${rowspan_num}">
								<div class="btn" onclick="viewStandbyEntry(${row.standby_idx}, 'null', 'KR')">전체조회</div>
							</td>
							<td rowspan="${rowspan_num}">${row.sales_price}원</td>
							<td rowspan="${rowspan_num}">${row.entry_start_date}<br>- ${row.entry_end_date}</td>
							<td rowspan="${rowspan_num}">${row.purchase_start_date}<br>- ${row.purchase_end_date}</td>
							<td rowspan="${rowspan_num}">
								<div class="btn" onclick="moveUpdatePage('KR', ${row.standby_idx})">편집</div>
							</td>
							<td rowspan="${rowspan_num}">
								<div class="btn" sel_idx="${row.standby_idx}" onclick="toggleDisplayFlg(this)">${display_str}</div>
							</td>
						</tr>
					`;

					strDiv += optionDivTotal;
					$('#standby_checkbox_table_' + country).append(strCheckboxDiv);
					$('#standby_result_table_' + country).append(strDiv);
				});
				document.querySelectorAll('.marker_td_' + country).forEach(
					(el,idx)=>
						{
							$('.checkbox_tr_' + country).eq(idx).css('height',el.offsetHeight);
						}
				);
			}
			
		},
	},rows,page);
}
function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$(obj).parents('.standby_tab').find('.cnt_total').text(total_cnt.val());
	$(obj).parents('.standby_tab').find('.cnt_result').text(result_cnt.val());
}
function rowsChange(obj) {
	var country = $('#country').val();
	var rows = $(obj).val();
	$('#frm-standby-filter_' + country).find('.rows').val(rows);
	$('#frm-standby-filter_' + country).find('.page').val(1);
	
	getStandbyList(country);
}

function selectAllClick(obj, country) {
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$(`#standby_standby_table_${country}`).find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$(`#standby_standby_table_${country}`).find('.select').prop('checked',false);
	}
}

function moveRegistPage(country){
	location.href=`standby/regist?country=${country}`;
}

function moveUpdatePage(country, idx){
	location.href=`standby/update?param=${country}|${idx}`;
}

function viewStandbyEntry(standby_idx, option_idx, country){
	var option_param = '';
	if(option_idx != 'null'){
		option_param = `&option_idx=${option_idx}`;
	}
	location.href=`standby/entry?standby_idx=${standby_idx}&country=${country}${option_param}`;
}
function displayNumCheck(obj) {
	var country = $('#country').val();
	
	var display_num_max = $('#frm-standby-filter_'+country).find('#display_num_max').val();
	var action_type = $(obj).attr('action_type');
	var num = $(obj).attr('display_num');
	var idx = $(obj).attr('idx');

	if (action_type == "up") {
		if (num == 1) {
			alert('진행순서를 변경할수 없습니다.');
			return false;
		} else {
			updateDisplayNum('up',num,idx);
		}
	} else if (action_type == "down") {
		if (num == display_num_max) {
			alert('진행순서를 변경할수 없습니다.');
			return false;
		} else {
			updateDisplayNum('down',num,idx);
		}
	}
}

function updateDisplayNum(action, num, idx){
	var country = $('#country').val();
	var standby_idx = idx;

	$.ajax({
		url: config.api + "order/standby/put",
		type: "post",
		data: {
			'recent_idx': standby_idx,
			'recent_num': num,
			'country': country,
            'display_num_flg' : true,
			'action_type': action
		},
		dataType: "json",
		error: function() {
			alert('스탠바이 순서번경 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			getStandbyList(country);
		}
	})
}
function deleteStandby(){
	confirm('선택하신 스탠바이를 삭제하시겠습니까?',function(){
		let country = $('#country').val();
		var formData = new FormData();
		formData = $("#frm-standby-list_"+country).serializeObject();
		formData.country = country;

		$.ajax({
			url: config.api + "order/standby/delete",
			type: "post",
			data: formData,
			dataType: "json",
			error: function() {
				alert('스탠바이 진열상태 변경 처리중 오류가 발생했습니다.');
			},
			success: function(d) {
				alert('진열상태를 변경했습니다.', function(){
					getStandbyList(country);
				});
			}
		})
	})
}

function toggleDisplayFlg(obj){
	confirm('진열상태를 변경하시겠습니까?', function(){
		var sel_idx = $(obj).attr('sel_idx');
		var country = $('#country').val();
		
		var formData = new FormData();
		formData = $("#frm-standby-list_"+country).serializeObject();

		formData.btn_action_flg = true;
		formData.country = country;
		
		if(typeof sel_idx != "undefined"){
			formData.standby_idx = sel_idx;
		}

		$.ajax({
			url: config.api + "order/standby/put",
			type: "post",
			data: formData,
			dataType: "json",
			error: function() {
				alert('스탠바이 진열상태 변경 처리중 오류가 발생했습니다.');
			},
			success: function(d) {
				getStandbyList(country);
			}
		})
	})
}
function init_filter(frm_id, func_name, country){
	var formObj = $('#'+frm_id);
	formObj.find('.rd__block').find('input:radio[value="all"]').prop('checked', true);
	formObj.find('.rd__block').find('input:radio[value="ALL"]').prop('checked', true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=date]').val('');
	formObj.find('input[type=number]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');

	timeSelectSet(country);
	window[func_name](country);
}

function copyStandby() {
	let country_from = $('#country_from').val();
	let country_to = $('#country_to').val();
	
	if (country_from == country_to) {
		alert('동일한 국가로 복사할 수 없습니다.');
		return false;
	}
	
	confirm(
		'스탠바이 정보를 복사하시겠습니까? 기존에 작성된 스탠바이 정보는 전부 삭제됩니다.',
		function() {
			$.ajax({
				type: "post",
				url: config.api + "order/standby/save/copy",
				data: {
					'country_from': country_from,
					'country_to': country_to
				},
				dataType: "json",
				beforeSend: function(){
					loadingWithMask('/images/default/loading_img.gif')
				},
				error: function() {
					alert('스탠바이 정보 복사처리중 오류가 발생했습니다.');
				},
				success: function(d) {
					if (d.code == 200) {
						getStandbyList(country_to);
						
						closeLoadingWithMask();
						
						alert("스탠바이 정보가 복사되었습니다.");
					}
				}
			});
		}
	)
}

function loadingWithMask(gif) {
	var maskHeight = $(document).height();
	var maskWidth  = window.document.body.clientWidth;
	var top = 0;
	var left = 0;

	top = ( $(window).height()) / 2 + $(window).scrollTop();
	left = ( $(window).width()) / 2 + $(window).scrollLeft();

	//화면에 출력할 마스크를 설정해줍니다.
	var mask	   = "<div id='mask_loading' style='position:absolute; z-index:9000; background-color:#000000; display:none; left:0; top:0;'></div>";
	
	let strDiv = "";
	strDiv += '<div id="loading_img">';
	strDiv += '	<img src="' + gif + '" style="width:75px; height:75px;"/>';
	strDiv += '</div>';

	$('body').append(mask);
	$('body').append(strDiv);
	
	$('#loading_img').css('top',top);
	$('#loading_img').css('left',left);

	$('#mask_loading').css({'width' : maskWidth,'height': maskHeight,'opacity' : '0.5'}); 

	$('#mask_loading').show();
	$('#loading_img').show();
}

function closeLoadingWithMask() {
    $('#mask_loading, #loading_img').hide();
    $('#mask_loading, #loading_img').empty();  
}
</script>