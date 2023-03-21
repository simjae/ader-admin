<div id="member_detail_INQ">
	<div class="content__card">
		<div class="card__body">
			<form id="frm-INQ" action="modal/board/list/get">
				<input type="hidden" name="country" value="<?=$country?>">
					<input type="hidden" name="member_idx" value="<?=$member_idx?>">
					
				<input type="hidden" class="sort_value" name="sort_value" value="PB.CREATE_DATE">
				<input type="hidden" class="sort_type" name="sort_type" value="DESC">
				
				<input type="hidden" class="rows" name="rows" value="10">
				<input type="hidden" class="page" name="page" value="1">
				
				<div class="card__header">
					<div class="card__header">
						<h3>문의정보 검색</h3>
						<div class="drive--x"></div>
					</div>
				</div>
				
				<div class="card__body">					
					<div class="content__wrap">
						<div class="content__title">작성일</div>
						<div class="content__row">
							<div class="content__date__wrap">
								<div class="content__date__picker">
									<input id="date_from_INQ" class="date_param_INQ" type="date" name="date_from"  placeholder="From" readonly="" style="width:150px">
									<font class="" >~</font>
									<input id="date_to_INQ" class="date_param_INQ" type="date" name="date_to" placeholder="To" readonly="" style="width:150px;">
								</div>
							</div>
						</div>
					</div>
					
					<div class="content__wrap">
						<div class="content__title">게시판 선택</div>
						<div class="content__row">
							<select class="fSelect" name="board_category" style="width:130px;">
								<option value="ALL"> 카테고리 전체</option>
								<option value="DAE">배송/기타문의</option>
								<option value="CAR">취소/환불</option>
								<option value="OAP">주문/결제</option>
								<option value="FAD">출고/배송</option>
								<option value="RAE">반품/교환</option>
								<option value="RST">재입고</option>
								<option value="PIQ">제품문의</option>
								<option value="BAR">블루마크/정가품</option>
								<option value="AFS">A/S</option>
								<option value="VUC">바우처</option>
								<option value="ETC">기타서비스</option>
							</select>
						</div>
					</div>
					
					<div class="content__wrap">
						<div class="content__title">게시글 제목</div>
						<div class="content__row">
							<input type="text" name="board_title" value="" style="width:40%;">
						</div>
					</div>
					
					<div class="content__wrap">
						<div class="content__title">답변 상태</div>
						<div class="content__row">
							<div class="rd__block">
								<input type="radio" id="answer_state_INQ_ALL" class="radio__input" value="" name="answer_status" checked/>
								<label for="answer_state_INQ_ALL">전체보기</label>
								
								<input type="radio" id="answer_state_INQ_NAS" class="radio__input" value="NAS" name="answer_status"/>
								<label for="answer_state_INQ_NAS">답변전</label>
								
								<input type="radio" id="answer_state_INQ_PCS" class="radio__input" value="PCS" name="answer_status"/>
								<label for="answer_state_INQ_PCS">처리중</label>
								
								<input type="radio" id="answer_state_RCP" class="radio__input" value="RCP" name="answer_status"/>
								<label for="answer_state_RCP">답변완료</label>
							</div>
						</div>
					</div>
					
					<div class="content__wrap">
						<div class="content__title">첨부파일 여부</div>
						<div class="content__row">
							<div class="rd__block">
								<input type="radio" id="file_flg_INQ_ALL" class="radio__input" value="" name="file_flg" checked/>
								<label for="file_flg_INQ_ALL">전체보기</label>
								
								<input type="radio" id="file_flg_INQ_TRUE" class="radio__input" value="true" name="file_flg"/>
								<label for="file_flg_INQ_TRUE">있음</label>
								
								<input type="radio" id="file_flg_INQ_FALSE" class="radio__input" value="false" name="file_flg"/>
								<label for="file_flg_INQ_FALSE">없음</label>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		
		<div class="card__footer">
			<div class="footer__btn__wrap">
				<div></div>
				<div class="btn__wrap--lg">
					<div class="blue__color__btn" onClick="getModalInqInfoList();"><span>검색</span></div>
					<div class="defult__color__btn" onClick="init_fileter('frm-filter-INQ', 'getModalInqInfoList')">
						<span>초기화</span></div>
				</div>
			</div>
		</div>
		
		<div class="card__header">
			<h3>문의하기 게시물 목록</h3>
			<div class="drive--x"></div>
		</div>
		
		<div class="card__body">
			<div class="info__wrap " style="justify-content:space-between; align-items: center;">
				<div class="body__info--count">
					<div class="drive--left"></div>
					총 <font class="cnt_INQ_total info__count">0</font>건/검색결과 <font class="cnt_INQ_result info__count">0</font>건
				</div>
					
				<div class="content__row">
					<select class="fSelect" id="eSearchSort" name="searchSort" onChange="orderChange_INQ(this);" align="absmiddle" style="width:130px;float:right;margin-right:10px;">
						<option value="PB.CREATE_DATE|DESC">등록일 역순</option>
						<option value="PB.CREATE_DATE|ASC">등록일 순</option>
						<option value="PB.TITLE|DESC">제목명 역순</option>
						<option value="PB.TITLE|ASC">제목명 순</option>
					</select>	

					<select name="rows" onChange="rowsChange_INQ(this);" style="width: 130px;">
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
					<TABLE>
						<colgroup>
							<col width="150px;">
							
							<col width="auto;">
							<col width="100px;">
							
							<col width="150px;">
							<col width="150px;">
						</colgroup>
						<THEAD>
							<TR>
								<TH>카테고리</TH>
								
								<TH>문의제목</TH>
								<TH>이미지첨부</TH>
								
								<TH>문의상태</TH>
								<TH>작성일</TH>
							</TR>
						</THEAD>
						<TBODY class="result_body">
						</TBODY>
					</TABLE>
				</div>
			</div>
			
			<div class="padding__wrap">
				<input type="hidden" class="total_cnt" value="0" onChange="setPaging_INQ(this);">
				<input type="hidden" class="result_cnt" value="0" onChange="setPaging_INQ(this);">
				<div class="paging_INQ"></div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	getModalInqInfoList();
});

