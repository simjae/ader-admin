<style>
#answer{
	margin-top : 50px;
}
.content__card.modal__view .card__body{
    height:92vh;
}
</style>
<?php
    $param_arr = explode(',', $param);

    if(count($param_arr) != 2){
        echo "
            <script>
                alert('잘못된 경로로 접근했습니다.',function(){
                    location.href='/display/board';
                });
            </script>
        ";
    }
    else{
        $page_idx = $param_arr[0];
        $country = $param_arr[1];
    }

    $get_notice_sql = "
            SELECT
                BOARD.IDX,
                BOARD.DISPLAY_NUM,
                BOARD.COUNTRY,
                BOARD.BOARD_TYPE,
                BOARD.CATEGORY,
                BOARD.ADMIN_IDX,
                BOARD.ADMIN_ID,
                BOARD.ADMIN_NAME,
                IFNULL(BOARD.IP,'-')            AS IP,
                BOARD.TITLE,
                BOARD.CONTENTS,
                BOARD.REPLY_FLG,
                BOARD.EXPOSURE_FLG				AS EXPOSURE_FLG,
                DATE_FORMAT(
                    BOARD.EXPOSURE_START_DATE,
                    '%Y-%m-%d %H:%i'
                )					            AS EXPOSURE_START_DATE,
                DATE_FORMAT(
                    BOARD.EXPOSURE_END_DATE,
                    '%Y-%m-%d %H:%i'
                )					            AS EXPOSURE_END_DATE,
                BOARD.FIX_FLG					AS FIX_FLG,			
                BOARD.CREATE_DATE,
                BOARD.CREATER,
                BOARD.UPDATE_DATE,
                BOARD.UPDATER
            FROM
                dev.PAGE_BOARD BOARD
            WHERE
                BOARD.IDX = ".$page_idx."
    ";

    $db->query($get_notice_sql);

    foreach($db->fetch() as $data) {
        $display_num		    = $data['DISPLAY_NUM'];
        $idx                    = $data['IDX'];
        $country                = $data['COUNTRY'];
        $board_type             = $data['BOARD_TYPE'];
        $category               = $data['CATEGORY'];
        $admin_idx              = $data['ADMIN_IDX'];
        $admin_id               = $data['ADMIN_ID'];
        $admin_name             = $data['ADMIN_NAME'];
        $ip                     = $data['IP'];
        $title                  = $data['TITLE'];
        $contents               = $data['CONTENTS'];
        $reply_flg              = $data['REPLY_FLG'];
        $exposure_flg           = $data['EXPOSURE_FLG'];
        $exposure_start_date    = $data['EXPOSURE_START_DATE'];
        $exposure_end_date      = $data['EXPOSURE_END_DATE'];
        $fix_flg                = $data['FIX_FLG'];
        $create_date            = $data['CREATE_DATE'];
        $creater                = $data['CREATER'];
        $update_date            = $data['UPDATE_DATE'];
        $updater                = $data['UPDATER'];
    }
    $kr_checked = '';
    $en_checked = '';
    $cn_checked = '';
    if($country == "KR"){
        $kr_checked = "checked";
    }
    else if($country == "EN"){
        $en_checked = "checked";
    }
    else if($country == "CN"){
        $cn_checked = "checked";
    }

    $cmn_selected = '';
    $udl_selected = '';
    if($category == "CMN"){
        $cmn_selected = "selected";
    }
    else if($category == "UDL"){
        $udl_selected = "selected";
    }

    $fixed_true_checked = '';
    $fixed_false_checked = '';
    if($fix_flg == true){
        $fixed_true_checked = "checked";
    }
    else if($fix_flg == false){
        $fixed_false_checked = "checked";
    }
    $date_from_arr = explode(' ',$exposure_start_date);
    $date_from_hour = explode(':',$date_from_arr[1])[0];
    $date_from_min = explode(':',$date_from_arr[1])[1];

    $date_to_arr = explode(' ',$exposure_end_date);
    $date_to_hour = explode(':',$date_to_arr[1])[0];
    $date_to_min = explode(':',$date_to_arr[1])[1];

    $always_exposure_checked = '';
    $nomal_exposure_checked = '';
    $date_disabled = '';
    if($date_to_arr[0] == '9999-12-31'){
        $always_exposure_checked = "checked";
        $date_disabled = "disabled";
    }
    else{
        $nomal_exposure_checked = "checked";
    }


