<style>
    .popup{
        background-color: #fff;
    }
    .preview{
        background-image: url('/images/popup/popup__bg.png');
        background-repeat: no-repeat;
        background-size: cover;
    }
    .time__select{width:80px!important;}
    .modal__wrap, .modal__wrap .modal__body{height:90vh}
    .modal__wrap{display:flex;flex-direction:column;}
    .modal__wrap .modal__body{flex: 1;overflow-y:scroll}
</style>
<form id='frm-web-list' action="display/popup/url/get">
	<input type="hidden" name="list_type" value="web">
    <input type="hidden" name="search_type" value="">
    <input type="hidden" name="search_keyword" value="">
	<input type="hidden" class="rows" name="rows" value="10">
	<input type="hidden" class="page" name="page" value="1">
</form>
<form id='frm-product-list' action="display/popup/url/get">	
	<input type="hidden" name="list_type" value="product">
    <input type="hidden" name="search_type" value="">
    <input type="hidden" name="search_keyword" value="">
	<input type="hidden" class="rows" name="rows" value="10">
	<input type="hidden" class="page" name="page" value="1">
</form>
<div class="content__card modal__wrap">
    <div class="modal__header">
        <div class="card__header">
            <div class="flex justify-between">
                <h3>팝업 설정</h3>
                <a href="javascript:;" onclick="modal_close();" class="btn-close"><i class="xi-close"></i></a>
            </div>
            <div class="drive--x"></div>
        </div>
    </div>
    <div class="modal__body">
        <form id='frm-update' action="display/popup/put">
            <input id="popup_idx" type="hidden" name="popup_idx" value="<?=$idx?>">
            <div class="content__card">
                <div class="card__header">
                    <div class="flex justify-between">
                        <h3>팝업 진행 설정</h3>
                    </div>
                    <div class="drive--x"></div>
                </div>
                <div class="card__body">
                    <div class="content__wrap" style="align-items: start;">
                        <div class="content__title">쇼핑몰 선택</div>
                        <div class="content__row" style="display: block;">
                            <select name="country" id="country" style="width:163px;">
                                <option value="KR">아더에러 한국몰</option>
                                <option value="EN">아더에러 영문몰</option>
                                <option value="CN">아더에러 중문몰</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content__card">
                <div class="card__header">
                    <h3>팝업 표시 설정</h3>
                    <div class="drive--x"></div>
                </div>
                <div class="card__body">
                    <div class="content__wrap">
                        <div class="content__title">기간 설정</div>
                        <div class="content__row">
                            <div class="rd__block">
                                <input id="display_flg" type="hidden" value="false">

                                <input type="radio" id="display_flg_modal_always" class="radio__input display_flg" radio_type="display" value="true" name="display_date" checked>
                                <label for="display_flg_modal_always">상시 오픈</label>
                                
                                <input type="radio" id="display_flg_modal_date" class="radio__input display_flg" radio_type="display" value="false" name="display_date">
                                <label for="display_flg_modal_date" style="gap:5px;">진행 기간</label>
                            </div>
                        </div>
                    </div>
                    <div class="content__wrap grid__half">
                        <div class="half__box__wrap">
                            <div class="content__title">팝업 진행시작일</div>
                            <div class="content__row">
                                <div class="content__date__wrap">
                                    <div class="content__date__picker">
                                        <input class="date_param" type="date" id="display_start_date"
                                            class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
                                            date_type="day" onChange="dateParamChange(this);" disabled>
                                        <select id="display_start_hour" class="time__select hour" date_type="hour" onChange="dateParamChange(this);" disabled></select>
                                        <span>&nbsp;시</span>
                                        <select id="display_start_minite" class="time__select minite" date_type="minite" onChange="dateParamChange(this);" disabled></select>
                                        <span>&nbsp;분</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="half__box__wrap">
                            <div class="content__title">팝업 진행종료일</div>
                            <div class="content__row">
                                <div class="content__date__wrap">
                                    <div class="content__date__picker">
                                        <input class="date_param" type="date" id="display_end_date"
                                            class="margin-bottom-6" placeholder="From" readonly style="width:150px;"
                                            date_type="day" onChange="dateParamChange(this);" disabled>
                                        <select id="display_end_hour" class="time__select hour" date_type="hour" onChange="dateParamChange(this);" disabled></select>
                                        <span>&nbsp;시</span>
                                        <select id="display_end_minite" class="time__select minite" date_type="minite" onChange="dateParamChange(this);" disabled></select>
                                        <span>&nbsp;분</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content__wrap">
                        <div class="content__title">팝업 표시 위치</div>
                        <div class="content__row">
                            <span>화면 위로부터</span>
                            <input style="width:60px;" value="" name="location_height" type="text"><span>,</span>
                            <span>왼쪽부터</span>
                            <input style="width:60px;" value="" name="location_width" type="text">
                            <span>픽셀에서 노출</span>
                        </div>
                    </div>
                    <div class="content__wrap" style="align-items: start;">
                        <div class="content__title">웹페이지별 선택</div>
                        <div class="content__row" style="display: block;">
                            <div class="table table__wrap" style="width: 42%; margin-top: 10px;float:left;" >
                                <div class="table__filter">
                                    <div class="filrer__wrap">
                                        <div class="filter__btn" action_type="" onClick="addSelectList('web')">추가</div>
                                    </div>   
                                    <div> 
                                        <select id="search_type_web" style="width:123px;">
                                            <option value="title" selected="">타이틀</option>
                                            <option value="url">URL</option>
                                        </select>
                                        <input type="text" id="search_keyword_web" value="" style="width:140px">  
                                        <button type="button" onclick="getUrlInfo(this)" searchType="web" style="font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;">검색</button>                         
                                    </div>                             
                                </div>
                                <table>
                                    <colgroup>
                                        <col width="30px;">
                                        <col width="auto;">
                                        <col width="auto;">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="cb__color">
                                                    <label>
                                                        <input type="checkbox" id="allWebSelect" onChange="selectAllClick(this, 'web')">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </th>
                                            <th><span class="result__title">페이지 타이틀</span> </th>
                                            <th><span class="result__title">페이지 URL</span> </th>
                                        </tr>
                                    </thead>
                                    <tbody id="result_web_table">
                                    </tbody>
                                </table>
                                <div class="padding__wrap">
                                    <input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
                                    <input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
                                    <div class="paging_web"></div>
                                </div>
                            </div>
                            <div class="table table__wrap popup__display__result" style="width: 42%; margin-top: 10px;margin-right: 50px;float:right;" >
                                <div class="table__filter">
                                    <div class="">
                                        <div class="content__title">선택된 웹페이지</div>
                                    </div>                                
                                </div>
                                <div style="overflow-x:hidden; overflow-y:scroll;height:auto;max-height:450px"> 
                                    <table>
                                        <colgroup>
                                            <col width="auto">
                                            <col width="auto;">
                                            <col width="80px;">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th><span class="result__title">페이지 타이틀</span> </th>
                                                <th><span class="result__title">페이지 URL</span> </th>
                                                <th><span class="result__title">제거</span> </th>
                                            </tr>
                                        </thead>
                                        <tbody id="select_web_table" >
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content__wrap" style="align-items: start;">
                        <div class="content__title">상품별 선택</div>
                        <div class="content__row" style="display: block;">
                            <div class="table table__wrap" style="width: 42%; margin-top: 10px;float:left;" >
                                <div class="table__filter">
                                    <div class="filrer__wrap">
                                        <div class="filter__btn" action_type="" onClick="addSelectList('product')">추가</div>
                                    </div>  
                                    <div> 
                                        <select id="search_type_product" style="width:123px;">
                                            <option value="product_code" selected="">상품코드</option>
                                            <option value="product_name">상품명</option>
                                        </select>
                                        <input type="text" id="search_keyword_product" value="" style="width:140px">  
                                        <button type="button" onclick="getUrlInfo(this)" searchType="product" style="font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;">검색</button>                         
                                    </div>
                                </div>
                                <table>
                                    <colgroup>
                                        <col width="30px;">
                                        <col width="80px;">
                                        <col width="150px;">
                                        <col width="auto;">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="cb__color">
                                                    <label>
                                                        <input type="checkbox" id="allProdSelect" onChange="selectAllClick(this, 'product')">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </th>
                                            <th><span class="result__title">상품 이미지</span> </th>
                                            <th><span class="result__title">상품 코드</span> </th>
                                            <th><span class="result__title">상품 명</span> </th>
                                        </tr>
                                    </thead>
                                    <tbody id="result_product_table">
                                    </tbody>
                                </table>
                                <div class="padding__wrap">
                                    <input type="hidden" class="total_cnt" value="0" onChange="setPaging(this);">
                                    <input type="hidden" class="result_cnt" value="0" onChange="setPaging(this);">
                                    <div class="paging_product"></div>
                                </div>
                            </div>
                            <div class="table table__wrap popup__display__result" style="width: 42%; margin-top: 10px;margin-right: 50px;float:right;" >
                                <div class="table__filter">
                                    <div class="">
                                        <div class="content__title">선택된 상품</div>
                                    </div>                                
                                </div>
                                <div style="overflow-x:hidden; overflow-y:scroll;height:auto;max-height:450px"> 
                                    <table>
                                        <colgroup>
                                            <col width="200px;">
                                            <col width="auto;">
                                            <col width="80px;">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th><span class="result__title">상품 코드</span> </th>
                                                <th><span class="result__title">상품 명</span> </th>
                                                <th><span class="result__title">제거</span> </th>
                                            </tr>
                                        </thead>
                                        <tbody id="select_product_table">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content__card">
                <div class="card__header">
                    <h3>팝업창 디자인</h3>
                    <div class="drive--x"></div>
                </div>
                <div class="card__body">
                    <div class="content__wrap">
                        <div class="content__title">팝업종류</div>
                        <div class="content__row">
                            <div class="rd__block">
                                <input type="radio" id="modal_popup_window_type" class="radio__input" value="LAYER" name="popup_type" checked/>
                                <label for="modal_popup_window_type">레이어 팝업</label>
                                <input type="radio" id="modal_popup_layer_type" class="radio__input" value="WINDOW" name="popup_type"/>
                                <label for="modal_popup_layer_type">윈도우 팝업</label>
                            </div>
                        </div>
                    </div>
                    <div class="content__wrap">
                        <div class="content__title">디바이스</div>
                        <div class="content__row">
                            <div class="rd__block">
                                <input type="radio" id="modal_device_web" class="radio__input" value="WEB" name="device" checked/>
                                <label for="modal_device_web">웹</label>
                                <input type="radio" id="modal_device_mobile" class="radio__input" value="MOBILE" name="device"/>
                                <label for="modal_device_mobile">모바일</label>
                                <input type="radio" id="modal_device_all" class="radio__input" value="ALL" name="device"/>
                                <label for="modal_device_all">반응형</label>
                            </div>
                        </div>
                    </div>
                    <div class="content__wrap">
                        <div class="content__title">팝업 크기</div>
                        <div class="content__row">
                            <span>*가로</span>
                            <input style="width:60px;" value="" name="size_width" type="text"><span>픽셀</span>
                            <span>*세로</span>
                            <input style="width:60px;" value="" name="size_height" type="text">
                            <span>픽셀</span>
                        </div>
                    </div>
                    <div class="content__wrap">
                        <div class="content__title">창닫기 방법</div>
                        <div class="content__row">
                            <div class="rd__block">
                                <input type="radio" id="modal_close_today" class="radio__input" value="TODAY" name="close_flg" checked/>
                                <label for="modal_close_today">오늘 하루 열지 않음</label>
                                <input type="radio" id="modal_close_none" class="radio__input" value="NONE" name="close_flg"/>
                                <label for="modal_close_none">다시 열지 않음</label>
                            </div>
                        </div>
                    </div>
                    <div class="content__wrap">
                        <div class="content__title">문구 정렬</div>
                        <div class="content__row">
                            <select name="align" style="width:163px;">
                                <option value="RIGHT" selected="">오른쪽 정렬</option>
                                <option value="LEFT">왼쪽 정렬</option>
                                <option value="CENTER">가운데 정렬</option>
                            </select>
                        </div>
                    </div>
                    <div class="content__wrap">
                        <div class="content__title">팝업 제목</div>
                        <div class="content__row">
                        <input type="text" name="title" width="100%">
                        </div>
                    </div>
                    <div class="content__wrap" style="align-items: start;">
                        <div class="content__title">팝업 내용</div>
                        <div class="content__row">
                            <textarea class="width-100p" id="popup_contents" name="contents" title="내용" required></textarea>
                        </div>
                    </div>
                    <div class="content__wrap" style="align-items: start;">
                    <div class="content__title">
                        <div class="justify-center btn__wrap--lg">
                            <div class="defult__color__btn" onClick="previewPopup();">
                                <span>미리보기</span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="content__card">
                <div class="card__header">
                    <h3>미리보기</h3>
                    <div class="drive--x"></div>
                </div>
                <div class="card__body">
                    <div class="preview">
                        <div class="preview_web" style="overflow-y:scroll;overflow-x:scroll;width: 100%;height: 600px;border: 1px solid #707070; border-radius: 2px;">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal__footer">
        <div class="card__footer">
            <div class="footer__btn__wrap">
                <div class="tmp" toggle="hide"></div>
                <div class="btn__wrap--lg">
                    <div  class="blue__color__btn" onClick="popupUpdateAction();"><span>팝업 수정하기</span></div>
                    <div class="defult__color__btn" onClick="modal_close();"><span>창 닫기</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var popup_contents = [];