function getModalInqInfoList() {
	let frm = $('#frm-INQ');
	let result_body = $('#member_detail_INQ').find('.result_body');
	
	var rows = frm.find('.rows').val();
	var page = frm.find('.page').val();
	
	get_contents(frm,{
		pageObj : $(".paging_INQ"),
		html : function(d) {
			result_body.html('');
			if (d != null) {
				let strDiv = "";
				d.forEach(function(row) {
					strDiv += '<TR>';
					strDiv += '    <td>' + row.board_category + '</td>';

					strDiv += '    <td>' + row.board_title + '</td>';
					strDiv += '    <td>' + row.file_flg + '</td>';

					strDiv += '    <td>' + row.answer_status + '</td>';
					strDiv += '    <td>' + row.create_date + '</td>';
					strDiv += '</TR>';
				});
				
				result_body.append(strDiv);
			} else {
				let strDiv = "";
				strDiv += '<TR>';
				strDiv += '    <TD colspan="5" style="text-align:left;">';
				strDiv += '        조회결과가 없습니다.';
				strDiv += '    </TD>';
				strDiv += '</TR>';
				
				result_body.append(strDiv);
			}
		},
	},rows, page);
}

function orderChange_INQ(obj) {	
	let frm = $('#frm-INQ');
	var select_value = $(obj).val();
	var order_value = [];
	
	order_value = select_value.split('|');
	
	frm.find('.sort_value').val(order_value[0]);
	frm.find('.sort_type').val(order_value[1]);
	
	getModalMileageInfo();
}

function rowsChange_INQ(obj) {
	let frm = $('#frm-INQ');
	var rows = $(obj).val();

	frm.find('.rows').val(rows);
	frm.find('.page').val(1);
	
	getModalMileageInfo();
}

function setPaging_INQ(obj) {
	var total_cnt = $(obj).parent().find('.total_cnt');
	var result_cnt = $(obj).parent().find('.result_cnt');
	
	$('.cnt_INQ_total').text(total_cnt.val());
	$('.cnt_INQ_result').text(result_cnt.val());
}
</script>
        