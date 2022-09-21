<style>
    .popup{
        background-color: #fff;
    }
    .preview{
        background-image: url('/images/popup/popup__bg.png');
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
<form id='frm-list'>
	<div class="content__card">
		<div class="card__header">
			<h3>팝업 진행 설정</h3>
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

						<input type="radio" id="display_flg_always" class="radio__input display_flg" radio_type="display" value="true" name="display_date" checked>
						<label for="display_flg_always">상시 오픈</label>
						
						<input type="radio" id="display_flg_date" class="radio__input display_flg" radio_type="display" value="false" name="display_date">
						<label for="display_flg_date" style="gap:5px;">진행 기간</label>
						
						<div class="content__date__picker">
							<input id="display_from" class="display_date" type="date" name="display_from" placeholder="From" readonly="" style="width:150px" onChange="displayDateChange(this)" disabled>
							<font class="" >~</font>
							<input id="display_to" class="display_date" type="date" name="display_to" placeholder="To" readonly="" style="width:150px; " onChange="displayDateChange(this)" disabled>
						</div>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">팝업 표시 위치</div>
				<div class="content__row">
					<span>화면 위로부터</span>
					<input style="width:60px;" value="" name="location_height" type="text" onKeyup="this.value=this.value.replace(/[^-0-9]/g,'');"><span>,</span>
					<span>왼쪽부터</span>
					<input style="width:60px;" value="" name="location_width" type="text" onKeyup="this.value=this.value.replace(/[^-0-9]/g,'');">
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
						<input type="radio" id="popup_window_type" class="radio__input" value="LAYER" name="popup_type" checked/>
						<label for="popup_window_type">레이어 팝업</label>
						<input type="radio" id="popup_layer_type" class="radio__input" value="WINDOW" name="popup_type"/>
						<label for="popup_layer_type">윈도우 팝업</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">디바이스</div>
				<div class="content__row">
					<div class="rd__block">
						<input type="radio" id="device_web" class="radio__input" value="WEB" name="device" checked/>
						<label for="device_web">웹</label>
						<input type="radio" id="device_mobile" class="radio__input" value="MOBILE" name="device"/>
						<label for="device_mobile">모바일</label>
						<input type="radio" id="device_all" class="radio__input" value="ALL" name="device"/>
						<label for="device_all">반응형</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">팝업 크기</div>
				<div class="content__row">
					<span>*가로</span>
					<input style="width:60px;" value="" name="size_width" type="text" onKeyup="this.value=this.value.replace(/[^-0-9]/g,'');"><span>픽셀</span>
					<span>*세로</span>
					<input style="width:60px;" value="" name="size_height" type="text" onKeyup="this.value=this.value.replace(/[^-0-9]/g,'');">
					<span>픽셀</span>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">창닫기 방법</div>
				<div class="content__row">
				<div class="rd__block">
						<input type="radio" id="close_today" class="radio__input" value="TODAY" name="close_flg" checked/>
						<label for="close_today">오늘 하루 열지 않음</label>
						<input type="radio" id="close_none" class="radio__input" value="NONE" name="close_flg"/>
						<label for="close_none">다시 열지 않음</label>
					</div>
				</div>
			</div>
			<div class="content__wrap">
				<div class="content__title">문구 정렬</div>
				<div class="content__row">
					<select id="align" name="align" style="width:163px;">
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
	<div class="content__card" style="padding: 20px;">
		<div class="justify-center btn__wrap--lg">
			<div class="blue__color__btn" onClick="popupNewRegistCheck();"><span>모든 항목 저장</span></div>
			<div class="defult__color__btn" onClick="resultTableReset(13);"><span>초기화</span></div>
		</div>
	</div>
</form>
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
<script>
var popup_contents = [];
//var oEditors2 = [];

$(document).ready(function() {

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
});
$('.display_flg').change(function(){
	var val = $(this).val();
	if (val != "false") {
		$('.display_date').val('');
		$('.display_date').attr("disabled", true);
	} else {
		$('.display_date').removeAttr("disabled");
	}
});

function displayDateChange(obj){
	var display_start_date 	= $("input[name='display_from']").val();
	var display_end_date 	= $("input[name='display_to']").val();

	var start_date 	= new Date(display_start_date);
	var end_date 	= new Date(display_end_date);
	
	if (start_date > end_date) {
		alert('진행 시작일/종료일에 올바른 날짜를 입력해주세요.');
		$(obj).val('');
		return false;
	}
}
function setPaging(obj) {
	var total_cnt 	= $(obj).parent().find('.total_cnt').val();
	var result_cnt 	= $(obj).parent().find('.result_cnt').val();

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
	var searchType 	= $(obj).attr('searchType');
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
				var param_first 	= '';
				var param_second 	= '';
				var prod_img_td 	= '';
				if(searchType == 'web'){
					param_first		= row.page_title;
					param_second	= row.page_url;
				}
				else if(searchType == 'product'){
					param_first		= row.product_code;
					param_second	= row.product_name;
					prod_img_td 	= '<td></td>';
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
			var idx 		= $(this).val();
			var tr 			= $(this).parents('tr');
			var target_box 	= '';

			if($('#select_'+type+'_table').find('input[name="'+type+'_idx[]"][value="'+idx+'"]').length == 0){
				var cols_first 	= '';
				var cols_second = '';

				if(type == 'web'){
					cols_first	= tr.children().eq(1).html(); 
					cols_second	= tr.children().eq(2).html();
					target_box 	= $('#allWebSelect');
				}
				else if(type == 'product'){
					cols_first	= tr.children().eq(2).html(); 
					cols_second	= tr.children().eq(3).html();
					target_box 	= $('#allProductSelect');
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
	var formData = new FormData();
	
	popup_contents.getById["popup_contents"].exec("UPDATE_CONTENTS_FIELD", []);
	formData = $("#frm-list").serializeObject();

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

	var close_str 		= '';
	var close_exec_str 	= '';

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
function popupNewRegistCheck(){
	var formData = new FormData();
	formData = $("#frm-list").serializeObject();
	popup_contents.getById["popup_contents"].exec("UPDATE_CONTENTS_FIELD", []);

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
	
	var display_flg = $("input[name='display_date']:checked").val();

	if (display_flg == "false") {
		var display_start_date 	= $("input[name='display_from']").val();
		var display_end_date 	= $("input[name='display_to']").val();

		if (display_start_date.length > 0 && display_end_date.length > 0) {
			var start_date 	= new Date(display_start_date);
			var end_date 	= new Date(display_end_date);
			
			if (start_date > end_date) {
				alert('진열 시작일/종료일에 올바른 날짜를 입력해주세요.',$("input[name='display_from']").focus());
				return false;
			}
		} else {
			alert('진열 시작일/종료일에 정확한 날짜를 입력해주세요.',$("input[name='display_from']").focus());
			return false;
		}
	}
	confirm("팝업을 생성하시겠습니까?",function() {
		$.ajax({
			type: "post",
			data: formData,
			dataType: "json",
			url: config.api + "display/popup/add",
			error: function() {
				alert("팝업 생성 처리에 실패했습니다.");
			},
			success: function(d) {
				if(d.code == 200) {
					insertLog("전시관리 > 팝업 관리", "팝업 생성", null);
					alert("팝업 생성 처리에 성공했습니다.");
					location.href='/display/popup/list';
				}
			}
		});
	});
}
</script>
