<div class="content__card" style="width:950px;margin: 0;">
	<span><?=$idx?></span>
	<form id="frm-add" action="event/add">
		<div class="card__header">
			<div class="flex justify-between">
				<h3>이벤트 등록하기</h3>
				<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
			</div>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
            <div class="content__wrap">
				<div class="content__title">국가</div>
				<div class="content__row">
					<select id="country" type="select" name="country" style="width:80px">
						<option value="" selected>국가</option>
						<option value="KR" >한국몰</option>
						<option value="EN" >영문몰</option>
						<option value="CN" >중문몰</option>
					</select>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">이벤트 명</div>
				<div class="content__row">
					<input id="event_title" type="text" value="" style="width:80%;" placeholder="" name="event_title">
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">이벤트 시작일/종료일</div>
				<div class="content__row">
					<div class="rd__block">
                        <input id="event_flg" type="hidden" value="false">
						
						<input type="radio" id="event_always" class="radio__input" radio_type="display" value="true" name="event_always" checked>
						<label for="event_always">상시 오픈</label>
						
						<input type="radio" id="event_none_always" class="radio__input" radio_type="display" value="false" name="event_always">
						<label for="event_none_always" style="gap:5px;">지정 시간에만 </label>
						<div class="content__date__picker">
							<input id="event_from" class="event_date" type="date" name="event_from" placeholder="From" readonly="" style="width:150px" onChange="" disabled>
							<select class="event_date" type="select" name="event_from_h" style="width:80px" disabled>시 
								<option value="" selected>시간</option>
							</select>
							<select class="event_date" type="select" name="event_from_m" style="width:80px" disabled>분
								<option value="" selected>분</option>
							</select>
							
							<br><font class="" >~</font><br>
							
							<input id="event_to" class="event_date" type="date" name="event_to" placeholder="To" readonly="" style="width:150px; " onChange="" disabled>
							<select class="event_date" type="select" name="event_to_h" style="width:80px" disabled>시 
								<option value="" selected>시간</option>
							</select>
							<select class="event_date" type="select" name="event_to_m" style="width:80px" disabled>분
								<option value="" selected>분</option>
							</select>
						</div>
					</div>
				</div>
			</div>
            <div class="content__wrap">
				<div class="content__title">이벤트 노출 여부</div>
                <div class="rd__block">
                    <input type="radio" id="display_flg_true" class="radio__input" value="true" name="display_flg" />
                    <label for="display_flg_true">노출함</label>
                    <input type="radio" id="display_flg_false" class="radio__input" value="false" name="display_flg" />
                    <label for="display_flg_false">노출 안함</label>
                </div>
            </div>
            <div class="content__wrap">
				<div class="content__title">이벤트 진행 여부</div>
                <div class="rd__block">
                    <input type="radio" id="status_true" class="radio__input" value="true" name="status" />
                    <label for="status_true">진행</label>
                    <input type="radio" id="status_false" class="radio__input" value="false" name="status" />
                    <label for="status_false">미진행</label>
                </div>
            </div>
            <div class="content__wrap">
				<div class="content__title">당첨자 수 설정</div>
				<div class="content__row">
					<input id="winner_cnt" type="text" value="" style="width:150px;" placeholder="" name="winner_cnt" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                    <span style="color:red">※입력하지 않으면 이벤트에 응모한 전원이 당첨자가 됩니다.</span>
                </div>
			</div>
            <div class="content__wrap">
				<div class="content__title">랜덤 선별 여부</div>
                <div class="rd__block">
                    <input type="radio" id="random_flg_true" class="radio__input" value="true" name="random_flg" />
                    <label for="random_flg_true">ON</label>
                    <input type="radio" id="random_flg_false" class="radio__input" value="false" name="random_flg" />
                    <label for="random_flg_false">OFF</label>
                </div>
            </div>
            <div class="content__wrap">
				<div class="content__title">응모 상품 최대 개수</div>
				<div class="content__row">
					<input id="apply_product_cnt" type="text" value="" style="width:150px;" placeholder="" name="apply_product_cnt" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                </div>
			</div>
			<div class="content__wrap">
				<div class="content__title">당첨자 알람 여부</div>
                <div class="rd__block">
                    <input type="radio" id="alarm_flg_true" class="radio__input" value="true" name="alarm_flg" />
                    <label for="alarm_flg_true">ON</label>
                    <input type="radio" id="alarm_flg_false" class="radio__input" value="false" name="alarm_flg" />
                    <label for="alarm_flg_false">OFF</label>
                </div>
            </div>
			<div class="content__wrap">
				<div class="content__title">참여자 리스트<br>엑셀 내려받기 여부</div>
                <div class="rd__block">
                    <input type="radio" id="excel_print_flg_true" class="radio__input" value="true" name="excel_print_flg" />
                    <label for="excel_print_flg_true">ON</label>
                    <input type="radio" id="excel_print_flg_false" class="radio__input" value="false" name="excel_print_flg" />
                    <label for="excel_print_flg_false">OFF</label>
                </div>
            </div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div  onclick="eventAddAction();"  class="blue__color__btn"><span>저장</span></div>
					<div onclick="modal_cancel();" class="defult__color__btn"><span>작성 취소</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>
