<div class="filter-wrap" style="margin-bottom:20px">
	<button class="standby_tab_btn tap__button" country="KR" style="width:150px; background-color: #000;color: #fff;font-weight: 500;" onClick="standbyTabBtnClick(this);">한국몰</button>
	<button class="standby_tab_btn tap__button" country="EN" style="width:150px;" onClick="standbyTabBtnClick(this);">영문몰</button>
	<button class="standby_tab_btn tap__button" country="CN" style="width:150px;" onClick="standbyTabBtnClick(this);">중국몰</button>
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
	
	$(obj).css('background-color','#000');
	$(obj).css('color','#ffffff');
	
	$('.standby_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.standby_tab_btn').not($(obj)).css('color','#000000');
}

function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function selectAllClick(obj, country) {
	if ($(obj).prop('checked') == true) {
		$(obj).prop('checked',true);
		$(`#standby_result_table_${country}`).find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$(`#standby_result_table_${country}`).find('.select').prop('checked',false);
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
	
	var display_num_max = $('#frm-standby-filter_'+country.toLowerCase()).find('#display_num_max').val();
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
			switch(country){
				case 'KR':
					getStandbyListKr();
					break;
				case 'EN':
					getStandbyListEn();
					break;
				case 'CN':
					getStandbyListCn();
					break;
			}
		}
	})
}

function toggleDisplayFlg(obj){
	var sel_idx = $(obj).attr('sel_idx');
	var country = $('#country').val();
	
	var formData = new FormData();
	formData = $("#frm-standby-list_"+country.toLowerCase()).serializeObject();

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
			switch(country){
				case 'KR':
					getStandbyListKr();
					break;
				case 'EN':
					getStandbyListEn();
					break;
				case 'CN':
					getStandbyListCn();
					break;
			}
		}
	})
}
</script>