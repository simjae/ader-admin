<div class="filter-wrap" style="margin-bottom:20px">
	<button class="draw_tab_btn tap__button" country="KR" style="width:150px; background-color: #000;color: #fff;font-weight: 500;" onClick="drawTabBtnClick(this);">한국몰</button>
	<button class="draw_tab_btn tap__button" country="EN" style="width:150px;" onClick="drawTabBtnClick(this);">영문몰</button>
	<button class="draw_tab_btn tap__button" country="CN" style="width:150px;" onClick="drawTabBtnClick(this);">중국몰</button>
</div>

<input id="country" type="hidden" value="KR">

<div id="draw_tab_KR" class="row draw_tab" style="margin-top:0px;">
	<?php include_once("display-draw-kr.php"); ?>
</div>

<div id="draw_tab_EN" class="row draw_tab" style="display:none;margin-top:0px;">
	<?php include_once("display-draw-en.php"); ?>
</div>

<div id="draw_tab_CN" class="row draw_tab" style="display:none;margin-top:0px;">
	<?php include_once("display-draw-cn.php"); ?>
</div>

<script>
function drawTabBtnClick(obj) {
	var country = $(obj).attr('country');
	$('#country').val(country);
	$('.draw_tab').hide();
	$('#draw_tab_' + country).show();
	
	$(obj).css('background-color','#000');
	$(obj).css('color','#ffffff');
	
	$('.draw_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.draw_tab_btn').not($(obj)).css('color','#000000');
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
		$(`#draw_result_table_${country}`).find('.select').prop('checked',true);
	} else {
		$(obj).attr('checked',false);
		$(`#draw_result_table_${country}`).find('.select').prop('checked',false);
	}
}

function moveRegistPage(country){
	location.href=`draw/regist?country=${country}`;
}

function moveUpdatePage(country, idx){
	location.href=`draw/update?country=${country}&draw_idx=${idx}`;
}

function viewDrawEntry(draw_idx, option_idx, country){
	var option_param = '';
	if(option_idx != 'null'){
		option_param = `&option_idx=${option_idx}`;
	}
	location.href=`draw/entry?draw_idx=${draw_idx}&country=${country}${option_param}`;
}
function displayNumCheck(obj) {
	var country = $('#country').val();
	
	var display_num_max = $('#frm-draw-filter_'+country.toLowerCase()).find('#display_num_max').val();
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
	var draw_idx = idx;

	$.ajax({
		url: config.api + "order/draw/put",
		type: "post",
		data: {
			'recent_idx': draw_idx,
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
					getDrawListKr();
					break;
				case 'EN':
					getDrawListEn();
					break;
				case 'CN':
					getDrawListCn();
					break;
			}
		}
	})
}

function toggleDisplayFlg(obj){
	var sel_idx = $(obj).attr('sel_idx');
	var country = $('#country').val();
	
	var formData = new FormData();
	formData = $("#frm-draw-list_"+country.toLowerCase()).serializeObject();

	formData.btn_action_flg = true;
	formData.country = country;
	
	if(typeof sel_idx != "undefined"){
		formData.draw_idx = sel_idx;
	}

	$.ajax({
		url: config.api + "order/draw/put",
		type: "post",
		data: formData,
		dataType: "json",
		error: function() {
			alert('스탠바이 진열상태 변경 처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			switch(country){
				case 'KR':
					getDrawListKr();
					break;
				case 'EN':
					getDrawListEn();
					break;
				case 'CN':
					getDrawListCn();
					break;
			}
		}
	})
}

function prizeDraw(country, idx){
	$.ajax({
		url: config.api + "order/draw/prize/put",
		type: "post",
		data: {draw_idx : idx},
		dataType: "json",
		error: function() {
			alert('드로우 당첨처리에 오류가 발생했습니다.');
		},
		success: function(d) {
			alert('드로우 당첨처리가 완료되었습니다.');
			switch(country){
				case 'KR':
					getDrawListKr();
					break;
				case 'EN':
					getDrawListEn();
					break;
				case 'CN':
					getDrawListCn();
					break;
			}
		}
	})
}
</script>