<script>
$(document).ready(function() {
	timeSelectInit();
});
function timeSelectInit(){
	for(var i = 0; i < 24; i++){
		$("select[name='event_from_h']").append('<option value="' + i.toString().padStart(2,'0') + '">' + i.toString().padStart(2,'0') + '시</option>');
		$("select[name='event_to_h']").append('<option value="' + i.toString().padStart(2,'0') + '">' + i.toString().padStart(2,'0') + '시</option>');
	}
	
	for(var j = 0; j < 60; j++){
		$("select[name='event_from_m']").append('<option value="' + j.toString().padStart(2,'0') + '">' + j.toString().padStart(2,'0') + '분</option>');
		$("select[name='event_to_m']").append('<option value="' + j.toString().padStart(2,'0') + '">' + j.toString().padStart(2,'0') + '분</option>');
	}

    $('input[name="event_always"]').click(function() {
		var event_flg = $(this).val();
		$('#event_flg').val(event_flg);

        if(event_flg == "true"){
            $('.event_date').val('');
            $('.event_date').attr("disabled", true);
        }
        else{
            $('.event_date').removeAttr("disabled");
        }
	});
}
function eventAddAction(){
	var country 		    = $('select[name=country]');
    var event_title 		= $('input[name=event_title]');
    var display_flg 		= $('input[name=display_flg]:checked');
    var status 		        = $('input[name=status]:checked');
    var random_flg 		    = $('input[name=random_flg]:checked');
    var apply_product_cnt 	= $('input[name=apply_product_cnt]');
    var alarm_flg 		    = $('input[name=alarm_flg]:checked');
    var excel_print_flg 	= $('input[name=excel_print_flg]:checked');
	
	if(country.val().length == 0){
		alert("국가를 선택해주세요", country.focus());
		return false;
	}
	if(event_title.val().length == 0){
		alert("이벤트명을 입력해주세요", event_title.focus());
		return false;
	}
    if(display_flg.length == 0){
		alert("이벤트 노출 여부를 선택해주세요", display_flg.focus());
		return false;
	}
    if(status.length == 0){
		alert("이벤트 진행여부를 선택해주세요", status.focus());
		return false;
	}
    if(random_flg.length == 0){
		alert("랜덤 선별 여부를 선택해주세요", random_flg.focus());
		return false;
	}
    if(apply_product_cnt.val().length == 0){
		alert("응모 상품 최대 개수를 입력해주세요", apply_product_cnt.focus());
		return false;
	}
    if(alarm_flg.length == 0){
		alert("당첨자 알람여부를 선택해주세요", alarm_flg.focus());
		return false;
	}
    if(excel_print_flg.length == 0){
		alert("참여자 리스트 엑셀로 내려받기 여부를 선택해주세요", excel_print_flg.focus());
		return false;
	}
	
	var event_start_date = $("input[name='event_from']").val() + ' ' + $("select[name='event_from_h']").val() + ':' + $("select[name='event_from_m']").val();
    var event_end_date = $("input[name='event_to']").val() + ' ' + $("select[name='event_to_h']").val() + ':' + $("select[name='event_to_m']").val();
    
    if (event_start_date != null && event_end_date != null) {
        var start_date = new Date(event_start_date);
        var end_date = new Date(event_end_date);
        
        if (start_date > end_date) {
            alert('진열 시작일/종료일에 올바른 날짜를 입력해주세요.');
            return false;
        }
    } else {
        alert('진열 시작일/종료일에 정확한 날짜를 입력해주세요.');
        return false;
    }
	insertLog("전시관리 > 이벤트 관리 ", "[" + event_title.val() + "] 이벤트 수정", null);
	modal_submit($('#frm-add'),'getEventInfoList');
}
</script>