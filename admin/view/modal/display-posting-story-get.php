<div class="content__card" style="margin: 0;">
	<input id="param" type="hidden" value="<?=$param?>">
	<form id="frm-filter_modal" action="display/posting/story/modal/list/get">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="IDX">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>게시물 전체 검색
				<a onclick="modal_close();" class="btn-close" style="float:right">
					<i class="xi-close"></i>
				</a>
			</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">국가</div>
					<div class="content__row" style="display: block;">
						<select class="fSelect eSearch" name="country" style="width:163px;">
							<option value="ALL" selected>전체</option>
							<option value="KR">한국몰</option>
							<option value="EN">영문몰</option>
							<option value="CN">중문몰</option>
						</select>
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">게시물 타입</div>
					<div class="content__row">
						<div class="cb__color">
							<label>
								<input class="posting_type" type="checkbox" name="posting_type[]" value="ALL" onClick="checkPostingType(this);" checked>
								<span>전체</span>
							</label>
							
							<label>
								<input class="posting_type" type="checkbox" name="posting_type[]" value="EDTL" onClick="checkPostingType(this);">
								<span>에디토리얼</span>
							</label>
							
							<label>
								<input class="posting_type" type="checkbox" name="posting_type[]" value="RNWY" onClick="checkPostingType(this);">
								<span>런웨이</span>
							</label>
							
							<label>
								<input class="posting_type" type="checkbox" name="posting_type[]" value="COLC" onClick="checkPostingType(this);">
								<span>컬렉션</span>
							</label>
							
							<label>
								<input class="posting_type" type="checkbox" name="posting_type[]" value="COLA" onClick="checkPostingType(this);">
								<span>콜라보레이션</span>
							</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">타이틀</div>
				<div class="content__row">
					<input type="text" name="page_title" style="width:100%;">
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">메모</div>
				<div class="content__row">
					<input type="text" name="page_memo" style="width:100%;">
				</div>
			</div>
							
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">게시물 진열 상태</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="display_status_all" type="radio" name="display_status" value="ALL" checked>
							<label for="display_status_all">전체</label>
							
							<input id="display_status_dpc" type="radio" name="display_status" value="DPC">
							<label for="display_status_dpc">진열중</label>
							
							<input id="display_status_dwt" type="radio" name="display_status" value="DWT">
							<label for="display_status_dwt">진열대기</label>
							
							<input id="display_status_ded" type="radio" name="display_status" value="DED">
							<label for="display_status_ded">진열종료</label>
							
							<input id="display_status_dno" type="radio" name="display_status" value="DNO">
							<label for="display_status_dno">진열안함</label>
						</div>
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">게시물 진열 기간</div>
					<div class="content__row">
						<div class="content__date__picker">
							<input class="date_param margin-bottom-6" type="date" name="display_start_date" placeholder="From" style="width:150px;">
							<font>~</font>
							<input class="date_param" type="date" name="display_end_date" placeholder="To" readonly style="width:150px;">
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div toggle="hide"></div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getPostingPage();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter_modal','getPostingPage');"><span>초기화</span></div>
					<div class="defult__color__btn" onClick="modal_close();"><span>취소</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="content__card">
	<form id="frm-list_all">
		<div class="card__header">
			<h3>게시물 검색 결과</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 상품 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
				</div>
					
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
						<option value="CREATE_DATE|DESC">등록일 역순</option>
						<option value="CREATE_DATE|ASC" selected>등록일 순</option>
						<option value="PRODUCT_NAME|DESC">상품명 역순</option>
						<option value="PRODUCT_NAME|ASC">상품명 순</option>
					</select>
					<select name="rows" style="width:163px;margin-right:10px;float:right;" onChange="rowsChange(this);">
						<option value="10" selected>10개씩보기</option>
						<option value="20">20개씩보기</option>
						<option value="30">30개씩보기</option>
						<option value="50">50개씩보기</option>
						<option value="100">100개씩보기</option>
						<option value="200">200개씩보기</option>
						<option value="300">300개씩보기</option>
						<option value="500">500개씩보기</option>
					</select>
				</div>
			</div>
			
			<div class="table table__wrap">
				<div class="overflow-x-auto">
					<TABLE id="page_table_modal" style="width:100%;">
						
					</TABLE>
				</div>
			</div>
			
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" tab_num="ALL" value="0" onChange="setModalPaging(this);">
				<input type="hidden" class="result_cnt" tab_num="ALL" value="0" onChange="setModalPaging(this);">
            	<div class="paging"></div>
        	</div>
		</div>
	</form>
