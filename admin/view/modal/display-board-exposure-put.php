<div class="content__card" style="width:900px;margin: 0;">
    <div class="card__header">
        <div class="flex justify-between">
            <h3>게시판 노출시간 설정</h3>
            <a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <form id="frm-update-date-NTC" action="page/board/put">
            <input type="hidden" name="board_idx[]" value="<?=$board_idx_arr?>">
            <input type="hidden" name="put_type" value="exposure_date">
            <div class="content__wrap">
                <div class="content__title">노출 시간 설정</div>
                <div class="content__row">
                    <div class="rd__block">
                        <input id="exposure_flg" type="hidden" value="true">
                        
                        <input type="radio" id="exposure_flg_always" class="radio__input exposure_flg" value="true" name="exposure_flg" checked>
                        <label for="exposure_flg_always">상시 노출</label>
                        
                        <input type="radio" id="exposure_flg_date" class="radio__input exposure_flg" value="false" name="exposure_flg">
                        <label for="exposure_flg_date" style="gap:5px;">지정 시간에만 </label>
                        
                        <div class="content__date__picker">
                            <input id="exposure_from" class="exposure_date" type="date" name="exposure_from" placeholder="From" readonly="" style="width:150px" onChange="dateSelectDiableSet(this)" disabled>
                            <select class="exposure_date" type="select" name="exposure_from_h" style="width:80px" disabled>시 
                                <option value="" selected>시간</option>
                            </select>
                            <select class="exposure_date" type="select" name="exposure_from_m" style="width:80px" disabled>분
                                <option value="" selected>분</option>
                            </select>
                            
                            <br><font class="" >~</font><br>
                            
                            <input id="exposure_to" class="exposure_date" type="date" name="exposure_to" placeholder="To" readonly="" style="width:150px; " onChange="dateSelectDiableSet(this)" disabled>
                            <select class="exposure_date" type="select" name="exposure_to_h" style="width:80px" disabled>시 
                                <option value="" selected>시간</option>
                            </select>
                            <select class="exposure_date" type="select" name="exposure_to_m" style="width:80px" disabled>분
                                <option value="" selected>분</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card__footer">
		<div class="footer__btn__wrap">
			<div class="tmp" toggle="tmp"></div>
			<div class="btn__wrap--lg">
				<div  class="blue__color__btn" onclick="boardUpdateCheck();"><span>수정</span></div>
				<div class="defult__color__btn" onclick="modal_cancel();"><span>창 닫기</span></div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	timeSelectInit();
    
	if($(this).prop("checked")) {
		$("#goods-ticket-cnt,#goods-ticket-add-text").removeClass("hidden");

	}
    $('.exposure_flg').change(function(){
        var val = this.value;
        $('#exposure_flg').val(val);
        switch(val){
            case 'true':
                $('.exposure_date').val('');
                $('.exposure_date').attr("disabled", true);
                break;
            case 'false':
                $('.exposure_date').removeAttr("disabled");
                break;
        }
    });
});
function dateSelectDiableSet(obj){
    var name = $(obj).attr('name');
    switch(name){
        case 'exposure_to':
            $('#update_table_exposure_date').find("select.to").attr("disabled", false);
            break;
        case 'exposure_from':
            $('#update_table_exposure_date').find("select.from").attr("disabled", false);
            break;    
    }
}
function boardUpdateCheck() {
    var exposure_flg = $('#exposure_flg').val();
	if (exposure_flg == "false") {
		var exposure_start_date = $("input[name='exposure_from']").val() + ' ' + $("select[name='exposure_from_h']").val() + ':' + $("select[name='exposure_from_m']").val();
		var exposure_end_date = $("input[name='exposure_to']").val() + ' ' + $("select[name='exposure_to_h']").val() + ':' + $("select[name='exposure_to_m']").val();
		
		if (exposure_start_date.length == 16 && exposure_end_date.length == 16) {
			var start_date = new Date(exposure_start_date);
			var end_date = new Date(exposure_end_date);
			
			if (start_date > end_date) {
				alert('진열 시작일/종료일에 올바른 날짜를 입력해주세요.');
				return false;
			}
		} else {
			alert('진열 시작일/종료일에 정확한 날짜를 입력해주세요.');
			return false;
		}
	}
    modal_submit($('#frm-update-date-NTC'),'getBoardInfoList_NTC');  
}
function timeSelectInit(){
	for(var i = 0; i < 24; i++){
        var str = i.toString();
        var h = str.padStart(2,'0');
		$("select[name='exposure_from_h']").append('<option value="'+h+'">'+h+'시</option>');
		$("select[name='exposure_to_h']").append('<option value="'+h+'">'+h+'시</option>');
	}
	for(var j = 0; j < 60; j++){
        var str = j.toString();
        var m = str.padStart(2,'0');
		$("select[name='exposure_from_m']").append('<option value="'+m+'">'+m+'분</option>');
		$("select[name='exposure_to_m']").append('<option value="'+m+'">'+m+'분</option>');
	}
}
</script>