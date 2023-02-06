<div class="content__card" style="margin: 0;">
	<form id="frm-M_KEY" action="display/search/modal/keyword/list/get">
		<input type="hidden" class="country" name="country" value="<?=$country?>">
		<input type="hidden" class="sort_type" name="sort_type" value="DESC">
		<input type="hidden" class="sort_value" name="sort_value" value="IDX">
		
		<input type="hidden" class="rows" name="rows" value="10">
		<input type="hidden" class="page" name="page" value="1">

		<div class="card__header">
			<h3>메뉴 전체 검색</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="content__wrap grid__half">
				<div class="half__box__wrap">
					<div class="content__title">메뉴유형</div>
					<div class="content__row">
						<select class="menu_sort" name="menu_sort">
							<option value="L" selected>대</option>
							<option value="M">중</option>
							<option value="S">소</option>
						</select>
					</div>
				</div>
				
				<div class="half__box__wrap">
					<div class="content__title">메뉴타입</div>
					<div class="content__row">
						<div class="rd__block">
							<input id="menu_type_ALL" type="radio" name="menu_type" value="ALL" checked>
							<label for="menu_type_ALL">전체</label>
							
							<input id="menu_type_PR" type="radio" name="menu_type" value="PR" >
							<label for="menu_type_PR">상품</label>
							
							<input id="menu_type_PO" type="radio" name="menu_type" value="PO" >
							<label for="menu_type_PO">게시물</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="content__wrap">
				<div class="content__title">메뉴타이틀</div>
				<div class="content__row">
					<input type="text" name="menu_title" style="width:100%;">
				</div>
			</div>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div toggle="hide"></div>
				<div class="btn__wrap--lg">
					<div  class="blue__color__btn" onClick="getMenuList();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-M_KEY','getMenuList');"><span>초기화</span></div>
					<div class="defult__color__btn" onClick="modal_close();"><span>취소</span></div>
				</div>
			</div>
		</div>
	</form>
</div>

<div class="content__card">
	<form id="frm-list_all">
		<div class="card__header">
			<h3>메뉴 검색 결과</h3>
			<div class="drive--x"></div>
		</div>
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 메뉴 수 <font class="cnt_total info__count" >0</font>개 / 검색결과 <font class="cnt_result info__count" >0</font>개
				</div>
					
				<div class="content__row">
					<select style="width:163px;float:right;margin-right:10px;" onChange="orderChange(this);">
						<option value="CREATE_DATE|DESC">등록일 역순</option>
						<option value="CREATE_DATE|ASC" selected>등록일 순</option>
						<option value="UPDATE_DATE|DESC">삭제일 역순</option>
						<option value="UPDATE_DATE|ASC">삭제일 순</option>
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
					<TABLE id="excel_table" style="width:100%;">
						<THEAD>
							<TR>
								<TH style="width:250px;">메뉴 선택</TH>	
								<TH style="width:250px;">메뉴 타입</TH>
								<TH style="width:500px;">메뉴 타이틀</TH>
								<TH style="width:500px;">메뉴 URL</TH>
							</TR>
						</THEAD>
						<TBODY class="result_table_M_KEY">
							<TR>
								<TD class="default_td" colspan="4" style="text-align:left;">
									조회 결과가 없습니다.
								</TD>
							</TR>
						</TBODY>
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
	getMenuList();
});

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

function checkMenuType(obj) {
	let menu_type = $(obj).val();
	
	if (posting_type != "ALL") {
		$('.menu_type').eq(0).prop('checked',false);
	} else {
		for (let i=1; i<$('.menu_type').length; i++) {
			$('.menu_type').eq(i).prop('checked',false);
		}
	}
}

function setModalPaging(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_total').text(total_cnt.val());
	$('.cnt_result').text(result_cnt.val());
}

function getMenuList(){
	let result_table = $(".result_table_M_KEY");
	result_table.html('');
	
	let strDiv = '';
	strDiv += '<TR>';
	strDiv += '    <TD class="default_td" colspan="13" style="text-align:left;">';
	strDiv += '        조회 결과가 없습니다.';
	strDiv += '    </TD>';
	strDiv += '</TR>';
	
	result_table.append(strDiv);
	
	var rows = $("#frm-M_KEY").find('.rows').val();
	var page = $("#frm-M_KEY").find('.page').val();
	get_contents($("#frm-M_KEY"),{
		pageObj : $(".paging"),
		html : function(d) {
			if (d.length > 0) {
				result_table.html('');
			}
			
			let strDiv = "";
			d.forEach(function(row) {
				strDiv += '<TR>';
				strDiv += '    <TD style="width:5%;">';
				strDiv += '        <div class="btn" menu_sort="' + row.menu_sort + '" menu_idx="' + row.menu_idx + '" onClick="addMenu(this);">';
				strDiv += '            메뉴 선택';
				strDiv += '        </div>';
				strDiv += '    </TD>';
				strDiv += '    <TD style="width:250px;">' + row.menu_type + '</TD>';
				strDiv += '    <TD style="width:500px;">' + row.menu_title + '</TD>';
				strDiv += '    <TD style="width:500px;">' + row.menu_link + '</TD>';
				strDiv += '</TR>';
			});
			
			result_table.append(strDiv);
		},
	},rows, page);
}

function addMenu(obj) {
	let country = $('#country').val();
	let menu_sort = $(obj).attr('menu_sort');
	let menu_idx = $(obj).attr('menu_idx');
	
	$.ajax({
		url: config.api + "display/search/modal/keyword/get",
		type: "post",
		data: {
			'country': country,
			'menu_sort': menu_sort,
			'menu_idx': menu_idx
		},
		dataType: "json",
		error: function() {
			alert('게시물 선택처리중 오류가 발생했습니다.');
		},
		success: function(d) {
			let code = d.code;
			if (code == 200) {
				let data = d.data;
				if (data != null) {
					let frm = $('#frm-KEY_' + country);
					
					frm.find('.menu_idx').val(data[0].menu_idx);
					frm.find('.menu_sort').val(data[0].menu_sort);
					frm.find('.menu_title').val(data[0].menu_title);
					frm.find('.menu_link').val(data[0].menu_link);
					
					modal_close();
				}
			} else {
				alert('게시물 선택처리에 실패했습니다. 선택하려는 게시물을 확인해주세요.');
			}
		}
	});
}
</script>