?>

<div class="content__card modal__view" style="width:1300px;margin: 0;">
    
    <div class="card__header">
        <div class="flex justify-between">
            <h3 id='preview_title'>공지사항 프리뷰</h3>
            <a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
        </div>
        <div class="drive--x"></div>
    </div>
    <div class="card__body">
        <input type="hidden" id="date_from_hour" value="<?=$date_from_hour?>">
        <input type="hidden" id="date_from_min" value="<?=$date_from_min?>">
        <input type="hidden" id="date_to_hour" value="<?=$date_to_hour?>">
        <input type="hidden" id="date_to_min" value="<?=$date_to_min?>">
        <form id="frm-update-NTC">
            <input type="hidden" name="board_idx" value="<?=$idx?>">
            <div class="content__wrap">
                <div class="content__title">쇼핑몰</div>
                <div class="content__row">
                    <select id="country" type="select" name="country" style="width:150px" disabled>
                        <option value="KR" <?=$kr_checked?>>한국몰</option>
                        <option value="EN" <?=$en_checked?>>영문몰</option>
                        <option value="CN" <?=$cn_checked?>>중국몰</option>
                    </select>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">카테고리</div>
                <div class="content__row">
                    <select id="category" type="select" name="category" style="width:150px">
                        <option value="">카테고리 선택</option>
                        <option value="CMN" <?=$cmn_selected?>>일반</option>
                        <option value="UDL" <?=$udl_selected?>>미확인입금자명단</option>
                    </select>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">제목</div>
                <div class="content__row">
                    <input type="text" value="<?=$title?>" style="width:80%;" placeholder=""  name="title">
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">글고정 여부</div>
                <div class="content__row">
                    <div class="rd__block">
                        <input type="radio" id="fix_flg_true" class="radio__input" value="true" name="fix_flg" <?=$fixed_true_checked?>/>
                        <label for="fix_flg_true">글고정 함</label>
                        <input type="radio" id="fix_flg_false" class="radio__input" value="false" name="fix_flg" <?=$fixed_false_checked?>/>
                        <label for="fix_flg_false">글고정 안함</label>
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">게시글 노출시간 설정</div>
                <div class="content__row">
                    <div class="rd__block">
                        <input id="display_flg" type="hidden" value="true">
                        
                        <input type="radio" id="display_flg_true" class="radio__input display_flg" value="true" name="display_flg" <?=$always_exposure_checked?>>
                        <label for="display_flg_true">상시 노출</label>
                        
                        <input type="radio" id="display_flg_false" class="radio__input display_flg" value="false" name="display_flg" <?=$nomal_exposure_checked?>>
                        <label for="display_flg_false" style="gap:5px;">
                            지정 시간에만 
                        </label>
                        
                        <div class="content__date__picker">
                            <input class="display_date" type="date" name="display_from"  placeholder="From" readonly="" style="width:150px" onChange="" value="<?=$date_from_arr[0]?>" <?=$date_disabled?>>
                                
                            <select class="display_date" type="select" name="display_from_h" style="width:80px" value="" <?=$date_disabled?>>시 
                                <option value="" selected>시간</option>
                            </select>
                            <select class="display_date" type="select" name="display_from_m" style="width:80px" value="" <?=$date_disabled?>>분
                                <option value="" selected>분</option>
                            </select>
                            
                            <br><font class="" >~</font><br>
                            
                            <input class="display_date" type="date" name="display_to" placeholder="To" readonly="" style="width:150px; " onChange="" value="<?=$date_to_arr[0]?>" <?=$date_disabled?>>
                            <select class="display_date" type="select" name="display_to_h" style="width:80px" value="" <?=$date_disabled?>>시 
                                <option value="" selected>시간</option>
                            </select>
                            <select class="display_date" type="select" name="display_to_m" style="width:80px" value="" <?=$date_disabled?>>분
                                <option value="" selected>분</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content__wrap">
                <div class="content__title">내용</div>
                <div class="content__row">
                    <textarea id="contents" name="contents" required style="width:100%;height:230px;"><?=$contents?></textarea>
                </div>
            </div>
        </form>
    </div>
    <div class="card__footer">
        <div class="footer__btn__wrap" style="grid: none;">
            <div class="btn__wrap--lg">
                <div onclick="noticeUpdate();"  class="blue__color__btn"><span>저장</span></div>
                <div onclick="modal_close();" class="defult__color__btn"><span>작성 취소</span></div>
            </div>
        </div>
    </div>
