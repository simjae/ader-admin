<style>
.time__select{width:80px!important;}
</style>
<div class="content__card" style="width:80vw;margin: 0;">
	<form id="frm-preview" action="event/put">
		<input type="hidden" id="event_idx" name="event_idx" value="<?=$idx?>">
		<div class="card__header">
			<div class="flex justify-between">
				<h3>이벤트 프리뷰</h3>
				<a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
			</div>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
            <div class="content__wrap">
				<div class="content__title">국가</div>
				<div class="content__row" id="country_str">
					
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">이벤트 명</div>
				<div class="content__row">
					<input id="event_title" type="text" value="" style="width:80%;" placeholder="" name="event_title" disabled>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">이벤트 시작일/종료일</div>
				<div class="content__row">
					<div class="rd__block">
                        <input id="event_flg" type="hidden" value="false">
						
						<input type="radio" id="event_always" class="radio__input event__always__flg" radio_type="display" value="true" name="event_always" checked disabled>
						<label for="event_always">상시 오픈</label>
						
						<input type="radio" id="event_none_always" class="radio__input event__always__flg" radio_type="display" value="false" name="event_always" disabled>
						<label for="event_none_always" style="gap:5px;">지정 시간에만 </label>
					</div>
				</div>
			</div>
			<div class="content__wrap grid__half event__date hidden">
				<div class="half__box__wrap">
					<div class="content__title">시작일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input class="date_param" type="date" id="sdate"
									class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
									date_type="day" onChange="dateParamChange(this);" disabled>
								<select id="sdate_hour" class="time__select hour" date_type="hour" onChange="dateParamChange(this);" disabled></select>
								<span>&nbsp;시</span>
								<select id="sdate_minite" class="time__select minite" date_type="minite" onChange="dateParamChange(this);" disabled></select>
								<span>&nbsp;분</span>
							</div>
						</div>
					</div>
				</div>
				<div class="half__box__wrap">
					<div class="content__title">종료일</div>
					<div class="content__row">
						<div class="content__date__wrap">
							<div class="content__date__picker">
								<input class="date_param" type="date" id="edate"
									class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
									date_type="day" onChange="dateParamChange(this);" disabled>
								<select id="edate_hour" class="time__select hour" date_type="hour" onChange="dateParamChange(this);" disabled></select>
								<span>&nbsp;시</span>
								<select id="edate_minite" class="time__select minite" date_type="minite" onChange="dateParamChange(this);" disabled></select>
								<span>&nbsp;분</span>
							</div>
						</div>
					</div>
				</div>
			</div>
            <div class="content__wrap">
				<div class="content__title">이벤트 노출 여부</div>
                <div class="rd__block">
                    <input type="radio" id="display_flg_true" class="radio__input" value="true" name="display_flg" checked disabled/>
                    <label for="display_flg_true">노출함</label>
                    <input type="radio" id="display_flg_false" class="radio__input" value="false" name="display_flg" disabled/>
                    <label for="display_flg_false">노출 안함</label>
                </div>
            </div>
            <div class="content__wrap">
				<div class="content__title">이벤트 진행 여부</div>
                <div class="rd__block">
                    <input type="radio" id="status_true" class="radio__input" value="Y" name="status" checked disabled/>
                    <label for="status_true">진행</label>
                    <input type="radio" id="status_false" class="radio__input" value="N" name="status" disabled/>
                    <label for="status_false">미진행</label>
                </div>
            </div>
            <div class="content__wrap">
				<div class="content__title">당첨자 수 설정</div>
				<div class="content__row">
					<input id="winner_cnt" type="text" value="" style="width:150px;" placeholder="" name="winner_cnt" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" disabled>
                </div>
			</div>
            <div class="content__wrap">
				<div class="content__title">랜덤 선별 여부</div>
                <div class="rd__block">
                    <input type="radio" id="random_flg_true" class="radio__input" value="true" name="random_flg" checked disabled/>
                    <label for="random_flg_true">ON</label>
                    <input type="radio" id="random_flg_false" class="radio__input" value="false" name="random_flg" disabled/>
                    <label for="random_flg_false">OFF</label>
                </div>
            </div>
            <div class="content__wrap">
				<div class="content__title">응모 상품 최대 개수</div>
				<div class="content__row">
					<input id="apply_product_cnt" type="text" value="" style="width:150px;" placeholder="" name="apply_product_cnt" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" disabled>
                </div>
			</div>
			<div class="content__wrap">
				<div class="content__title">당첨자 알람 여부</div>
                <div class="rd__block">
                    <input type="radio" id="alarm_flg_true" class="radio__input" value="true" name="alarm_flg" checked disabled/>
                    <label for="alarm_flg_true">ON</label>
                    <input type="radio" id="alarm_flg_false" class="radio__input" value="false" name="alarm_flg" disabled/>
                    <label for="alarm_flg_false">OFF</label>
                </div>
            </div>
			<div class="content__wrap">
				<div class="content__title">참여자 리스트<br>엑셀 내려받기 여부</div>
                <div class="rd__block">
                    <input type="radio" id="excel_print_flg_true" class="radio__input" value="true" name="excel_print_flg" checked disabled/>
                    <label for="excel_print_flg_true">ON</label>
                    <input type="radio" id="excel_print_flg_false" class="radio__input" value="false" name="excel_print_flg" disabled/>
                    <label for="excel_print_flg_false">OFF</label>
                </div>
            </div>
		</div>
		<div class="card__footer">
			<div class="footer__btn__wrap" style="grid: none;">
				<div class="btn__wrap--lg">
					<div onclick="modal_close();" class="defult__color__btn"><span>창닫기</span></div>
				</div>
			</div>
		</div> 
	</form>
