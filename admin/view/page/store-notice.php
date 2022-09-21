<style>
.filter-wrap{
	display: flex;
	gap: 10px;	
	margin-bottom: 20px;
}
.filter-btn{
	color: black;
	background-color: #fff;
	font-size: 20px;
	font-weight: 500;
	padding: 10px;
}
.checked{
	background-color: #11aba6;
	color: #fff;
}
.append-btn{
	background-color: #11aba6;
	color: #fff;
	font-size: 20px;
	font-weight: 500;
	padding: 10px;
}
.apply-btn{
	background-color: #11aba6;
	color: #fff;
	font-size: 20px;
	font-weight: 500;
	padding: 10px;
}
</style>
<div class="country__tap">
	<div class="country__btn checked" data-filter="korea" onclick="countryTapClick(this)">
		<img src="/images/korea-logo.svg" alt="">
		<span>국문몰</span>
	</div>
	<div class="country__btn" data-filter="engilsh" onclick="countryTapClick(this)">
		<img src="/images/engilsh-logo.svg" alt="">
		<span>영문몰</span>
	</div>
	<div class="country__btn" data-filter="china" onclick="countryTapClick(this)">
		<img src="/images/china-logo.svg" alt="" >
		<span>중문몰</span>
	</div>
</div>

<div class="korea-tap filter-tap">
	<?php include_once("store-notice-store_korea.php"); ?>
</div>
<div class="hidden engilsh-tap filter-tap">
	<?php include_once("store-notice-store_english.php"); ?>	
</div>
<div class="hidden china-tap filter-tap">
	<?php include_once("store-notice-store_china.php"); ?>
</div>




<input type="hidden" name="tab_num" value="01">
<input type="hidden" class="rows" name="rows" value="10">
<input type="hidden" class="page" name="page" value="1">

<script>
$(document).ready(function() {
	//countryTapClick();
	noticeGetInfo();
});
/*
function filterTap() {
	$('.tap__button').on('click',function(){
		$('.tap__button').removeClass('checked');
		$('.filter-tap').addClass('hidden');
		let checkTab = $(this).data('filter');

		$('.' + checkTab + '-tap').toggleClass('hidden');
		$('.' + checkTab + '-btn').addClass('checked');
	});
	
}
*/
function countryTapClick(obj){
	/*
	$('.country__btn').on('click', function () {
		var btn_class = $(obj).attr('class');
		let $target   = $('.' + btn_class);
		//$('.country__btn');
		let checkTab = $(obj).data('filter');

		$target.not($(this)).removeClass('checked');
		$(this).addClass('checked');
		$('.filter-tap').addClass('hidden');

		$('.' + checkTab + '-tap').toggleClass('hidden');
		$('#' + checkTab + '-btn').addClass('checked');
	});
	*/
	var btn_class = $(obj).attr('class');
	let $target   = $('.' + btn_class);
	//$('.country__btn');
	let checkTab = $(obj).data('filter');

	$target.not($(obj)).removeClass('checked');
	$(obj).addClass('checked');
	$('.filter-tap').addClass('hidden');

	$('.' + checkTab + '-tap').toggleClass('hidden');
	$('#' + checkTab + '-btn').addClass('checked');
}
function noticeGetInfo(){
	$.ajax({
		type: "post",  
		dataType: "json",
		url: config.api + "store/notice/get",
		success: function(d) {
			if(d.code == 200) {
				var data = d.data;
				// 토스트 메시지 띄움
				data.forEach(function(row) {
					var tab_num = '';
					switch(row.country){
						case 'KR':
							tab_num = '01';
							break;
						case 'EN':
							tab_num = '02';
							break;
						case 'CN':
							tab_num = '03';
							break;
					}
					var row_location = $('#notice_table_' + tab_num).find('input[value="' + row.alarm_condition + '"]');
					var row_message = row_location.parent().find('input[name=alarm_message]');

					row_message.val('');
					row_message.attr("placeholder", row.alarm_message);
				});
			}
			else {
				alert('메세지 수정에 실패했습니다.');
			}
		},
		error: function() {
			alert('메세지 수정에 실패했습니다.');
		}
	});
}

function saveAlarm(obj){
	confirm("알림메세지를 저장하시겠습니까?",function() {
		var tab_num = $(obj).attr('tab-num');
		var formData = new FormData();
		formData = $("#frm-list-"+tab_num).serializeObject();
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "store/notice/put",
			error: function() {
				alert("처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert('저장을 완료했습니다.');
					noticeGetInfo();
				}
			}
		});
	});
}

function singleSaveBtn(obj){
	var country 	= $(obj).parents('form').find('input[name=country]').val();
	var condition 	= $(obj).parents('tr').find('input:eq(0)').val();
	var message 	= $(obj).parents('tr').find('input:eq(1)').val();
	if(message.length == 0){
		alert('메세지를 입력하지 않았습니다.');
		return false;
	}
	confirm("알림메세지를 저장하시겠습니까?",function() {
		$.ajax({
			type: "post",
			data: 
				{ 
					country : country,
					alarm_condition : condition,
					alarm_message : message
				},
			dataType: "json",
			url: config.api + "store/notice/put",
			error: function() {
				alert("처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert('저장을 완료했습니다.');
					noticeGetInfo();
				}
			}
		});
	});
}
</script>