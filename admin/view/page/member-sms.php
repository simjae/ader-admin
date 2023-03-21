<?php include_once("check.php"); ?>
<style>
.sms_tab .card__header .btn{margin-bottom:20px;}
.sms_tab table{width:1120px;}
.sms_tab table tbody tr{height:200px;}
.sms_tab textarea{width:260px;height:150px;resize:none;border:1px solid #dcdcdc;padding:5px;}
.sms_tab .cb__color{margin-top:40px;}
.sms_tab .btn.preview{margin-top:10px;}
.current__byte{margin-left:100px;}
</style>

<div class="filter-wrap" style="margin-bottom:20px">
	<button class="sms_tab_btn tap__button" tab_status="ODR" style="background-color: #000;color: #fff;font-weight: 500;" onClick="orderTabBtnClick(this);">주문 관련 메세지</button>
	<button class="sms_tab_btn tap__button" tab_status="MEM" onClick="orderTabBtnClick(this);">회원 관련 메시지</button>
	<button class="sms_tab_btn tap__button" tab_status="BRD" onClick="orderTabBtnClick(this);">게시판 관련 메시지</button>
	<button class="sms_tab_btn tap__button" tab_status="ADV" onClick="orderTabBtnClick(this);">광고 관련 메시지</button>
</div>

<input id="tab_status" type="hidden" value="ODR">

<div id="sms_tab_ODR" class="sms_tab">
	<?php include_once("member-sms-odr.php"); ?>
</div>

<div id="sms_tab_MEM" class="sms_tab" style="display:none;">
	<?php include_once("member-sms-mem.php"); ?>
</div>

<div id="sms_tab_BRD" class="sms_tab" style="display:none;">
	<?php include_once("member-sms-brd.php"); ?>
</div>

<div id="sms_tab_ADV" class="sms_tab" style="display:none;">
	<?php include_once("member-sms-adv.php"); ?>
</div>

<script>
function orderTabBtnClick(obj) {
	var tab_status = $(obj).attr('tab_status');
	$('#tab_status').val(tab_status);
	$('.sms_tab').hide();
	$('#sms_tab_' + tab_status).show();
	
	$(obj).css('background-color','#000000');
	$(obj).css('color','#ffffff');
	
	$('.sms_tab_btn').not($(obj)).css('background-color','#ffffff');
	$('.sms_tab_btn').not($(obj)).css('color','#000000');
}
function byteCheck(obj){
	const max_len = 100;

	let obj_str = $(obj).val();
	let obj_len = $(obj).val().length;

	let totalByte = 0;

	for(let i = 0; i < obj_len; i++){
		let uni_char = escape(obj_str.charAt(i));

		if(uni_char.length > 4){
			totalByte += 2;
		}
		else{
			totalByte += 1;
		}
	}

	if(totalByte > max_len){
		$(obj).parent().find('.current__byte').text(totalByte);
		$(obj).parent().find('.current__byte').css('color','red');
	}
	else{
		$(obj).parent().find('.current__byte').text(totalByte);
		$(obj).parent().find('.current__byte').css('color','black');
	}
}
function saveMsgTap(){
	confirm('메세지를 현재상태로 저장하시겠습니까?',function(){
		var tab_status = $('#tab_status').val();

		let frm = $('#frm-list_' + tab_status);
		let formData = new FormData();
		formData = frm.serializeObject();

		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "member/sms/put",
			error: function() {
				alert("적립금 내역 처리가 실패했습니다.");
			},
			success: function(d) {
				if(d != null){
					if(d.code == 200) {
						alert('메세지가 저장되었습니다.');
					}
				}
			}
		});
	});
}
</script>