</div>
<script>
$(document).ready(function() {
	timeSelectSet();
	getEventInfo();
});

function timeSelectSet(){
	var hourOption = '<option value="">선택</option>';
    var miniteOption = '<option value="">선택</option>';
	
	for(var i = 0; i <= 24; i++){
		var hour_val = i.toString().padStart(2,'0');
		hourOption += `
			<option value='${hour_val}'>${hour_val}</option>
		`;
	}
	$('.hour').append(hourOption);

    for(var j = 0; j < 60; j++){
		var minite_val = j.toString().padStart(2,'0');
		miniteOption += `
			<option value='${minite_val}'>${minite_val}</option>
		`;
	}
	$('.minite').append(miniteOption);
}
function getEventInfo(){
	let event_idx = $('#event_idx').val();

	$.ajax({
		type: "post",
		data: {
			'event_idx' : event_idx
		},
		dataType: "json",
		url: config.api + "event/get",
		error: function() {
			alert("이벤트 열람이 실패했습니다.");
		},
		success: function(d) {
			if(d != null){
				if(d.code == 200) {
					if(d.data != null){
						let data = d.data;
						let preview_form = $('#frm-preview');

						let country_str = '';
						switch(data.country){
							case 'KR':
								country_str = '한국몰';
								break;
							case 'EN':
								country_str = '영문몰';
								break;
							case 'CN':
								country_str = '중국몰';
								break;
						}
						$('#country_str').text(country_str);
						
						$('#event_title').val(data.event_title);

						if (data.edate == '9999-12-31 23:59:00') {
                            $('#event_always').prop('checked',true);
                        } 
						else if(data.edate != null){
                            $('#event_none_always').prop('checked',true);
                            $('.event__date').removeClass('hidden');
                            
                            var sdate_arr =  data.sdate.split(' ');
                            $('#sdate').val(sdate_arr[0]);
                            $('#sdate_hour').val(sdate_arr[1].split(':')[0]).prop("selected",true);
                            $('#sdate_minite').val(sdate_arr[1].split(':')[1])

                            var edate_arr =  data.edate.split(' ');
                            $('#edate').val(edate_arr[0]);
                            $('#edate_hour').val(edate_arr[1].split(':')[0]).prop("selected",true);
                            $('#edate_minite').val(edate_arr[1].split(':')[1]);
                        }
						preview_form.find(`input:radio[name="display_flg"][value="${data.display_flg==true?'true':'false'}"]`).prop('checked',true);
						preview_form.find(`input:radio[name="status"][value="${data.status}"]`).prop('checked',true);
						preview_form.find(`input:radio[name="random_flg"][value="${data.random_flg==true?'true':'false'}"]`).prop('checked',true);
						preview_form.find(`input:radio[name="alarm_flg"][value="${data.alarm_flg==true?'true':'false'}"]`).prop('checked',true);
						preview_form.find(`input:radio[name="excel_print_flg"][value="${data.excel_print_flg==true?'true':'false'}"]`).prop('checked',true);
						$('#winner_cnt').val(data.winner_cnt);
						$('#apply_product_cnt').val(data.apply_product_cnt);
					}
				}
			}
		}
	});
}

</script>