$(document).ready(function() {
    timeSelectSet();
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: popup_contents,
		elPlaceHolder: "popup_contents",
		sSkinURI: "/scripts/smarteditor2/SmartEditor2Skin.html",
		fOnAppLoad : function(){}
	});

	$('input[name="popupLocation"]').on('change',function(){
		let clickVal = $(this).val();
		let strhtml = '';
		$('.popup__display__result').html();
	});

    var popup_idx = $('#popup_idx').val();
    if(popup_idx != null){
        $.ajax({
            type: "post",
            data: {
                'popup_idx' : popup_idx
            },
            dataType: "json",
            url: config.api + "display/popup/get",
            error: function() {
                alert("팝업 불러오기 처리에 실패했습니다.");
            },
            success: function(data) {
                if(data != null){
                    if(data.code == 200) {
                        var update_form = $('#frm-update');
                        var row = data.data[0];
                        
                        update_form.find('select[name="country"]').val(row.country).prop('selected',true);
                        if (row.display_end_date == '9999-12-31 23:59') {
                            $('#display_flg_modal_always').prop('checked',true);
                            $('.date_param').val('');
                            $('.date_param').attr("disabled", true);

                            $('.time__select.minite').val('');
                            $('.time__select.minite').attr("disabled", true);
                            $('.time__select.hour option:eq(0)').prop('selected',true);
                            $('.time__select.hour').attr("disabled", true);
                            //update_form.find('.display_date').attr("disabled", true);
                        } else {
                            $('#display_flg_modal_date').prop('checked',true);
                            //update_form.find('.display_date').removeAttr("disabled");
                            $('.date_param').removeAttr("disabled");
                            $('.time__select').removeAttr("disabled");
                            
                            var display_start_date_arr =  row.display_start_date.split(' ');
                            $('#display_start_date').val(display_start_date_arr[0]);
                            $('#display_start_hour').val(display_start_date_arr[1].split(':')[0]).prop("selected",true);
                            $('#display_start_minite').val(display_start_date_arr[1].split(':')[1])

                            var display_end_date_arr =  row.display_end_date.split(' ');
                            $('#display_end_date').val(display_end_date_arr[0]);
                            $('#display_end_hour').val(display_end_date_arr[1].split(':')[0]).prop("selected",true);
                            $('#display_end_minite').val(display_end_date_arr[1].split(':')[1])
                        }
                        update_form.find('input[name=location_height]').val(row.location_height);
                        update_form.find('input[name=location_width]').val(row.location_width);

                        update_form.find('input[name="popup_type"][value="'+row.popup_type+'"]').prop('checked',true);
                        update_form.find('input[name="device"][value="'+row.device+'"]').prop('checked',true);

                        update_form.find('input[name="size_height"]').val(row.size_height);
                        update_form.find('input[name="size_width"]').val(row.size_width);

                        update_form.find('input[name="close_flg"][value="'+row.close_flg+'"]').prop('checked',true);
                        update_form.find('select[name="align"]').val(row.align).prop('selected',true);

                        update_form.find('input[name="title"]').val(row.title);
                        update_form.find("textarea[name='contents']").html(row.contents);


                        var close_str = '';
                        $('.preview_web').html('');

                        if(row.close_flg=='TODAY'){
                            close_str 		= '오늘 하루 열지 않기';
                        }
                        else if(row.close_flg=='NONE'){
                            close_str 		= '다시 열지 않기';
                        }
                        popupDiv = `
                            <div class="popup" style="width:${row.size_width}px; margin-top: ${row.location_height}px; margin-left:${row.location_width}px;">
                                <div class="pop__header">
                                    <div></div>
                                    <div class="h__title">${row.title}</div>
                                    <div class="h__close"><i class="xi-close"></i></div>
                                </div>
                                <div class="pop__body" style="height:${row.size_height}px; text-align:${row.align.toLowerCase()}">
                                    <div class="b__content">
                                        ${row.contents}
                                    </div>
                                </div>
                                <div class="pop__footer">
                                    <div class="f__box">
                                        <div class="f__cookie">${close_str}</div>
                                        <div class="f__close">닫기</div>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('.preview_web').prepend(popupDiv);
                    }
                }
                
            }
        });

        $.ajax({
            type: "post",
            data: {
                'popup_idx' : popup_idx
            },
            dataType: "json",
            url: config.api + "display/popup/url/get",
            error: function() {
                alert("팝업 URL 불러오기 처리에 실패했습니다.");
            },
            success: function(data) {
                if(data.data != null){
                    if(data.code == 200) {
                        data.data.forEach(function(row){
                            var type_idx = '';
                            var type = '';
                            var cols_first = '';
                            var cols_second = '';

                            if(row.popup_url_type == 'WEB'){
                                type_idx = row.front_idx;
                                type = 'web';
                                cols_first	= `<span class="result__span">${row.page_title}</span>`;
                                cols_second	= `<span class="result__span">${row.page_url}</span>`;
                            }
                            else if(row.popup_url_type == 'PRODUCT'){
                                type_idx = row.product_idx;
                                type = 'product';
                                cols_first	= `<span class="result__span">${row.product_code}</span>`;
                                cols_second	= `<span class="result__span">${row.product_name}</span>`;
                            }
                            strDiv = `
                                    <tr>
                                        <td>
                                            <input type='hidden' name="${type}_idx[]" value=${type_idx}>
                                            ${cols_first}
                                        </td>
                                        <td>
                                            ${cols_second}
                                        </db>
                                        <td>
                                            <button type="button" style="font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;" onclick="delSelectList(this)">제거</button>
                                        </db>
                                    </tr>	
                            `;
                            $('#select_'+type+'_table').append(strDiv);
                        });
                    }
                }
            }
        });
    }
});
$('.display_flg').change(function(){
	var val = $(this).val();
	if (val != "false") {
		$('.date_param').val('');
		$('.date_param').attr("disabled", true);

		$('.time__select.minite').val('');
		$('.time__select.minite').attr("disabled", true);
		$('.time__select.hour option:eq(0)').prop('selected',true);
		$('.time__select.hour').attr("disabled", true);
	} else {
		$('.date_param').removeAttr("disabled");
		$('.time__select').removeAttr("disabled");
	}
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
function dateParamChange(obj) {
	//content__date__picker
    let date_type = $(obj).attr('date_type');
    let parent_obj = $(obj).parent();

    let now_date = new Date();
    let now_gettime = now_date.getTime();
    let now_year = now_date.getFullYear();
    let now_month = (now_date.getMonth() + 1).toString().padStart(2,'0');
    let now_day = (now_date.getDate()).toString().padStart(2,'0');
    let now_hour = (now_date.getHours()).toString().padStart(2,'0');
    let now_minite = (now_date.getMinutes()).toString().padStart(2,'0');
    let now_date_str = `${now_year}-${now_month}-${now_day}`;
  
    switch(date_type){
        case 'day':
            if($(obj).val() < now_date_str){
                alert('과거시점으로 입력하실 수 없습니다.');
                $(obj).val(now_date_str);
                parent_obj.find('.time__select').val('');
                parent_obj.find('.time__select.minite').attr('disabled',true);
                return false;
            }
            parent_obj.find('.time__select').val('');
            parent_obj.find('.time__select.minite').attr('disabled',true);
            break;
        case 'hour':
            if(parent_obj.find('.date_param').val() + ' ' + $(obj).val() < now_date_str + ' ' + now_hour){
                alert('과거시점으로 입력하실 수 없습니다.');
                $(obj).val('');
                parent_obj.find('.time__select.minite').attr('disabled',true);
                return false;
            }
            parent_obj.find('.time__select.minite').val('');
            parent_obj.find('.time__select.minite').attr('disabled',false);
            break;
        case 'minite':
            if(parent_obj.find('.date_param').val() + ' ' + parent_obj.find('.time__select.hour').val() + ':' + $(obj).val() < now_date_str + ' ' + now_hour + ':' + now_minite){
                alert('과거시점으로 입력하실 수 없습니다.');
                $(obj).val('');
                return false;
            }
            break;
    }
}

function setPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt').val();
	var result_cnt = $(obj).parent().find('.result_cnt').val();

	$('.cnt_total').text(total_cnt);
	$('.cnt_result').text(result_cnt);
}
function selectAllClick(obj, type) {
	if ($(obj).prop('checked') == true) {
		$("#result_"+type+"_table").find('.select').prop('checked',true);
	} else {
		$("#result_"+type+"_table").find('.select').prop('checked',false);
	}
}
function getUrlInfo(obj){
	var searchType = $(obj).attr('searchType');
	var sel_keyType = $('#search_type_'+searchType).val();
	var sel_keyword = $('#search_keyword_'+searchType).val();
	
	$('#frm-'+searchType+'-list').find("input[name='search_type']").val(sel_keyType);
	$('#frm-'+searchType+'-list').find("input[name='search_keyword']").val(sel_keyword);

	var colsNum = 0;
	if(searchType == 'web'){
		colsNum = 3;
	}
	else if(searchType == 'product'){
		colsNum = 4;
	}
	$("#result_"+searchType+"_table").html('');
	var strDiv = `
				<TR>
					<TD class="default_td" colspan="${colsNum}">
						조회 결과가 없습니다
					</TD>
				</TR>
	`;
	$("#result_"+searchType+"_table").append(strDiv);
	
	var rows = $("#frm-"+searchType+"-list").find('.rows').val();
	var page = $("#frm-"+searchType+"-list").find('.page').val();
	
	get_contents($("#frm-"+searchType+"-list"),{
		pageObj : $(".paging_"+searchType),
		html : function(d) {
			if (d.length > 0) {
				$("#result_"+searchType+"_table").html('');
			}
			d.forEach(function(row) {
				var param_first = '';
				var param_second = '';
				var prod_img_td = '';
				if(searchType == 'web'){
					param_first		= row.page_title;
					param_second	= row.page_url;
				}
				else if(searchType == 'product'){
					param_first		= row.product_code;
					param_second	= row.product_name;
					prod_img_td = '<td></td>';
				}
				strDiv = `
					<tr>
						<td>
							<div class="cb__color">
								<label>
									<input class="select" type="checkbox" name="select_idx[]" value="${row.idx}" >
								</label>
							</div>
						</td>
						${prod_img_td}
						<td>
							<span class="result__span">${param_first}</span> 
						</td>
						<td>
							<span class="result__span">${param_second}</span> 
						</db>
					</tr>
				`;
				$("#result_"+searchType+"_table").append(strDiv);
			});
		},
	},rows,page);
}
function addSelectList(type){
	var result_table = $("#result_"+type+"_table");
	if(result_table != null){
		var sel_row = result_table.find('input:checkbox[name="select_idx[]"]:checked');

		sel_row.each(function(idx){
			var idx = $(this).val();
			var tr = $(this).parents('tr');
			var target_box = '';

			if($('#select_'+type+'_table').find('input[name="'+type+'_idx[]"][value="'+idx+'"]').length == 0){
				var cols_first = '';
				var cols_second = '';

				if(type == 'web'){
					cols_first	= tr.children().eq(1).html(); 
					cols_second	= tr.children().eq(2).html();
					target_box = $('#allWebSelect');
				}
				else if(type == 'product'){
					cols_first	= tr.children().eq(2).html(); 
					cols_second	= tr.children().eq(3).html();
					target_box = $('#allProductSelect');
				}

				strDiv = `
						<tr>
							<td>
								<input type='hidden' name="${type}_idx[]" value=${idx}>
								${cols_first}
							</td>
							<td>
								${cols_second}
							</db>
							<td>
								<button type="button" style="font-size:0.5rem;width:60px;height:30px;border:1px solid;background-color:#ffffff;" onclick="delSelectList(this)">제거</button>
							</db>
						</tr>	
				`;
				$('#select_'+type+'_table').append(strDiv);
				
				target_box.prop("checked",false);
				selectAllClick(target_box, type);
			}
		})

	}
}
function delSelectList(obj){
	if(obj != null){
		$(obj).parents('tr').remove();
	}
}
function previewPopup(){
    popup_contents.getById["popup_contents"].exec("UPDATE_CONTENTS_FIELD", []);

	var formData = new FormData();
	formData = $("#frm-update").serializeObject();

	if(formData.location_height.length == 0){
		alert("[팝업 표시 위치] -> [화면위 픽셀]을 입력해주세요", $('input[name=location_height]').focus());
		return false;
	}
	
	if(formData.location_width.length == 0){
		alert("[팝업 표시 위치] -> [왼쪽 픽셀]을 입력해주세요", $('input[name=location_width]').focus());
		return false;
	}
	
	if(formData.size_height.length == 0){
		alert("[팝업 세로픽셀]을 입력해주세요", $('input[name=size_width]').focus());
		return false;
	}

	if(formData.size_width.length == 0){
		alert("[팝업 가로픽셀]을 입력해주세요",$('input[name=size_height]').focus());
		return false;
	}

	if(formData.contents == '<p>&nbsp;</p>'){
		alert("[팝업 내용]을 기입해주세요",$('input[name=title]').focus());
		return false;
	}

	var close_str = '';
	var close_exec_str = '';
    var align_str = '';

	$('.preview_web').html('');

	if(formData.close_flg=='TODAY'){
		close_str 		= '오늘 하루 열지 않기';
	}
	else if(formData.close_flg=='NONE'){
		close_str 		= '다시 열지 않기';
	}

	popupDiv = `
        <div class="popup" style="width:${formData.size_width}px; margin-top: ${formData.location_height}px; margin-left:${formData.location_width}px;">
            <div class="pop__header">
                <div></div>
                <div class="h__title">${formData.title}</div>
                <div class="h__close"><i class="xi-close"></i></div>
            </div>
            <div class="pop__body" style="height:${formData.size_height}px; text-align:${formData.align.toLowerCase()}">
                <div class="b__content">
                    ${formData.contents}
                </div>
            </div>
            <div class="pop__footer">
                <div class="f__box">
                    <div class="f__cookie">${close_str}</div>
                    <div class="f__close">닫기</div>
                </div>
            </div>
        </div>
	`;
	$('.preview_web').prepend(popupDiv);
}
function popupUpdateAction(){
    popup_contents.getById["popup_contents"].exec("UPDATE_CONTENTS_FIELD", []);

	var formData = new FormData();
	formData = $("#frm-update").serializeObject();
	

	var display_flg = $('#frm-update').find("input[name='display_date']:checked").val();
	if (display_flg == "false") {
		var display_start_date = '';
		if($('#display_start_minite').val().length == 0){
			alert('팝업 시작일을 입력해주세요');
			return false;
		}
		display_start_date += $('#display_start_date').val() + ' ';
		display_start_date += $('#display_start_hour').val() + ':';
		display_start_date += $('#display_start_minite').val()==''?'00':$('#display_start_minite').val();

		var display_end_date = '';
		if($('#display_end_minite').val().length == 0){
			alert('팝업 종료일을 입력해주세요');
			return false;
		}
		display_end_date += $('#display_end_date').val() + ' ';
		display_end_date += $('#display_end_hour').val() + ':';
		display_end_date += $('#display_end_minite').val()==''?'00':$('#display_end_minite').val();

		if(display_start_date > display_end_date){
			alert('시작일/종료일 입력이 잘못되었습니다.');
			return false;
		}
		formData.display_start_date = display_start_date;
		formData.display_end_date = display_end_date;
	}

	if(formData.location_height.length == 0){
		alert("[팝업 표시 위치] -> [화면위 픽셀]을 입력해주세요", $('input[name=location_height]').focus());
		return false;
	}
	
	if(formData.location_width.length == 0){
		alert("[팝업 표시 위치] -> [왼쪽 픽셀]을 입력해주세요", $('input[name=location_width]').focus());
		return false;
	}
	
	if(formData.size_height.length == 0){
		alert("[팝업 세로픽셀]을 입력해주세요", $('input[name=size_width]').focus());
		return false;
	}

	if(formData.size_width.length == 0){
		alert("[팝업 가로픽셀]을 입력해주세요",$('input[name=size_height]').focus());
		return false;
	}

	if(formData.title.length == 0){
		alert("[팝업제목]을 입력해주세요",$('input[name=title]').focus());
		return false;
	}

	if(formData.contents == '<p>&nbsp;</p>'){
		alert("[팝업 내용]을 기입해주세요",$('input[name=title]').focus());
		return false;
	}

	
	confirm("팝업을 수정하시겠습니까?",function() {
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "display/popup/put",
			error: function() {
				alert("팝업 생성 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					insertLog("전시관리 > 팝업 관리", "팝업 수정", null);
					alert("팝업 수정 처리에 성공했습니다.",function(){
                        getPopupInfo();
                        modal_close();
                    });
					
				}
			}
		});
	});
}
</script>