</div>

<script>
$(document).ready(function() {
	getPostingPage();
});

function checkPostingType(obj) {
	let posting_type = $(obj).val();
	
	if (posting_type != "ALL") {
		$('.posting_type').eq(0).prop('checked',false);
	} else {
		for (let i=1; i<$('.posting_type').length; i++) {
			$('.posting_type').eq(i).prop('checked',false);
		}
	}
}

function setModalPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function getPostingPage(){
	let frm = $('#frm-filter_modal');
	let param = $('#param').val();
	let tmp_arr = param.split('_');
	
	let action = tmp_arr[0];
	let country = tmp_arr[1];
	let story_type = tmp_arr[2];
	
	let result_table = $("#result_table_modal");
	result_table.html('');
	
	var strDiv = '';
	strDiv += '<TR>';
	strDiv += '    <TD class="default_td" colspan="13" style="text-align:left;">';
	strDiv += '        조회 결과가 없습니다.';
	strDiv += '    </TD>';
	strDiv += '</TR>';
	
	$("#result_table_modal").append(strDiv);
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();
	get_contents(frm),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				result_table.html('');
			}
			
		},
	},rows, page);
}

function addPostingPage(obj) {
	let param = $('#param').val();
	let tmp_arr = param.split('_');
	
	let action = tmp_arr[0];
	let country = tmp_arr[1];
	let story_type = tmp_arr[2];
	
	let frm = $("#frm-" + action + "_" + country);
	let page_idx = $(obj).attr('page_idx');
	frm.find('.page_idx').val(page_idx);
	
	$.ajax({
		url: config.api + "display/posting/story/modal/get",
		type: "post",
		data: {
			'page_idx': page_idx,
		},
		dataType: "json",
		error: function() {
			alert('게시물 선택처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				let result_table = "result_table_" + action + "_" + country;
				console.log(result_table);
				$('#' + result_table).html('');
				
				let data = d.data;
				if (data != null) {
					data.forEach(function(row) {
						let strDiv = "";
						strDiv += '<TR>';
						strDiv += '    <TD>';
						strDiv += '        <div class="btn" onClick="deletePostingPage(this);">';
						strDiv += '            게시물 삭제';
						strDiv += '        </div>';
						strDiv += '    </TD>';
						strDiv += '    <TD>' + row.posting_type + '</TD>';
						strDiv += '    <TD>' + row.page_title + '</TD>';
						strDiv += '    <TD>' + row.page_memo + '</TD>';
						strDiv += '    <TD>' + row.page_url + '</TD>';
						strDiv += '    <TD>' + row.display_status + '</TD>';
						strDiv += '    <TD>' + row.display_start_date + ' ~ ' + row.display_end_date + '</TD>';
						strDiv += '    <TD>' + row.page_view + '</TD>';
						strDiv += '    <TD>' + row.create_date + '</TD>';
						strDiv += '    <TD>' + row.creater + '</TD>';
						strDiv += '    <TD>' + row.update_date + '</TD>';
						strDiv += '    <TD>' + row.updater + '</TD>';
						strDiv += '</TR>';
						
						$('#' + result_table).append(strDiv);
					});
					
					modal_close();
				}
			} else {
				alert('게시물 선택처리에 실패했습니다. 선택하려는 게시물을 확인해주세요.');
			}
		}
	});
}

function init_fileter(frm_id, func_name){
	var formObj = $('#'+frm_id);
	formObj.find('.rd__block').find('input:radio[value="all"]').prop('checked',true);
	formObj.find('.rd__block').find('input:radio[value="ALL"]').prop('checked',true);

	formObj.find('.fSelect').prop("selectedIndex", 0);

	formObj.find('input[type=checkbox]').attr("checked", false);
	formObj.find('input[type=text]').val('');
	formObj.find('input[type=date]').val('');

	formObj.find('.date__picker').css('background-color','#ffffff');
	formObj.find('.date__picker').css('color','#000000');
	formObj.find('input[name="search_date"]').val('');
	
	$('.posting_type').eq(0).prop('checked',true);
	
	window[func_name]();
}
</script>