</div>

<script>
var contents = [];
$(document).ready(function() {
    timeSelectInit();

    $('.radio__input.display_flg').click(function() {
		var display_flg = $(this).val();
		$('#display_flg').val(display_flg);
	});
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: contents,
		elPlaceHolder: "contents",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		htParams: { fOnBeforeUnload : function(){}}
	});
    $('.radio__input.display_flg').change(function(){
        var val = $(this).val();
        
        switch(val){
            case 'true':
                $('.display_date').val('');
                $('.display_date').attr("disabled", true);
                break;
            case 'false':
                $('.display_date').removeAttr("disabled");
                break;
        }
    })

    $("select[name='display_from_h']").val($('#date_from_hour').val());
    $("select[name='display_to_h']").val($('#date_to_hour').val());
    $("select[name='display_from_m']").val($('#date_from_min').val());
    $("select[name='display_to_m']").val($('#date_to_min').val());
});	
function noticeUpdate(){
	contents.getById["contents"].exec("UPDATE_CONTENTS_FIELD", []);

    var formData = new FormData();
	formData = $("#frm-update-NTC").serializeObject();

	if(formData.category.length == 0){
		alert("공지사항 카테고리를 입력해주세요", $('select[name=category]').focus());
		return false;
	}
	if(formData.title.length == 0){
		alert("공지사항 제목을 입력해주세요", $('input[name=title]').focus());
		return false;
	}
	if(formData.contents == '<p>&nbsp;</p>'){
		alert("공지사항 내용을 기입해주세요");
		return false;
	}

    var display_flg = $('#display_flg').val();
	if (display_flg == "false") {
		var display_start_date = $("input[name='display_from']").val() + ' ' + $("select[name='display_from_h']").val() + ':' + $("select[name='display_from_m']").val();
		var display_end_date = $("input[name='display_to']").val() + ' ' + $("select[name='display_to_h']").val() + ':' + $("select[name='display_to_m']").val();
		
		if ($("input[name='display_from']").val().length != 0 && $("input[name='display_to']").val().length != 0) {
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
	confirm("공지사항을 수정 하시겠습니까?",function() {
		$.ajax({
			type: "post",
            data: formData,
			dataType: "json",
			url: config.api + "page/board/notice/put",
			error: function() {
				alert("공지사항 수정이 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					alert("공지사항 수정에 성공했습니다.",function(){
						getBoardTabInfoNTC();
                        modal_close();
					});
				}
                else{
                    alert("공지사항 수정이 실패했습니다.");
                }
			}
		});
	});
}
function timeSelectInit(){
	for(var i = 0; i < 24; i++){
		$("select[name='display_from_h']").append('<option value="'+String(i).padStart(2, '0')+'">'+String(i).padStart(2, '0')+'시</option>');
		$("select[name='display_to_h']").append('<option value="'+String(i).padStart(2, '0')+'">'+String(i).padStart(2, '0')+'시</option>');
	}
	for(var j = 0; j < 60; j++){
		$("select[name='display_from_m']").append('<option value="'+String(j).padStart(2, '0')+'">'+String(j).padStart(2, '0')+'분</option>');
		$("select[name='display_to_m']").append('<option value="'+String(j).padStart(2, '0')+'">'+String(j).padStart(2, '0')+'분</option>');
	}
}



</script>